@extends('layouts.app')

@section('content')<article class="pt-24 pb-20 bg-gray-50 min-h-screen"><div class="max-w-4xl mx-auto px-6 lg:px-8 mb-8 reveal">
                <nav class="flex text-sm font-display">
                    <ol class="flex items-center space-x-2">
                        <li>
                            <a href="{{ url('/') }}" class="text-gray-500 hover:text-crimson-600 transition-colors">Home</a>
                        </li>
                        <li><span class="text-gray-300">/</span></li>
                        <li>
                            <a href="{{ route('services.index') }}"
                                class="text-gray-500 hover:text-crimson-600 transition-colors">Services</a>
                        </li>
                        <li><span class="text-gray-300">/</span></li>
                        <li>
                            <span class="text-crimson-600 font-600">{{ $service->name }}</span>
                        </li>
                    </ol>
                </nav>
            </div><header class="max-w-4xl mx-auto px-6 lg:px-8 mb-14 reveal reveal-delay-1">

                
                <span
                    class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-display font-600 tracking-wider uppercase border mb-5 {{ $service->tagBadgeClass() }}">
                    {{ $service->tag }}
                </span>

                
                <h1 class="font-display font-800 text-4xl lg:text-5xl text-gray-900 leading-tight mb-5">
                    {{ $service->name }}
                </h1>

                
                @if($service->tagline)
                    <p class="font-body text-xl text-gray-600 leading-relaxed mb-8">
                        {{ $service->tagline }}
                    </p>
                @endif

                
                <div
                    class="flex flex-wrap items-center gap-4 text-sm font-body text-gray-500 pb-8 border-b border-gray-200">
                    
                    <div class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 rounded-lg bg-crimson-500/10 border border-crimson-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="{{ $service->icon }}" />
                            </svg>
                        </div>
                        <span class="font-display font-600 text-gray-700">REDSOL</span>
                    </div>

                    <span class="text-gray-300">•</span>

                    
                    <span>{{ $service->tag }} Service</span>

                    <span class="text-gray-300">•</span>

                    
                    <a href="/contact"
                        class="inline-flex items-center gap-1.5 text-crimson-600 font-display font-600 hover:underline transition-all">
                        Request this service
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </header><div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-12 items-start">


                    
                    <div>

                        
                        @if($service->description)
                            <div class="bg-white rounded-3xl border border-gray-200 p-8 lg:p-10 mb-8 reveal reveal-delay-2">
                                <div class="flex items-center gap-3 mb-5">
                                    <div class="h-px w-10 bg-crimson-500"></div>
                                    <span
                                        class="text-crimson-500 text-xs font-display tracking-widests uppercase font-600">About
                                        This Service</span>
                                </div>
                                <div class="prose prose-lg max-w-none
                                        prose-headings:font-display prose-headings:text-gray-900
                                        prose-h2:text-2xl prose-h3:text-xl
                                        prose-p:text-gray-600 prose-p:leading-relaxed prose-p:font-body
                                        prose-li:text-gray-600 prose-li:font-body
                                        prose-strong:text-gray-900
                                        prose-a:text-crimson-600 hover:prose-a:underline
                                        prose-blockquote:border-crimson-500 prose-blockquote:text-gray-700">
                                    {!! nl2br(e($service->description)) !!}
                                </div>
                            </div>
                        @endif


                        
                        @if($service->features && count($service->features))
                            <div class="bg-white rounded-3xl border border-gray-200 p-8 lg:p-10 mb-8 reveal reveal-delay-3">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="h-px w-10 bg-crimson-500"></div>
                                    <span
                                        class="text-crimson-500 text-xs font-display tracking-widests uppercase font-600">What's
                                        Included</span>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @foreach($service->features as $feature)
                                        <div
                                            class="flex items-start gap-3 p-4 rounded-2xl bg-gray-50 border border-gray-100
                                                hover:bg-crimson-500/3 hover:border-crimson-500/15 transition-all duration-200 group">
                                            <div class="w-5 h-5 rounded-full bg-crimson-500 flex items-center justify-center shrink-0 mt-0.5
                                                    group-hover:scale-110 transition-transform">
                                                <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                            <span class="font-body text-sm text-gray-700 leading-snug">{{ $feature }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif


                        
                        <div
                            class="bg-gray-900 rounded-3xl p-8 lg:p-10 mb-8 relative overflow-hidden reveal reveal-delay-4">
                            
                            <div class="absolute inset-0 pointer-events-none opacity-40"
                                style="background-image: linear-gradient(rgba(225,29,72,0.06) 1px, transparent 1px), linear-gradient(90deg, rgba(225,29,72,0.06) 1px, transparent 1px); background-size: 32px 32px;">
                            </div>

                            <div class="relative z-10">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="h-px w-10 bg-crimson-500"></div>
                                    <span
                                        class="text-crimson-400 text-xs font-display tracking-widests uppercase font-600">Our
                                        Process</span>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-0 relative">
                                    
                                    <div
                                        class="hidden lg:block absolute top-6 left-[calc(12.5%+20px)] right-[calc(12.5%+20px)] h-px bg-gradient-to-r from-crimson-500/40 via-crimson-500/20 to-crimson-500/40">
                                    </div>

                                    @php
                                        $steps = [
                                            ['num' => '01', 'title' => 'Consultation', 'desc' => 'We assess your hospital\'s workflows and requirements.'],
                                            ['num' => '02', 'title' => 'Scoping', 'desc' => 'Clear timeline, deliverables, and pricing agreed upfront.'],
                                            ['num' => '03', 'title' => 'Delivery', 'desc' => 'Your solution built, configured, and tested thoroughly.'],
                                            ['num' => '04', 'title' => 'Support', 'desc' => 'Go-live support and ongoing AMC maintenance.'],
                                        ];
                                    @endphp

                                    @foreach($steps as $i => $step)
                                        <div class="flex flex-col items-center text-center px-4 py-2">
                                            <div
                                                class="w-12 h-12 rounded-2xl bg-crimson-500/15 border border-crimson-500/30 flex items-center justify-center mb-4 relative z-10">
                                                <span class="font-display font-800 text-crimson-400 text-sm">{{ $step['num'] }}</span>
                                            </div>
                                            <div class="font-display font-700 text-white text-sm mb-2">{{ $step['title'] }}
                                            </div>
                                            <p class="font-body text-gray-500 text-xs leading-relaxed">{{ $step['desc'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        
                        @if(isset($relatedServices) && $relatedServices->count())
                            <div class="reveal reveal-delay-5">
                                <div class="flex items-center gap-3 mb-5">
                                    <div class="h-px w-10 bg-crimson-500"></div>
                                    <span
                                        class="text-crimson-500 text-xs font-display tracking-widests uppercase font-600">Related
                                        Services</span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($relatedServices as $related)
                                        <a href="{{ route('services.show', $related->slug) }}"
                                            class="group bg-white rounded-2xl border border-gray-200 p-5 card-hover flex items-start gap-4">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-crimson-500/8 border border-crimson-500/15 flex items-center justify-center shrink-0
                                                    group-hover:bg-crimson-500/15 group-hover:border-crimson-500/30 transition-all">
                                                <svg class="w-4 h-4 text-crimson-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="{{ $related->icon }}" />
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div
                                                    class="font-display font-700 text-gray-900 text-sm mb-1 group-hover:text-crimson-600 transition-colors">
                                                    {{ $related->name }}
                                                </div>
                                                <p class="font-body text-xs text-gray-400 line-clamp-2">{{ $related->tagline }}</p>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-300 group-hover:text-crimson-500 shrink-0 mt-0.5 transition-colors"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>


                    
                    <div class="space-y-5 lg:sticky lg:top-28">

                        
                        <div
                            class="p-6 rounded-3xl bg-gradient-to-br from-crimson-500/5 to-crimson-500/2 border border-crimson-500/20 text-center reveal reveal-delay-2">
                            <div
                                class="w-14 h-14 rounded-2xl bg-crimson-500/10 border border-crimson-500/20 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="{{ $service->icon }}" />
                                </svg>
                            </div>
                            <h3 class="font-display font-700 text-gray-900 text-lg mb-2">
                                Interested in {{ $service->name }}?
                            </h3>
                            <p class="font-body text-gray-600 text-sm mb-5 leading-relaxed">
                                Book a Free Demo and we'll discuss exactly how this fits your hospital's needs.
                            </p>
                            <a href="/contact" class="block w-full py-3 px-5 rounded-xl bg-crimson-500 text-white font-display font-700 text-sm text-center
                                  hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25">
                                Request a Free Consultation
                            </a>
                            <a href="{{ route('services.index') }}" class="block w-full mt-2 py-2.5 px-5 rounded-xl border border-gray-200 text-gray-600 font-display font-600 text-sm text-center
                                  hover:border-gray-300 hover:bg-gray-50 transition-all">
                                View All Services
                            </a>
                        </div>


                        
                        <div class="bg-white rounded-3xl border border-gray-200 overflow-hidden reveal reveal-delay-3">
                            <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                                    <span class="font-display font-700 text-gray-900 text-sm">Service Details</span>
                                </div>
                            </div>
                            <div class="divide-y divide-gray-50 px-5">
                                @foreach([
                                        ['label' => 'Type', 'value' => $service->tag],
                                        ['label' => 'Delivery', 'value' => 'On-site & Remote'],
                                        ['label' => 'Training', 'value' => 'Included'],
                                        ['label' => 'Support', 'value' => 'AMC Available'],
                                        ['label' => 'ICD-10', 'value' => 'Compliant'],
                                    ] as $info)
                                    <div class="flex items-center justify-between py-3">
                                        <span class="font-body text-xs text-gray-400">{{ $info['label'] }}</span>
                                        <span class="font-display font-600 text-xs text-gray-700">{{ $info['value'] }}</span>
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
                                        ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'text' => '99% client retention rate'],
                                        ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'text' => 'Full staff training included'],
                                        ['icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'text' => '24/7 AMC support available'],
                                        ['icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'text' => $hospitalCount . '+ hospitals served'],
                                    ] as $trust)
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-7 h-7 rounded-lg bg-crimson-500/8 flex items-center justify-center shrink-0">
                                            <svg class="w-3.5 h-3.5 text-crimson-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="{{ $trust['icon'] }}" />
                                            </svg>
                                        </div>
                                        <span class="font-body text-xs text-gray-600">{{ $trust['text'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        
                        @if(isset($allServices) && $allServices->count())
                            <div class="bg-white rounded-3xl border border-gray-200 overflow-hidden reveal reveal-delay-5">
                                <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                                        <span class="font-display font-700 text-gray-900 text-sm">All Services</span>
                                    </div>
                                </div>
                                <div class="divide-y divide-gray-50">
                                    @foreach($allServices as $svc)
                                        <a href="{{ route('services.show', $svc->slug) }}" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-50 transition-colors group
                                              {{ $svc->slug === $service->slug ? 'bg-crimson-500/4' : '' }}">
                                            <span
                                                class="w-1.5 h-1.5 rounded-full shrink-0
                                                     {{ $svc->slug === $service->slug ? 'bg-crimson-500' : 'bg-gray-200 group-hover:bg-crimson-500/40' }} transition-colors"></span>
                                            <span
                                                class="font-body text-sm font-500 truncate
                                                     {{ $svc->slug === $service->slug ? 'text-crimson-600 font-600' : 'text-gray-600 group-hover:text-crimson-600' }} transition-colors">
                                                {{ $svc->name }}
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div><section class="max-w-3xl mx-auto px-6 lg:px-8 mt-20 reveal reveal-delay-5">
                <div
                    class="p-8 rounded-3xl bg-gradient-to-br from-crimson-500/5 to-crimson-500/2 border border-crimson-500/20 text-center">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-crimson-500/25 bg-crimson-500/8 mb-5">
                        <span class="w-2 h-2 rounded-full bg-crimson-500 animate-pulse"></span>
                        <span class="text-crimson-500 text-xs font-display tracking-widests uppercase font-600">Ready to Get
                            Started?</span>
                    </div>
                    <h3 class="font-display font-700 text-gray-900 text-2xl mb-3">
                        Let's Discuss {{ $service->name }}
                    </h3>
                    <p class="font-body text-gray-600 mb-6 leading-relaxed">
                        Book a Free Demo and our team will walk you through exactly how this service maps to your
                        hospital's workflows.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                        <a href="/contact" class="flex-1 flex items-center justify-center gap-2 py-3 px-6 rounded-xl bg-crimson-500 text-white font-display font-700 text-sm
                              hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25">
                            Book Free Consultation
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('services.index') }}" class="flex-1 flex items-center justify-center gap-2 py-3 px-6 rounded-xl border-2 border-gray-200 text-gray-700 font-display font-600 text-sm
                              hover:border-gray-300 hover:bg-white transition-all">
                            All Services
                        </a>
                    </div>
                </div>
            </section>

        </article>

@endsection

    @push('scripts')
        <script>
            const revealObs = new IntersectionObserver((entries) => {
                entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
            }, { threshold: 0.08, rootMargin: '0px 0px -50px 0px' });
            document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));
        </script>
    @endpush