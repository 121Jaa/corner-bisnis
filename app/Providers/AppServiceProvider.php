<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
            $view->with('categories', \App\Models\Category::with('businesses')->get());
        });
    }
}