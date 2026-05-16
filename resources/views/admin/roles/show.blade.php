<x-layouts.app>

    <div class="space-y-6">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold">
                    Detalle del rol
                </h1>

                <p class="text-sm text-zinc-500">
                    Información y permisos del rol.
                </p>

            </div>

            <flux:button :href="route('admin.roles.index')" wire:navigate>
                Volver
            </flux:button>

        </div>

        <div class="grid gap-6 lg:grid-cols-2">

            <flux:card>

                <div class="space-y-4">

                    <h2 class="text-lg font-semibold">
                        Información general
                    </h2>

                    <div>

                        <p class="text-sm text-zinc-500">
                            Nombre
                        </p>

                        <flux:badge color="indigo">
                            {{ $role->name }}
                        </flux:badge>

                    </div>

                    <div>

                        <p class="text-sm text-zinc-500">
                            Total permisos
                        </p>

                        <p class="font-medium">
                            {{ $role->permissions->count() }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-zinc-500">
                            Fecha creación
                        </p>

                        <p class="font-medium">
                            {{ $role->created_at?->format('d/m/Y H:i') }}
                        </p>

                    </div>

                </div>

            </flux:card>

            <flux:card>

                <div class="space-y-4">

                    <h2 class="text-lg font-semibold">
                        Permisos asignados
                    </h2>

                    <div class="flex flex-wrap gap-2">

                        @forelse($role->permissions as $permission)
                            <flux:badge>
                                {{ $permission->name }}
                            </flux:badge>

                        @empty

                            <p class="text-sm text-zinc-500">
                                Sin permisos asignados.
                            </p>
                        @endforelse

                    </div>

                </div>

            </flux:card>

        </div>

    </div>

</x-layouts.app>
