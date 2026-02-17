<x-guest-layout>
    <header class="mb-10">
        <h2 class="text-3xl font-black text-white tracking-tight">
            {{ __('Join the Aura') }}
        </h2>
        <p class="text-white/40 text-xs font-black uppercase tracking-[0.2em] mt-2 italic">
            {{ __('Create your premium account to find love.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Gender, City, Birthday (New Fields) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <x-input-label for="gender" :value="__('I am a')" />
                <select id="gender" name="gender" class="block w-full bg-white/5 border-white/10 text-white rounded-2xl px-6 py-4 focus:border-rose-500/50 focus:ring-rose-500/20 shadow-inner transition-all duration-300">
                    <option value="" class="bg-slate-900">{{ __('Select...') }}</option>
                    <option value="women" class="bg-slate-900" {{ old('gender') == 'women' ? 'selected' : '' }}>{{ __('Woman') }}</option>
                    <option value="men" class="bg-slate-900" {{ old('gender') == 'men' ? 'selected' : '' }}>{{ __('Man') }}</option>
                    <option value="other" class="bg-slate-900" {{ old('gender') == 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <div class="space-y-2">
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" class="block w-full" type="text" name="city" :value="old('city')" required placeholder="Paris" />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>
        </div>

        <div class="space-y-2">
            <x-input-label for="birthday" :value="__('Birthday')" />
            <x-text-input id="birthday" class="block w-full" type="date" name="birthday" :value="old('birthday')" required />
            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="space-y-2">
                <x-input-label for="password_confirmation" :value="__('Confirm')" />
                <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="pt-6">
            <x-primary-button class="w-full justify-center">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-4">
            <p class="text-xs text-white/30 font-bold">
                {{ __('Already registered?') }}
                <a href="{{ route('login') }}" class="text-rose-400 hover:text-rose-300 font-black uppercase tracking-widest ml-1 transition-colors">
                    {{ __('Log in') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
