@extends('layouts.app')

@section('content')
    <article class="pt-24 pb-20 bg-gray-50 min-h-screen">

        
        <div class="max-w-4xl mx-auto px-6 lg:px-8 mb-8 reveal">
            <nav class="flex text-sm font-display">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="{{ url('/') }}" class="text-gray-500 hover:text-crimson-600 transition-colors">Home</a>
                    </li>
                    <li><span class="text-gray-300">/</span></li>
                    <li>
                        <a href="{{ route('blog.index') }}" class="text-gray-500 hover:text-crimson-600 transition-colors">Blog</a>
                    </li>
                    <li><span class="text-gray-300">/</span></li>
                    <li><span class="text-crimson-600 font-600">{{ $blog->category }}</span></li>
                </ol>
            </nav>
        </div>

        
        <header class="max-w-4xl mx-auto px-6 lg:px-8 mb-12 reveal reveal-delay-1">
            
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-display font-600 tracking-wider uppercase bg-crimson-500/10 text-crimson-700 border border-crimson-500/20 mb-5">
                {{ $blog->category }}
            </span>

            
            <h1 class="font-display font-800 text-4xl lg:text-5xl text-gray-900 leading-tight mb-6">
                {{ $blog->title }}
            </h1>

            
            <p class="font-body text-xl text-gray-600 leading-relaxed mb-8">
                {{ $blog->excerpt }}
            </p>

            
            <div class="flex flex-wrap items-center gap-4 text-sm font-body text-gray-500 mb-10">
                @if($blog->author)
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-crimson-500/10 flex items-center justify-center">
                            <span class="text-crimson-600 font-display font-600 text-xs">
                                {{ strtoupper(substr($blog->author->name ?? 'A', 0, 1)) }}
                            </span>
                        </div>
                        <span>{{ $blog->author->name ?? 'REDSOL Team' }}</span>
                    </div>
                    <span class="text-gray-300">•</span>
                @endif
                <time datetime="{{ $blog->published_at->format('Y-m-d') }}">
                    {{ $blog->published_at->format('F j, Y') }}
                </time>
                <span class="text-gray-300">•</span>
                <span>{{ $blog->read_time_minutes }} min read</span>
                
                
            </div>

            
            @if($blog->featured_image)
                <figure class="rounded-3xl overflow-hidden shadow-lg border border-gray-200 mb-10">
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                         alt="{{ $blog->featured_image_alt ?? $blog->title }}"
                         class="w-full h-auto object-cover">
                    @if($blog->featured_image_alt)
                        <figcaption class="px-5 py-3 bg-gray-100 text-xs text-gray-500 font-body">
                            {{ $blog->featured_image_alt }}
                        </figcaption>
                    @endif
                </figure>
            @endif
        </header>

        
        <div class="max-w-3xl mx-auto px-6 lg:px-8 reveal reveal-delay-2">
            <div class="prose prose-lg max-w-none
                        prose-headings:text-gray-900
                        prose-h1:text-4xl prose-h2:text-3xl prose-h3:text-2xl
                        prose-p:text-gray-600 prose-p:leading-relaxed
                        prose-li:text-gray-600
                        prose-strong:text-gray-900
                        prose-a:text-crimson-600 hover:prose-a:underline
                        prose-blockquote:border-crimson-500
                        prose-blockquote:text-gray-700
                        prose-img:rounded-2xl prose-img:border prose-img:border-gray-200">
                {!! $blog->body !!}
            </div>
            
            @if($blog->tags && count($blog->tags))
                <div class="flex flex-wrap gap-2 mt-12 pt-8 border-t border-gray-200">
                    @foreach($blog->tags as $tag)
                        <a href="{{ route('blog.index', ['tag' => $tag]) }}"
                           class="px-3 py-1.5 rounded-lg text-xs font-display font-600 tracking-wide
                                  bg-gray-100 text-gray-600 border border-gray-200
                                  hover:bg-crimson-500/10 hover:text-crimson-700 hover:border-crimson-500/30
                                  transition-all">
                            #{{ $tag }}
                        </a>
                    @endforeach
                </div>
            @endif

            
            {{-- <div class="flex items-center gap-4 mt-10 pt-8 border-t border-gray-200">
                <span class="font-display font-600 text-gray-900 text-sm">Share:</span>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode($blog->url()) }}"
                   target="_blank"
                   class="w-9 h-9 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center
                          text-gray-500 hover:text-crimson-600 hover:border-crimson-500/30 hover:bg-crimson-500/5
                          transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($blog->url()) }}"
                   target="_blank"
                   class="w-9 h-9 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center
                          text-gray-500 hover:text-crimson-600 hover:border-crimson-500/30 hover:bg-crimson-500/5
                          transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($blog->url()) }}"
                   target="_blank"
                   class="w-9 h-9 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center
                          text-gray-500 hover:text-crimson-600 hover:border-crimson-500/30 hover:bg-crimson-500/5
                          transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.321 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.47h-3.12V24c5.737-.9 10.125-5.864 10.125-11.854z"/></svg>
                </a>
                <button onclick="navigator.clipboard.writeText('{{ $blog->url() }}')"
                        class="w-9 h-9 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center
                               text-gray-500 hover:text-crimson-600 hover:border-crimson-500/30 hover:bg-crimson-500/5
                               transition-all"
                        title="Copy link">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                    </svg>
                </button>
            </div> --}}

            
            @if($blog->author)
                <div class="mt-16 p-6 rounded-2xl bg-white border border-gray-200 reveal reveal-delay-3">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-crimson-500/10 flex items-center justify-center flex-shrink-0">
                            <span class="text-crimson-600 font-display font-700 text-lg">
                                {{ strtoupper(substr($blog->author->name ?? 'A', 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <h4 class="font-display font-700 text-gray-900 text-lg mb-1">
                                {{ $blog->author->name ?? 'REDSOL Team' }}
                            </h4>
                            <p class="font-body text-gray-600 text-sm mb-3">
                                {{ $blog->author->bio ?? 'Healthcare technology specialist at REDSOL, focused on digital transformation in Pakistani hospitals.' }}
                            </p>
                            @if($blog->author->social_links)
                                <div class="flex gap-3">
                                    @if($blog->author->social_links['twitter'] ?? false)
                                        <a href="{{ $blog->author->social_links['twitter'] }}" class="text-gray-400 hover:text-crimson-600 transition-colors">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                        </a>
                                    @endif
                                    @if($blog->author->social_links['linkedin'] ?? false)
                                        <a href="{{ $blog->author->social_links['linkedin'] }}" class="text-gray-400 hover:text-crimson-600 transition-colors">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div><section class="max-w-3xl mx-auto px-6 lg:px-8 mt-20 reveal reveal-delay-5">
            <div class="p-8 rounded-3xl bg-gradient-to-br from-crimson-500/5 to-crimson-500/2 border border-crimson-500/20 text-center">
                <h3 class="font-display font-700 text-gray-900 text-2xl mb-3">
                    Enjoying our insights?
                </h3>
                <p class="font-body text-gray-600 mb-6">
                    Get healthcare technology updates delivered to your inbox. No spam, ever.
                </p>
                <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                    <input type="email" 
                           placeholder="your@email.com"
                           class="flex-1 px-4 py-3 rounded-xl border-2 border-gray-300 bg-white text-gray-900 placeholder-gray-400
                                  focus:outline-none focus:border-crimson-500 focus:ring-4 focus:ring-crimson-500/10
                                  transition-all font-body text-sm">
                    <button type="submit"
                            class="px-6 py-3 rounded-xl bg-crimson-500 text-white font-display font-600 text-sm
                                   hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25">
                        Subscribe
                    </button>
                </form>
            </div>
        </section>

    </article>

    
    {{-- 
    <section class="max-w-3xl mx-auto px-6 lg:px-8 mt-20 pb-20 reveal">
        <h3 class="font-display font-700 text-gray-900 text-2xl mb-8">Comments</h3>
        
    </section> 
@endsection

@push('scripts')
    <script>
        // Reveal animations
        const revealObs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -50px 0px' });
        document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

        // Copy link feedback
        document.querySelector('button[title="Copy link"]')?.addEventListener('click', function(e) {
            const original = this.innerHTML;
            this.innerHTML = '<svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    </script>
@endpush