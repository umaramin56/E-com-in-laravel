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
        // === yahan add karo ===
        $middleware->alias([
            'userauth' => \App\Http\Middleware\UserAuth::class,
        ]);

        // Agar chaho to global bhi laga sakte ho (har request pe):
        // $middleware->append(\App\Http\Middleware\UserAuth::class);

        // Ya sirf 'web' group me:
        // $middleware->group('web', [
        //     \App\Http\Middleware\UserAuth::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();