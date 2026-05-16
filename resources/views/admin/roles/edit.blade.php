@extends('layouts.main')
@section('content')
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold">
                Editar rol
            </h1>
            <p class="text-sm text-zinc-500">
                Modificar permisos y configuración.
            </p>
        </div>

        <flux:card>

            <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="space-y-8">

                @csrf
                @method('PUT')

                <div class="grid gap-6 md:grid-cols-2">

                    <flux:input label="Nombre del rol" name="name" :value="old('name', $role->name)" />

                </div>

                <div class="space-y-6">

                    <div>

                        <h2 class="text-lg font-semibold">
                            Permisos
                        </h2>

                    </div>

                    <div class="grid gap-6 lg:grid-cols-2">

                        @foreach ($permissions as $grupo => $permisos)
                            <flux:card>

                                <div class="space-y-4">

                                    <div>

                                        <h3 class="text-lg font-semibold capitalize">
                                            {{ $grupo }}
                                        </h3>

                                    </div>

                                    <div class="space-y-3">

                                        @foreach ($permisos as $permission)
                                            <label class="flex items-center gap-3">

                                                <input type="checkbox" name="permissions[]"
                                                    value="{{ $permission->name }}" class="rounded border-zinc-300"
                                                    @checked($role->permissions->contains('name', $permission->name))>

                                                <span class="text-sm">
                                                    {{ $permission->name }}
                                                </span>

                                            </label>
                                        @endforeach

                                    </div>

                                </div>

                            </flux:card>
                        @endforeach

                    </div>

                </div>

                <div class="flex justify-end">

                    <flux:button type="submit" variant="primary">
                        Actualizar rol
                    </flux:button>

                </div>

            </form>

        </flux:card>

    </div>

@endsection
