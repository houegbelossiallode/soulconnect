<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SoulConnect - {{ __('Find Soulmate') }}</title>
        
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
            .glow-romantic {
                box-shadow: 0 0 30px rgba(255, 77, 148, 0.2);
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
            .heart-bg {
                position: absolute;
                font-size: 2rem;
                opacity: 0.1;
                filter: blur(2px);
                animation: float 20s infinite linear;
            }
            @keyframes float {
                from { transform: translateY(100vh) rotate(0deg); }
                to { transform: translateY(-10vh) rotate(360deg); }
            }
        </style>

        @if (file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="antialiased">
        <div class="hero-glow"></div>
        
        <!-- Animated Hearts Background -->
        <div class="fixed inset-0 pointer-events-none opacity-20">
            @for ($i = 0; $i < 15; $i++)
                <div class="heart-bg" style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 20) }}s; animation-duration: {{ rand(15, 30) }}s;">❤️</div>
            @endfor
        </div>

        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 px-6 py-4 flex justify-between items-center glass border-b border-white/5">
            <div class="text-2xl font-bold tracking-tighter flex items-center gap-2">
                <span class="text-rose-500">❤️</span> SOUL<span class="text-white/50">CONNECT</span>
            </div>
            
            <div class="hidden md:flex space-x-8 text-sm font-medium">
                <a href="{{ route('pricing') }}" class="hover:text-rose-400 transition-colors">{{ __('Pricing') }}</a>
                <a href="{{ route('safety') }}" class="hover:text-rose-400 transition-colors">{{ __('Safety') }}</a>
                <a href="{{ route('about') }}" class="hover:text-rose-400 transition-colors">{{ __('About') }}</a>
            </div>

            <div class="flex items-center space-x-4">
                @include('layouts.language-switcher')
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2 rounded-full glass text-sm hover:bg-white/10 transition-all">{{ __('My Profile') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium hover:text-rose-400 transition-colors">{{ __('Log in') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2 rounded-full bg-gradient-to-r from-rose-500 to-red-600 text-white text-sm font-bold hover:scale-105 transition-all glow-romantic">{{ __('Register') }}</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="relative pt-40 pb-20 px-6 max-w-7xl mx-auto flex flex-col items-center text-center">
            <div class="inline-block px-4 py-1.5 mb-8 rounded-full glass text-xs font-semibold tracking-widest uppercase text-rose-300 border border-rose-500/20">
                {{ __('✨ Love starts with a simple click') }}
            </div>
            
            <h1 class="text-6xl md:text-8xl font-bold mb-8 gradient-text leading-tight tracking-tighter">
                {!! __('Find your <br> other half.') !!}
            </h1>
            
            <p class="text-lg md:text-xl text-white/60 max-w-2xl mb-12 leading-relaxed">
                {{ __('Join the kindest community for dates that really matter. More than just a Match, a real connection.') }}
            </p>

            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-6">
                <a href="{{ route('register') }}" class="px-10 py-5 bg-gradient-to-r from-rose-500 to-red-600 text-white rounded-full font-bold text-xl hover:scale-105 transition-transform glow-romantic">
                    {{ __('Find Love') }}
                </a>
                <a href="#concept" class="px-10 py-5 glass rounded-full font-medium text-xl hover:bg-white/10 transition-all">
                    {{ __('Discover more') }}
                </a>
            </div>

            <!-- Profile Avatars Preview -->
            <div class="mt-20 flex -space-x-4 overflow-hidden">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="inline-block h-16 w-16 rounded-full ring-4 ring-[#0a0104] bg-neutral-800 flex items-center justify-center text-xs font-bold glass">
                        User {{ $i }}
                    </div>
                @endfor
                <div class="flex items-center justify-center h-16 w-16 rounded-full ring-4 ring-[#0a0104] bg-rose-500/20 backdrop-blur pl-1">
                    <span class="text-rose-400 text-xs font-bold">+2k</span>
                </div>
            </div>
            <p class="mt-6 text-white/40 text-sm">{{ __('Thousands of people already connected near you.') }}</p>
        </main>

        <!-- Features -->
        <section id="concept" class="py-32 px-6 bg-white/[0.01] border-y border-white/5">
            <div class="max-w-7xl mx-auto">
                <div class="mb-20 text-center">
                    <h2 class="text-4xl font-bold mb-6">{{ __('Match. Chat. Date.') }}</h2>
                    <p class="text-white/40 max-w-xl mx-auto">{{ __('Our approach is simple, natural and focused on your real compatibility.') }}</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="p-10 rounded-3xl glass hover:border-rose-500/30 transition-all group">
                        <div class="w-14 h-14 bg-rose-500/10 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-rose-500 transition-all">
                            <span class="text-2xl">🔍</span>
                        </div>
                        <h3 class="text-xl font-bold mb-4">{{ __('Verified Profiles') }}</h3>
                        <p class="text-white/50 leading-relaxed">{{ __('No more bad surprises. We verify the authenticity of each member for your safety.') }}</p>
                    </div>

                    <div class="p-10 rounded-3xl glass border-rose-500/20 hover:border-rose-500/40 transition-all group">
                        <div class="w-14 h-14 bg-rose-500/10 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-rose-500 transition-all">
                            <span class="text-2xl">❤️</span>
                        </div>
                        <h3 class="text-xl font-bold mb-4">{{ __('Intelligent Matching') }}</h3>
                        <p class="text-white/50 leading-relaxed">{{ __('Our algorithm analyzes not only photos, but also your passions and life values.') }}</p>
                    </div>

                    <div class="p-10 rounded-3xl glass hover:border-rose-500/30 transition-all group">
                        <div class="w-14 h-14 bg-rose-500/10 rounded-2xl flex his="text-2xl">🔥</span>
                        </div>
                        <h3 class="text-xl font-bold mb-4">{{ __('Exclusive Events') }}</h3>
                        <p class="text-white/50 leading-relaxed">{{ __('Meet singles at theme nights and exclusive workshops at SoulConnect.') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Success Stories -->
        <section class="py-32 px-6 overflow-hidden">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl font-bold mb-16 text-center italic">{{ __('"Thanks to SoulConnect, I found more than a date, I found my best friend and my partner."') }}</h2>
                <div class="flex justify-center flex-wrap gap-8 opacity-60 grayscale hover:grayscale-0 transition-all duration-700">
                    <span class="text-xl font-bold">Marie & Thomas</span>
                    <span class="text-xl font-bold">Julie & Antoine</span>
                    <span class="text-xl font-bold">Sarah & Emma</span>
                    <span class="text-xl font-bold">Nicolas & Lucie</span>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-32 px-6">
            <div class="max-w-5xl mx-auto p-12 md:p-24 rounded-[4rem] bg-gradient-to-br from-rose-600/20 to-red-900/40 text-center border border-rose-500/20 relative overflow-hidden backdrop-blur-sm">
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-rose-500/10 rounded-full filter blur-[100px]"></div>
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-6xl font-bold mb-8">{{ __('Don\'t let chance decide anymore.') }}</h2>
                    <p class="text-white/60 mb-12 text-xl max-w-xl mx-auto">{{ __('The love of your life might already be waiting for you on SoulConnect.') }}</p>
                    <a href="{{ route('register') }}" class="px-12 py-6 bg-white text-rose-600 rounded-full font-bold text-2xl hover:scale-105 transition-transform inline-block shadow-2xl">
                        {{ __('Create my Profile') }}
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-20 px-6 border-t border-white/5 bg-[#050102]">
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
