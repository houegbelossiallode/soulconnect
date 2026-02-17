<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="flex items-center gap-1 glass px-3 py-1.5 rounded-full text-xs font-bold hover:bg-white/10 transition-all border border-white/10 uppercase">
        <span>{{ App::getLocale() }}</span>
        <svg class="w-3 h-3 transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div x-show="open" @click.away="open = false" class="absolute top-full mt-2 right-0 glass border border-white/10 rounded-xl overflow-hidden shadow-2xl min-w-[120px] z-[100]" x-cloak>
        <a href="{{ route('lang.switch', 'fr') }}" class="block px-4 py-2 text-xs hover:bg-white/5 transition-colors {{ App::getLocale() == 'fr' ? 'text-rose-500 font-bold' : 'text-white/70' }}">
            🇫🇷 Français
        </a>
        <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 text-xs hover:bg-white/5 transition-colors {{ App::getLocale() == 'en' ? 'text-rose-500 font-bold' : 'text-white/70' }}">
            🇺🇸 English
        </a>
        <a href="{{ route('lang.switch', 'es') }}" class="block px-4 py-2 text-xs hover:bg-white/5 transition-colors {{ App::getLocale() == 'es' ? 'text-rose-500 font-bold' : 'text-white/70' }}">
            🇪🇸 Español
        </a>
    </div>
</div>
