<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>
        {{ $title ?? config('app.name') }}
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @include('partials.head')
</head>

<body class="min-h-screen bg-zinc-100 dark:bg-zinc-900">

    @include('layouts.app.sidebar')

    <main class="lg:ml-72 p-6">
        @yield('content')
    </main>

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts

</body>
</html>
