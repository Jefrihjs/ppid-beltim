<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $date = now()->format('Y-m-d');

        // Cek apakah IP ini sudah berkunjung hari ini?
        $exists = \DB::table('visitors')
            ->where('ip_address', $ip)
            ->where('visit_date', $date)
            ->exists();

        if (!$exists) {
            \DB::table('visitors')->insert([
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
                'visit_date' => $date,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $next($request);
    }
}
