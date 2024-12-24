<?php

use App\Http\Middleware\LastSeen;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RestrictDevAccess;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [LastSeen::class,]);
        $middleware->alias([
            'guest'=>RedirectIfAuthenticated::class,
            'auth'=>Authenticate::class,
            'restrict.dev'=>RestrictDevAccess::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
