<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PublicInformation;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data dasar
        $query = PublicInformation::where('is_active', true);

        // 2. Filter berdasarkan parameter URL
        if ($request->filled('kelompok')) {
            $query->where('kelompok', $request->kelompok);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 3. Ambil data dan kelompokkan
        // Kita pakai get() dulu baru groupBy di level Collection (lebih aman)
        $informations = $query->get()->groupBy('id_kel');

        // 4. Kirim ke View
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