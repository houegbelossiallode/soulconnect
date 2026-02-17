<x-guest-layout>
    <header class="mb-10">
        <h2 class="text-3xl font-black text-white tracking-tight">
            {{ __('Recover Soul') }}
        </h2>
        <p class="text-white/40 text-xs font-black uppercase tracking-[0.2em] mt-2 italic">
            {{ __('Lost your connection? Let us help you find it.') }}
        </p>
    </header>

    <div class="mb-8 p-6 bg-white/5 border border-white/5 rounded-3xl">
        <p class="text-sm text-white/60 leading-relaxed italic">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-8">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full justify-center">
                {{ __('Email Reset Link') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-6">
            <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-rose-400 hover:text-rose-300 transition-colors">
                {{ __('Back to login') }}
            </a>
        </div>
    </form>
</x-guest-layout>
