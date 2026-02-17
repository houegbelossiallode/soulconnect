@extends('layouts.public')

@section('title', __('Safety'))

@section('content')
<div class="max-w-4xl mx-auto py-20">
    <div class="text-center mb-16">
        <div class="inline-block px-4 py-1.5 mb-8 rounded-full glass text-xs font-semibold tracking-widest uppercase text-rose-300 border border-rose-500/20">
            {{ __('Protection & Trust') }}
        </div>
        <h1 class="text-5xl font-bold gradient-text">{{ __('Your safety is our top priority.') }}</h1>
    </div>
    
    <div class="space-y-8 text-white/70 leading-relaxed">
        <div class="glass p-10 rounded-[2rem]">
            <h2 class="text-2xl font-bold text-white mb-6">{{ __('Our technical commitments') }}</h2>
            <ul class="space-y-6">
                <li class="grid md:grid-cols-[40px_1fr] items-start gap-4">
                    <span class="text-2xl">🛡️</span>
                    <div>
                        <strong class="text-white block mb-1">{{ __('Data Encryption') }}</strong>
                        {{ __('All your conversations and personal data are encrypted end-to-end.') }}
                    </div>
                </li>
                <li class="grid md:grid-cols-[40px_1fr] items-start gap-4">
                    <span class="text-2xl">🤖</span>
                    <div>
                        <strong class="text-white block mb-1">{{ __('AI Moderation') }}</strong>
                        {{ __('Our algorithm automatically detects and blocks suspicious and inappropriate behavior.') }}
                    </div>
                </li>
                <li class="grid md:grid-cols-[40px_1fr] items-start gap-4">
                    <span class="text-2xl">✅</span>
                    <div>
                        <strong class="text-white block mb-1">{{ __('Profile Verification') }}</strong>
                        {{ __('We encourage each member to verify their profile via a dynamic selfie to ensure authenticity.') }}
                    </div>
                </li>
            </ul>
        </div>

        <div class="glass p-10 rounded-[2rem]">
            <h2 class="text-2xl font-bold text-white mb-6">{{ __('Tips for your dates') }}</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white/5 p-6 rounded-2xl">
                    <h3 class="text-rose-400 font-bold mb-2">{{ __('First exchanges') }}</h3>
                    {{ __('Keep your exchanges on the app until you feel totally confident. Never share your bank details.') }}
                </div>
                <div class="bg-white/5 p-6 rounded-2xl">
                    <h3 class="text-rose-400 font-bold mb-2">{{ __('First date') }}</h3>
                    {{ __('Always favor a public and busy place. Inform a loved one of where you are going.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

