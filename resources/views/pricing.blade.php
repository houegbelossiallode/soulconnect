@extends('layouts.public')

@section('title', __('Premium Pricing'))

@section('content')
<div class="py-20 text-center">
    <div class="inline-block px-4 py-1.5 mb-8 rounded-full glass text-xs font-semibold tracking-widest uppercase text-rose-300 border border-rose-500/20">
        {{ __('Premium Options') }}
    </div>
    
    <h1 class="text-5xl md:text-7xl font-bold mb-12 gradient-text">{{ __('Boost your destiny.') }}</h1>
    
    <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto mt-16">
        <!-- Free Plan -->
        <div class="glass p-12 rounded-[3rem] border-white/5 relative overflow-hidden group">
            <div class="text-2xl font-bold mb-4">Standard</div>
            <div class="text-5xl font-extrabold mb-8">{{ __('Free') }}</div>
            <ul class="text-left space-y-4 mb-12 text-white/50">
                <li class="flex items-center gap-3">✅ {{ __('20 Matches per day') }}</li>
                <li class="flex items-center gap-3">✅ {{ __('Basic public profile') }}</li>
                <li class="flex items-center gap-3">✅ {{ __('Standard messaging') }}</li>
                <li class="flex items-center gap-3 opacity-30">❌ {{ __('See who liked you') }}</li>
                <li class="flex items-center gap-3 opacity-30">❌ {{ __('Advanced filters') }}</li>
            </ul>
            <a href="{{ route('register') }}" class="w-full py-4 glass rounded-full font-bold hover:bg-white/10 transition-all block">
                {{ __('Start for free') }}
            </a>
        </div>

        <!-- Premium Plan -->
        <div class="p-12 rounded-[3rem] bg-gradient-to-br from-rose-600 to-red-900 border-2 border-rose-400 relative overflow-hidden group shadow-2xl scale-105">
            <div class="absolute top-6 right-8 bg-white text-rose-600 px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest">{{ __('Popular') }}</div>
            <div class="text-2xl font-bold mb-4">{{ __('Aura Premium') }}</div>
            <div class="text-5xl font-extrabold mb-8">9.99€<span class="text-lg font-normal opacity-70">{{ __('/month') }}</span></div>
            <ul class="text-left space-y-4 mb-12 text-white/90">
                <li class="flex items-center gap-3">✨ {{ __('Unlimited Matches') }}</li>
                <li class="flex items-center gap-3">✨ {{ __('See who liked you') }}</li>
                <li class="flex items-center gap-3">✨ {{ __('Advanced compatibility filters') }}</li>
                <li class="flex items-center gap-3">✨ {{ __('Incognito Mode') }}</li>
                <li class="flex items-center gap-3">✨ {{ __('Zero ads') }}</li>
            </ul>
            <a href="{{ route('register') }}" class="w-full py-4 bg-white text-rose-600 rounded-full font-bold hover:scale-105 transition-all block shadow-xl">
                {{ __('Become Premium') }}
            </a>
        </div>
    </div>

    <p class="mt-20 text-white/30 text-sm">{{ __('All subscriptions are non-binding and can be canceled at any time.') }}</p>
</div>
@endsection

