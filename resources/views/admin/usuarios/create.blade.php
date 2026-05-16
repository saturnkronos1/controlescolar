@extends('layouts.main')
@section('content')
    <div class="space-y-6">

        <div>
            <h1 class="text-3xl font-bold">
                Nuevo usuario
            </h1>
        </div>

        <flux:card>

            <form
                method="POST"
                action="{{ route('admin.usuarios.store') }}"
                class="space-y-6"
            >

                @csrf

                <div class="grid gap-6 md:grid-cols-2">

                    <flux:input
                        label="Nombre"
                        name="name"
                        :value="old('name')"
                    />

                    <flux:input
                        label="Correo electrónico"
                        name="email"
                        type="email"
                        :value="old('email')"
                    />

                    <flux:input
                        label="Contraseña"
                        name="password"
                        type="password"
                    />

                    @can('roles.asignar')                               
                    <flux:select label="Rol" name="role">
                        <option value="">Seleccione un rol</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </flux:select>
                    @endcan
                </div>

                <div class="flex justify-end">
                    @can('usuarios.crear')
                        <flux:button type="submit" variant="primary">
                        Guardar usuario
                        </flux:button>
                    @endcan
                </div>
            </form>

        </flux:card>

    </div>

@endsection
