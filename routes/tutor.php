<?php

declare(strict_types=1);

use App\Http\Controllers\Tutor\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    'verified',
    'role:Tutor',
])->prefix('tutor')
    ->name('tutor.')
    ->group(function (): void {

        Route::get(
            'dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');
    });