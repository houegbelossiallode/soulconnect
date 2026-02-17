<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white leading-tight">
            {{ __('Discover') }}
        </h2>
        <p class="text-white/40 text-sm mt-1 uppercase tracking-tighter">{{ __('Let destiny guide your matches.') }}</p>
    </x-slot>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <aside class="w-full lg:w-80 space-y-6">
            <form method="GET" action="{{ route('discover') }}" class="glass p-8 rounded-[3rem] border-white/5 shadow-2xl sticky top-24">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="font-black text-xl text-white tracking-tight">{{ __('Filters') }}</h3>
                    <a href="{{ route('discover') }}" class="text-[10px] font-black uppercase tracking-widest text-rose-400 hover:text-rose-300 transition-colors">{{ __('Reset') }}</a>
                </div>

                <div class="space-y-10">
                    <!-- Genre -->
                    <div>
                        <label class="text-[10px] font-black text-white/30 uppercase tracking-[0.2em] block mb-5">{{ __("I'm looking for") }}</label>
                        <input type="hidden" name="gender" id="gender-input" value="{{ request('gender', 'all') }}">
                        <div class="grid grid-cols-3 gap-2">
                            <button type="button" onclick="setGender('women')" id="btn-women" class="py-3 rounded-2xl border transition-all text-[10px] font-black uppercase tracking-widest {{ request('gender') == 'women' ? 'border-rose-500/50 bg-rose-500/10 text-white shadow-lg shadow-rose-500/10' : 'border-white/5 bg-white/5 text-white/40 hover:bg-white/10' }}">
                                {{ __('Women') }}
                            </button>
                            <button type="button" onclick="setGender('men')" id="btn-men" class="py-3 rounded-2xl border transition-all text-[10px] font-black uppercase tracking-widest {{ request('gender') == 'men' ? 'border-rose-500/50 bg-rose-500/10 text-white shadow-lg shadow-rose-500/10' : 'border-white/5 bg-white/5 text-white/40 hover:bg-white/10' }}">
                                {{ __('Men') }}
                            </button>
                            <button type="button" onclick="setGender('all')" id="btn-all" class="py-3 rounded-2xl border transition-all text-[10px] font-black uppercase tracking-widest {{ request('gender', 'all') == 'all' ? 'border-rose-500/50 bg-rose-500/10 text-white shadow-lg shadow-rose-500/10' : 'border-white/5 bg-white/5 text-white/40 hover:bg-white/10' }}">
                                {{ __('All') }}
                            </button>
                        </div>
                    </div>

                    <!-- Localisation -->
                    <div>
                        <label class="text-[10px] font-black text-white/30 uppercase tracking-[0.2em] block mb-5">{{ __('Location') }}</label>
                        <div class="relative group">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-lg opacity-40 group-focus-within:opacity-100 transition-opacity">📍</span>
                            <input type="text" name="city" value="{{ request('city') }}" placeholder="{{ __('My city...') }}" class="w-full pl-14 pr-6 py-4 bg-white/5 border-white/10 rounded-2xl text-sm text-white focus:border-rose-500/50 focus:ring-rose-500/10 transition-all placeholder:text-white/20">
                        </div>
                    </div>

                    <!-- Age Range -->
                    <div>
                        <label class="text-[10px] font-black text-white/30 uppercase tracking-[0.2em] block mb-5">{{ __('Age range') }}</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <span class="text-[9px] font-black text-white/20 uppercase tracking-widest ml-1">{{ __('Min') }}</span>
                                <input type="number" name="age_min" value="{{ request('age_min', 18) }}" min="18" max="100" class="w-full px-4 py-3 bg-white/5 border-white/10 rounded-xl text-xs text-white focus:border-rose-500/50 focus:ring-0">
                            </div>
                            <div class="space-y-2">
                                <span class="text-[9px] font-black text-white/20 uppercase tracking-widest ml-1">{{ __('Max') }}</span>
                                <input type="number" name="age_max" value="{{ request('age_max', 50) }}" min="18" max="100" class="w-full px-4 py-3 bg-white/5 border-white/10 rounded-xl text-xs text-white focus:border-rose-500/50 focus:ring-0">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full mt-12 py-5 bg-gradient-to-br from-rose-500 to-rose-600 border border-rose-400/20 rounded-[2rem] text-white font-black text-xs uppercase tracking-[0.2em] shadow-2xl shadow-rose-500/20 hover:scale-[1.02] hover:shadow-rose-500/30 active:scale-95 transition-all duration-300">
                    {{ __('Apply filters') }}
                </button>
            </form>
        </aside>

        <!-- Main Card Section -->
        <div class="flex-1 flex flex-col items-center justify-center min-h-[700px] relative py-12">
            <!-- Background Decoration -->
            <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
                <div class="w-[600px] h-[600px] bg-rose-500 rounded-full blur-[150px] animate-pulse"></div>
            </div>

            @if($users->count() > 0)
                <div class="relative w-full max-w-md aspect-[3/4.5] group">
                    @php $currentUser = $users->first(); @endphp
                    
                    <!-- Back Cards Decorations -->
                    <div class="absolute inset-x-8 top-8 bottom-[-2rem] glass rounded-[4rem] opacity-10 scale-90 translate-y-6"></div>
                    <div class="absolute inset-x-4 top-4 bottom-[-1rem] glass rounded-[4rem] opacity-30 scale-95 translate-y-3"></div>
                    
                    <!-- Main Active Card -->
                    <div class="absolute inset-0 glass rounded-[4rem] overflow-hidden border border-white/10 shadow-3xl transform transition-all duration-700 hover:rotate-1">
                        <!-- Photo -->
                    <img src="{{ $currentUser->profile_photo_url }}" class="w-full h-full object-cover">
                        
                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>

                        <!-- Content -->
                        <div class="absolute inset-x-0 bottom-0 p-10 pt-32">
                            <div class="flex items-end justify-between mb-6">
                                <div>
                                    <h1 class="text-5xl font-black text-white tracking-tighter">{{ $currentUser->name }}, {{ $currentUser->age }}</h1>
                                    <p class="text-white/60 flex items-center gap-2 text-xs font-bold uppercase tracking-widest mt-2">
                                        <span class="text-rose-500">📍</span> {{ $currentUser->city ?: __('Unknown City') }}
                                    </p>
                                </div>
                                <div class="bg-rose-500/20 px-4 py-2 rounded-2xl border border-rose-500/30 text-rose-400 text-[10px] font-black uppercase tracking-[0.2em] backdrop-blur-md">
                                    {{ rand(85, 99) }}% Match
                                </div>
                            </div>

                            <p class="text-white/70 text-base leading-relaxed italic line-clamp-3 mb-10">
                                "{{ $currentUser->getTranslation('bio') ?: __('Finding someone to explore the world with...') }}"
                            </p>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-center gap-8">
                                <!-- Dislike -->
                                <button class="w-20 h-20 rounded-[2rem] glass border-white/10 text-white flex items-center justify-center hover:bg-white/10 group/btn transition-all duration-300 shadow-xl">
                                    <svg class="w-8 h-8 group-hover/btn:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                                
                                <!-- Message -->
                                <a href="{{ route('messages.index', ['user_id' => $currentUser->id]) }}" class="w-16 h-16 rounded-2xl glass border-indigo-500/30 text-indigo-400 flex items-center justify-center hover:bg-indigo-500/10 group/btn transition-all duration-300 shadow-xl" title="{{ __('Send a message') }}">
                                    <svg class="w-7 h-7 group-hover/btn:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                                </a>

                                <!-- Like -->
                                <button class="w-20 h-20 rounded-[2rem] bg-gradient-to-br from-rose-500 to-rose-600 text-white flex items-center justify-center shadow-2xl shadow-rose-500/30 hover:scale-110 active:scale-95 group/btn transition-all duration-300">
                                    <svg class="w-10 h-10 group-hover/btn:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination/Hint -->
                <div class="mt-16 text-center space-y-4">
                    <p class="text-white/20 text-[10px] uppercase font-black tracking-[0.4em]">{{ __('Use arrows or swipe to choose') }}</p>
                    <div class="flex justify-center gap-1">
                        @foreach($users as $u)
                            <div class="w-1.5 h-1.5 rounded-full {{ $u->id === $currentUser->id ? 'bg-rose-500 w-4' : 'bg-white/10' }} transition-all"></div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center space-y-6 glass p-12 rounded-[3rem] border-white/5 shadow-2xl">
                    <div class="text-6xl">🔍</div>
                    <h2 class="text-2xl font-black text-white italic tracking-tight">{{ __('No Soulmates Found') }}</h2>
                    <p class="text-white/40 max-w-xs mx-auto leading-relaxed uppercase text-[10px] font-black tracking-[0.2em]">{{ __('Try to broaden your filters to find more connections.') }}</p>
                    <a href="{{ route('discover') }}" class="inline-block mt-4 text-rose-400 font-black uppercase text-xs tracking-widest hover:text-rose-300 transition-colors">
                        {{ __('Reset all filters') }}
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        function setGender(value) {
            document.getElementById('gender-input').value = value;
            
            // UI Update
            ['women', 'men', 'all'].forEach(g => {
                const btn = document.getElementById('btn-' + g);
                if (g === value) {
                    btn.classList.remove('border-white/5', 'bg-white/5', 'text-white/40');
                    btn.classList.add('border-rose-500/50', 'bg-rose-500/10', 'text-white', 'shadow-lg', 'shadow-rose-500/10');
                } else {
                    btn.classList.add('border-white/5', 'bg-white/5', 'text-white/40');
                    btn.classList.remove('border-rose-500/50', 'bg-rose-500/10', 'text-white', 'shadow-lg', 'shadow-rose-500/10');
                }
            });
        }
    </script>
</x-app-layout>
