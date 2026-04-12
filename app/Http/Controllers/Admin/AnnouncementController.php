<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement; // Pastikan Model Announcement sudah dibuat
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Tampilkan halaman utama manajemen pengumuman
     */
    public function index()
    {
        // Ambil semua pengumuman, urutkan dari yang terbaru
        $announcements = Announcement::latest()->get();
        
        return view('admin.announcement.index', compact('announcements'));
    }

    /**
     * Simpan pengumuman baru ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi input (tambahkan is_floating)
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'is_floating' => 'nullable|boolean'
        ]);

        // 2. Olah upload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan ke folder storage/app/public/announcements
            $imagePath = $request->file('image')->store('announcements', 'public');
        }

        // 3. Simpan data lengkap ke database
        Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'image' => $imagePath,
            'is_floating' => $request->has('is_floating') ? true : false,
            'is_active' => true
        ]);

        return back()->with('success', 'Pengumuman Berhasil Diterbitkan!');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcement.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Jika ada upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($announcement->image) {
                \Storage::disk('public')->delete($announcement->image);
            }
            $data['image'] = $request->file('image')->store('announcements', 'public');
        }

        $data['is_floating'] = $request->has('is_floating');

        $announcement->update($data);

        return redirect()->route('admin.announcement.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }
    /**
     * Hapus pengumuman
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        
        return back()->with('success', 'Pengumuman telah dihapus.');
    }
}