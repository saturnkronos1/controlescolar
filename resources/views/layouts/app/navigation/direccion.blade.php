{{-- =========================================
DIRECCIÓN
========================================= --}}

<flux:sidebar.group heading="Dirección" class="grid">

    <flux:sidebar.item
        icon="home"
        :href="route('direccion.dashboard')"
        :current="request()->routeIs('direccion.dashboard')"
        wire:navigate
    >
        Dashboard
    </flux:sidebar.item>

</flux:sidebar.group>

{{-- =========================================
ALUMNOS
========================================= --}}

{{-- @if(auth()->user()->can('alumnos.ver'))

<flux:sidebar.group heading="Alumnos" class="grid">

    <flux:sidebar.item
        icon="academic-cap"
        :href="route('direccion.alumnos.index')"
        :current="request()->routeIs('direccion.alumnos.*')"
        wire:navigate
    >
        Alumnos
    </flux:sidebar.item>

</flux:sidebar.group>

@endif --}}

{{-- =========================================
GRADOS Y GRUPOS
========================================= --}}

{{-- <flux:sidebar.group heading="Académico" class="grid">

@if(auth()->user()->can('grados.ver'))

    <flux:sidebar.item
        icon="building-library"
        :href="route('direccion.grados.index')"
        :current="request()->routeIs('direccion.grados.*')"
        wire:navigate
    >
        Grados
    </flux:sidebar.item>

@endif

@if(auth()->user()->can('grupos.ver'))

    <flux:sidebar.item
        icon="rectangle-group"
        :href="route('direccion.grupos.index')"
        :current="request()->routeIs('direccion.grupos.*')"
        wire:navigate
    >
        Grupos
    </flux:sidebar.item>

@endif

@if(auth()->user()->can('materias.ver'))

    <flux:sidebar.item
        icon="book-open"
        :href="route('direccion.materias.index')"
        :current="request()->routeIs('direccion.materias.*')"
        wire:navigate
    >
        Materias
    </flux:sidebar.item>

@endif

</flux:sidebar.group> --}}

{{-- =========================================
REPORTES
========================================= --}}

{{-- @if(auth()->user()->can('reportes.ver'))

<flux:sidebar.group heading="Reportes" class="grid">

    <flux:sidebar.item
        icon="document-chart-bar"
        :href="route('direccion.reportes.index')"
        :current="request()->routeIs('direccion.reportes.*')"
        wire:navigate
    >
        Reportes
    </flux:sidebar.item>

</flux:sidebar.group> --}}

{{-- @endif --}}
