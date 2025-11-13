<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SystemRequestLogger;
use App\Http\Middleware\RelaxCspForStaticPages;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Global and route middleware
        $middleware->append(SystemRequestLogger::class);
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'relax.csp' => RelaxCspForStaticPages::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

