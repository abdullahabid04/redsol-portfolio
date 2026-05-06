@props([
    'color' => 'primary', // primary, success, warning
])

@php
    $baseClasses = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border';
    
    $colors = [
        'primary' => 'bg-primary/15 border-primary/40 text-neon-red shadow-[0_0_10px_rgba(192,57,43,0.2)]',
        'success' => 'bg-success/15 border-success/40 text-success shadow-[0_0_10px_rgba(46,204,113,0.2)]',
        'warning' => 'bg-gold/15 border-gold/40 text-gold shadow-[0_0_10px_rgba(243,156,18,0.2)]',
    ];

    $classes = $baseClasses . ' ' . ($colors[$color] ?? $colors['primary']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
