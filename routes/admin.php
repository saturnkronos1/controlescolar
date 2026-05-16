<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AlumnoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    'verified',
    'role:Super Admin|Administrador',
])->prefix('admin')
    ->name('admin.')
    ->group(function (): void{

    Route::get(
        'dashboard',
        [DashboardController::class,'index']
    )->name('dashboard');

    Route::resource(
        'usuarios',                                                                                                                                                                   
        UsuarioController::class
    )->parameters([
        'usuarios' => 'usuario',
    ])
    ->middleware('permission:usuarios.ver');

    Route::resource(
        'roles',
        RolController::class
    )->parameters([
        'roles' => 'role',
    ])
    ->middleware('permission:roles.ver');

    Route::resource(
        'alumnos',
        AlumnoController::class
    )->parameters([
        'alumnos' => 'alumno',
    ]);
    
});