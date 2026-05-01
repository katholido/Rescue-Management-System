<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RescueSystem | Professional Management</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .hero-gradient {
            background: radial-gradient(circle at top right, rgba(239, 68, 68, 0.1), transparent),
                        radial-gradient(circle at bottom left, rgba(59, 130, 246, 0.1), transparent);
        }
    </style>
</head>
<body class="antialiased bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 selection:bg-red-500 selection:text-white">
    <div class="relative min-h-screen overflow-hidden hero-gradient">
        <!-- Navigation -->
        <nav class="relative z-10 flex items-center justify-between px-6 py-8 mx-auto max-w-7xl lg:px-8">
            <div class="flex items-center gap-2">
                <div class="p-2 bg-red-600 rounded-lg shadow-lg shadow-red-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight">Rescue<span class="text-red-600">System</span></span>
            </div>
            
            <div class="flex items-center gap-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 font-semibold text-white transition-all bg-slate-900 dark:bg-slate-100 dark:text-slate-900 rounded-xl hover:scale-105 active:scale-95">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold transition-colors hover:text-red-600">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 font-semibold text-white transition-all bg-red-600 rounded-xl hover:bg-red-700 hover:shadow-lg hover:shadow-red-500/30 hover:scale-105 active:scale-95">Join the Team</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="relative z-10 px-6 mx-auto mt-16 max-w-7xl lg:px-8 lg:mt-24">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div class="space-y-8">
                    <div class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded-full dark:bg-red-900/30 dark:text-red-400">
                        <span class="flex w-2 h-2 mr-2 bg-red-500 rounded-full animate-ping"></span>
                        Version 2.0 Now Live
                    </div>
                    <h1 class="text-5xl font-bold leading-tight lg:text-7xl">
                        Rapid Response. <br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-orange-500">Professional</span> Management.
                    </h1>
                    <p class="text-lg leading-relaxed text-slate-600 dark:text-slate-400 max-w-lg">
                        Centralize incident intelligence, manage your elite human resources, and establish operational links in real-time. Designed for the front lines of emergency service.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 text-lg font-bold text-white transition-all bg-slate-900 dark:bg-white dark:text-slate-950 rounded-2xl hover:shadow-2xl hover:-translate-y-1">
                            Get Started
                        </a>
                        <a href="#features" class="px-8 py-4 text-lg font-bold transition-all border border-slate-200 dark:border-slate-800 rounded-2xl hover:bg-slate-100 dark:hover:bg-slate-900">
                            Learn More
                        </a>
                    </div>
                </div>

                <!-- Hero Image Card -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-blue-600 rounded-[2rem] blur opacity-25 group-hover:opacity-40 transition duration-1000"></div>
                    <div class="relative overflow-hidden glass rounded-[2rem] shadow-2xl">
                        <img src="/rescue_hero_banner_1777643308639.png" alt="Rescue Management System" class="w-full object-cover aspect-video lg:aspect-square" />
                    </div>
                </div>
            </div>
        </main>

        <!-- Feature Grid -->
        <section id="features" class="px-6 py-24 mx-auto max-w-7xl lg:px-8">
            <div class="grid gap-8 md:grid-cols-3">
                <div class="p-8 transition-all glass rounded-3xl hover:border-red-500/50 group">
                    <div class="inline-flex items-center justify-center p-3 mb-6 bg-red-100 rounded-2xl dark:bg-red-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold">Incident Intelligence</h3>
                    <p class="text-slate-600 dark:text-slate-400">Track and manage emergency reports with full CRUD capabilities and real-time status updates.</p>
                </div>

                <div class="p-8 transition-all glass rounded-3xl hover:border-blue-500/50 group">
                    <div class="inline-flex items-center justify-center p-3 mb-6 bg-blue-100 rounded-2xl dark:bg-blue-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold">Team Deployment</h3>
                    <p class="text-slate-600 dark:text-slate-400">Monitor personnel availability and assign the right members to the right mission instantly.</p>
                </div>

                <div class="p-8 transition-all glass rounded-3xl hover:border-green-500/50 group">
                    <div class="inline-flex items-center justify-center p-3 mb-6 bg-green-100 rounded-2xl dark:bg-green-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold">Smart Analytics</h3>
                    <p class="text-slate-600 dark:text-slate-400">Visualize mission success rates and team efficiency through our advanced dashboard metrics.</p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="relative z-10 px-6 py-12 mx-auto mt-auto max-w-7xl lg:px-8 border-t border-slate-200 dark:border-slate-800">
            <div class="flex flex-col items-center justify-between gap-6 md:flex-row">
                <p class="text-sm text-slate-500">&copy; {{ date('Y') }} RescueSystem. Built for emergency excellence.</p>
                <div class="flex gap-6 text-sm text-slate-500">
                    <a href="#" class="hover:text-slate-900 dark:hover:text-white">Privacy Policy</a>
                    <a href="#" class="hover:text-slate-900 dark:hover:text-white">Terms of Service</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
