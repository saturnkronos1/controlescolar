<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

require __DIR__.'/settings.php';

require __DIR__ . '/admin.php';
require __DIR__ . '/direccion.php';
require __DIR__ . '/docente.php';
require __DIR__ . '/tutor.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
