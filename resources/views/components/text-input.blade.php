@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/5 border-white/10 text-white text-lg placeholder:text-white/20 focus:border-rose-500/50 focus:ring-rose-500/20 rounded-2xl px-6 py-4 shadow-inner transition-all duration-300 w-full']) }}>
