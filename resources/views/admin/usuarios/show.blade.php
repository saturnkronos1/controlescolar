@extends('layouts.main')
@section('content')
    <div class="space-y-6">

        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-3xl font-bold">
                    Detalle de usuario
                </h1>
            </div>

            <flux:button
                :href="route('admin.usuarios.index')"
                wire:navigate
            >
                Volver
            </flux:button>

        </div>

        <div class="grid gap-6 md:grid-cols-2">

            <flux:card>

                <div class="space-y-4">

                    <h2 class="text-lg font-semibold">
                        Información general
                    </h2>

                    <div>
                        <p class="text-sm text-zinc-500">
                            Nombre
                        </p>

                        <p class="font-medium">
                            {{ $usuario->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-zinc-500">
                            Correo electrónico
                        </p>

                        <p class="font-medium">
                            {{ $usuario->email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-zinc-500">
                            Rol
                        </p>

                        <flux:badge color="indigo">
                            {{ $usuario->roles->first()?->name }}
                        </flux:badge>
                    </div>

                </div>

            </flux:card>

            <flux:card>

                <div class="space-y-4">

                    <h2 class="text-lg font-semibold">
                        Permisos heredados
                    </h2>

                    <div class="flex flex-wrap gap-2">

                        @foreach($usuario->getAllPermissions() as $permission)

                            <flux:badge>
                                {{ $permission->name }}
                            </flux:badge>

                        @endforeach

                    </div>

                </div>

            </flux:card>

        </div>

    </div>

@endsection
