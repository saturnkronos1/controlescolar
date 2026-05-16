<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modulos = [

            'usuarios',
            'roles',

            'ciclos-escolares',
            'grados',
            'grupos',
            'materias',

            'alumnos',
            'docentes',
            'tutores',

            'inscripciones',
            'calificaciones',
            'asistencias',

            'reportes',

        ];

        $acciones = [
            'ver',
            'crear',
            'editar',
            'eliminar',
        ];

        foreach ($modulos as $modulo) {

            foreach ($acciones as $accion) {

                Permission::firstOrCreate([
                    'name' => "{$modulo}.{$accion}",
                    'guard_name' => 'web',
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | PERMISOS ESPECIALES
        |--------------------------------------------------------------------------
        */

        $permisosEspeciales = [

            'roles.asignar',

            'dashboard.admin',
            'dashboard.direccion',
            'dashboard.docente',
            'dashboard.tutor',

            'reportes.descargar',

            'calificaciones.capturar',
            'asistencias.capturar',

            'portal-tutor.ver',

        ];

        foreach ($permisosEspeciales as $permiso) {

            Permission::firstOrCreate([
                'name' => $permiso,
                'guard_name' => 'web',
            ]);
        }
    }
}
