<?php

namespace App\Http\Controllers;

use App\Models\InformasiPublik;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Video;
use App\Models\Category; 

class PublicController extends Controller
{
   // 1. Informasi Utama
    public function dipUtama() {
        $data_informasi = InformasiPublik::with('kategori_kelompok')
            ->where('kelompok', 'utama') // Kolom kelompok
            ->get();
        return view('public.informasi.index', compact('data_informasi'))->with('page_title', 'Informasi Utama');
    }

    // 2. Informasi Pembantu
    public function dipPembantu() {
        $data_informasi = InformasiPublik::with('kategori_kelompok')
            ->where('kelompok', 'pembantu') // Kolom kelompok
            ->get();
        return view('public.informasi.index', compact('data_informasi'))->with('page_title', 'Informasi Pembantu');
    }

    // 3. Informasi Berkala
    public function dipBerkala() {
        $data_informasi = InformasiPublik::with('kategori_kelompok')
            ->where('category', 'berkala') // Kolom category
            ->get();
        return view('public.informasi.index', compact('data_informasi'))->with('page_title', 'Informasi Berkala');
    }

    // 4. Informasi Setiap Saat
    public function dipSetiapSaat() {
        $data_informasi = InformasiPublik::with('kategori_kelompok')
            ->where('category', 'setiap saat') // Cari berdasarkan category setiap saat
            ->get();
        return view('public.informasi.index', compact('data_informasi'))->with('page_title', 'Informasi Setiap Saat');
    }

    // 5. Informasi Serta Merta
    public function dipSertaMerta() {
        $data_informasi = InformasiPublik::with('kategori_kelompok')
            ->where('category', 'serta merta') // Cari berdasarkan category serta merta
            ->get();
        return view('public.informasi.index', compact('data_informasi'))->with('page_title', 'Informasi Serta Merta');
    }

    public function gallery()
    {
        $galleries = Gallery::where('is_active', true)->latest()->get();
        return view('public.gallery', compact('galleries'));
    }

    public function prosedur()
    {
        $announcements = \App\Models\Announcement::where('is_active', true)
                            ->latest()
                            ->paginate(3); 
        return view('public.prosedur', compact('announcements'));
    }

    // 6. Halaman Detail
    public function show($id)
    {
        $informasi = InformasiPublik::with('kategori_kelompok')->findOrFail($id);
        return view('public.informasi.show', [
            'informasi' => $informasi,
            'page_title' => $informasi->title
        ]);
    }

    public function cetakLaporan(Request $request)
    {
        $query = InformasiPublik::with(['kategori_kelompok', 'opd']);

        // Jika user milih OPD tertentu
        if ($request->has('id_org') && $request->id_org != '') {
            $query->where('id_org', $request->id_org);
        }

        $data = $query->get();

        // Pastikan kirim data ke view laporan
        return view('admin.informasi.laporan', compact('data'));
    }

    public function index()
    {
        // 1. Ambil video utama untuk section panduan
        $mainVideo = \App\Models\Video::latest()->first(); // Hapus 'where is_active'

        // 2. Ambil foto untuk section dokumentasi
        $galleries = \App\Models\Gallery::where('is_active', true)->latest()->take(4)->get();

        // 3. Ambil data slide slider (Hero)
        $slides = \App\Models\Hero::where('is_active', true)->orderBy('order')->get();

        return view('public.home', compact('mainVideo', 'galleries', 'slides'));
    }

    public function privacyPolicy()
    {
        // Sesuaikan dengan folder 'pages' dan nama file 'privacy-policy'
        return view('pages.privacy-policy', [
            'page_title' => 'Kebijakan Privasi'
        ]);
    }

    public function termsConditions()
    {
        // Arahkan ke folder pages dan file terms-conditions
        return view('pages.terms-conditions', [
            'page_title' => 'Syarat & Ketentuan'
        ]);
    }
}