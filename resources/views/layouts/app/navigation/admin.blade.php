{{-- =========================================
SUPER ADMIN / ADMINISTRADOR
========================================= --}}

<flux:sidebar.group heading="Administración" class="grid">

    <flux:sidebar.item
        icon="home"
        :href="route('admin.dashboard')"
        :current="request()->routeIs('admin.dashboard')"
        wire:navigate
    >
        Dashboard
    </flux:sidebar.item>

</flux:sidebar.group>

{{-- =========================================
USUARIOS
========================================= --}}

@can('usuarios.ver')

<flux:sidebar.group heading="Usuarios" class="grid">

    <flux:sidebar.item
        icon="users"
        :href="route('admin.usuarios.index')"
        :current="request()->routeIs('admin.usuarios.*')"
        wire:navigate
    >
        Usuarioss
    </flux:sidebar.item>

</flux:sidebar.group>

@endcan

{{-- =========================================
ALUMNOS
========================================= --}}

@can('alumnos.ver')

<flux:sidebar.group heading="Alumnos" class="grid">

    <flux:sidebar.item
        icon="academic-cap"
        :href="route('admin.alumnos.index')"
        :current="request()->routeIs('admin.alumnos.*')"
        wire:navigate
    >
        Gestión de alumnos
    </flux:sidebar.item>

</flux:sidebar.group>

@endcan

{{-- =========================================
GRADOS
========================================= --}}

{{-- @can('grados.ver')

<flux:sidebar.group heading="Académico" class="grid">

    <flux:sidebar.item
        icon="building-library"
        :href="route('admin.grados.index')"
        :current="request()->routeIs('admin.grados.*')"
        wire:navigate
    >
        Grados
    </flux:sidebar.item>

@endcan --}}

{{-- =========================================
GRUPOS
========================================= --}}

{{-- @can('grupos.ver')

    <flux:sidebar.item
        icon="rectangle-group"
        :href="route('admin.grupos.index')"
        :current="request()->routeIs('admin.grupos.*')"
        wire:navigate
    >
        Grupos
    </flux:sidebar.item>

@endcan --}}

{{-- =========================================
MATERIAS
========================================= --}}

{{-- @can('materias.ver')

    <flux:sidebar.item
        icon="book-open"
        :href="route('admin.materias.index')"
        :current="request()->routeIs('admin.materias.*')"
        wire:navigate
    >
        Materias
    </flux:sidebar.item>

@endcan

</flux:sidebar.group> --}}

{{-- =========================================
REPORTES
========================================= --}}

{{-- @can('reportes.ver')

<flux:sidebar.group heading="Reportes" class="grid">

    <flux:sidebar.item
        icon="document-chart-bar"
        :href="route('admin.reportes.index')"
        :current="request()->routeIs('admin.reportes.*')"
        wire:navigate
    >
        Reportes
    </flux:sidebar.item>

</flux:sidebar.group> 

@endcan
--}}