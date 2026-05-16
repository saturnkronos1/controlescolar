{{-- =========================================
PORTAL TUTOR
========================================= --}}

<flux:sidebar.group heading="Portal Tutor" class="grid">

    <flux:sidebar.item
        icon="home"
        :href="route('tutor.dashboard')"
        :current="request()->routeIs('tutor.dashboard')"
        wire:navigate
    >
        Dashboard
    </flux:sidebar.item>

</flux:sidebar.group>

{{-- =========================================
MIS ALUMNOS
========================================= --}}

@if(auth()->user()->can('mis_alumnos.ver'))

<flux:sidebar.group heading="Mis alumnos" class="grid">

    <flux:sidebar.item
        icon="academic-cap"
        :href="route('tutor.alumnos.index')"
        :current="request()->routeIs('tutor.alumnos.*')"
        wire:navigate
    >
        Mis alumnos
    </flux:sidebar.item>

@endif

@if(auth()->user()->can('calificaciones.ver'))

    <flux:sidebar.item
        icon="clipboard-document-check"
        :href="route('tutor.calificaciones.index')"
        :current="request()->routeIs('tutor.calificaciones.*')"
        wire:navigate
    >
        Calificaciones
    </flux:sidebar.item>

@endif

@if(auth()->user()->can('asistencias.ver'))

    <flux:sidebar.item
        icon="check-badge"
        :href="route('tutor.asistencias.index')"
        :current="request()->routeIs('tutor.asistencias.*')"
        wire:navigate
    >
        Asistencias
    </flux:sidebar.item>

@endif

@if(auth()->user()->can('reportes.ver'))

    <flux:sidebar.item
        icon="document-arrow-down"
        :href="route('tutor.reportes.index')"
        :current="request()->routeIs('tutor.reportes.*')"
        wire:navigate
    >
        Reportes PDF
    </flux:sidebar.item>

@endif

</flux:sidebar.group>
