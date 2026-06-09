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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AdminAuth::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        // Redirect authenticated users away from guest-only routes (e.g. /admin login page)
        $middleware->redirectUsersTo(function () {
            if (auth()->check() && auth()->user()->role === \App\Enums\RoleEnum::SUPER_ADMIN) {
                return route('admin.dashboard');
            }
            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
