<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InformasiPublik; 
use App\Models\Opd;            
use App\Models\Category;

class InformationManagerController extends Controller
{
    public function index(Request $request)
    {
        $query = InformasiPublik::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('opd_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $informations = $query->latest()->paginate(10)->withQueryString();

        return view('admin.informasi.index', compact('informations'));
    }

    public function create() {
        $opds = Opd::all();
        
        $sub_juduls = Category::all(); 
        
        return view('admin.informasi.create', compact('opds', 'sub_juduls'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required|in:berkala,setiap saat,serta merta,dikecualikan', // Tambah dikecualikan
            'opd_name' => 'required', 
        ]);

        InformasiPublik::create($request->all());
        return redirect()->route('admin.informasi.index')->with('success', 'Data berhasil ditambah!');
    }

    public function edit($id)
    {
        $info = InformasiPublik::findOrFail($id);

        $opds = Opd::orderBy('nama_opd','asc')->get();

        $sub_juduls = Category::orderBy('name','asc')->get();

        return view('admin.informasi.edit', compact('info','opds','sub_juduls'));
    }

    public function update(Request $request, $id) 
    {
        $info = InformasiPublik::findOrFail($id);
        $info->update($request->all());
        return redirect()->route('admin.informasi.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id) 
    {
        InformasiPublik::destroy($id);
        return back()->with('success', 'Data berhasil dihapus!');
    }
}