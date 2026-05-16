<?php

declare(strict_types=1);

use App\Http\Controllers\Direccion\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    'verified',
    'role:Director|Subdirector',
])->prefix('direccion')
    ->name('direccion.')
    ->group(function (): void {

        Route::get(
            'dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');
    });