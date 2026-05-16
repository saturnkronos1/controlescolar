<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-zinc-100 dark:bg-zinc-900">


<x-layouts::app.sidebar :title="$title ?? null">
    <main class="lg:pl-72">
        <div class="p-6">
        {{ $slot }}
        </div>
    </main>
</x-layouts::app.sidebar>
</body>
</html>