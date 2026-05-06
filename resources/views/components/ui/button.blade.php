@props([
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-sans font-bold transition-all duration-300 rounded-[50px] cursor-pointer group focus:outline-none';
    
    $variants = [
        'primary' => 'bg-gradient-to-br from-primary to-neon-red text-white px-8 py-3.5 shadow-[0_0_30px_rgba(192,57,43,0.5)] hover:scale-105 hover:shadow-[0_0_40px_rgba(231,76,60,0.7)]',
        'ghost' => 'bg-transparent border border-white/30 text-white px-8 py-3.5 hover:bg-white/10',
        'sm' => 'bg-gradient-to-br from-primary to-neon-red text-white px-4 py-2 text-sm shadow-lg hover:scale-105',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
