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
        // Sesuaikan alamatnya menjadi 'public.partials.footer'
        View::composer('public.partials.footer', function ($view) {
            $view->with([
                'todayVisitors' => DB::table('visitors')->whereDate('visit_date', now()->today())->count(),
                'totalVisitors' => DB::table('visitors')->count(),
            ]);
        });
    }
}