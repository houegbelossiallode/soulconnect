@extends('layouts.public')

@section('title', __('Terms & Privacy'))

@section('content')
<div class="max-w-4xl mx-auto py-20 text-white/60 leading-relaxed">
    <h1 class="text-4xl font-bold text-white mb-12">{{ __('Legal.') }}</h1>
    
    <div class="glass p-10 rounded-[2rem] space-y-12">
        <section>
            <h2 class="text-xl font-bold text-white mb-4">{{ __('1. General Terms of Use') }}</h2>
            <p class="mb-4">
                {{ __('By using SoulConnect, you agree to respect our community rules. Kindness and mutual respect are mandatory.') }}
            </p>
            <p>
                {{ __('Any harassing, discriminatory or misleading behavior will result in a permanent ban without notice.') }}
            </p>
        </section>

        <section>
            <h2 class="text-xl font-bold text-white mb-4">{{ __('2. Privacy Policy') }}</h2>
            <p class="mb-4">
                {{ __('Your data is used only to improve your matching experience. We never sell your personal data to third parties.') }}
            </p>
            <ul class="list-disc pl-6 space-y-2">
                <li>{{ __('Collected data: Profile, Location (optional), Preferences.') }}</li>
                <li>{{ __('Right to be forgotten: You can delete your account and all your data at any time from your settings.') }}</li>
            </ul>
        </section>

        <section>
            <h2 class="text-xl font-bold text-white mb-4">{{ __('3. Cookies') }}</h2>
            <p>
                {{ __('We use cookies essential to the technical functioning of the platform and the security of your session.') }}
            </p>
        </section>
    </div>

    <div class="mt-12 text-center text-xs opacity-50">
        {{ __('Last update: February 2026') }}
    </div>
</div>
@endsection

