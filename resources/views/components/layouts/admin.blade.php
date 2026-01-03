<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional head content from components -->
    @stack('head')
</head>

<body class="min-h-screen flex flex-col">

<!-- ✅ TOP NAVBAR -->
<header class="bg-gradient-to-r from-[#0b1220] to-[#020617] border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-16 flex items-center justify-between">

            <!-- LEFT: NAV -->
            <nav class="flex items-center space-x-6">
                <a wire:navigate href="{{ route('dashboard') }}"
                   class="text-blue-500 font-medium hover:text-blue-400 transition">
                    Dashboard
                </a>
                <a wire:navigate href="/dashboard/articles"
                   class="text-blue-500 font-medium hover:text-blue-400 transition">
                    Articles Manager
                </a>
            </nav>

        </div>
    </div>
</header>

<!-- ✅ PAGE CONTENT -->
<main class="flex-1 w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
    {{ $slot }}
</main>

<!-- Additional scripts from components -->
@stack('scripts')

</body>
</html>
``_
