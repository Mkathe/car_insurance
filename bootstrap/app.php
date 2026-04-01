<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\SetLang;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            'is.admin' => IsAdmin::class,
        ]);
        $middleware->web(append: SetLang::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
