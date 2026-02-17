<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white leading-tight">
            {{ __('My Profile') }}
        </h2>
        <p class="text-white/40 text-sm mt-1 uppercase tracking-tighter">{{ __('Manage your information and radiance preferences.') }}</p>
    </x-slot>

    <div class="py-12 space-y-12">
        <!-- Hero Section -->
        <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-rose-500 to-indigo-600 rounded-[3rem] blur opacity-25 group-hover:opacity-40 transition duration-1000"></div>
            <div class="relative glass rounded-[3rem] p-10 border-white/10 flex flex-col md:flex-row items-center gap-10 shadow-2xl overflow-hidden text-center md:text-left">
                <!-- Background Glow -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-rose-500/10 rounded-full blur-[80px] -mr-32 -mt-32"></div>
                
                <!-- Avatar -->
                <div class="relative shrink-0">
                    <img src="{{ $user->profile_photo_url }}" class="w-40 h-40 rounded-[2.5rem] object-cover ring-4 ring-rose-500/30 shadow-2xl hover:scale-105 transition-transform duration-500">
                    <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-gradient-to-br from-rose-500 to-rose-600 rounded-2xl flex items-center justify-center text-white shadow-xl border-2 border-black/20 cursor-pointer hover:rotate-12 transition-all">
                        📷
                    </div>
                </div>

                <!-- Info -->
                <div class="flex-1 space-y-4">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h1 class="text-5xl font-black text-white tracking-tight">{{ auth()->user()->name }}</h1>
                            <p class="text-rose-400 font-bold uppercase tracking-[0.3em] text-xs mt-2">{{ __('Premium Member') }}</p>
                        </div>
                        <div class="flex gap-3">
                            <div class="px-6 py-3 glass rounded-2xl border-white/5 text-center">
                                <div class="text-white font-black text-xl">12</div>
                                <div class="text-[9px] text-white/40 uppercase font-black">{{ __('Matches') }}</div>
                            </div>
                            <div class="px-6 py-3 glass rounded-2xl border-white/5 text-center">
                                <div class="text-white font-black text-xl">98%</div>
                                <div class="text-[9px] text-white/40 uppercase font-black">{{ __('Radiance') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="max-w-2xl">
                        <p class="text-white/60 leading-relaxed italic text-lg">
                            "{{ auth()->user()->getTranslation('bio') ?: __('No bio yet... Express yourself!') }}"
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Edit Profile -->
            <div class="p-10 glass rounded-[3rem] border-white/5 shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-colors"></div>
                <h3 class="text-xl font-black text-white mb-8 flex items-center gap-4">
                    <span class="w-12 h-12 flex items-center justify-center bg-rose-500/20 text-rose-400 rounded-2xl shadow-lg border border-rose-500/20">👤</span>
                    {{ __('Personal Information') }}
                </h3>
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Update Password -->
            <div class="p-10 glass rounded-[3rem] border-white/5 shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/5 rounded-full blur-3xl group-hover:bg-emerald-500/10 transition-colors"></div>
                <h3 class="text-xl font-black text-white mb-8 flex items-center gap-4">
                    <span class="w-12 h-12 flex items-center justify-center bg-emerald-500/20 text-emerald-400 rounded-2xl shadow-lg border border-emerald-500/20">🔒</span>
                    {{ __('Account Security') }}
                </h3>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="p-10 bg-red-500/5 border border-red-500/10 rounded-[3rem] shadow-2xl group">
            <div class="max-w-xl">
                <h3 class="text-xl font-black text-red-500 mb-8 flex items-center gap-4">
                    <span class="w-12 h-12 flex items-center justify-center bg-red-500/20 text-red-400 rounded-2xl shadow-lg border border-red-500/20">⚠️</span>
                    {{ __('Danger Zone') }}
                </h3>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
