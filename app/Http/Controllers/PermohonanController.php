<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Permohonan;

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
        // Validasi input
        $request->validate([
            'kode_permohonan' => 'required|string|size:7', // Validasi panjang harus 7
            'nik' => 'required|numeric'
        ], [
            'kode_permohonan.required' => 'Kode permohonan wajib diisi',
            'kode_permohonan.size' => 'Kode permohonan harus berjumlah 7 karakter',
            'nik.required' => 'NIK wajib diisi untuk verifikasi data'
        ]);

        // Cari data: Input 'kode_permohonan' dicocokkan ke kolom 'nomor_registrasi'
        $permohonan = Permohonan::where('nomor_registrasi', $request->kode_permohonan)
            ->where('nik', $request->nik)
            ->first();

        if (!$permohonan) {
            return back()->with('error', 'Data tidak ditemukan. Silakan periksa kembali Kode Permohonan dan NIK Anda.');
        }

        return view('public.monitoring_result', compact('permohonan'));
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
        // 1. Validasi Input
        $request->validate([
            'kategori_pemohon' => 'required|in:perorangan,lembaga',
            'nama' => 'required|string|max:255',
            'nik' => 'required|digits_between:8,20',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'rincian_informasi' => 'required|string',
            'tujuan_penggunaan' => 'required|string',
            'cara_memperoleh' => 'required',
            'jenis_salinan' => 'required',
            'cara_pengiriman' => 'required',
        ]);

        // 2. GENERATE KODE PERMOHONAN ACAK (Untuk Monitoring sesuai Gambar 1)
        // Ini yang akan disimpan ke database kolom 'nomor_registrasi'
        do {
            $kodeMonitoring = Str::lower(Str::random(7));
        } while (Permohonan::where('nomor_registrasi', $kodeMonitoring)->exists());

        // 3. SIMPAN KE DATABASE
        $permohonan = Permohonan::create([
            'nomor_registrasi' => $kodeMonitoring, // Kode pendek: 3bde57d
            'kategori_pemohon' => $request->kategori_pemohon,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'rincian_informasi' => $request->rincian_informasi,
            'tujuan_penggunaan' => $request->tujuan_penggunaan,
            'cara_memperoleh' => $request->cara_memperoleh,
            'jenis_salinan' => $request->jenis_salinan,
            'cara_pengiriman' => $request->cara_pengiriman,
            'status' => 'pending',
        ]);

        // 4. REDIRECT KE HALAMAN SUKSES (Membawa Kode Pendek & Trigger SweetAlert)
        return redirect()->route('permohonan.sukses')->with([
            'sukses_kirim' => true,
            'kode' => $kodeMonitoring // Inilah yang muncul di "Kode Permohonan : 3bde57d"
        ]);
    }

    /**
     * Dashboard Admin: Daftar Semua Permohonan
     */
    public function index()
    {
        $permohonans = Permohonan::latest()->paginate(10);
        return view('admin.permohonan.index', compact('permohonans'));
    }

    /**
     * Dashboard Admin: Detail Permohonan
     */
    public function show($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        return view('admin.permohonan.show', compact('permohonan'));
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
}