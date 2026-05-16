<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        /* then: function ():void{ */
            /* Rutas admin */
            /* Route::middleware('web') */
            /* ->prefix('admin')
            ->as('admin.') */
            /* ->group(base_path('routes/admin.php')); */
            /* Rutas direccion */
        /* Route::middleware('web') */
            /* ->prefix('direccion')
            ->as('direccion.') */
            /* ->group(base_path('routes/direccion.php')); */
        /* Rutas docente */
        /* Route::middleware('web') */
            /* ->prefix('docente')
            ->as('docente.') */
            /* ->group(base_path('routes/docente.php')); */
        /* Rutas tutor */
            /* Route::middleware('web') */
            /* ->prefix('tutor')
            ->as('tutor.') */
            /* ->group(base_path('routes/tutor.php')); */
        /* } */
    )
    /* alias cortos para roles y permisos */
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' =>
            \Spatie\Permission\Middleware\RoleMiddleware::class,

            'permission' =>
            \Spatie\Permission\Middleware\PermissionMiddleware::class,
            
            'role_or_permission' =>
            \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
