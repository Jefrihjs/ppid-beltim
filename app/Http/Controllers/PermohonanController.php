<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\Keberatan;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PermohonanController extends Controller
{
    /**
     * Menampilkan form monitoring untuk publik
     */
    public function monitoringForm()
    {
        return view('public.monitoring');
    }

    /**
     * Mengecek status permohonan berdasarkan nomor registrasi dan NIK
     */
    public function monitoringCheck(Request $request)
    {
        $kodeInput = trim($request->kode_permohonan);

        // Gunakan LIKE untuk pencarian yang lebih fleksibel
        $permohonan = Permohonan::where('kode_tracking', $request->kode_permohonan)
        ->where('nik', $request->nik)
        ->first();

    if (!$permohonan) {
        return back()->with('error', 'Data tidak ditemukan.');
    }

    // Definisi variabel keberatan agar tidak error di Blade
    $keberatan = \App\Models\Keberatan::where('permohonan_id', $permohonan->id)->first();

    // Kirim data ke view
    return view('public.monitoring_result', [
        'permohonan' => $permohonan,
        'keberatan'  => $keberatan,
        'status'     => strtoupper($permohonan->status) // <--- Tambahkan ini Jef!
    ]);
    }

    /**
     * Menampilkan form input permohonan publik
     */
    public function create()
    {
        return view('public.permohonan');
    }

    /**
     * Menyimpan data permohonan baru
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (Tambahkan validasi file)
        $request->validate([
            'kategori_pemohon'  => 'required|in:perorangan,lembaga',
            'nama'              => 'required|string|max:255',
            'nik'               => 'required|numeric|digits:16',
            'nik.digits'        => 'Nomor NIK harus tepat 16 digit angka.',
            'nik.numeric'       => 'NIK hanya boleh berisi angka.',
            'alamat'            => 'required|string',
            'email'             => 'required|email',
            'no_hp'             => 'required|string|max:20',
            'rincian_informasi' => 'required|string',
            'tujuan_penggunaan' => 'required|string',
            'cara_memperoleh'   => 'required',
            'jenis_salinan'     => 'required',
            'cara_pengiriman'   => 'required',
            'file_ktp'          => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'file_akta'         => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        // 2. GENERATE KODE & NOMOR RESMI
        do {
            $kodeTracking = Str::lower(Str::random(7));
        } while (Permohonan::where('kode_tracking', $kodeTracking)->exists());

        $count = Permohonan::whereYear('created_at', date('Y'))->count() + 1;
        $nomorResmi = sprintf("%03d", $count) . '/PPID/' . $this->getRomawi(date('n')) . '/' . date('Y');

        // 3. LOGIKA UPLOAD FILE
        $filePathKtp = null;
        if ($request->hasFile('file_ktp')) {
            // Simpan ke folder public/ktp
            $filePathKtp = $request->file('file_ktp')->store('ktp', 'public');
        }

        $filePathAkta = null;
        if ($request->hasFile('file_akta')) {
            // Simpan ke folder public/akta
            $filePathAkta = $request->file('file_akta')->store('akta', 'public');
        }

        // 4. SIMPAN KE DATABASE
        $permohonan = Permohonan::create([
            'nomor_registrasi'  => $nomorResmi,  
            'kode_tracking'     => $kodeTracking,
            'kategori_pemohon'  => $request->kategori_pemohon,
            'nama'              => $request->nama,
            'nik'               => $request->nik,
            'alamat'            => $request->alamat,
            'email'             => $request->email,
            'no_hp'             => $request->no_hp,
            'rincian_informasi' => $request->rincian_informasi,
            'tujuan_penggunaan' => $request->tujuan_penggunaan,
            'cara_memperoleh'   => $request->cara_memperoleh,
            'jenis_salinan'     => $request->jenis_salinan,
            'cara_pengiriman'   => $request->cara_pengiriman,
            'file_ktp'          => $filePathKtp,  // Simpan path file KTP
            'file_akta'         => $filePathAkta, // Simpan path file Akta
            'status'            => 'pending',
        ]);

        return redirect()->route('permohonan.sukses')->with([
            'sukses_kirim' => true,
            'kode'         => $kodeTracking
        ]);
    }

    /**
     * Dashboard Admin: Daftar Semua Permohonan
     */
    public function index(Request $request)
    {
        // 1. Ambil Statistik (untuk bagian atas)
        $stats = [
            'total'    => \App\Models\Permohonan::count(),
            'baru'     => \App\Models\Permohonan::where('status', 'pending')->count(),
            'diproses' => \App\Models\Permohonan::where('status', 'diproses')->count(),
            'selesai'  => \App\Models\Permohonan::where('status', 'selesai')->count(),
        ];

        // 2. BUAT VARIABEL INI (Penyebab Error di Gambar Jefri)
        // Ambil data yang statusnya pending untuk list di samping
        $permohonanBaru = \App\Models\Permohonan::where('status', 'pending')->latest()->take(5)->get();

        // 3. Query untuk Tabel Utama
        $query = \App\Models\Permohonan::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $permohonans = $query->latest()->paginate(10)->withQueryString();

        // 4. KIRIM SEMUANYA KE VIEW
        return view('admin.permohonan.index', [
            'permohonans' => $permohonans,
            'stats' => $stats,
            'permohonanBaru' => $permohonanBaru // <--- Harus ada ini Jef!
        ]);
    }

    /**
     * Dashboard Admin: Detail Permohonan
     */
    public function show($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $opds = \DB::table('opds')->orderBy('nama_opd', 'asc')->get();

        // HAPUS LOGIKA UPDATE STATUS OTOMATIS DI SINI
        // Biarkan admin melihat data tanpa mengubah status sistem.

        $keberatan = \App\Models\Keberatan::where('permohonan_id', $id)->first();
        
        // Ambil data untuk sidebar jika diperlukan
        $permohonanBaru = Permohonan::where('status', 'pending')->latest()->take(5)->get();

        return view('admin.permohonan.show', compact('permohonan', 'opds', 'permohonanBaru'));
    }

    /**
     * Dashboard Admin: Update Status Permohonan
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak'
        ]);

        $permohonan = Permohonan::findOrFail($id);
        $permohonan->status = $request->status;
        $permohonan->diproses_oleh = auth()->user()->name ?? 'Admin'; 
        $permohonan->diproses_pada = now();
        $permohonan->save();

        return back()->with('success', 'Status permohonan berhasil diperbarui.');
    }

    /**
     * Dashboard Admin: Cetak Laporan PDF
     */
    public function cetakLaporan(Request $request)
    {
        $data = Permohonan::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->get();

        $pdf = Pdf::loadView('admin.permohonan.pdf_laporan', compact('data'))
                    ->setPaper('a4', 'landscape'); 

        return $pdf->stream('Laporan-PPID-' . now()->format('M-Y') . '.pdf');
    }

    public function storePemberitahuan(Request $request, $id)
    {
        $permohonan = Permohonan::findOrFail($id);

        // Simpan rincian ke tabel ppid_pemberitahuan_tertulis
        \DB::table('ppid_pemberitahuan_tertulis')->updateOrInsert(
            ['id_permohonan' => $id], // <--- Pastikan namanya id_permohonan sesuai di Heidi
            [
                'penguasaan'             => $request->penguasaan_informasi, 
                'nama_opd'               => ($request->penguasaan_informasi == 'opd_lain') ? $request->opd_tujuan : 'Diskominfo',
                'bentuk_fisik'           => $request->bentuk_fisik,
                'total_biaya'            => $request->total_biaya ?? 0,
                'waktu_penyediaan'       => $request->waktu_penyediaan,
                'penjelasan_penghitaman' => $request->penjelasan_penghitaman,
                'updated_at'             => now(),
            ]
        );

        // Update status permohonan utama menjadi DIPROSES
        $permohonan->update(['status' => 'DIPROSES']);

        return back()->with('success', 'Pemberitahuan berhasil disimpan dan dikirim.');
    }

    public function storeKeberatan(Request $request, $id)
    {
        $permohonan = Permohonan::findOrFail($id);
        
        // Validasi input keberatan
        $request->validate([
            'alasan' => 'required',
            'kronologi' => 'required|string',
        ]);

        // Logika nomor: 001/PPID/KEBERATAN/IV/2026
        $count = Keberatan::whereYear('created_at', date('Y'))->count() + 1;
        $no_reg = sprintf("%03d", $count) . '/PPID/KEBERATAN/' . $this->getRomawi(date('n')) . '/' . date('Y');

        // Simpan ke tabel keberatans
        Keberatan::create([
            'permohonan_id' => $id,
            'nomor_registrasi_keberatan' => $no_reg,
            'alasan_kode' => $request->alasan, // Sesuai kolom di Screenshot 111315
            'kronologi' => $request->kronologi,
            'status' => 'PENDING'
        ]);

        // Update status permohonan induk jadi KEBERATAN
        // Ini penting supaya di daftar admin muncul status merah
        $permohonan->update(['status' => 'KEBERATAN']);

        return redirect()->back()->with('success', 'Keberatan #' . $no_reg . ' berhasil dikirim. Silahkan pantau berkala.');
    }

    // Helper untuk angka Romawi
    private function getRomawi($month) {
        $map = [1=>'I', 2=>'II', 3=>'III', 4=>'IV', 5=>'V', 6=>'VI', 7=>'VII', 8=>'VIII', 9=>'IX', 10=>'X', 11=>'XI', 12=>'XII'];
        return $map[$month];
    }

    public function destroy($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        
        // Hapus data keberatan terkait jika ada (opsional)
        \App\Models\Keberatan::where('permohonan_id', $id)->delete();
        
        $permohonan->delete();

        return redirect()->route('admin.permohonan.index')->with('success', 'Data permohonan berhasil dihapus.');
    }

    public function cetakBukti($kode)
    {
        // Ambil data permohonan berdasarkan kode_tracking
        $permohonan = Permohonan::where('kode_tracking', $kode)->firstOrFail();

        // Load view yang tadi kita simpan
        $pdf = Pdf::loadView('public.cetak_bukti_pdf', compact('permohonan'));

        // Set ukuran kertas A4
        $pdf->setPaper('a4', 'portrait');

        // Tampilkan di browser (stream)
        return $pdf->stream('Bukti_Permohonan_' . $kode . '.pdf');
    }

    public function tidakLengkap(Request $request, $id)
    {
        $permohonan = Permohonan::findOrFail($id);
        
        // Pastikan tidak bisa diubah kalau sudah lewat tahap ini
        if($permohonan->status == 'TIDAK_LENGKAP') return back();

        $permohonan->update([
            'status' => 'TIDAK_LENGKAP',
            'keterangan_tindak_lanjut' => $request->rincian_ketidaklengkapan,
            // Ini yang akan muncul di monitoring pemohon
        ]);

        return back()->with('success', 'Pemberitahuan ketidaklengkapan telah dikirim ke pemohon.');
    }

    public function cetakPemberitahuan($id)
    {
        // 1. Cari data permohonan
        $permohonan = Permohonan::find($id);
        
        // Jika ID permohonan tidak ada di DB, jangan lanjut
        if (!$permohonan) {
            return back()->with('error', 'Data permohonan tidak ditemukan.');
        }

        // 2. Proteksi Status
        if (in_array(strtoupper($permohonan->status), ['TIDAK_LENGKAP', 'DITOLAK'])) {
            return $this->cetakPenolakan($id);
        }

        // 3. Ambil data rincian
        $pemberitahuan = \DB::table('ppid_pemberitahuan_tertulis')
                            ->where('id_permohonan', $id)
                            ->first();

        // 4. JANGAN ERROR kalau rincian kosong, kasih object kosong saja sebagai cadangan
        if (!$pemberitahuan) {
            $pemberitahuan = (object) [
                'penguasaan' => '-',
                'nama_opd' => '-',
                'bentuk_fisik' => '-',
                'total_biaya' => 0,
                'waktu_penyediaan' => '-',
                'penjelasan_penghitaman' => '-'
            ];
        }

        $data = [
            'permohonan'    => $permohonan,
            'pemberitahuan' => $pemberitahuan,
            'tanggal_cetak' => date('d-m-Y'), 
        ];

        // 5. Pakai try-catch buat nangkep error rendering PDF
        try {
            // Gunakan global namespace \Pdf untuk Barryvdh
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.permohonan.pdf_pemberitahuan', $data);
            
            $safeName = str_replace(['/', '\\'], '-', $permohonan->nomor_registrasi);
            return $pdf->stream('Surat_' . $safeName . '.pdf');
        } catch (\Exception $e) {
            // Kalau error, munculkan pesan error aslinya di layar buat debug
            return "Gagal render PDF. Error: " . $e->getMessage();
        }
    }

    public function cetakPenolakan($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        
        // Tentukan Judul secara dinamis
        $judulPemberitahuan = (strtoupper($permohonan->status) == 'TIDAK_LENGKAP') 
                            ? 'PEMBERITAHUAN BERKAS TIDAK LENGKAP' 
                            : 'PEMBERITAHUAN PENOLAKAN PERMOHONAN';

        // Siapkan data untuk dikirim ke Blade PDF
        $data = [
            'permohonan'    => $permohonan,
            'judul'         => $judulPemberitahuan,
            'tanggal_cetak' => now()->translatedFormat('d F Y'), 
            // Ambil alasan dari kolom keterangan_tindak_lanjut
            'alasan'        => $permohonan->keterangan_tindak_lanjut ?? 'Berkas tidak memenuhi persyaratan administrasi.'
        ];

        $pdf = \PDF::loadView('admin.permohonan.pdf_penolakan', $data);
        $pdf->setPaper('a4', 'portrait');

        // SOLUSI DISINI: Bersihkan nomor registrasi dari karakter / atau \
        $safeName = str_replace(['/', '\\'], '-', $permohonan->nomor_registrasi);

        // Gunakan $safeName untuk nama file
        return $pdf->stream('Pemberitahuan_' . $safeName . '.pdf');
    }

    public function uploadSelesai(Request $request, $id)
    {
        // 1. Validasi Input
        $request->validate([
            'file_penyelesaian' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // Maks 5MB
        ]);

        $permohonan = Permohonan::findOrFail($id);

        // 2. LOGIKA PROTEKSI (Garda Terdepan)
        // Jika status sudah Ditolak atau Tidak Lengkap, blokir proses upload.
        if (in_array(strtoupper($permohonan->status), ['DITOLAK', 'TIDAK_LENGKAP'])) {
            return back()->with('error', 'Gagal! Permohonan ini sudah dihentikan (Ditolak/Tidak Lengkap) dan tidak dapat diunggah dokumennya.');
        }

        // 3. Proses File
        if ($request->hasFile('file_penyelesaian')) {
            
            // Hapus file lama jika ada (Maintenance Storage)
            if ($permohonan->file_penyelesaian && \Storage::disk('public')->exists($permohonan->file_penyelesaian)) {
                \Storage::disk('public')->delete($permohonan->file_penyelesaian);
            }

            // Simpan file baru
            $path = $request->file('file_penyelesaian')->store('bukti_selesai', 'public');
            
            // 4. Update Database
            $permohonan->update([
                'file_penyelesaian' => $path,
                'status' => 'SELESAI', // Status FINAL
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Permohonan berhasil diselesaikan dan dokumen telah dikirim ke pemohon.');
    }

    public function indexKeberatan()
    {
        $stats = [
            'total'  => \App\Models\Keberatan::count(),
            'baru'   => \App\Models\Keberatan::where('status', 'PENDING')->count(),
            'proses' => \App\Models\Keberatan::where('status', 'DIPROSES')->count(),
            'selesai'=> \App\Models\Keberatan::where('status', 'SELESAI')->count(),
        ];

        $keberatans = \App\Models\Keberatan::with('permohonan')->latest()->paginate(10);

        return view('admin.keberatan.index', compact('keberatans', 'stats'));
    }
}