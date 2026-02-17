<x-app-layout>
    <div class="py-12 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="fixed top-20 left-10 w-72 h-72 bg-rose-500/20 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="fixed bottom-20 right-10 w-96 h-96 bg-indigo-500/20 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Welcome Section -->
            <div class="glass rounded-[3rem] p-10 mb-12 border border-white/10 shadow-2xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-rose-500/10 to-indigo-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                
                <div class="flex flex-col md:flex-row items-center gap-10 relative z-10">
                    <!-- Avatar & Completion Ring -->
                    <div class="relative shrink-0">
                        <div class="w-48 h-48 relative">
                            <!-- Progress Ring SVG -->
                            <svg class="w-full h-full transform -rotate-90">
                                <circle cx="96" cy="96" r="88" stroke="currentColor" stroke-width="8" fill="transparent" class="text-white/5" />
                                <circle cx="96" cy="96" r="88" stroke="currentColor" stroke-width="8" fill="transparent" class="text-rose-500 transition-all duration-1000 ease-out" 
                                    stroke-dasharray="553" 
                                    stroke-dashoffset="{{ 553 - (553 * $user->profile_completion_percentage) / 100 }}" 
                                    stroke-linecap="round" />
                            </svg>
                            
                            <!-- Inner Avatar -->
                            <div class="absolute inset-2 rounded-full overflow-hidden border-4 border-[#030014] shadow-2xl">
                                <img src="{{ $user->profile_photo_url }}" class="w-full h-full object-cover">
                            </div>

                            <!-- Percentage Badge -->
                            <div class="absolute -bottom-2 md:bottom-2 -right-2 bg-white text-rose-600 font-black text-xl px-3 py-1 rounded-xl shadow-lg border-2 border-rose-100">
                                {{ $user->profile_completion_percentage }}%
                            </div>
                        </div>
                    </div>

                    <!-- Welcome Text -->
                    <div class="flex-1 text-center md:text-left space-y-4">
                        <h2 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-tight">
                            {{ __('Welcome back,') }} <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-indigo-400">
                                {{ $user->name }}
                            </span>
                        </h2>
                        
                        @if($user->profile_completion_percentage < 100)
                            <p class="text-white/60 text-lg font-medium">
                                {{ __('Your profile is') }} <strong class="text-white">{{ $user->profile_completion_percentage }}%</strong> {{ __('complete. Complete it to increase your visibility!') }}
                            </p>
                            <div class="pt-2">
                                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-6 py-3 bg-white text-[#030014] rounded-xl font-bold uppercase tracking-wider hover:bg-rose-50 transition-colors shadow-lg hover:shadow-white/20">
                                    {{ __('Complete Profile') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                                </a>
                            </div>
                        @else
                            <p class="text-white/60 text-lg font-medium">
                                {{ __('Your profile is perfectly optimized for finding love. Go discover!') }}
                            </p>
                            <div class="pt-2">
                                <a href="{{ route('discover') }}" class="inline-flex items-center px-6 py-3 bg-rose-500 text-white rounded-xl font-bold uppercase tracking-wider hover:bg-rose-600 transition-colors shadow-lg hover:shadow-rose-500/30">
                                    {{ __('Start Discovering') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Matches -->
                <div class="glass p-8 rounded-[2rem] border border-white/5 shadow-xl hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-rose-500/20 rounded-2xl flex items-center justify-center text-rose-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                        </div>
                        <span class="text-emerald-400 text-xs font-bold bg-emerald-400/10 px-2 py-1 rounded-lg">+12%</span>
                    </div>
                    <div class="text-4xl font-black text-white mb-1">0</div>
                    <div class="text-white/40 font-medium uppercase tracking-widest text-xs">{{ __('Matches') }}</div>
                </div>

                <!-- Messages -->
                <div class="glass p-8 rounded-[2rem] border border-white/5 shadow-xl hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-indigo-500/20 rounded-2xl flex items-center justify-center text-indigo-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                        </div>
                        <span class="text-white/20 text-xs font-bold px-2 py-1 rounded-lg">--</span>
                    </div>
                    <div class="text-4xl font-black text-white mb-1">0</div>
                    <div class="text-white/40 font-medium uppercase tracking-widest text-xs">{{ __('Messages') }}</div>
                </div>

                <!-- Profile Views -->
                <div class="glass p-8 rounded-[2rem] border border-white/5 shadow-xl hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-amber-500/20 rounded-2xl flex items-center justify-center text-amber-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </div>
                        <span class="text-emerald-400 text-xs font-bold bg-emerald-400/10 px-2 py-1 rounded-lg">+5%</span>
                    </div>
                    <div class="text-4xl font-black text-white mb-1">24</div>
                    <div class="text-white/40 font-medium uppercase tracking-widest text-xs">{{ __('Profile Views') }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
