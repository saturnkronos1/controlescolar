<?php

declare(strict_types=1);

use App\Http\Controllers\Docente\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    'verified',
    'role:Docente',
])->prefix('docente')
    ->name('docente.')
    ->group(function (): void {

        Route::get(
            'dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');
    });