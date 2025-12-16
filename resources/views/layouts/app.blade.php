@props(['user_username'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"> Bootstrap -->


    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script> <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
         <!-- Check the current URL and include the appropriate navigation layout -->
        @if (request()->is('user/*'))
            @include('layouts.usernav', ['user_username' => $user_username]) <!-- This will include the UserNav layout -->

        @elseif (request()->is('dashboard*'))
            @include('layouts.navigation')
        @else
            @include('layouts.homenav') <!-- This will include the default Navigation layout -->
        @endif
        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
