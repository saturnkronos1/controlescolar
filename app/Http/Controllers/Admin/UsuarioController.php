<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\Admin\StoreUsuarioRequest;
use App\Http\Requests\Admin\UpdateUsuarioRequest;

class UsuarioController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware('permission:usuarios.ver',
                only: ['index', 'show']
            ),

            new Middleware(
                'permission:usuarios.crear',
                only: ['create', 'store']
            ),

            new Middleware(
                'permission:usuarios.editar',
                only: ['edit', 'update']
            ),

            new Middleware(
                'permission:usuarios.eliminar',
                only: ['destroy']
            ),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $buscar = $request->string('buscar');

        $usuarios = User::query()
            ->with('roles')
            ->when($buscar,
                fn($query) => $query
                    ->where(
                        'name',
                        'like',
                        "%{$buscar}%"
                    )
                    ->orWhere(
                        'email',
                        'like',
                        "%{$buscar}%"
                    )
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view('admin.usuarios.index',compact('usuarios'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create(): View
    {
        $roles = Role::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.usuarios.create',
            compact(
                'roles'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(
        StoreUsuarioRequest $request
    ): RedirectResponse {

        $usuario = User::create(
            $request->validated()
        );

        $usuario->syncRoles([
            $request->role,
        ]);

        return redirect()

            ->route(
                'admin.usuarios.index'
            )

            ->with(
                'success',
                'Usuario creado correctamente.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        User $usuario
    ): View {

        $usuario->load('roles');

        return view(
            'admin.usuarios.show',
            compact(
                'usuario'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        User $usuario
    ): View {

        $roles = Role::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.usuarios.edit',
            compact(
                'usuario',
                'roles',
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        UpdateUsuarioRequest $request,
        User $usuario
    ): RedirectResponse {

        $usuario->update(
            $request->validated()
        );

        $usuario->syncRoles([
            $request->role,
        ]);

        return redirect()

            ->route(
                'admin.usuarios.index'
            )

            ->with(
                'success',
                'Usuario actualizado correctamente.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(
        User $usuario
    ): RedirectResponse {

        if (
            $usuario->hasRole('Super Admin')
        ) {

            return back()->with(
                'error',
                'No puedes eliminar el Super Admin.'
            );
        }

        $usuario->delete();

        return redirect()

            ->route(
                'admin.usuarios.index'
            )

            ->with(
                'success',
                'Usuario eliminado correctamente.'
            );
    }
}
