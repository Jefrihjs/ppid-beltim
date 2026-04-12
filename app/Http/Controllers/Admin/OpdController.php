<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    public function index() {
        $opds = Opd::orderBy('nama_opd')->get();
        return view('admin.opd.index', compact('opds'));
    }

    public function store(Request $request) {
        $request->validate(['nama_opd' => 'required|unique:opds']);
        Opd::create($request->all());
        return back()->with('success', 'OPD baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $opd = Opd::findOrFail($id);
        $opd->update($request->all());
        return back()->with('success', 'Nomenklatur OPD berhasil diperbarui!');
    }
}
