<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeberatanController extends Controller
{
    public function index()
    {
        // Ambil data dari tabel keberatans
        $keberatans = \App\Models\Keberatan::with('permohonan')->latest()->get();

        $stats = [
            'total' => $keberatans->count(),
            'baru' => $keberatans->where('status', 'PENDING')->count(),
            'proses' => $keberatans->where('status', 'DIPROSES')->count(),
            'selesai' => $keberatans->where('status', 'SELESAI')->count(),
        ];

        return view('admin.keberatan.index', compact('keberatans', 'stats'));
    }
}