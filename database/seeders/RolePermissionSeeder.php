<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ROLES
        |--------------------------------------------------------------------------
        */

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);

        $administrador = Role::firstOrCreate([
            'name' => 'Administrador',
            'guard_name' => 'web',
        ]);

        $director = Role::firstOrCreate([
            'name' => 'Director',
            'guard_name' => 'web',
        ]);

        $subdirector = Role::firstOrCreate([
            'name' => 'Subdirector',
            'guard_name' => 'web',
        ]);

        $docente = Role::firstOrCreate([
            'name' => 'Docente',
            'guard_name' => 'web',
        ]);

        $tutor = Role::firstOrCreate([
            'name' => 'Tutor',
            'guard_name' => 'web',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        $superAdmin->syncPermissions(
            Permission::all()
        );

        /*
        |--------------------------------------------------------------------------
        | ADMINISTRADOR
        |--------------------------------------------------------------------------
        */

        $administrador->syncPermissions([

            'dashboard.admin',

            'usuarios.ver',
            'usuarios.crear',
            'usuarios.editar',

            'roles.ver',

            'ciclos-escolares.ver',
            'ciclos-escolares.crear',
            'ciclos-escolares.editar',
            'ciclos-escolares.eliminar',

            'grados.ver',
            'grados.crear',
            'grados.editar',
            'grados.eliminar',

            'grupos.ver',
            'grupos.crear',
            'grupos.editar',
            'grupos.eliminar',

            'materias.ver',
            'materias.crear',
            'materias.editar',
            'materias.eliminar',

            'alumnos.ver',
            'alumnos.crear',
            'alumnos.editar',
            'alumnos.eliminar',

            'docentes.ver',
            'docentes.crear',
            'docentes.editar',
            'docentes.eliminar',

            'tutores.ver',
            'tutores.crear',
            'tutores.editar',
            'tutores.eliminar',

            'inscripciones.ver',
            'inscripciones.crear',
            'inscripciones.editar',
            'inscripciones.eliminar',

            'calificaciones.ver',

            'asistencias.ver',

            'reportes.ver',
            'reportes.descargar',

            'roles.asignar',
        ]);

        /*
        |--------------------------------------------------------------------------
        | DIRECTOR
        |--------------------------------------------------------------------------
        */

        $director->syncPermissions([

            'dashboard.direccion',

            'usuarios.ver',

            'alumnos.ver',
            'alumnos.crear',
            'alumnos.editar',

            'docentes.ver',

            'grados.ver',
            'grupos.ver',
            'materias.ver',

            'inscripciones.ver',

            'calificaciones.ver',

            'asistencias.ver',

            'reportes.ver',
            'reportes.descargar',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SUBDIRECTOR
        |--------------------------------------------------------------------------
        */

        $subdirector->syncPermissions([

            'dashboard.direccion',

            'alumnos.ver',

            'grados.ver',
            'grupos.ver',
            'materias.ver',

            'inscripciones.ver',

            'calificaciones.ver',

            'asistencias.ver',

            'reportes.ver',
        ]);

        /*
        |--------------------------------------------------------------------------
        | DOCENTE
        |--------------------------------------------------------------------------
        */

        $docente->syncPermissions([

            'dashboard.docente',

            'calificaciones.ver',
            'calificaciones.capturar',

            'asistencias.ver',
            'asistencias.capturar',

            'reportes.ver',
        ]);

        /*
        |--------------------------------------------------------------------------
        | TUTOR
        |--------------------------------------------------------------------------
        */

        $tutor->syncPermissions([

            'dashboard.tutor',

            'portal-tutor.ver',

            'alumnos.ver',

            'calificaciones.ver',

            'asistencias.ver',

            'reportes.ver',
            'reportes.descargar',
        ]);
    }
}
