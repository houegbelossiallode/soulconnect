<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-8 py-4 bg-gradient-to-br from-rose-500 to-rose-600 border border-rose-400/20 rounded-2xl font-black text-xs text-white uppercase tracking-[0.2em] shadow-xl shadow-rose-500/20 hover:scale-[1.02] hover:shadow-rose-500/30 active:scale-95 transition-all duration-300']) }}>
    {{ $slot }}
</button>
