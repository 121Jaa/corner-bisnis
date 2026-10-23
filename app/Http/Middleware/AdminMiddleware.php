<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek user aktif
        if (!auth()->user()->is_active) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Akun kamu tidak aktif. Hubungi admin.');
        }

        // Kalau BUKAN admin, redirect ke dashboard user TANPA NOTIF ERROR
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}