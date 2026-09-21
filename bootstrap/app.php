<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Redirect kalau udah login
        $middleware->redirectUsersTo(function () {
            if (auth()->check()) {
                return auth()->user()->isAdmin()
                    ? route('dashboard')
                    : route('user.dashboard');
            }
            return '/';
        });

        // Redirect kalau belum login
        $middleware->redirectGuestsTo(fn() => route('login'));

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'user'  => \App\Http\Middleware\UserMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
