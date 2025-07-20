<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api/admin',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isMember' => \App\Http\Middleware\CheckMembership::class,
            'isAuth' => \App\Http\Middleware\IsAuth::class,
            'hasRole' => \App\Http\Middleware\EnsureUserHasRole::class,
        ]);
//        $middleware->validateCsrfTokens(except: [
//            '*', // allow all origins to enter this server (dev only!)
//        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
