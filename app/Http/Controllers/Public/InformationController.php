<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PublicInformation;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        // 1. JANGAN filter berdasarkan category di sini agar semua tab terisi
        $query = PublicInformation::where('is_active', true);

        // Filter Kelompok (Utama/Pembantu) tetap dipertahankan karena ini beda halaman
        if ($request->filled('kelompok')) {
            $query->where('kelompok', $request->kelompok);
        }

        // Filter Search tetap di level DB agar ringan
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 2. Ambil SEMUA data informasi (Berkala, Setiap Saat, Serta Merta, Dikecualikan)
        // Dengan begini, variabel $informations akan berisi data untuk SEMUA tab
        $informations = $query->get(); 

        // 3. Kirim ke View
        return view('public.informasi.index', compact('informations'));
    }

    public function show($id)
    {
        $info = \App\Models\PublicInformation::findOrFail($id);
        
        // Tambah 1 angka setiap halaman ini dibuka
        $info->increment('views'); 

        return view('public.informasi.show', compact('info'));
    }

    public function download($id)
    {
        $info = \App\Models\PublicInformation::findOrFail($id);
        
        // Tambah angka unduhan di database
        $info->increment('downloads');

        // Lempar user ke link asli (Google Drive / Website)
        return redirect()->away($info->link_url);
    }
}