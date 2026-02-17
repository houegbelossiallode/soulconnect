<section>
    <header>
        <h2 class="text-xl font-black text-white">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm text-white/40 uppercase font-black tracking-widest italic">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-8" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Profile Photo Section -->
        <div class="flex flex-col items-center gap-6 p-8 glass rounded-[2.5rem] bg-white/5 border-white/10 shadow-inner">
            <div class="relative group">
                <div class="w-40 h-40 rounded-[2.5rem] overflow-hidden border-4 border-white/10 shadow-2xl transition-transform duration-500 group-hover:scale-105">
                    <img id="photo-preview" src="{{ $user->profile_photo_url }}" class="w-full h-full object-cover">
                </div>
                <label for="profile_photo" class="absolute -bottom-2 -right-2 w-12 h-12 bg-rose-500 rounded-2xl flex items-center justify-center cursor-pointer shadow-xl shadow-rose-500/20 hover:scale-110 active:scale-95 transition-all">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    <input type="file" id="profile_photo" name="profile_photo" class="hidden" accept="image/*" onchange="previewPhoto(this)">
                </label>
            </div>
            <div class="text-center">
                <h4 class="text-white font-black uppercase text-xs tracking-[0.2em]">{{ __('Profile Photo') }}</h4>
                <p class="text-white/20 text-[10px] mt-1 uppercase font-bold tracking-widest">{{ __('Square format recommended for best radiance') }}</p>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea id="bio" name="bio" rows="4" class="block w-full bg-white/5 border-white/10 rounded-2xl text-white text-lg px-6 py-4 placeholder:text-white/20 focus:border-rose-500/50 focus:ring-rose-500/20 shadow-inner transition-all duration-300">{{ old('bio', $user->getTranslation('bio')) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
            <p class="mt-2 text-[10px] text-white/20 uppercase font-black tracking-widest">{{ __('This bio will be translated for your matches.') }}</p>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <script>
        function previewPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photo-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</section>
