@props(['user_username'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Inspiro') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-gray-900">
    <div class="min-h-screen">
        @if (request()->is('user/*'))
            @include('layouts.usernav', ['user_username' => $user_username])
        @elseif (request()->is('dashboard*'))
            @include('layouts.navigation')
        @else
            @include('layouts.homenav')
        @endif

        @if (isset($header))
        <header class="bg-white border-b border-slate-200">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('scripts')
    <x-toast />
</body>
</html>
