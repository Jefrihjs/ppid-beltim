<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories,name']);
        Category::create($request->all());
        return back()->with('success', 'Sub-Judul berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return back()->with('success', 'Sub-Judul diperbarui!');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return back()->with('success', 'Sub-Judul dihapus!');
    }
}