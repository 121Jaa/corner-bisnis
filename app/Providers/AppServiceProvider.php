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
        // ⭐ Blade directive @active
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

        // ⭐ Share $categories ke semua view — DENGAN TRY-CATCH
        View::composer('*', function ($view) {
            try {
                $categories = \App\Models\Category::with('businesses')->get();
            } catch (Throwable $e) {
                $categories = collect();
                Log::error('Gagal load categories: ' . $e->getMessage());
            }
            $view->with('categories', $categories);
        });
    }
}