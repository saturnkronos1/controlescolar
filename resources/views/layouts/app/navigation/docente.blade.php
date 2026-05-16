{{-- =========================================
DOCENTE
========================================= --}}

<flux:sidebar.group heading="Panel Docente" class="grid">

    <flux:sidebar.item
        icon="home"
        :href="route('docente.dashboard')"
        :current="request()->routeIs('docente.dashboard')"
        wire:navigate
    >
        Dashboard
    </flux:sidebar.item>

</flux:sidebar.group>

{{-- =========================================
MIS GRUPOS
========================================= --}}

@if(auth()->user()->can('grupos.ver'))

<flux:sidebar.group heading="Académico" class="grid">

    <flux:sidebar.item
        icon="rectangle-group"
        :href="route('docente.grupos.index')"
        :current="request()->routeIs('docente.grupos.*')"
        wire:navigate
    >
        Mis grupos
    </flux:sidebar.item>

@endif

@if(auth()->user()->can('calificaciones.ver'))

    <flux:sidebar.item
        icon="clipboard-document-check"
        :href="route('docente.calificaciones.index')"
        :current="request()->routeIs('docente.calificaciones.*')"
        wire:navigate
    >
        Calificaciones
    </flux:sidebar.item>

@endif

@if(auth()->user()->can('asistencias.ver'))

    <flux:sidebar.item
        icon="check-badge"
        :href="route('docente.asistencias.index')"
        :current="request()->routeIs('docente.asistencias.*')"
        wire:navigate
    >
        Asistencias
    </flux:sidebar.item>

@endif

</flux:sidebar.group>
