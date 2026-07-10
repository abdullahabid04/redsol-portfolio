@extends('layouts.app')

@section('content')<article class="pt-24 pb-20 bg-gray-50 min-h-screen"><div class="max-w-4xl mx-auto px-6 lg:px-8 mb-8 reveal">
            <nav class="flex text-sm font-display">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="{{ url('/') }}"
                           class="text-gray-500 hover:text-crimson-600 transition-colors">Home</a>
                    </li>
                    <li><span class="text-gray-300">/</span></li>
                    <li>
                        <a href="{{ route('projects.index') }}"
                           class="text-gray-500 hover:text-crimson-600 transition-colors">Projects</a>
                    </li>
                    <li><span class="text-gray-300">/</span></li>
                    <li>
                        <span class="text-crimson-600 font-600">{{ $project->client_name }}</span>
                    </li>
                </ol>
            </nav>
        </div><header class="max-w-4xl mx-auto px-6 lg:px-8 mb-12 reveal reveal-delay-1">

            
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-display font-600 tracking-wider uppercase border mb-5 {{ $project->clientTypeBadgeClass() }}">
                {{ $project->clientTypeLabel() }}
            </span>

            
            <h1 class="font-display font-800 text-4xl lg:text-5xl text-gray-900 leading-tight mb-5">
                {{ $project->title }}
            </h1>

            
            @if($project->summary)
            <p class="font-body text-xl text-gray-600 leading-relaxed mb-8">
                {{ $project->summary }}
            </p>
            @endif

            
            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm font-body text-gray-500 pb-8 border-b border-gray-200">

                
                @if($project->locationString())
                <div class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>{{ $project->locationString() }}</span>
                </div>
                <span class="text-gray-300">•</span>
                @endif

                
                <div class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ $project->durationLabel() }}</span>
                </div>

                
                @if($project->completion_date)
                <span class="text-gray-300">•</span>
                <div class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $project->completion_date->format('F Y') }}</span>
                </div>
                @endif

                
                @if($project->moduleCount())
                <span class="text-gray-300">•</span>
                <span>{{ $project->moduleCount() }} modules deployed</span>
                @endif

            </div>
        </header>@if($project->featuredImageUrl())
        <div class="max-w-4xl mx-auto px-6 lg:px-8 mb-12 reveal reveal-delay-2">
            <figure class="rounded-3xl overflow-hidden shadow-lg border border-gray-200">
                <img src="{{ $project->featuredImageUrl() }}"
                     alt="{{ $project->featured_image_alt ?? $project->title }}"
                     class="w-full h-auto object-cover">
                @if($project->featured_image_alt)
                <figcaption class="px-5 py-3 bg-gray-100 text-xs text-gray-500 font-body">
                    {{ $project->featured_image_alt }}
                </figcaption>
                @endif
            </figure>
        </div>
        @endif@if($project->stats && count($project->stats))
            <div class="max-w-4xl mx-auto px-6 lg:px-8 mb-12 reveal reveal-delay-2">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-px bg-gray-200 rounded-3xl overflow-hidden border border-gray-200">

                    @foreach($project->stats as $key => $value)
                        <div class="bg-white px-6 py-6 text-center group hover:bg-crimson-500/3 transition-colors">
                            
                            <div
                                class="font-display font-800 text-2xl text-crimson-500 mb-1 group-hover:scale-110 transition-transform inline-block">
                                {{ $value }}
                            </div>

                            
                            <div class="font-body text-xs text-gray-400 tracking-wide">
                                {{ ucfirst(str_replace('_', ' ', $key)) }}
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endif<div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-12 items-start">


                
                <div class="space-y-8">

                    
                    @if($project->description)
                    <div class="bg-white rounded-3xl border border-gray-200 p-8 lg:p-10 reveal reveal-delay-2">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="h-px w-10 bg-crimson-500"></div>
                            <span class="text-crimson-500 text-xs font-display tracking-widests uppercase font-600">
                                About This Project
                            </span>
                        </div>
                        <div class="prose prose-lg max-w-none
                                    prose-headings:font-display prose-headings:text-gray-900
                                    prose-h2:text-2xl prose-h3:text-xl
                                    prose-p:text-gray-600 prose-p:leading-relaxed prose-p:font-body
                                    prose-li:text-gray-600 prose-li:font-body
                                    prose-strong:text-gray-900
                                    prose-a:text-crimson-600 hover:prose-a:underline
                                    prose-blockquote:border-crimson-500 prose-blockquote:text-gray-700
                                    prose-img:rounded-2xl prose-img:border prose-img:border-gray-200">
                            {!! $project->description !!}
                        </div>
                    </div>
                    @endif


                    
                    @if($project->outcomes && count($project->outcomes))
                    <div class="bg-white rounded-3xl border border-gray-200 p-8 lg:p-10 reveal reveal-delay-3">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="h-px w-10 bg-crimson-500"></div>
                            <span class="text-crimson-500 text-xs font-display tracking-widests uppercase font-600">
                                Project Outcomes
                            </span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($project->outcomes as $outcome)
                            <div class="flex items-start gap-3 p-4 rounded-2xl bg-gray-50 border border-gray-100
                                        hover:bg-crimson-500/3 hover:border-crimson-500/15 transition-all duration-200 group">
                                <div class="w-5 h-5 rounded-full bg-crimson-500 flex items-center justify-center shrink-0 mt-0.5
                                            group-hover:scale-110 transition-transform">
                                    <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <span class="font-body text-sm text-gray-700 leading-snug">{{ $outcome }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif


                    
                    @if($project->moduleCount())
                    <div class="bg-gray-900 rounded-3xl p-8 lg:p-10 relative overflow-hidden reveal reveal-delay-3">
                        
                        <div class="absolute inset-0 pointer-events-none opacity-40"
                             style="background-image:linear-gradient(rgba(225,29,72,0.06) 1px,transparent 1px),linear-gradient(90deg,rgba(225,29,72,0.06) 1px,transparent 1px);background-size:32px 32px;"></div>

                        <div class="relative z-10">
                            <div class="flex items-center justify-between flex-wrap gap-3 mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-px w-10 bg-crimson-500"></div>
                                    <span class="text-crimson-400 text-xs font-display tracking-widests uppercase font-600">
                                        HIS Modules Deployed
                                    </span>
                                </div>
                                <span class="font-display font-700 text-xs px-2.5 py-1 rounded-lg bg-crimson-500/20 text-crimson-400">
                                    {{ $project->moduleCount() }} modules
                                </span>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                @foreach($project->moduleNames() as $module)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-display font-600
                                             bg-white/8 text-gray-300 border border-white/10
                                             hover:bg-crimson-500/20 hover:text-crimson-300 hover:border-crimson-500/30 transition-all cursor-default">
                                    <span class="w-1 h-1 rounded-full bg-crimson-500"></span>
                                    {{ $module }}
                                </span>
                                @endforeach

                                
                                @if($project->moduleNames()->isEmpty())
                                    @foreach($project->modules_deployed as $slug)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-display font-600
                                                 bg-white/8 text-gray-300 border border-white/10">
                                        <span class="w-1 h-1 rounded-full bg-crimson-500"></span>
                                        {{ ucwords(str_replace(['-', '_'], ' ', $slug)) }}
                                    </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif


                    
                    @if($project->serviceNames()->isNotEmpty())
                    <div class="bg-white rounded-3xl border border-gray-200 p-8 lg:p-10 reveal reveal-delay-4">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="h-px w-10 bg-crimson-500"></div>
                            <span class="text-crimson-500 text-xs font-display tracking-widests uppercase font-600">
                                Services Provided
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->serviceNames() as $service)
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-display font-600 tracking-wider uppercase
                                         bg-crimson-500/10 text-crimson-700 border border-crimson-500/20">
                                {{ $service }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif


                    
                    @if(count($project->galleryUrls()))
                    <div class="reveal reveal-delay-4">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="h-px w-10 bg-crimson-500"></div>
                            <span class="text-crimson-500 text-xs font-display tracking-widests uppercase font-600">
                                Project Gallery
                            </span>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach($project->galleryUrls() as $imgUrl)
                            <div class="group rounded-2xl overflow-hidden border border-gray-200 aspect-video bg-gray-100 cursor-pointer"
                                 onclick="openLightbox('{{ $imgUrl }}')">
                                <img src="{{ $imgUrl }}"
                                     alt="Project gallery image"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                     loading="lazy">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif


                    
                    @if($project->testimonial)
                    <div class="reveal reveal-delay-5">
                        <div class="p-8 rounded-3xl bg-gradient-to-br from-crimson-500/5 to-crimson-500/2 border border-crimson-500/20">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="h-px w-10 bg-crimson-500"></div>
                                <span class="text-crimson-500 text-xs font-display tracking-widests uppercase font-600">
                                    Client Feedback
                                </span>
                            </div>

                            
                            @if(isset($project->testimonial->rating))
                            <div class="flex gap-1 mb-4">
                                @for($s = 0; $s < $project->testimonial->rating; $s++)
                                <svg class="w-4 h-4 text-crimson-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                                @endfor
                            </div>
                            @endif

                            
                            <div class="font-display text-7xl text-crimson-500/10 leading-none mb-2 select-none">"</div>

                            <blockquote class="font-body text-lg text-gray-700 leading-relaxed italic mb-6">
                                "{{ $project->testimonial->quote }}"
                            </blockquote>

                            <div class="flex items-center gap-3 pt-5 border-t border-crimson-500/15">
                                <div class="w-11 h-11 rounded-full bg-crimson-500 flex items-center justify-center shrink-0">
                                    <span class="font-display font-700 text-white">
                                        {{ strtoupper(substr($project->testimonial->name, 0, 2)) }}
                                    </span>
                                </div>
                                <div>
                                    <div class="font-display font-700 text-gray-900">
                                        {{ $project->testimonial->name }}
                                    </div>
                                    <div class="font-body text-sm text-gray-500">
                                        {{ $project->testimonial->role }}
                                        @if($project->testimonial->company)
                                            , {{ $project->testimonial->company }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>


                
                <div class="space-y-5 lg:sticky lg:top-28">

                    
                    <div class="p-6 rounded-3xl bg-gradient-to-br from-crimson-500/5 to-crimson-500/2 border border-crimson-500/20 text-center reveal reveal-delay-2">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-crimson-500/25 bg-crimson-500/8 mb-4">
                            <span class="w-1.5 h-1.5 rounded-full bg-crimson-500 animate-pulse"></span>
                            <span class="text-crimson-500 text-[10px] font-display font-600 tracking-widests uppercase">Similar Project?</span>
                        </div>
                        <h3 class="font-display font-700 text-gray-900 text-lg mb-2">
                            Let's Do This For Your Hospital
                        </h3>
                        <p class="font-body text-gray-600 text-sm mb-5 leading-relaxed">
                            Book a free consultation and see how REDSOL can deliver the same results for your facility.
                        </p>
                        <a href="/contact"
                           class="block w-full py-3 px-5 rounded-xl bg-crimson-500 text-white font-display font-700 text-sm text-center
                                  hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25 mb-2">
                            Book Free Consultation
                        </a>
                        <a href="{{ route('projects.index') }}"
                           class="block w-full py-2.5 px-5 rounded-xl border border-gray-200 text-gray-600 font-display font-600 text-sm text-center
                                  hover:border-gray-300 hover:bg-gray-50 transition-all">
                            View All Projects
                        </a>
                    </div>


                    
                    <div class="bg-white rounded-3xl border border-gray-200 overflow-hidden reveal reveal-delay-3">
                        <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                                <span class="font-display font-700 text-gray-900 text-sm">Project Details</span>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-50 px-5">
                            @foreach(array_filter([
        ['label' => 'Client', 'value' => $project->client_name],
        ['label' => 'Location', 'value' => $project->locationString() ?: null],
        ['label' => 'Type', 'value' => $project->clientTypeLabel()],
        ['label' => 'Duration', 'value' => $project->durationLabel()],
        ['label' => 'Completed', 'value' => $project->completion_date?->format('F Y')],
        ['label' => 'Modules', 'value' => $project->moduleCount() ? $project->moduleCount() . ' deployed' : null],
    ], fn($row) => !empty($row['value'])) as $info)
                            <div class="flex items-center justify-between py-3">
                                <span class="font-body text-xs text-gray-400">{{ $info['label'] }}</span>
                                <span class="font-display font-600 text-xs text-gray-700 text-right max-w-[160px]">{{ $info['value'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>


                    
                    <div class="bg-white rounded-3xl border border-gray-200 p-5 reveal reveal-delay-4">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                            <span class="font-display font-700 text-gray-900 text-sm">Why REDSOL</span>
                        </div>
                        <div class="space-y-3">
                            @foreach([
        [
            'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
            'text' => '99% client retention rate'
        ],
        [
            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
            'text' => 'Full staff training included'
        ],
        [
            'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z',
            'text' => '24/7 AMC support available'
        ],
        [
            'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z',
            'text' => $moduleCount . '+ HIS modules available'
        ],
    ] as $trust)
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 rounded-lg bg-crimson-500/8 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $trust['icon'] }}"/>
                                    </svg>
                                </div>
                                <span class="font-body text-xs text-gray-600">{{ $trust['text'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>


                    
                    @if(isset($relatedProjects) && $relatedProjects->count())
                    <div class="bg-white rounded-3xl border border-gray-200 overflow-hidden reveal reveal-delay-5">
                        <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                                <span class="font-display font-700 text-gray-900 text-sm">Related Projects</span>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-50">
                            @foreach($relatedProjects as $related)
                            <a href="{{ route('projects.show', $related->slug) }}"
                               class="group flex items-start gap-3 px-5 py-4 hover:bg-gray-50 transition-colors">
                                <div class="w-9 h-9 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center shrink-0
                                            group-hover:bg-crimson-500/10 group-hover:border-crimson-500/20 transition-all">
                                    <span class="font-display font-700 text-gray-500 text-xs group-hover:text-crimson-600 transition-colors">
                                        {{ strtoupper(substr($related->client_name, 0, 2)) }}
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-display font-600 text-gray-900 text-sm leading-snug group-hover:text-crimson-600 transition-colors line-clamp-2 mb-0.5">
                                        {{ $related->title }}
                                    </div>
                                    <div class="font-body text-xs text-gray-400">{{ $related->locationString() }}</div>
                                </div>
                                <svg class="w-4 h-4 text-gray-300 group-hover:text-crimson-500 shrink-0 mt-0.5 transition-colors"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>

            </div>
        </div><section class="max-w-3xl mx-auto px-6 lg:px-8 mt-20 reveal reveal-delay-5">
            <div class="p-8 rounded-3xl bg-gradient-to-br from-crimson-500/5 to-crimson-500/2 border border-crimson-500/20 text-center">
                <h3 class="font-display font-700 text-gray-900 text-2xl mb-3">
                    Ready to Start Your Project?
                </h3>
                <p class="font-body text-gray-600 mb-6 leading-relaxed">
                    Every successful deployment starts with a conversation. Book a free consultation and let's talk about your hospital's needs.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                    <a href="/contact"
                       class="flex-1 flex items-center justify-center gap-2 py-3 px-6 rounded-xl bg-crimson-500 text-white font-display font-700 text-sm
                              hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25">
                        Book Free Consultation
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="{{ route('projects.index') }}"
                       class="flex-1 flex items-center justify-center gap-2 py-3 px-6 rounded-xl border-2 border-gray-200 text-gray-700 font-display font-600 text-sm
                              hover:border-gray-300 hover:bg-white transition-all">
                        All Projects
                    </a>
                </div>
            </div>
        </section>

    </article>@if(count($project->galleryUrls()))
    <div id="lightbox"
         class="hidden fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4"
         onclick="closeLightbox()">
        <button class="absolute top-5 right-5 w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors"
                onclick="closeLightbox()">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="lightboxImg" src="" alt="Gallery image"
             class="max-w-full max-h-[85vh] object-contain rounded-2xl shadow-2xl"
             onclick="event.stopPropagation()">
    </div>
    @endif

@endsection

@push('scripts')
<script>
        const revealObs = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.08, rootMargin: '0px 0px -50px 0px' });
    document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

        function openLightbox(src) {
        document.getElementById('lightboxImg').src = src;
        document.getElementById('lightbox').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.getElementById('lightboxImg').src = '';
        document.body.style.overflow = '';
    }
    // Close on Escape key
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeLightbox();
    });
</script>
@endpush