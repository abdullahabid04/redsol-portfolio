@extends('layouts.app')

@section('content')
    <section class="relative w-full h-screen min-h-[700px] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">

            <!-- Slide 0 -->
            <div class="hero-slide active" id="slide-0">
                <img src="{{ asset('images/1.png') }}" alt="Connected Digital Ecosystems"
                    class="w-full h-full object-cover scale-105 transition-transform duration-[8000ms] ease-linear"
                    id="slide-img-0">
                <div
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-full sm:w-[45%] pl-6 pr-4 sm:pl-10 sm:pr-6 lg:pl-16 lg:pr-8">
                    <div
                        class="max-w-lg rounded-2xl bg-gray-900/50 backdrop-blur-md border border-white/10 p-6 sm:p-8 shadow-2xl">
                        <p class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600 mb-3">01 /
                            NETWORK</p>
                        <h2
                            class="text-3xl sm:text-4xl lg:text-5xl font-display font-800 text-white leading-tight drop-shadow-lg">
                            Connected Digital<br>Ecosystems
                        </h2>
                        <p class="text-sm sm:text-base font-body text-gray-300 leading-relaxed mt-4">
                            We weave seamless integrations that transform how your systems, teams, and customers interact.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Slide 1 -->
            <div class="hero-slide" id="slide-1">
                <img src="{{ asset('images/2.png') }}" alt="Enterprise-Grade Infrastructure"
                    class="w-full h-full object-cover scale-105 transition-transform duration-[8000ms] ease-linear"
                    id="slide-img-1">
                <div
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-full sm:w-[45%] pl-6 pr-4 sm:pl-10 sm:pr-6 lg:pl-16 lg:pr-8">
                    <div
                        class="max-w-lg rounded-2xl bg-gray-900/50 backdrop-blur-md border border-white/10 p-6 sm:p-8 shadow-2xl">
                        <p class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600 mb-3">02 /
                            HARDWARE</p>
                        <h2
                            class="text-3xl sm:text-4xl lg:text-5xl font-display font-800 text-white leading-tight drop-shadow-lg">
                            Enterprise-Grade<br>Infrastructure
                        </h2>
                        <p class="text-sm sm:text-base font-body text-gray-300 leading-relaxed mt-4">
                            High-performance hosting, data centers, and server solutions built for mission-critical
                            applications.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="hero-slide" id="slide-2">
                <img src="{{ asset('images/3.png') }}" alt="Cloud-Powered Infrastructure"
                    class="w-full h-full object-cover scale-105 transition-transform duration-[8000ms] ease-linear"
                    id="slide-img-2">
                <div
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-full sm:w-[45%] pl-6 pr-4 sm:pl-10 sm:pr-6 lg:pl-16 lg:pr-8">
                    <div
                        class="max-w-lg rounded-2xl bg-gray-900/60 backdrop-blur-md border border-white/10 p-6 sm:p-8 shadow-2xl">
                        <p class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600 mb-3">03 / CLOUD
                        </p>
                        <h2
                            class="text-3xl sm:text-4xl lg:text-5xl font-display font-800 text-white leading-tight drop-shadow-lg">
                            Cloud-Powered<br>Infrastructure
                        </h2>
                        <p class="text-sm sm:text-base font-body text-gray-300 leading-relaxed mt-4">
                            Scalable, secure, and always-on solutions that keep your business running 24/7 with
                            enterprise-grade reliability.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="hero-slide" id="slide-3">
                <img src="{{ asset('images/4.png') }}" alt="End-to-End IT Solutions"
                    class="w-full h-full object-cover scale-105 transition-transform duration-[8000ms] ease-linear"
                    id="slide-img-3">
                <div
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-full sm:w-[45%] pl-6 pr-4 sm:pl-10 sm:pr-6 lg:pl-16 lg:pr-8">
                    <div
                        class="max-w-lg rounded-2xl bg-gray-900/50 backdrop-blur-md border border-white/10 p-6 sm:p-8 shadow-2xl">
                        <p class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600 mb-3">04 /
                            SOLUTIONS</p>
                        <h2
                            class="text-3xl sm:text-4xl lg:text-5xl font-display font-800 text-white leading-tight drop-shadow-lg">
                            End-to-End<br>IT Solutions
                        </h2>
                        <p class="text-sm sm:text-base font-body text-gray-300 leading-relaxed mt-4">
                            From strategy to execution — cloud, automation, consulting, and support tailored to your goals.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="hero-slide" id="slide-4">
                <img src="{{ asset('images/5.png') }}" alt="Intelligent Process Automation"
                    class="w-full h-full object-cover scale-105 transition-transform duration-[8000ms] ease-linear"
                    id="slide-img-4">
                <div
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-full sm:w-[45%] pl-6 pr-4 sm:pl-10 sm:pr-6 lg:pl-16 lg:pr-8">
                    <div
                        class="max-w-lg rounded-2xl bg-gray-900/50 backdrop-blur-md border border-white/10 p-6 sm:p-8 shadow-2xl">
                        <p class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600 mb-3">05 /
                            AUTOMATION</p>
                        <h2
                            class="text-3xl sm:text-4xl lg:text-5xl font-display font-800 text-white leading-tight drop-shadow-lg">
                            Intelligent Process<br>Automation
                        </h2>
                        <p class="text-sm sm:text-base font-body text-gray-300 leading-relaxed mt-4">
                            Streamline workflows, eliminate bottlenecks, and accelerate growth with smart, automated
                            systems.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Slide 5 -->
            <div class="hero-slide" id="slide-5">
                <img src="{{ asset('images/7.png') }}" alt="AI-Powered Cloud Solutions"
                    class="w-full h-full object-cover scale-105 transition-transform duration-[8000ms] ease-linear"
                    id="slide-img-5">
                <div
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-full sm:w-[45%] pl-6 pr-4 sm:pl-10 sm:pr-6 lg:pl-16 lg:pr-8">
                    <div
                        class="max-w-lg rounded-2xl bg-gray-900/50 backdrop-blur-md border border-white/10 p-6 sm:p-8 shadow-2xl">
                        <p class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600 mb-3">06 / AI &
                            CLOUD</p>
                        <h2
                            class="text-3xl sm:text-4xl lg:text-5xl font-display font-800 text-white leading-tight drop-shadow-lg">
                            AI-Powered Cloud<br>Solutions
                        </h2>
                        <p class="text-sm sm:text-base font-body text-gray-300 leading-relaxed mt-4">
                            Intelligent automation meets scalable cloud infrastructure — transforming how your business
                            operates in the digital age.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Background Overlays -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/70 to-black/30"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <div
                    class="absolute w-full h-px bg-gradient-to-r from-transparent via-crimson-500/30 to-transparent scan-line">
                </div>
            </div>
        </div>

        <!-- Main Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 w-full pt-20">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-crimson-500/30 bg-crimson-500/10 mb-8 hero-tag"
                    style="opacity:0; animation: fadeUp 0.7s ease 0.2s forwards;">
                    <span class="w-2 h-2 rounded-full bg-crimson-500 animate-pulse-slow"></span>
                    <span class="text-crimson-400 text-xs font-display tracking-widest uppercase font-600">Healthcare
                        Software Solutions</span>
                </div>

                <h1 class="font-display text-5xl lg:text-7xl xl:text-8xl font-800 text-white leading-[0.95] mb-6"
                    style="opacity:0; animation: fadeUp 0.8s ease 0.4s forwards;">
                    The Digital<br>
                    <span class="red-gradient-text">Backbone</span><br>
                    <span class="text-gray-300">of Modern</span><br>
                    <span class="relative">
                        Healthcare
                        <svg class="absolute -bottom-2 left-0 w-full" height="6" viewBox="0 0 300 6" fill="none"
                            preserveAspectRatio="none">
                            <path d="M0 3 Q75 0 150 3 Q225 6 300 3" stroke="#e11d48" stroke-width="2" fill="none"
                                opacity="0.6" />
                        </svg>
                    </span>
                </h1>

                <p class="font-body text-lg text-gray-400 leading-relaxed mb-10 max-w-xl"
                    style="opacity:0; animation: fadeUp 0.8s ease 0.6s forwards;">
                    REDSOL delivers enterprise-grade Health Information Systems — from patient registration to radiology
                    imaging — built for hospitals that refuse to compromise.
                </p>

                <div class="flex flex-wrap gap-4" style="opacity:0; animation: fadeUp 0.8s ease 0.8s forwards;">
                    <a href="/products"
                        class="group flex items-center gap-3 px-8 py-4 rounded-2xl bg-crimson-500 text-white font-display font-700 text-sm hover:bg-crimson-600 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-crimson-500/30">
                        Explore Our Products
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="/contact"
                        class="group flex items-center gap-3 px-8 py-4 rounded-2xl border border-white/20 text-gray-300 font-display font-600 text-sm hover:border-crimson-500/40 hover:text-crimson-400 hover:bg-crimson-500/5 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Watch Demo
                    </a>
                </div>

                <div class="mt-14 flex items-center gap-6" style="opacity:0; animation: fadeUp 0.8s ease 1s forwards;">
                    <div class="flex -space-x-2">
                        @foreach (['bg-crimson-500', 'bg-gray-700', 'bg-crimson-700', 'bg-gray-500'] as $color)
                            <div
                                class="w-8 h-8 rounded-full {{ $color }} border-2 border-black flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        @endforeach
                    </div>
                    <span class="text-gray-500 text-sm font-body">
                        <span class="text-white font-600">{{ $moduleCount }}+ modules</span> — one integrated platform
                    </span>
                </div>
            </div>
        </div>

        <!-- Slide Indicators -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-2" id="slideIndicators">
            @for ($i = 0; $i < 6; $i++)
                <button onclick="goToSlide({{ $i }})"
                    class="slide-dot h-1 rounded-full transition-all duration-500 {{ $i === 0 ? 'w-8 bg-crimson-500' : 'w-2 bg-white/30' }}"
                    data-index="{{ $i }}"></button>
            @endfor
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-10 right-10 z-20 flex flex-col items-center gap-2 opacity-60">
            <span class="text-gray-400 text-[10px] tracking-widest uppercase font-body"
                style="writing-mode: vertical-rl;">Scroll Down</span>
            <div class="w-px h-12 bg-gradient-to-b from-crimson-500 to-transparent"></div>
        </div>
    </section>

    <section class="relative py-20 border-y border-gray-200">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-0 lg:divide-x lg:divide-gray-200">
                @php
                    $stats = [
                        [
                            'number' => $hospitalCount,
                            'suffix' => '+',
                            'label' => 'Hospitals Deployed',
                            'icon' =>
                                'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                        ],
                        [
                            'number' => $moduleCount,
                            'suffix' => '+',
                            'label' => 'HIS Modules',
                            'icon' =>
                                'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z',
                        ],
                        [
                            'number' => 12,
                            'suffix' => '+',
                            'label' => 'Years Experience',
                            'icon' =>
                                'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
                        ],
                        [
                            'number' => 99,
                            'suffix' => '%',
                            'label' => 'Client Retention',
                            'icon' =>
                                'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                        ],
                    ];
                @endphp

                @foreach ($stats as $i => $stat)
                    <div class="flex flex-col items-center text-center lg:px-10 reveal reveal-delay-{{ $i + 1 }}">
                        <div
                            class="w-12 h-12 rounded-2xl bg-crimson-500/8 border border-crimson-500/20 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-crimson-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="{{ $stat['icon'] }}" />
                            </svg>
                        </div>
                        <div class="stat-number text-5xl lg:text-6xl font-display font-800 leading-none mb-2">
                            <span data-target="{{ $stat['number'] }}">0</span>{{ $stat['suffix'] }}
                        </div>
                        <div class="text-gray-500 text-sm font-body tracking-wide">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-28 relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-2xl mb-16 reveal">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-px w-12 bg-crimson-500"></div>
                    <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">What We
                        Do</span>
                </div>
                <h2 class="font-display text-4xl lg:text-5xl font-800 text-gray-900 leading-tight mb-5">
                    Healthcare Software,<br>
                    <span class="red-gradient-text">Done Right</span>
                </h2>
                <p class="font-body text-gray-500 leading-relaxed">
                    From end-to-end HIS implementation to bespoke patient portals, we build software that makes hospitals
                    run smarter — and care better.
                </p>
            </div>

            <div class="relative">
                <button id="servicesScrollLeft"
                    class="absolute left-2 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white border border-crimson-500/20 flex items-center justify-center text-crimson-500 hover:bg-crimson-500/5 hover:border-crimson-500/40 transition-all duration-200 shadow-md md:opacity-100 md:pointer-events-auto"
                    aria-label="Scroll left">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <div class="flex gap-5 overflow-x-auto scroll-track px-6 lg:px-8 pb-4 overflow-hidden" id="servicesTrack">
                    @php
                        $colorMap = [
                            'HIS-Related' => [
                                'icon' => 'text-crimson-500',
                                'bg' => 'bg-crimson-500/8',
                                'border' => 'border-crimson-500/20',
                                'tag' => 'bg-crimson-500/10 text-crimson-600 border-crimson-500/25',
                            ],
                            'Custom Dev' => [
                                'icon' => 'text-gray-700',
                                'bg' => 'bg-gray-100',
                                'border' => 'border-gray-200',
                                'tag' => 'bg-gray-100 text-gray-600 border-gray-200',
                            ],
                            'Support' => [
                                'icon' => 'text-gray-700',
                                'bg' => 'bg-gray-100',
                                'border' => 'border-gray-200',
                                'tag' => 'bg-gray-100 text-gray-600 border-gray-200',
                            ],
                            'Advisory' => [
                                'icon' => 'text-gray-700',
                                'bg' => 'bg-gray-100',
                                'border' => 'border-gray-200',
                                'tag' => 'bg-gray-100 text-gray-600 border-gray-200',
                            ],
                        ];
                    @endphp

                    @forelse($featuredServices as $service)
                        @php $c = $colorMap[$service->tag] ?? $colorMap['Custom Dev']; @endphp
                        <a href="{{ $service->href }}" class="flex-none w-80 card-hover group rounded-2xl p-7 bg-white">
                            <div class="flex items-start justify-between mb-5">
                                <div
                                    class="w-12 h-12 rounded-xl {{ $c['bg'] }} border {{ $c['border'] }} flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-5 h-5 {{ $c['icon'] }}" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="{{ $service->icon }}" />
                                    </svg>
                                </div>
                                <span
                                    class="text-[10px] font-display font-600 tracking-wider uppercase px-2.5 py-1 rounded-full border {{ $c['tag'] }}">
                                    {{ $service->tag }}
                                </span>
                            </div>
                            <h3
                                class="font-display font-700 text-gray-900 text-lg mb-2 group-hover:text-crimson-500 transition-colors">
                                {{ $service->name }}
                            </h3>
                            <p class="font-body text-gray-500 text-sm leading-relaxed mb-5 break-words overflow-hidden">
                                {{ $service->description }}
                            </p>
                            <div
                                class="flex items-center gap-2 text-xs font-display font-600 {{ $c['icon'] }} opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Learn More
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-500">No featured services available.</p>
                    @endforelse
                </div>

                <button id="servicesScrollRight"
                    class="absolute right-2 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white border border-crimson-500/20 flex items-center justify-center text-crimson-500 hover:bg-crimson-500/5 hover:border-crimson-500/40 transition-all duration-200 shadow-md md:opacity-100 md:pointer-events-auto"
                    aria-label="Scroll right">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>


                <div
                    class="absolute top-0 left-0 w-16 h-full bg-gradient-to-r from-white to-transparent pointer-events-none">
                </div>
                <div
                    class="absolute top-0 right-0 w-32 h-full bg-gradient-to-l from-white to-transparent pointer-events-none">
                </div>
            </div>

            <div class="text-center mt-10 reveal">
                <a href="/services"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-gray-200 text-gray-500 hover:text-crimson-500 hover:border-crimson-500/30 text-sm font-display font-600 transition-all duration-300">
                    View All Services
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <section class="py-20 border-t border-gray-200 overflow-hidden bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-10">
            <div class="flex items-end justify-between reveal">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="h-px w-12 bg-crimson-500"></div>
                        <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">Our
                            Products</span>
                    </div>
                    <h2 class="font-display text-4xl lg:text-5xl font-800 text-gray-900 leading-tight">
                        {{-- {{ $moduleCount }}  --}}
                        Hospital Management Information System<br>
                        <span class="red-gradient-text">One Platform.</span>
                    </h2>
                    <p class="mt-4 text-gray-600 text-base lg:text-lg max-w-xl leading-relaxed">
                        Manage your entire hospital — from patient care to billing — all in one unified platform.
                    </p>
                </div>
                <a href="/products"
                    class="hidden md:flex items-center gap-2 text-sm font-display font-600 text-crimson-500 hover:text-crimson-600 transition-colors">
                    All Products
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>


        <div class="relative">

            <button id="scrollLeft"
                class="absolute left-2 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white border border-crimson-500/20 flex items-center justify-center text-crimson-500 hover:bg-crimson-500/5 hover:border-crimson-500/40 transition-all duration-200 shadow-md md:opacity-100 md:pointer-events-auto"
                aria-label="Scroll left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="flex gap-5 overflow-x-auto scroll-track px-6 lg:px-8 pb-4" id="productTrack">

                @forelse($featuredModules as $module)
                    <a href="/products/{{ $module->slug }}"
                        class="flex-none w-72 card-hover rounded-2xl p-6 bg-white cursor-pointer group">
                        <div class="text-3xl mb-4">{{ $module->icon ?? '📦' }}</div>
                        <h3
                            class="font-display font-700 text-gray-900 text-base mb-2 group-hover:text-crimson-500 transition-colors">
                            {{ $module->name }}
                        </h3>
                        <p class="font-body text-gray-500 text-sm leading-relaxed">
                            {{ $module->tagline ?? Str::limit($module->description, 80) }}
                        </p>
                        <div
                            class="mt-4 flex items-center gap-1.5 text-xs text-crimson-500/60 font-body group-hover:text-crimson-500 transition-colors">
                            <span>View module</span>
                            <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500">No featured modules available.</p>
                @endforelse
            </div>


            <button id="scrollRight"
                class="absolute right-2 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white border border-crimson-500/20 flex items-center justify-center text-crimson-500 hover:bg-crimson-500/5 hover:border-crimson-500/40 transition-all duration-200 shadow-md md:opacity-100 md:pointer-events-auto"
                aria-label="Scroll right">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>


            <div
                class="absolute top-0 left-0 w-16 h-full bg-gradient-to-r from-gray-50 to-transparent pointer-events-none">
            </div>
            <div
                class="absolute top-0 right-0 w-32 h-full bg-gradient-to-l from-gray-50 to-transparent pointer-events-none">
            </div>
        </div>
    </section>

    <section class="py-28 relative border-t border-gray-200">
        <div class="absolute inset-0 bg-gradient-to-b from-gray-50/60 to-transparent pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-16 reveal">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="h-px w-12 bg-crimson-500"></div>
                    <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">How It
                        Works</span>
                    <div class="h-px w-12 bg-crimson-500"></div>
                </div>
                <h2 class="font-display text-4xl lg:text-5xl font-800 text-gray-900 leading-tight mb-4">
                    From Consultation<br>to <span class="red-gradient-text">Go-Live</span>
                </h2>
                <p class="font-body text-gray-500 max-w-xl mx-auto">
                    A structured, proven process that ensures your hospital's HIS is up and running — fully configured,
                    trained, and supported.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative">


                <div class="hidden lg:block absolute top-[52px] left-[calc(12.5%+24px)] right-[calc(12.5%+24px)] h-px">
                    <div class="h-full bg-gradient-to-r from-crimson-500/50 via-crimson-500/20 to-crimson-500/50"></div>
                </div>

                @php
                    $steps = [
                        [
                            'num' => '01',
                            'title' => 'Consultation',
                            'desc' =>
                                'We assess your hospital\'s workflows, current systems, and pain points to design the ideal HIS configuration.',
                            'icon' =>
                                'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z',
                        ],
                        [
                            'num' => '02',
                            'title' => 'Configuration',
                            'desc' =>
                                'Our team customizes and configures each module to match your hospital\'s specific departments and processes.',
                            'icon' =>
                                'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                        ],
                        [
                            'num' => '03',
                            'title' => 'Training',
                            'desc' =>
                                'Comprehensive hands-on training for all staff — from front desk to radiologists — with custom user manuals provided.',
                            'icon' =>
                                'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                        ],
                        [
                            'num' => '04',
                            'title' => 'Go-Live & Support',
                            'desc' =>
                                'We stay with you through launch day and beyond — with AMC contracts ensuring your system runs at peak performance.',
                            'icon' =>
                                'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                        ],
                    ];
                @endphp

                @foreach ($steps as $i => $step)
                    <div class="flex flex-col items-center text-center reveal reveal-delay-{{ $i + 1 }}">
                        <div class="relative mb-6">
                            <div
                                class="w-14 h-14 rounded-2xl bg-crimson-500/8 border border-crimson-500/20 flex items-center justify-center z-10 relative">
                                <svg class="w-6 h-6 text-crimson-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="{{ $step['icon'] }}" />
                                </svg>
                            </div>
                            <span
                                class="absolute -top-2 -right-3 font-display font-800 text-xs text-crimson-500/40">{{ $step['num'] }}</span>
                        </div>
                        <h3 class="font-display font-700 text-gray-900 text-lg mb-3">{{ $step['title'] }}</h3>
                        <p class="font-body text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20 border-t border-gray-200 overflow-hidden bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-12 reveal">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-px w-12 bg-crimson-500"></div>
                    <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">Trusted
                        By</span>
                </div>
                <a href="/clients"
                    class="text-sm font-display font-600 text-gray-400 hover:text-crimson-500 transition-colors flex items-center gap-1.5">
                    All Clients
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <p class="mt-3 font-body text-gray-500 text-sm">
                Hospitals and healthcare facilities across Pakistan putting their trust in REDSOL.
            </p>
        </div>

        <div class="relative">
            <button id="clientScrollLeft"
                class="absolute left-2 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white border border-crimson-500/20 flex items-center justify-center text-crimson-500 hover:bg-crimson-500/5 hover:border-crimson-500/40 transition-all duration-200 shadow-md md:opacity-100 md:pointer-events-auto"
                aria-label="Scroll left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="flex gap-5 overflow-x-auto scroll-track px-6 lg:px-8 pb-4" id="clientTrack">
                @forelse($featuredClients as $client)
                    <div
                        class="flex-none w-72 sm:w-80 group overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm transition hover:shadow-lg">
                        <div class="h-48 bg-gray-100 overflow-hidden">
                            @if ($client->logoUrl())
                                <img src="{{ $client->logoUrl() }}" alt="{{ $client->logo_alt ?? $client->name }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                    <span class="text-4xl font-display font-800 text-gray-500">
                                        {{ collect(explode(' ', $client->name))->take(2)->map(fn($w) => strtoupper($w[0]))->implode('') }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="text-base font-display font-700 text-gray-900 mb-2">{{ $client->name }}</div>
                            <div class="text-xs uppercase tracking-[0.24em] text-gray-500 mb-4">
                                {{ $client->locationString() }}</div>
                            <div class="text-sm text-gray-700">
                                {{ $client->deployedModuleCount() }} modules deployed
                            </div>
                            @if (!empty($client->modules))
                                @foreach ($client->modules as $module)
                                    <div class="text-sm text-gray-500">
                                        {{ $module }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No featured clients available.</p>
                @endforelse
            </div>

            <button id="clientScrollRight"
                class="absolute right-2 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white border border-crimson-500/20 flex items-center justify-center text-crimson-500 hover:bg-crimson-500/5 hover:border-crimson-500/40 transition-all duration-200 shadow-md md:opacity-100 md:pointer-events-auto"
                aria-label="Scroll right">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div
                class="absolute top-0 left-0 w-16 h-full bg-gradient-to-r from-gray-50 to-transparent pointer-events-none">
            </div>
            <div
                class="absolute top-0 right-0 w-32 h-full bg-gradient-to-l from-gray-50 to-transparent pointer-events-none">
            </div>
        </div>
    </section>

    <section class="py-28 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-16 reveal">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="h-px w-12 bg-crimson-500"></div>
                    <span
                        class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">Testimonials</span>
                    <div class="h-px w-12 bg-crimson-500"></div>
                </div>
                <h2 class="font-display text-4xl lg:text-5xl font-800 text-gray-900 leading-tight">
                    What Hospital Leaders<br>
                    <span class="red-gradient-text">Say About Us</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6" x-data="{ active: 0 }">

                @php
                    $testimonials = [
                        [
                            'quote' =>
                                'REDSOL\'s HIS transformed our entire patient flow. What used to take hours at registration now takes minutes. The LIMS integration alone saved our lab team immeasurable time every single day.',
                            'name' => 'Dr. Muhammad Arif',
                            'role' => 'Medical Superintendent',
                            'hospital' => 'DHQ Hospital',
                            'rating' => 5,
                            'initials' => 'MA',
                            'color' => 'from-crimson-500 to-crimson-700',
                        ],
                        [
                            'quote' =>
                                'The PACS system they integrated is world-class. Our radiologists can access patient imaging from any workstation in the hospital. The voice recognition reporting feature is a game changer for our department.',
                            'name' => 'Dr. Sarah Hassan',
                            'role' => 'Head of Radiology',
                            'hospital' => 'Civil Hospital',
                            'rating' => 5,
                            'initials' => 'SH',
                            'color' => 'from-gray-700 to-gray-900',
                        ],
                        [
                            'quote' =>
                                'We deployed REDSOL across 4 hospital branches. Their team configured each location perfectly and the training was thorough. The AMC support is prompt and professional — exactly what a hospital needs.',
                            'name' => 'Mr. Khalid Mehmood',
                            'role' => 'Hospital Administrator',
                            'hospital' => 'Allied Medical Center',
                            'rating' => 5,
                            'initials' => 'KM',
                            'color' => 'from-crimson-600 to-gray-800',
                        ],
                    ];
                @endphp

                @foreach ($testimonials as $i => $t)
                    <div class="testimonial-card rounded-2xl p-7 reveal reveal-delay-{{ $i + 1 }}">

                        <div class="flex gap-1 mb-5">
                            @for ($s = 0; $s < $t['rating']; $s++)
                                <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            @endfor
                        </div>


                        <blockquote class="font-body text-gray-600 text-sm leading-relaxed mb-6 italic">
                            "{{ $t['quote'] }}"
                        </blockquote>


                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br {{ $t['color'] }} flex items-center justify-center font-display font-700 text-white text-sm">
                                {{ $t['initials'] }}
                            </div>
                            <div>
                                <div class="font-display font-600 text-gray-900 text-sm">{{ $t['name'] }}</div>
                                <div class="font-body text-gray-500 text-xs">{{ $t['role'] }}, {{ $t['hospital'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-10 reveal">
                <a href="/testimonials"
                    class="inline-flex items-center gap-2 text-sm font-display font-600 text-gray-500 hover:text-crimson-500 transition-colors">
                    Read More Testimonials
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <section class="py-28 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-16 reveal">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="h-px w-12 bg-crimson-500"></div>
                    <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">Our Team</span>
                    <div class="h-px w-12 bg-crimson-500"></div>
                </div>
                <h2 class="font-display text-4xl lg:text-5xl font-800 text-gray-900 leading-tight mb-4">
                    Meet The Experts<br>
                    <span class="red-gradient-text">Behind REDSOL</span>
                </h2>
                <p class="font-body text-gray-500 max-w-xl mx-auto">
                    A passionate team of healthcare software specialists dedicated to transforming hospital operations.
                </p>
            </div>

            @if ($teamMembers->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($teamMembers as $i => $member)
                        @php
                            $linkedin = $member->socialLink('linkedin');
                            $twitter = $member->socialLink('twitter');
                            $email = $member->socialLink('email');
                        @endphp

                        <div class="group reveal reveal-delay-{{ ($i % 4) + 1 }}">
                            <div class="relative mb-5 overflow-hidden rounded-2xl bg-gray-100 h-72">
                                @if ($member->photoUrl())
                                    <img src="{{ $member->photoUrl() }}" alt="{{ $member->photo_alt ?? $member->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gradient-to-br from-crimson-100 to-gray-100">
                                        <div
                                            class="flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-crimson-500 to-crimson-700 text-white font-display font-800 text-2xl">
                                            {{ $member->initials }}
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="text-center px-2">
                                <h3
                                    class="font-display font-700 text-gray-900 text-lg group-hover:text-crimson-500 transition-colors">
                                    {{ $member->name }}
                                </h3>

                                <p class="font-body text-crimson-600 text-sm font-600 mb-1">
                                    {{ $member->position }}
                                </p>

                                @if ($member->department)
                                    <p class="font-body text-gray-500 text-xs mb-3">
                                        {{ $member->department }}
                                    </p>
                                @endif

                                @if ($member->bio)
                                    <p class="font-body text-gray-500 text-sm leading-relaxed mb-4">
                                        {{ Str::limit($member->bio, 120) }}
                                    </p>
                                @endif

                                {{-- 🔥 SOCIAL ICONS BELOW BIO --}}
                                @if ($linkedin || $twitter || $email)
                                    <div class="flex justify-center gap-3 mt-2">

                                        @if ($linkedin)
                                            <a href="{{ $linkedin }}" target="_blank" rel="noopener noreferrer"
                                                class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-crimson-500 text-gray-600 hover:text-white transition-all duration-300">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239
                                                    5-5v-14c0-2.761-2.238-5-5-5zm-11
                                                    19h-3v-11h3v11zm-1.5-12.268c-.966
                                                    0-1.75-.79-1.75-1.764s.784-1.764
                                                    1.75-1.764 1.75.79 1.75
                                                    1.764-.783 1.764-1.75
                                                    1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4
                                                    0v5.604h-3v-11h3v1.765c1.396-2.586
                                                    7-2.777 7 2.476v6.759z" />
                                                </svg>
                                            </a>
                                        @endif

                                        @if ($twitter)
                                            <a href="{{ $twitter }}" target="_blank" rel="noopener noreferrer"
                                                class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-crimson-500 text-gray-600 hover:text-white transition-all duration-300">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M23 3a10.9 10.9 0 01-3.14
                                                    1.53 4.48 4.48 0 00-7.86
                                                    3v1A10.66 10.66 0 013
                                                    4s-4 9 5 13a11.64 11.64
                                                    0 01-7 2s9 5 20
                                                    5a9.5 9.5 0 00-9-5.5c4.75
                                                    2.25 7-7 7-7" />
                                                </svg>
                                            </a>
                                        @endif

                                        @if ($email)
                                            <a href="mailto:{{ $email }}"
                                                class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-crimson-500 text-gray-600 hover:text-white transition-all duration-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22
                                                          0L21 8M5 19h14a2 2 0 002-2V7a2
                                                          2 0 00-2-2H5a2 2 0 00-2
                                                          2v10a2 2 0 002 2z" />
                                                </svg>
                                            </a>
                                        @endif

                                    </div>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 border-2 border-dashed border-gray-200 rounded-3xl">
                    <h3 class="font-display font-600 text-gray-900 mb-2">No Team Members Yet</h3>
                    <p class="font-body text-gray-500 max-w-md mx-auto">
                        Our team members will be showcased here soon.
                    </p>
                </div>
            @endif
        </div>
    </section>
    <section class="py-28 border-t border-gray-200 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="flex items-end justify-between mb-14 reveal">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="h-px w-12 bg-crimson-500"></div>
                        <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">From Our
                            Blog</span>
                    </div>
                    <h2 class="font-display text-4xl lg:text-5xl font-800 text-gray-900 leading-tight">
                        Healthcare Tech<br>
                        <span class="red-gradient-text">Insights</span>
                    </h2>
                </div>
                <a href="/blog"
                    class="hidden md:flex items-center gap-2 text-sm font-display font-600 text-crimson-500 hover:text-crimson-600 transition-colors">
                    All Articles
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @php
                    $categoryColorMap = [
                        'HIS Implementation' => 'text-crimson-600 bg-crimson-500/10 border-crimson-500/25',
                        'PACS & Radiology' => 'text-gray-700 bg-gray-100 border-gray-200',
                        'Digital Health' => 'text-crimson-600 bg-crimson-500/10 border-crimson-500/25',
                    ];
                @endphp

                @forelse($recentBlogPosts as $i => $post)
                    <a href="/blog/{{ $post->slug }}"
                        class="group card-hover rounded-2xl overflow-hidden bg-white reveal reveal-delay-{{ $i + 1 }}">

                        <div class="relative h-48 overflow-hidden blog-card-img">
                            @if ($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}"
                                    alt="{{ $post->featured_image_alt ?? $post->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            @if ($post->category)
                                <span
                                    class="absolute top-4 left-4 text-[10px] font-display font-600 tracking-wider uppercase px-2.5 py-1 rounded-full border {{ $categoryColorMap[$post->category] ?? 'text-gray-700 bg-gray-100 border-gray-200' }}">
                                    {{ $post->category }}
                                </span>
                            @endif
                        </div>


                        <div class="p-6">
                            <h3
                                class="font-display font-700 text-gray-900 text-base leading-snug mb-3 group-hover:text-crimson-500 transition-colors line-clamp-2">
                                {{ $post->title }}
                            </h3>
                            <p class="font-body text-gray-500 text-sm leading-relaxed mb-5 line-clamp-2">
                                {{ $post->excerpt }}
                            </p>
                            <div class="flex items-center justify-between text-xs font-body text-gray-400">
                                <span>{{ $post->published_at?->format('M d, Y') }}</span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $post->read_time_minutes ?? 5 }} min read
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-center text-gray-500">No published blog posts available.</p>
                @endforelse
            </div>
        </div>
    </section>
    <section class="py-24 px-6">
        <div class="max-w-5xl mx-auto reveal">
            <div class="cta-bg rounded-3xl p-12 lg:p-16 text-center relative overflow-hidden">


                <div
                    class="absolute -top-20 -left-20 w-60 h-60 rounded-full bg-crimson-500/8 blur-3xl pointer-events-none">
                </div>
                <div
                    class="absolute -bottom-20 -right-20 w-60 h-60 rounded-full bg-gray-900/5 blur-3xl pointer-events-none">
                </div>

                <div class="relative z-10">
                    <span
                        class="inline-block text-crimson-600 text-xs font-display tracking-widest uppercase font-600 mb-5 px-4 py-1.5 rounded-full border border-crimson-500/20 bg-crimson-500/5">
                        Ready to Transform Your Hospital?
                    </span>
                    <h2 class="font-display text-4xl lg:text-6xl font-800 text-gray-900 leading-tight mb-5">
                        Let's Build the Future<br>
                        of <span class="red-gradient-text">Your Healthcare</span>
                    </h2>
                    <p class="font-body text-gray-500 text-lg max-w-xl mx-auto mb-10">
                        Schedule a free consultation and see exactly how REDSOL's HIS can transform your hospital's
                        operations from day one.
                    </p>
                    <div class="flex flex-wrap gap-4 justify-center">
                        <a href="/contact"
                            class="group flex items-center gap-3 px-10 py-4 rounded-2xl bg-crimson-500 text-white font-display font-700 text-sm hover:bg-crimson-600 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-crimson-500/25">
                            Book a Free Demo
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="/products"
                            class="group flex items-center gap-3 px-10 py-4 rounded-2xl border border-crimson-500/30 text-crimson-600 font-display font-600 text-sm hover:bg-crimson-500/5 transition-all duration-300">
                            View All Modules
                        </a>
                    </div>


                    <div class="flex flex-wrap justify-center gap-8 mt-12 pt-10 border-t border-gray-200">
                        @foreach (['Full training included', '24/7 AMC support', 'ICD-10 compliant'] as $trust)
                            <div class="flex items-center gap-2 text-sm font-body text-gray-500">
                                <svg class="w-4 h-4 text-crimson-500 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                {{ $trust }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('head')
    <style>
        /* Hero scan line */
        @keyframes scanLine {
            0% {
                top: -2px;
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 0.3;
            }

            100% {
                top: 100%;
                opacity: 0;
            }
        }

        .scan-line {
            animation: scanLine 4s linear infinite;
            animation-delay: 1s;
        }

        /* Ken Burns on active slide image */
        .hero-slide.active img {
            animation: kenBurns 8s ease forwards;
        }

        @keyframes kenBurns {
            0% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1.0);
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const productTrack = document.getElementById('productTrack');
            const productLeftBtn = document.getElementById('scrollLeft');
            const productRightBtn = document.getElementById('scrollRight');

            if (productTrack && productLeftBtn && productRightBtn) {
                const scrollAmount = 300;
                let isProductDragging = false;
                let productStartX = 0;
                let productScrollLeft = 0;

                const updateProductArrowState = () => {
                    const hasScroll = productTrack.scrollWidth > productTrack.clientWidth;

                    if (!hasScroll) {
                        productLeftBtn.style.display = 'none';
                        productRightBtn.style.display = 'none';
                        return;
                    }

                    productLeftBtn.style.display = 'flex';
                    productRightBtn.style.display = 'flex';

                    if (productTrack.scrollLeft <= 0) {
                        productLeftBtn.style.opacity = '0';
                        productLeftBtn.style.pointerEvents = 'none';
                    } else {
                        productLeftBtn.style.opacity = '1';
                        productLeftBtn.style.pointerEvents = 'auto';
                    }

                    if (productTrack.scrollLeft + productTrack.clientWidth >= productTrack.scrollWidth - 10) {
                        productRightBtn.style.opacity = '0';
                        productRightBtn.style.pointerEvents = 'none';
                    } else {
                        productRightBtn.style.opacity = '1';
                        productRightBtn.style.pointerEvents = 'auto';
                    }
                };

                productLeftBtn.addEventListener('click', () => {
                    productTrack.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth'
                    });
                });

                productRightBtn.addEventListener('click', () => {
                    productTrack.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });

                productTrack.addEventListener('scroll', updateProductArrowState);
                window.addEventListener('resize', updateProductArrowState);

                setTimeout(updateProductArrowState, 100);
                setTimeout(updateProductArrowState, 300);
                setTimeout(updateProductArrowState, 500);
            }

            const clientTrack = document.getElementById('clientTrack');
            const clientLeftBtn = document.getElementById('clientScrollLeft');
            const clientRightBtn = document.getElementById('clientScrollRight');

            if (clientTrack && clientLeftBtn && clientRightBtn) {
                const scrollAmount = 320;

                const updateClientArrowState = () => {
                    const hasScroll = clientTrack.scrollWidth > clientTrack.clientWidth;

                    if (!hasScroll) {
                        clientLeftBtn.style.display = 'none';
                        clientRightBtn.style.display = 'none';
                        return;
                    }

                    clientLeftBtn.style.display = 'flex';
                    clientRightBtn.style.display = 'flex';

                    if (clientTrack.scrollLeft <= 0) {
                        clientLeftBtn.style.opacity = '0';
                        clientLeftBtn.style.pointerEvents = 'none';
                    } else {
                        clientLeftBtn.style.opacity = '1';
                        clientLeftBtn.style.pointerEvents = 'auto';
                    }

                    if (clientTrack.scrollLeft + clientTrack.clientWidth >= clientTrack.scrollWidth - 10) {
                        clientRightBtn.style.opacity = '0';
                        clientRightBtn.style.pointerEvents = 'none';
                    } else {
                        clientRightBtn.style.opacity = '1';
                        clientRightBtn.style.pointerEvents = 'auto';
                    }
                };

                clientLeftBtn.addEventListener('click', () => {
                    clientTrack.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth'
                    });
                });

                clientRightBtn.addEventListener('click', () => {
                    clientTrack.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });

                clientTrack.addEventListener('scroll', updateClientArrowState);
                window.addEventListener('resize', updateClientArrowState);

                setTimeout(updateClientArrowState, 100);
                setTimeout(updateClientArrowState, 300);
                setTimeout(updateClientArrowState, 500);
            }

            const servicesTrack = document.getElementById('servicesTrack');
            const servicesLeftBtn = document.getElementById('servicesScrollLeft');
            const servicesRightBtn = document.getElementById('servicesScrollRight');

            if (servicesTrack && servicesLeftBtn && servicesRightBtn) {
                const scrollAmount = 300;
                let isServicesDragging = false;
                let servicesStartX = 0;
                let servicesScrollLeft = 0;

                const updateServicesArrowState = () => {
                    const hasScroll = servicesTrack.scrollWidth > servicesTrack.clientWidth;

                    if (!hasScroll) {
                        servicesLeftBtn.style.display = 'none';
                        servicesRightBtn.style.display = 'none';
                        return;
                    }

                    servicesLeftBtn.style.display = 'flex';
                    servicesRightBtn.style.display = 'flex';

                    if (servicesTrack.scrollLeft <= 0) {
                        servicesLeftBtn.style.opacity = '0';
                        servicesLeftBtn.style.pointerEvents = 'none';
                    } else {
                        servicesLeftBtn.style.opacity = '1';
                        servicesLeftBtn.style.pointerEvents = 'auto';
                    }

                    if (servicesTrack.scrollLeft + servicesTrack.clientWidth >= servicesTrack.scrollWidth -
                        10) {
                        servicesRightBtn.style.opacity = '0';
                        servicesRightBtn.style.pointerEvents = 'none';
                    } else {
                        servicesRightBtn.style.opacity = '1';
                        servicesRightBtn.style.pointerEvents = 'auto';
                    }
                };

                servicesLeftBtn.addEventListener('click', () => {
                    servicesTrack.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth'
                    });
                });

                servicesRightBtn.addEventListener('click', () => {
                    servicesTrack.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });


                servicesTrack.addEventListener('scroll', updateServicesArrowState);
                window.addEventListener('resize', updateServicesArrowState);

                setTimeout(updateServicesArrowState, 100);
                setTimeout(updateServicesArrowState, 300);
                setTimeout(updateServicesArrowState, 500);
            }
        });

        // Hero slideshow
        let currentSlide = 0;
        const totalSlides = 6;

        function goToSlide(index) {
            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.slide-dot');

            slides[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('w-8', 'bg-crimson-500');
            dots[currentSlide].classList.add('w-2', 'bg-white/30');

            currentSlide = index;

            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('w-8', 'bg-crimson-500');
            dots[currentSlide].classList.remove('w-2', 'bg-white/30');
        }

        // Auto-advance every 5 seconds
        setInterval(() => {
            goToSlide((currentSlide + 1) % totalSlides);
        }, 5000);
    </script>
@endpush
