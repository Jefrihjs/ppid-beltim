<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\Keberatan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil inputan dari URL (?jenis=...&tahun=...)
        $jenis = $request->get('jenis', 'permohonan'); // default permohonan
        $tahun = $request->get('tahun', date('Y'));    // default tahun sekarang

        // 2. Logika penarikan data berdasarkan pilihan Admin
        if ($jenis == 'keberatan') {
            // Tarik data dari tabel keberatans yang ada di tahun terpilih
            $permohonans = Keberatan::with('permohonan')
                            ->whereYear('created_at', $tahun)
                            ->latest()
                            ->get();
        } else {
            // Tarik data dari tabel permohonans yang ada di tahun terpilih
            $permohonans = Permohonan::whereYear('created_at', $tahun)
                            ->latest()
                            ->get();
        }

        // 3. Lempar data ke view
        return view('admin.laporan.index', compact('permohonans'));
    }

    public function cetakSemua(Request $request)
    {
        // Samakan logikanya dengan index supaya yang diprint sesuai dengan yang difilter
        $jenis = $request->get('jenis', 'permohonan');
        $tahun = $request->get('tahun', date('Y'));

        if ($jenis == 'keberatan') {
            $permohonans = Keberatan::with('permohonan')
                            ->whereYear('created_at', $tahun)
                            ->latest()
                            ->get();
            return view('admin.laporan.cetak_keberatan', compact('permohonans', 'tahun'));
        } else {
            $permohonans = Permohonan::whereYear('created_at', $tahun)
                            ->latest()
                            ->get();
            return view('admin.laporan.cetak_semua', compact('permohonans', 'tahun'));
        }
    }
}