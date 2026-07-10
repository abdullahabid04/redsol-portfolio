@extends('layouts.app')
    @section('content')

                    <section class="relative pt-36 pb-20 bg-gray-900 overflow-hidden">
                        
                        <div class="absolute inset-0 pointer-events-none"
                            style="background-image: linear-gradient(rgba(225,29,72,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(225,29,72,0.04) 1px, transparent 1px); background-size: 48px 48px;">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-900 to-transparent pointer-events-none">
                        </div>
                        <div
                            class="absolute top-0 right-0 w-[600px] h-[600px] rounded-full bg-crimson-500/5 blur-[120px] pointer-events-none">
                        </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <h1 class="font-display text-5xl lg:text-7xl font-800 text-white leading-[0.92] mb-6" data-aos="fade-up">
                    REDSOL <span class="text-crimson-500">Insights</span>
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Latest news, product updates, and thought leadership in healthcare technology and digital transformation.
                </p>
            </div>

                    </section>

                        <!-- Blog Grid -->
                        <section class="py-24 bg-midnight relative z-10 border-t border-white/5 min-h-[60vh]">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    @forelse($blogPosts as $post)
                                        <article
                                            class="group flex flex-col h-full bg-white border border-gray-200 rounded-2xl overflow-hidden card-hover reveal"
                                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">

                                            
                                            <a href="{{ route('blog.show', $post->slug) }}"
                                                class="block w-full aspect-[16/10] bg-gray-100 rounded-t-2xl overflow-hidden relative">
                                                @if($post->featured_image)
                                                    <img src="{{ asset('storage/' . $post->featured_image) }}"
                                                        alt="{{ $post->featured_image_alt ?? $post->title }}"
                                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                                @else
                                                    
                                                    <div
                                                        class="absolute inset-0 flex items-center justify-center text-gray-300 group-hover:scale-105 transition-transform duration-500">
                                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif

                                                
                                                <div class="absolute top-4 left-4">
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-display font-600 tracking-wider uppercase 
                                                                   bg-crimson-500/10 text-crimson-700 border border-crimson-500/20">
                                                        {{ $post->category }}
                                                    </span>
                                                </div>
                                            </a>

                                            
                                            <div class="p-6 flex-grow flex flex-col">
                                                
                                                <div class="flex items-center text-gray-500 text-sm mb-4 font-body">
                                                    <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                                                        {{ $post->published_at->format('F j, Y') }}
                                                    </time>
                                                    <span class="mx-2">•</span>
                                                    <span>{{ $post->read_time_minutes }} min read</span>
                                                </div>

                                                
                                                <h2
                                                    class="font-display font-700 text-gray-900 text-lg mb-3 group-hover:text-crimson-600 transition-colors leading-snug">
                                                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:underline">
                                                        {{ $post->title }}
                                                    </a>
                                                </h2>

                                                
                                                <p class="font-body text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                                    {{ $post->excerpt }}
                                                </p>

                                                
                                                @if($post->tags && count($post->tags))
                                                    <div class="flex flex-wrap gap-2 mb-6">
                                                        @foreach(array_slice($post->tags, 0, 2) as $tag)
                                                            <span class="px-2 py-0.5 rounded text-[10px] font-display font-600 tracking-wide 
                                                                                   bg-gray-100 text-gray-600 border border-gray-200">
                                                                #{{ $tag }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                
                                                <div class="mt-auto">
                                                    <a href="{{ route('blog.show', $post->slug) }}"
                                                        class="inline-flex items-center text-crimson-600 font-display font-600 hover:text-crimson-700 transition-colors text-sm uppercase tracking-wider group/link">
                                                        Read Article
                                                        <svg class="ml-2 w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </article>
                                    @empty
                                        
                                        <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
                                            <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                                </svg>
                                            </div>
                                            <h3 class="font-display font-700 text-gray-900 text-xl mb-2">No articles yet</h3>
                                            <p class="font-body text-gray-500 max-w-sm">
                                                We're working on new insights about healthcare technology. Check back soon!
                                            </p>
                                        </div>
                                    @endforelse
                                </div>

                                
                                @if($blogPosts->onFirstPage())
                                    <span class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center
                                                                                     text-gray-300 cursor-not-allowed">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </span>
                                @else
                                    <a href="{{ $blogPosts->previousPageUrl() }}"
                                        class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center
                                                                                  text-gray-500 hover:border-crimson-500/30 hover:text-crimson-600 transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </a>
                                @endif

                                
                                @if($blogPosts instanceof \Illuminate\Pagination\LengthAwarePaginator && $blogPosts->hasPages())
                                    <div class="mt-12 flex items-center justify-center gap-1.5 reveal">

                                        
                                        @if($blogPosts->onFirstPage())
                                            <span
                                                class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-300 cursor-not-allowed">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                                </svg>
                                            </span>
                                        @else
                                            <a href="{{ $blogPosts->previousPageUrl() }}"
                                                class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-crimson-500/30 hover:text-crimson-600 hover:bg-crimson-500/3 transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                                </svg>
                                            </a>
                                        @endif

                                        
                                        @foreach($blogPosts->getUrlRange(
                                            max(1, $blogPosts->currentPage() - 2),
                                            min($blogPosts->lastPage(), $blogPosts->currentPage() + 2)
                                        ) as $page => $url)
                                            @if($page === $blogPosts->currentPage())
                                                    <span class="w-10 h-10 rounded-xl bg-crimson-500 text-white border border-crimson-500 flex items-center justify-center text-sm font-display font-700">
                                                    {{ $page }}
                                                 </span>
                                              @else
                                                <a href="{{ $url }}" 
                                                       class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-sm font-display font-700 text-gray-500 hover:border-crimson-500/30 hover:text-crimson-600 hover:bg-crimson-500/3 transition-all">
                                                            {{ $page }}
                                                                    </a>
                                            @endif
                                        @endforeach

                                    
                                    @if($blogPosts->hasMorePages())
                                        <a href="{{ $blogPosts->nextPageUrl() }}" 
                                            class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-crimson-500/30 hover:text-crimson-600 hover:bg-crimson-500/3 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            <
                                         /  svg>
                                        </a>
                                    @else
                                         <span class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-300 cursor-not-allowed">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                            </svg>
                                            </span>
                                    @endif

                                    </div>
                                @endif

                            </div>
                        </section>

                        
    @endsection
