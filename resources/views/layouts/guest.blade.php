<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SoulConnect') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Outfit', sans-serif; background-color: #030014; }
            .glass {
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.05);
            }
        </style>
    </head>
    <body class="antialiased text-white overflow-x-hidden">
        <div class="min-h-screen relative flex flex-col items-center justify-center p-6">
            <!-- Background Elements -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
                <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-rose-500/20 rounded-full blur-[120px] animate-pulse"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-600/20 rounded-full blur-[120px] animate-pulse" style="animation-delay: 2s"></div>
            </div>

            <div class="w-full max-w-md">
                <div class="text-center mb-10">
                    <a href="/" class="inline-flex flex-col items-center group">
                        <div class="w-20 h-20 bg-gradient-to-br from-rose-500 to-rose-600 rounded-[2rem] flex items-center justify-center shadow-2xl shadow-rose-500/20 group-hover:scale-110 transition-transform duration-500">
                            <span class="text-4xl">✨</span>
                        </div>
                        <h1 class="mt-6 text-3xl font-black tracking-tighter text-white uppercase italic">SoulConnect</h1>
                    </a>
                </div>

                <div class="glass rounded-[3rem] p-10 shadow-3xl border-white/10 relative overflow-hidden">
                    <!-- Internal Glow -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-rose-500/5 rounded-full blur-3xl"></div>
                    
                    {{ $slot }}
                </div>

                <div class="mt-10 text-center">
                    <p class="text-white/20 text-[10px] font-black uppercase tracking-[0.3em]">&copy; 2026 SoulConnect Premium. All radiance reserved.</p>
                </div>
            </div>
        </div>
    </body>
</html>
