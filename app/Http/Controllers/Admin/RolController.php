<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware(
                'permission:roles.ver',
                only: ['index', 'show']
            ),

            new Middleware(
                'permission:roles.crear',
                only: ['create', 'store']
            ),

            new Middleware(
                'permission:roles.editar',
                only: ['edit', 'update']
            ),

            new Middleware(
                'permission:roles.eliminar',
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

        $roles = Role::query()

            ->with('permissions')

            ->when(
                $buscar,
                fn($query) => $query
                    ->where(
                        'name',
                        'like',
                        "%{$buscar}%"
                    )
            )

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view(
            'admin.roles.index',
            compact(
                'roles'
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
        $permissions = Permission::query()

            ->orderBy('name')

            ->get()

            ->groupBy(
                fn($permission) => explode(
                    '.',
                    $permission->name
                )[0]
            );

        return view(
            'admin.roles.create',
            compact(
                'permissions'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request
    ): RedirectResponse {

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:roles,name',
            ],

            'permissions' => [
                'nullable',
                'array',
            ],
        ]);

        $role = Role::create([

            'name' => $validated['name'],

            'guard_name' => 'web',
        ]);

        $role->syncPermissions(
            $validated['permissions'] ?? []
        );

        return redirect()

            ->route(
                'admin.roles.index'
            )

            ->with(
                'success',
                'Rol creado correctamente.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        Role $role
    ): View {

        $role->load('permissions');

        return view(
            'admin.roles.show',
            compact(
                'role'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        Role $role
    ): View {

        $permissions = Permission::query()

            ->orderBy('name')

            ->get()

            ->groupBy(
                fn($permission) => explode(
                    '.',
                    $permission->name
                )[0]
            );

        $role->load('permissions');

        return view(
            'admin.roles.edit',
            compact(
                'role',
                'permissions',
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Role $role
    ): RedirectResponse {

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:roles,name,' . $role->id,
            ],

            'permissions' => [
                'nullable',
                'array',
            ],
        ]);

        if (
            in_array($role->name, [
                'Super Admin',
                'Administrador',
            ])
        ) {

            $validated['name'] = $role->name;
        }

        $role->update([

            'name' => $validated['name'],
        ]);

        $role->syncPermissions(
            $validated['permissions'] ?? []
        );

        return redirect()

            ->route(
                'admin.roles.index'
            )

            ->with(
                'success',
                'Rol actualizado correctamente.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Role $role
    ): RedirectResponse {

        if (
            in_array($role->name, [
                'Super Admin',
                'Administrador',
            ])
        ) {

            return back()->with(
                'error',
                'No se puede eliminar este rol.'
            );
        }

        $role->delete();

        return redirect()

            ->route(
                'admin.roles.index'
            )

            ->with(
                'success',
                'Rol eliminado correctamente.'
            );
    }
}
