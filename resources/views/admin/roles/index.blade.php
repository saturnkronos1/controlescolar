<x-layouts.app>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">
                    Roles
                </h1>

                <p class="text-sm text-zinc-500">
                    Administración de roles y permisos.
                </p>

            </div>

            @can('roles.crear')
                <flux:button :href="route('admin.roles.create')" variant="primary" wire:navigate>
                    Nuevo rol
                </flux:button>
            @endcan

        </div>

        <flux:card>

            <form method="GET" class="mb-6">

                <flux:input name="buscar" :value="request('buscar')" placeholder="Buscar rol..." />

            </form>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">

                    <thead>

                        <tr>

                            <th class="px-4 py-3 text-left">
                                Nombre
                            </th>

                            <th class="px-4 py-3 text-left">
                                Permisos
                            </th>

                            <th class="px-4 py-3 text-left">
                                Fecha
                            </th>

                            <th class="px-4 py-3 text-left">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">

                        @forelse($roles as $role)
                            <tr>

                                <td class="px-4 py-3">

                                    <flux:badge color="indigo">
                                        {{ $role->name }}
                                    </flux:badge>

                                </td>

                                <td class="px-4 py-3">

                                    <flux:badge>
                                        {{ $role->permissions->count() }}
                                        permisos
                                    </flux:badge>

                                </td>

                                <td class="px-4 py-3">
                                    {{ $role->created_at?->format('d/m/Y') }}
                                </td>

                                <td class="px-4 py-3">

                                    <div class="flex gap-2">

                                        @can('roles.ver')
                                            <flux:button size="sm" :href="route('admin.roles.show', $role)" wire:navigate>
                                                Ver
                                            </flux:button>
                                        @endcan

                                        @can('roles.editar')
                                            <flux:button size="sm" variant="primary"
                                                :href="route('admin.roles.edit', $role)" wire:navigate>
                                                Editar
                                            </flux:button>
                                        @endcan

                                        @can('roles.eliminar')
                                            @if (!in_array($role->name, ['Super Admin', 'Administrador']))
                                                <form method="POST" action="{{ route('admin.roles.destroy', $role) }}">

                                                    @csrf
                                                    @method('DELETE')

                                                    <flux:button type="submit" size="sm" variant="danger">
                                                        Eliminar
                                                    </flux:button>

                                                </form>
                                            @endif
                                        @endcan

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="px-4 py-6 text-center text-zinc-500">
                                    No hay roles registrados.
                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-6">
                {{ $roles->links() }}
            </div>

        </flux:card>

    </div>

</x-layouts.app>