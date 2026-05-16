<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Grado;
use App\Models\Grupo;
use App\Models\Alumno;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\CicloEscolar;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\Admin\StoreAlumnoRequest;
use App\Http\Requests\Admin\UpdateAlumnoRequest;

class AlumnoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware(
                'permission:alumnos.ver',
                only: ['index', 'show']
            ),

            new Middleware(
                'permission:alumnos.crear',
                only: ['create', 'store']
            ),

            new Middleware(
                'permission:alumnos.editar',
                only: ['edit', 'update']
            ),

            new Middleware(
                'permission:alumnos.eliminar',
                only: ['destroy']
            ),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(
        Request $request
    ): View {

        $buscar = $request->string(
            'buscar'
        );

        $alumnos = Alumno::query()

            ->with([
                'grado',
                'grupo',
                'cicloEscolar',
                'tutor',
            ])

            ->when(
                $buscar,
                fn($query) => $query
                    ->where(
                        'nombre',
                        'like',
                        "%{$buscar}%"
                    )
                    ->orWhere(
                        'apellido_paterno',
                        'like',
                        "%{$buscar}%"
                    )
                    ->orWhere(
                        'matricula',
                        'like',
                        "%{$buscar}%"
                    )
                    ->orWhere(
                        'curp',
                        'like',
                        "%{$buscar}%"
                    )
            )

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view(
            'admin.alumnos.index',
            compact(
                'alumnos'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create(): View
    {
        $ciclos = CicloEscolar::query()
            ->orderBy('nombre')
            ->get();

        $grados = Grado::query()
            ->orderBy('nombre')
            ->get();

        $grupos = Grupo::query()
            ->orderBy('nombre')
            ->get();

        $tutores = User::role('Tutor')
            ->orderBy('name')
            ->get();

        return view(
            'admin.alumnos.create',
            compact(
                'ciclos',
                'grados',
                'grupos',
                'tutores',
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(
        StoreAlumnoRequest $request
    ): RedirectResponse {

        Alumno::create(
            $request->validated()
        );

        return redirect()

            ->route(
                'admin.alumnos.index'
            )

            ->with(
                'success',
                'Alumno registrado correctamente.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        Alumno $alumno
    ): View {

        $alumno->load([
            'grado',
            'grupo',
            'cicloEscolar',
            'tutor',
        ]);

        return view(
            'admin.alumnos.show',
            compact(
                'alumno'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        Alumno $alumno
    ): View {

        $ciclos = CicloEscolar::query()
            ->orderBy('nombre')
            ->get();

        $grados = Grado::query()
            ->orderBy('nombre')
            ->get();

        $grupos = Grupo::query()
            ->orderBy('nombre')
            ->get();

        $tutores = User::role('Tutor')
            ->orderBy('name')
            ->get();

        return view(
            'admin.alumnos.edit',
            compact(
                'alumno',
                'ciclos',
                'grados',
                'grupos',
                'tutores',
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        UpdateAlumnoRequest $request,
        Alumno $alumno
    ): RedirectResponse {

        $alumno->update(
            $request->validated()
        );

        return redirect()

            ->route(
                'admin.alumnos.index'
            )

            ->with(
                'success',
                'Alumno actualizado correctamente.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Alumno $alumno
    ): RedirectResponse {

        $alumno->delete();

        return redirect()

            ->route(
                'admin.alumnos.index'
            )

            ->with(
                'success',
                'Alumno eliminado correctamente.'
            );
    }
}
