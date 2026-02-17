<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'SoulConnect') - {{ __('Your Dating Site') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Outfit', sans-serif;
                background: #0a0104;
                color: #fff;
                overflow-x: hidden;
            }
            .glass {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(15px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .gradient-text {
                background: linear-gradient(135deg, #ff4d94 0%, #ff1a1a 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .hero-glow {
                position: absolute;
                top: -20%;
                left: 50%;
                transform: translateX(-50%);
                width: 100vw;
                height: 80vh;
                background: radial-gradient(circle, rgba(255, 77, 148, 0.1) 0%, transparent 60%);
                pointer-events: none;
            }
            [x-cloak] { display: none !important; }
        </style>

        @if (file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="antialiased">
        <div class="hero-glow"></div>

        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 px-6 py-4 flex justify-between items-center glass border-b border-white/5">
            <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tighter flex items-center gap-2">
                <span class="text-rose-500">❤️</span> SOUL<span class="text-white/50">CONNECT</span>
            </a>
            
            <div class="hidden md:flex space-x-8 text-sm font-medium">
                <a href="{{ route('pricing') }}" class="hover:text-rose-400 @if(Route::is('pricing')) text-rose-400 @endif transition-colors">{{ __('Pricing') }}</a>
                <a href="{{ route('safety') }}" class="hover:text-rose-400 @if(Route::is('safety')) text-rose-400 @endif transition-colors">{{ __('Safety') }}</a>
                <a href="{{ route('about') }}" class="hover:text-rose-400 @if(Route::is('about')) text-rose-400 @endif transition-colors">{{ __('About') }}</a>
            </div>

            <div class="flex items-center space-x-4">
                @include('layouts.language-switcher')
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2 rounded-full glass text-sm hover:bg-white/10 transition-all">{{ __('My Profile') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium hover:text-rose-400 transition-colors">{{ __('Log in') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2 rounded-full bg-gradient-to-r from-rose-500 to-red-600 text-white text-sm font-bold hover:scale-105 transition-all">{{ __('Register') }}</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- Content -->
        <div class="min-h-screen pt-24 px-6 max-w-7xl mx-auto">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="py-20 px-6 border-t border-white/5 bg-[#050102] mt-20">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center space-y-8 md:space-y-0 text-white/40">
                <div class="text-xl font-bold tracking-tighter flex items-center gap-2">
                    <span class="text-rose-500">❤️</span> SOULCONNECT
                </div>
                <div class="flex gap-8 text-sm">
                    <a href="{{ route('about') }}" class="hover:text-white transition-colors">{{ __('About') }}</a>
                    <a href="{{ route('safety') }}" class="hover:text-white transition-colors">{{ __('Safety') }}</a>
                    <a href="{{ route('terms') }}" class="hover:text-white transition-colors">{{ __('Terms / Privacy') }}</a>
                </div>
                <div class="text-xs">
                    &copy; {{ date('Y') }} SoulConnect. {{ __('Love doesn\'t wait.') }}
                </div>
            </div>
        </footer>
    </body>

</html>
