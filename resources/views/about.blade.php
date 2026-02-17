@extends('layouts.public')

@section('title', __('About'))

@section('content')
<div class="max-w-4xl mx-auto py-20 text-center">
    <div class="inline-block px-4 py-1.5 mb-8 rounded-full glass text-xs font-semibold tracking-widest uppercase text-rose-300 border border-rose-500/20">
        {{ __('Our Mission') }}
    </div>
    
    <h1 class="text-5xl md:text-7xl font-bold mb-12 gradient-text">{{ __('True love in a digital world.') }}</h1>
    
    <div class="space-y-12 text-left text-white/70 leading-relaxed text-lg">
        <section class="glass p-10 rounded-[2rem]">
            <h2 class="text-3xl font-bold text-white mb-6">{{ __('Why SoulConnect?') }}</h2>
            <p class="mb-6">
                {{ __('In a world where swipes have become a mechanical habit, we wanted to create a space where every connection makes sense. SoulConnect was born from the desire to put humans and values back at the center of online dating.') }}
            </p>
            <p>
                {{ __('We are not just another dating app. We are a platform dedicated to those looking for a long-term relationship, based on real compatibility and mutual respect.') }}
            </p>
        </section>

        <section class="grid md:grid-cols-2 gap-8">
            <div class="glass p-8 rounded-[2rem]">
                <h3 class="text-xl font-bold text-white mb-4">{{ __('Our Vision') }}</h3>
                <p>{{ __('Create the first global network of singles committed to a quest for meaning and authenticity.') }}</p>
            </div>
            <div class="glass p-8 rounded-[2rem]">
                <h3 class="text-xl font-bold text-white mb-4">{{ __('Our Values') }}</h3>
                <p>{{ __('Safety, Kindness, Transparency. These three pillars guide each of our technical and human decisions.') }}</p>
            </div>
        </section>

        <div class="text-center pt-10">
            <a href="{{ route('register') }}" class="px-10 py-5 bg-gradient-to-r from-rose-500 to-red-600 text-white rounded-full font-bold text-xl hover:scale-105 transition-all glow-romantic inline-block">
                {{ __('Join the Adventure') }}
            </a>
        </div>
    </div>
</div>
@endsection

