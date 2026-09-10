@extends('layouts.app') {{-- Adjust if your layout file is named differently --}}

@section('title', 'Testimonials - REDSOL')

@section('content')

<section class="pt-32 pb-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        {{-- Page Header --}}
        <div class="text-center mb-16 reveal">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div class="h-px w-12 bg-crimson-500"></div>
                <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">Testimonials</span>
                <div class="h-px w-12 bg-crimson-500"></div>
            </div>
            <h1 class="font-display text-4xl lg:text-5xl font-800 text-gray-900 leading-tight">
                What Hospital Leaders<br>
                <span class="red-gradient-text">Say About Us</span>
            </h1>
            <p class="mt-6 text-lg text-gray-600 max-w-2xl mx-auto">
                Discover how REDSOL's healthcare solutions are transforming patient care and hospital operations across the region.
            </p>
        </div>

        {{-- Testimonials Grid --}}
        @if($testimonials->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($testimonials as $i => $t)
                    <div class="testimonial-card rounded-2xl p-8 reveal reveal-delay-{{ ($i % 3) + 1 }}">
                        
                        <div class="flex gap-1 mb-6">
                            @for ($s = 0; $s < $t->rating; $s++)
                                <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            @endfor
                        </div>

                        <blockquote class="font-body text-gray-600 text-base leading-relaxed mb-8 italic">
                            "{{ $t->quote }}"
                        </blockquote>

                        <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br {{ $t->avatar_gradient }} flex items-center justify-center font-display font-700 text-white text-base">
                                {{ $t->author_initials }}
                            </div>
                            <div>
                                <div class="font-display font-600 text-gray-900 text-base">{{ $t->author_name }}</div>
                                <div class="font-body text-gray-500 text-sm">{{ $t->author_role }}, {{ $t->hospital }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-gray-500 text-lg">No testimonials available at the moment. Please check back later.</p>
            </div>
        @endif

    </div>
</section>

@endsection