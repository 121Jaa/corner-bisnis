<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
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

        // ⭐ Kalau BUKAN user, redirect ke dashboard admin
        if (!auth()->user()->isUser()) {
            return redirect()->route('dashboard')
                ->with('error', 'Akses ditolak. Halaman ini hanya untuk pemilik usaha.');
        }

        return $next($request);
    }
}