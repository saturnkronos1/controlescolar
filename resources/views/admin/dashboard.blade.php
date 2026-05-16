<x-layouts.app>
    <div class="space-y-8">
        {{-- HEADER --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
                    Dashboard Administrativo
                </h1>

                <p class="mt-1 text-sm text-zinc-500">
                    Panel principal del sistema de control escolar.
                </p>
            </div>

        </div>

        {{-- MÉTRICAS --}}
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            @can('alumnos.ver')
            <flux:card>
                <div class="space-y-2">
                    <p class="text-sm text-zinc-500">
                        Total alumnos
                    </p>

                    <h2 class="text-3xl font-bold">
                        {{ $totalAlumnos ?? 0 }}
                    </h2>
                </div>
            </flux:card>
            @endcan

            @can('docentes.ver')
            <flux:card>
                <div class="space-y-2">
                    <p class="text-sm text-zinc-500">
                        Docentes
                    </p>

                    <h2 class="text-3xl font-bold">
                        {{ $totalDocentes ?? 0 }}
                    </h2>
                </div>
            </flux:card>
            @endcan

            @can('grupos.ver')
            <flux:card>
                <div class="space-y-2">
                    <p class="text-sm text-zinc-500">
                        Grupos activos
                    </p>

                    <h2 class="text-3xl font-bold">
                        {{ $totalGrupos ?? 0 }}
                    </h2>
                </div>
            </flux:card>
            @endcan

            <flux:card>
                <div class="space-y-2">
                    <p class="text-sm text-zinc-500">
                        Ciclo escolar
                    </p>

                    <h2 class="text-lg font-semibold">
                        2025 - 2026
                    </h2>
                </div>
            </flux:card>

        </div>

        {{-- ACCESOS RÁPIDOS --}}
        <div class="grid gap-6 lg:grid-cols-2">

            <flux:card>
                <div class="space-y-5">

                    <div>
                        <h2 class="text-lg font-semibold">
                            Accesos rápidos
                        </h2>

                        <p class="text-sm text-zinc-500">
                            Módulos principales del sistema.
                        </p>
                    </div>

                    <div class="grid gap-3">

                        @can('alumnos.ver')
                            <a href="{{ route('admin.alumnos.index') }}"
                            wire:navigate
                                class="rounded-xl border border-zinc-200 p-4 hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-800"
                            >
                                Alumnos
                            </a>
                        @endcan

                        @can('grados.ver')
                            {{-- <a
                                href="{{ route('admin.grados.index') }}"
                                wire:navigate
                                class="rounded-xl border border-zinc-200 p-4 hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-800"
                            > --}}
                                Grados
                            </a>
                        @endcan

                        @can('grupos.ver')
                            {{-- <a
                                href="{{ route('admin.grupos.index') }}"
                                wire:navigate
                                class="rounded-xl border border-zinc-200 p-4 hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-800"
                            > --}}
                                Grupos
                            </a>
                        @endcan

                    </div>

                </div>
            </flux:card>

            <flux:card>
                <div class="space-y-5">

                    <div>
                        <h2 class="text-lg font-semibold">
                            Actividad reciente
                        </h2>

                        <p class="text-sm text-zinc-500">
                            Últimos movimientos del sistema.
                        </p>
                    </div>

                    <div class="space-y-3">

                        <div class="rounded-xl border border-zinc-200 p-4 dark:border-zinc-700">
                            Sistema inicializado correctamente.
                        </div>

                        <div class="rounded-xl border border-zinc-200 p-4 dark:border-zinc-700">
                            Configuración RBAC activa.
                        </div>

                    </div>

                </div>
            </flux:card>

        </div>

    </div>
</x-layouts.app>
