<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Video; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        $videos = Video::latest()->get(); // Ambil data video juga
        return view('admin.gallery.index', compact('galleries', 'videos'));
    }

    // Fungsi simpan foto tetap sama
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'caption' => $request->caption,
            'image_path' => $path,
            'is_active' => true
        ]);

        return back()->with('success', 'Foto berhasil diunggah!');
    }

    // --- TAMBAHKAN FUNGSI INI UNTUK VIDEO ---
    public function storeVideo(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'youtube_url' => 'required|url',
        ]);

        // Logika mengambil ID dari URL YouTube
        // Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ -> dQw4w9WgXcQ
        parse_str(parse_url($request->youtube_url, PHP_URL_QUERY), $vars);
        $youtube_id = $vars['v'] ?? null;

        if (!$youtube_id) {
            return back()->with('error', 'Format URL YouTube tidak valid!');
        }

        Video::create([
            'title' => $request->title,
            'youtube_id' => $youtube_id,
            'is_active' => true
        ]);

        return back()->with('success', 'Video berhasil ditambahkan!');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();
        return back()->with('success', 'Foto berhasil dihapus!');
    }

    // Tambahkan hapus video
    public function destroyVideo(Video $video)
    {
        $video->delete();
        return back()->with('success', 'Video berhasil dihapus!');
    }
}