<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ⭐ Blade directive @active — auto-detect active menu
        Blade::directive('active', function ($expression) {
            return "<?php 
                \$patterns = $expression;
                \$active = false;
                foreach ((array) \$patterns as \$pattern) {
                    if (request()->routeIs(\$pattern) || request()->is(\$pattern)) {
                        \$active = true;
                        break;
                    }
                }
                echo \$active ? 'bg-white/10 shadow-inner' : '';
            ?>";
        });

        // ⭐ Share $categories ke SEMUA view (untuk navbar)
        //    Dibungkus try-catch agar kalau DB bermasalah,
        //    halaman error tetap bisa dirender & error asli terlihat.
        View::composer('*', function ($view) {
            try {
                $categories = \App\Models\Category::with('businesses')->get();
            } catch (Throwable $e) {
                // Jangan crash — kirim koleksi kosong agar view tetap render
                $categories = collect();

                // Log supaya kita tahu penyebab sebenarnya (muncul di Vercel Runtime Logs)
                Log::error('Gagal memuat categories untuk navbar: ' . $e->getMessage(), [
                    'exception' => $e,
                ]);
            }

            $view->with('categories', $categories);
        });
    }
}