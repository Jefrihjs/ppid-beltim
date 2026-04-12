<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // DAFTARKAN MIDDLEWARE VISITOR DI SINI
        $middleware->web(append: [
            \App\Http\Middleware\TrackVisitor::class,
        ]);

    }) // Pastikan ada kurung tutup ini
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();