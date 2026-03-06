<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 - Server Error | Inspiro</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-slate-50">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="text-center">
            <h1 class="text-8xl font-bold text-slate-400 mb-4">500</h1>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Something Went Wrong</h2>
            <p class="text-slate-500 mb-8 max-w-md mx-auto">We're experiencing technical difficulties. Please try again later.</p>
            <a href="{{ url('/') }}" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold px-6 py-3 rounded-xl transition-all duration-300">
                Go Home
            </a>
        </div>
    </div>
</body>
</html>
