<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-zinc-100 dark:bg-zinc-900">

    {{-- Sidebar --}}
    @include('layouts.app.sidebar')

    {{-- Contenido --}}
    <flux:main>
        
            {{ $slot }}
        
    </flux:main>

    {{-- Toasts --}}
    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts

</body>
</html>