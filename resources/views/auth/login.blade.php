<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <header class="mb-10">
        <h2 class="text-3xl font-black text-white tracking-tight">
            {{ __('Welcome back') }}
        </h2>
        <p class="text-white/40 text-xs font-black uppercase tracking-[0.2em] mt-2 italic">
            {{ __('Ready for your next Soulmate connection?') }}
        </p>
    </header>

    <form method="POST" action="{{ route('login') }}" class="space-y-8">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-black uppercase tracking-widest text-white/30 hover:text-rose-400 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <div class="relative flex items-center">
                    <input id="remember_me" type="checkbox" class="w-5 h-5 rounded-lg border-white/10 bg-white/5 text-rose-500 focus:ring-rose-500/20 focus:ring-offset-0 transition-all cursor-pointer" name="remember">
                </div>
                <span class="ms-3 text-[10px] font-black uppercase tracking-widest text-white/40 group-hover:text-white/60 transition-colors">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-6">
            <p class="text-xs text-white/30 font-bold">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="text-rose-400 hover:text-rose-300 font-black uppercase tracking-widest ml-1 transition-colors">
                    {{ __('Register') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
