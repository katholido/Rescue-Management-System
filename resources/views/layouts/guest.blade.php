<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RescueSystem') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Outfit', sans-serif; }
            .auth-bg {
                background: radial-gradient(circle at top right, rgba(239, 68, 68, 0.05), transparent),
                            radial-gradient(circle at bottom left, rgba(59, 130, 246, 0.05), transparent);
            }
        </style>
    </head>
    <body class="antialiased bg-slate-100 text-slate-900 auth-bg min-h-screen flex flex-col justify-center items-center py-12">
        <div class="fixed top-8 left-8">
            <a href="/" class="group flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-red-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Website
            </a>
        </div>
        <div class="mb-8">
            <a href="/" class="flex flex-col items-center gap-2">
                <div class="p-3 bg-red-600 rounded-2xl shadow-xl shadow-red-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-2xl font-bold tracking-tight text-slate-900">Rescue<span class="text-red-600">System</span></span>
            </a>
        </div>

        <div class="w-full sm:max-w-md px-8 py-10 bg-slate-900 shadow-2xl overflow-hidden sm:rounded-[2rem] border border-slate-800 text-white">
            {{ $slot }}
        </div>
    </body>
</html>
