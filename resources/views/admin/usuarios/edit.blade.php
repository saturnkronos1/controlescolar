@extends('layouts.main')
@section('content')

    <div class="space-y-6">

        <div>
            <h1 class="text-3xl font-bold">
                Editar usuario
            </h1>
        </div>

        <flux:card>

            <form
                method="POST"
                action="{{ route('admin.usuarios.update', $usuario) }}"
                class="space-y-6"
            >

                @csrf
                @method('PUT')

                <div class="grid gap-6 md:grid-cols-2">

                    <flux:input
                        label="Nombre"
                        name="name"
                        :value="old('name', $usuario->name)"
                    />

                    <flux:input
                        label="Correo electrónico"
                        name="email"
                        type="email"
                        :value="old('email', $usuario->email)"
                    />

                    <flux:select
                        label="Rol"
                        name="role"
                    >

                        @foreach($roles as $role)

                            <option
                                value="{{ $role->name }}"
                                @selected(
                                    $usuario->roles->first()?->name === $role->name
                                )
                            >
                                {{ $role->name }}
                            </option>

                        @endforeach

                    </flux:select>

                </div>

                <div class="flex justify-end">

                    <flux:button
                        type="submit"
                        variant="primary"
                    >
                        Actualizar usuario
                    </flux:button>

                </div>

            </form>

        </flux:card>

    </div>

@endsection
