@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-[10px] uppercase tracking-[0.2em] text-white/30 mb-2']) }}>
    {{ $value ?? $slot }}
</label>
