@props([
    'hoverEffect' => false,
])

<div {{ $attributes->merge(['class' => 'glass-card relative overflow-hidden group ' . ($hoverEffect ? 'transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_15px_40px_rgba(0,0,0,0.4)]' : '')]) }}>
    
    @if($hoverEffect)
        <!-- Subtle border glow effect on hover -->
        <div class="absolute inset-0 border-2 border-transparent group-hover:border-primary/30 rounded-[20px] transition-colors duration-300 pointer-events-none"></div>
    @endif
    
    <div class="relative z-10 p-6 sm:p-8">
        {{ $slot }}
    </div>
</div>
