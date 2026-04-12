<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Tambahkan ini
use Illuminate\Support\Facades\DB;   // Tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    public function register(): void { /* ... */ }

    public function boot(): void
    {
        // Kirim data visitor khusus ke file footer
        View::composer('layouts.footer', function ($view) {
            $view->with([
                'todayVisitors' => DB::table('visitors')->where('visit_date', now()->format('Y-m-d'))->count(),
                'totalVisitors' => DB::table('visitors')->count(),
            ]);
        });
    }
}