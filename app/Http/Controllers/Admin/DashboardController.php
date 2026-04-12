<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// PANGGIL SEMUA MODEL SESUAI GAMBAR BAPAK
use App\Models\InformasiPublik;
use App\Models\Permohonan;
use App\Models\ContactMessage;
use App\Models\Hero;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Statistik
        $stats = [
            'total_informasi'  => InformasiPublik::count(),
            'permohonan_baru'  => Permohonan::where('status', 'pending')->count(),
            'pesan_masuk'      => ContactMessage::count(),
            'total_permohonan' => Permohonan::count(),
        ];

        // 2. Siapkan Grafik (7 Hari Terakhir)
        $days = collect();
        $visitorCounts = collect();

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $days->push(now()->subDays($i)->translatedFormat('d M'));
            
            // Cek ke tabel visitors (pastikan migrasinya sudah jalan)
            $count = DB::table('visitors')->where('visit_date', $date)->count();
            $visitorCounts->push($count);
        }

        // 3. Data Visitor Utama
        $todayVisitors = DB::table('visitors')->where('visit_date', now()->format('Y-m-d'))->count();
        $totalVisitors = DB::table('visitors')->count();

        // 4. Data Tabel (Permohonan Terbaru)
        $recent_permohonan = Permohonan::latest()->take(5)->get();

        // 5. Kirim ke View
        return view('admin.dashboard', compact(
            'stats', 
            'days', 
            'visitorCounts', 
            'todayVisitors', 
            'totalVisitors', 
            'recent_permohonan'
        ));
    }
}