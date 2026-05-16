@extends('layouts.main')
@section('content')
    <div class="w-full space-y-6">

        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-3xl font-bold">
                    Usuarios
                </h1>

                <p class="text-sm text-zinc-500">
                    Administración de usuarios del sistema.
                </p>
            </div>

            @can('usuarios.crear')
                <flux:button :href="route('admin.usuarios.create')" variant="primary" wire:navigate>
                    Nuevo usuario
                </flux:button>
            @endcan

        </div>

        <div class="overflow-hidden rounded-xl border border-zinc-200
        bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-800">

            <form method="GET" class="mb-6">
                <flux:input name="buscar" :value="request('buscar')" placeholder="Buscar usuario..." />
            </form>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">

                    <thead>
                        <tr>

                            <th class="px-4 py-3 text-left">
                                Nombre
                            </th>

                            <th class="px-4 py-3 text-left">
                                Correo
                            </th>

                            <th class="px-4 py-3 text-left">
                                Rol
                            </th>
                            @canany(['usuarios.editar', 'usuarios.eliminar'])
                                <th class="px-4 py-3 text-left">
                                    Acciones
                                </th>
                            @endcanany
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">

                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td class="px-4 py-3">
                                    {{ $usuario->name }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $usuario->email }}
                                </td>
                                <td class="px-4 py-3">
                                    <flux:badge color="indigo">
                                        {{ $usuario->roles->first()?->name }}
                                    </flux:badge>
                                </td>
                                @canany(['usuarios.editar', 'usuarios.eliminar'])
                                    <td class="px-4 py-3">
                                        @include('admin.usuarios.partials.actions')
                                    </td>
                                @endcanany
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="mt-6">
                {{ $usuarios->links() }}
            </div>

        </div>

    </div>

@endsection
