<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // 1. Use cukup sekali di sini (paling atas)

class VisitorController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Statistik Ringkas
        $stats = [
            'today' => DB::table('visitors')->where('visit_date', now()->format('Y-m-d'))->count(),
            'total' => DB::table('visitors')->count(),
            // Live: Pengunjung yang aktif dalam 5 menit terakhir
            'live'  => DB::table('visitors')->where('updated_at', '>=', now()->subMinutes(5))->count(),
        ];

        // 2. Ambil List Pengunjung Terbaru
        $visitors = DB::table('visitors')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.visitors.index', compact('stats', 'visitors'));
    }

    // 2. Hapus tulisan "use Barryvdh..." yang tadi ada di sini (karena bikin error Trait)

    public function exportPdf()
    {
        $data = [
            'title' => 'LAPORAN STATISTIK PENGUNJUNG PORTAL PPID',
            'date' => now()->format('d F Y'),
            'stats' => [
                'today' => DB::table('visitors')->where('visit_date', now()->format('Y-m-d'))->count(),
                'total' => DB::table('visitors')->count(),
                'this_month' => DB::table('visitors')->whereMonth('created_at', now()->month)->count(),
            ],
            'visitors' => DB::table('visitors')->orderBy('created_at', 'desc')->limit(50)->get()
        ];

        $pdf = Pdf::loadView('admin.visitors.pdf', $data);
        
        // GANTI download() JADI stream()
        return $pdf->stream('Laporan-Pengunjung-PPID.pdf');
    }
}