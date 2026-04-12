<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::orderBy('order')->get();
        return view('admin.hero.index', compact('heroes'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hero_title' => 'required',
            'hero_image' => 'required|image|mimes:jpg,png,jpeg|max:10240', 
        ]);

        $file = $request->file('hero_image');
        $newName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension(); 
        
        $file->storeAs('images', $newName, 'public');

        Hero::create([
            'title'         => $request->hero_title,
            'subtitle'      => $request->hero_subtitle,
            'image'         => $newName, 
            'is_active'     => $request->is_active ?? 1,
            'show_title'    => $request->has('show_title'), // Simpan status tombol geser judul
            'show_subtitle' => $request->has('show_subtitle'), // Simpan status tombol geser sub
            'order'         => Hero::count() + 1,
        ]);

        return redirect()->route('admin.hero.index')->with('success', 'Slide berhasil ditambah!');
    }

    public function edit(Hero $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, Hero $hero)
    {
        $request->validate([
            'hero_title' => 'required',
            'hero_image' => 'nullable|image|mimes:jpg,png,jpeg|max:10240',
        ]);

        if ($request->hasFile('hero_image')) {
            if (Storage::exists('public/images/' . $hero->image)) {
                Storage::delete('public/images/' . $hero->image);
            }
            $file = $request->file('hero_image');
            $newName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images', $newName, 'public');
            $hero->image = $newName;
        }

        $hero->title         = $request->hero_title;
        $hero->subtitle      = $request->hero_subtitle;
        
        
        $hero->is_active     = $request->is_active ?? 1; 
        
        $hero->show_title    = $request->has('show_title');
        $hero->show_subtitle = $request->has('show_subtitle');
        
        $hero->save();

        return redirect()->route('admin.hero.index')->with('success', 'Slide berhasil diperbarui!');
    }

    public function destroy(Hero $hero)
    {
        if (Storage::exists('public/images/' . $hero->image)) {
            Storage::delete('public/images/' . $hero->image);
        }
        
        $hero->delete();
        return redirect()->route('admin.hero.index')->with('success', 'Slide berhasil dihapus!');
    }
}