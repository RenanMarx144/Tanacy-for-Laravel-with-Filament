<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            $centralDomain = config('tenancy.central_domains');

            foreach ($centralDomain as $key => $domain) {
                # code...
                Route::middleware('universal')
                ->domain($domain)
                ->group(base_path('routes/web.php'));
            }

            Route::middleware('universal')->group(base_path('routes/tenant.php'));
        },

        // web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->group('universal', []);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
