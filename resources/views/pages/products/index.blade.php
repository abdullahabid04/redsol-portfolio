@extends('layouts.app')

@section('content')

            {{-- ═══════════════════════════════════════════════════
                PAGE HERO
            ════════════════════════════════════════════════════ --}}
            <section class="relative pt-36 pb-20 bg-gray-900 overflow-hidden">
                {{-- Background pattern --}}
                <div class="absolute inset-0 pointer-events-none" style="background-image: linear-gradient(rgba(225,29,72,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(225,29,72,0.04) 1px, transparent 1px); background-size: 48px 48px;"></div>
                <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-900 to-transparent pointer-events-none"></div>
                <div class="absolute top-0 right-0 w-[600px] h-[600px] rounded-full bg-crimson-500/5 blur-[120px] pointer-events-none"></div>

                <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-px w-10 bg-crimson-500"></div>
                        <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">HIS Product Suite</span>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-end">
                        <div>
                            <h1 class="font-display text-5xl lg:text-7xl font-800 text-white leading-[0.92] mb-6">
                                25 Modules.<br>
                                <span class="red-gradient-text">One Platform.</span><br>
                                <span class="text-gray-400">Zero Gaps.</span>
                            </h1>
                            <p class="font-body text-gray-400 text-lg leading-relaxed max-w-lg">
                                Every module in the REDSOL HIS is built around a single unified database — clinical, diagnostic, administrative, and imaging workflows all talking to each other in real time.
                            </p>
                        </div>

                        {{-- Stats bar --}}
                        <div class="grid grid-cols-3 gap-px bg-white/5 rounded-2xl overflow-hidden">
                            @foreach([['25+', 'Integrated Modules'], ['150+', 'Hospitals Live'], ['1', 'Unified Database']] as $s)
                                <div class="bg-gray-900 px-6 py-8 text-center">
                                    <div class="font-display font-800 text-3xl text-crimson-400 mb-1">{{ $s[0] }}</div>
                                    <div class="font-body text-gray-500 text-xs tracking-wide">{{ $s[1] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Category nav --}}
                    <div class="mt-14 flex flex-wrap gap-2" id="catNav">
                        @foreach(['All Modules', 'Administration', 'Patient Journey', 'Clinical', 'Diagnostics & Imaging', 'Operations'] as $ci => $cat)
                            <button
                                onclick="filterCat(this, '{{ Str::slug($cat) }}')"
                                class="cat-btn px-4 py-2 rounded-lg text-xs font-display font-600 tracking-wide border transition-all duration-200
                                       {{ $ci === 0 ? 'bg-crimson-500 text-white border-crimson-500' : 'bg-white/5 text-gray-400 border-white/10 hover:border-crimson-500/30 hover:text-white' }}">
                                {{ $cat }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </section>


            {{-- ═══════════════════════════════════════════════════
                GENERAL SPECS BANNER
            ════════════════════════════════════════════════════ --}}
            <section class="bg-white border-b border-gray-100 py-5 overflow-hidden">
                <div class="flex gap-10 animate-[ticker_40s_linear_infinite] w-max">
                    @php
    $specs = ['ICD-10 Coded', 'DICOM 3.0', 'IHE Protocol', 'CLSI Standards', 'One Database', 'Voice Reporting', 'Lossless PACS Compression', 'Multi-printer Support', 'Barcode Integration', 'Web-based Reports', 'SNOMED Histopathology', 'Secure Email Reports', 'Patient Alerts', 'Document Scanning'];
    $doubled = array_merge($specs, $specs);
                    @endphp
                    @foreach($doubled as $spec)
                        <div class="flex items-center gap-2.5 shrink-0">
                            <div class="w-1.5 h-1.5 rounded-full bg-crimson-500"></div>
                            <span class="font-body text-sm text-gray-500 whitespace-nowrap">{{ $spec }}</span>
                        </div>
                    @endforeach
                </div>
            </section>


            {{-- ═══════════════════════════════════════════════════
                MODULES GRID
            ════════════════════════════════════════════════════ --}}
            <section class="py-20 bg-white">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">

                    @php


    $catColors = [
        'administration' => ['bg' => 'bg-gray-900', 'text' => 'text-white', 'badge_bg' => 'bg-white/10', 'badge_text' => 'text-gray-300', 'accent' => 'bg-crimson-500'],
        'patient-journey' => ['bg' => 'bg-white', 'text' => 'text-gray-900', 'badge_bg' => 'bg-crimson-500/8', 'badge_text' => 'text-crimson-600', 'accent' => 'bg-crimson-500'],
        'clinical' => ['bg' => 'bg-white', 'text' => 'text-gray-900', 'badge_bg' => 'bg-gray-100', 'badge_text' => 'text-gray-600', 'accent' => 'bg-gray-800'],
        'diagnostics' => ['bg' => 'bg-gray-900', 'text' => 'text-white', 'badge_bg' => 'bg-crimson-500/15', 'badge_text' => 'text-crimson-400', 'accent' => 'bg-crimson-500'],
        'operations' => ['bg' => 'bg-white', 'text' => 'text-gray-900', 'badge_bg' => 'bg-crimson-500/8', 'badge_text' => 'text-crimson-600', 'accent' => 'bg-crimson-500'],
    ];
                    @endphp

                    {{-- Section headers per category --}}
                    @php
    $sections = [
        'administration' => ['label' => 'Administration & Security', 'desc' => 'The operational and security foundation of the entire platform — access control, reporting, HR, and asset management.'],
        'patient-journey' => ['label' => 'Patient Journey', 'desc' => 'Every touchpoint from first registration to final discharge — registration, appointments, queuing, welfare and admission.'],
        'clinical' => ['label' => 'Clinical & Departmental', 'desc' => 'Department-level clinical modules covering consultation, emergency, wards, surgery, gynecology and specialist centres.'],
        'diagnostics' => ['label' => 'Diagnostics & Imaging', 'desc' => 'Full lab, radiology and PACS suite — DICOM, analyzers, voice reporting, lossless compression and unlimited licences.'],
        'operations' => ['label' => 'Operations & Supply Chain', 'desc' => 'Billing, pharmacy dispensing, and inventory management — the financial and supply backbone of the hospital.'],
    ];
    $currentCat = '';
                    @endphp

                    @foreach($allModules as $mi => $module)

                                                    {{-- Category divider --}}
                                                    @if($currentCat !== $module['category'])
                                                        @php $currentCat = $module['category'];
                                $sec = $sections[$currentCat]; @endphp
                                                        <div class="module-section mt-16 mb-8 reveal" data-cat="{{ $currentCat }}">
                                                            <div class="flex items-center gap-4">
                                                                <div class="h-px flex-1 bg-gray-100 max-w-[60px]"></div>
                                                                <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">{{ $sec['label'] }}</span>
                                                                <div class="h-px flex-1 bg-gray-100"></div>
                                                            </div>
                                                            <p class="text-center font-body text-sm text-gray-400 mt-2">{{ $sec['desc'] }}</p>
                                                        </div>
                                                    @endif

                                                    {{-- Module card --}}
                                                    @php $c = $catColors[$module['category']]; @endphp
                                                    <div class="module-card group rounded-3xl border border-gray-100 overflow-hidden mb-5 reveal reveal-delay-{{ ($mi % 3) + 1 }} transition-all duration-500 hover:shadow-2xl hover:shadow-black/8 hover:-translate-y-1"
                                                         data-cat="{{ $module['category'] }}">

                                                        <div class="{{ $c['bg'] }} p-8 lg:p-10">
                                                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                                                                {{-- Left: identity --}}
                                                                <div class="lg:col-span-1">
                                                                    <div class="flex items-start gap-4 mb-6">
                                                                        <div class="text-4xl leading-none">{{ $module['icon'] }}</div>
                                                                        <div class="flex-1">
                                                                            <span class="inline-block text-[10px] font-display font-600 tracking-wider uppercase px-2.5 py-1 rounded-full {{ $c['badge_bg'] }} {{ $c['badge_text'] }} border border-current/20 mb-2">
                                                                                {{ $module['cat_label'] }}
                                                                            </span>
                                                                            <h3 class="font-display font-800 {{ $c['text'] }} text-xl leading-tight">
                                                                                {{ $module['name'] }}
                                                                            </h3>
                                                                        </div>
                                                                    </div>

                                                                    <p class="{{ $module['category'] === 'administration' || $module['category'] === 'diagnostics' ? 'text-gray-400' : 'text-gray-500' }} font-body text-sm leading-relaxed mb-6 italic">
                                                                        "{{ $module['tagline'] }}"
                                                                    </p>

                                                                    <a href="/products/{{ $module['slug'] }}"
                                                                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-display font-600 transition-all duration-200
                                                                              {{ $module['category'] === 'administration' || $module['category'] === 'diagnostics'
                                ? 'bg-crimson-500 text-white hover:bg-crimson-600 hover:shadow-lg hover:shadow-crimson-500/25'
                                : 'bg-crimson-500 text-white hover:bg-crimson-600 hover:shadow-lg hover:shadow-crimson-500/20' }}">
                                                                        View Full Details
                                                                        <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>

                                                                {{-- Middle: description --}}
                                                                <div class="lg:col-span-1">
                            <p class="{{ $module['category'] === 'administration' || $module['category'] === 'diagnostics' ? 'text-gray-400' : 'text-gray-600' }} font-body text-sm leading-[1.85]">
                                {{ \Illuminate\Support\Str::limit($module['description'], 250) }}
                            </p>
                        </div>

                                                                {{-- Right: features --}}
                                                                <div class="lg:col-span-1">
                                                                    <div class="flex items-center gap-2 mb-4">
                                                                        <div class="w-4 h-px {{ $c['accent'] }}"></div>
                                                                        <span class="{{ $module['category'] === 'administration' || $module['category'] === 'diagnostics' ? 'text-gray-400' : 'text-gray-400' }} text-xs font-display tracking-widest uppercase font-600">Key Features</span>
                                                                    </div>
                                                                    <ul class="space-y-2.5">
                                                                        @foreach($module['features']->take(5) as $feat)
                                                                            <li class="flex items-start gap-2.5">
                                                                                <svg class="w-3.5 h-3.5 text-crimson-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                                                </svg>
                                                                                <span class="{{ $module['category'] === 'administration' || $module['category'] === 'diagnostics' ? 'text-gray-400' : 'text-gray-600' }} font-body text-xs leading-relaxed">{{ $feat->feature_text }}</span>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                    @endforeach
                </div>
            </section>


            {{-- ═══════════════════════════════════════════════════
                CTA SECTION
            ════════════════════════════════════════════════════ --}}
            <section class="py-24 bg-gray-900 border-t border-gray-800">
                <div class="max-w-4xl mx-auto px-6 text-center reveal">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-crimson-500/25 bg-crimson-500/8 mb-8">
                        <span class="w-2 h-2 rounded-full bg-crimson-500 animate-pulse"></span>
                        <span class="text-crimson-400 text-xs font-display tracking-widest uppercase font-600">See it in action</span>
                    </div>
                    <h2 class="font-display text-4xl lg:text-5xl font-800 text-white leading-tight mb-5">
                        Ready to See REDSOL<br><span class="red-gradient-text">in Your Hospital?</span>
                    </h2>
                    <p class="font-body text-gray-400 text-lg max-w-xl mx-auto mb-10">
                        Schedule a free walkthrough of any module — or all 25 at once. Our team will show you exactly how REDSOL maps to your specific workflows.
                    </p>
                    <div class="flex flex-wrap gap-4 justify-center">
                        <a href="/contact" class="group flex items-center gap-3 px-10 py-4 rounded-2xl bg-crimson-500 text-white font-display font-700 text-sm hover:bg-crimson-600 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-crimson-500/30">
                            Request a Demo
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <a href="/services" class="group flex items-center gap-3 px-10 py-4 rounded-2xl border border-white/15 text-gray-300 font-display font-600 text-sm hover:border-crimson-500/40 hover:text-crimson-400 transition-all duration-300">
                            View All Services
                        </a>
                    </div>
                </div>
            </section>

@endsection

@push('head')
    <style>
        .red-gradient-text {
            background: linear-gradient(135deg, #e11d48 0%, #9f1239 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        @keyframes ticker {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.75s cubic-bezier(0.16,1,0.3,1), transform 0.75s cubic-bezier(0.16,1,0.3,1);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.06s; }
        .reveal-delay-2 { transition-delay: 0.12s; }
        .reveal-delay-3 { transition-delay: 0.18s; }

        /* Hide filtered cards */
        .module-card.filtered-out {
            display: none;
        }
        .module-section.filtered-out {
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Scroll reveal
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
        }, { threshold: 0.05, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));

        // Category filter
        function filterCat(btn, cat) {
            // Update button styles
            document.querySelectorAll('.cat-btn').forEach(b => {
                b.classList.remove('bg-crimson-500', 'text-white', 'border-crimson-500');
                b.classList.add('bg-white/5', 'text-gray-400', 'border-white/10');
            });
            btn.classList.add('bg-crimson-500', 'text-white', 'border-crimson-500');
            btn.classList.remove('bg-white/5', 'text-gray-400', 'border-white/10');

            const cards = document.querySelectorAll('.module-card');
            const sections = document.querySelectorAll('.module-section');

            if (cat === 'all-modules') {
                cards.forEach(c => c.classList.remove('filtered-out'));
                sections.forEach(s => s.classList.remove('filtered-out'));
            } else {
                // Map button slug to data-cat value
                const catMap = {
                    'administration': 'administration',
                    'patient-journey': 'patient-journey',
                    'clinical': 'clinical',
                    'diagnostics-imaging': 'diagnostics',
                    'operations': 'operations',
                };
                const dataCat = catMap[cat] || cat;

                cards.forEach(c => {
                    c.dataset.cat === dataCat
                        ? c.classList.remove('filtered-out')
                        : c.classList.add('filtered-out');
                });
                sections.forEach(s => {
                    s.dataset.cat === dataCat
                        ? s.classList.remove('filtered-out')
                        : s.classList.add('filtered-out');
                });
            }

            // Re-trigger reveals for visible cards
            document.querySelectorAll('.module-card:not(.filtered-out)').forEach(el => {
                el.classList.remove('visible');
                setTimeout(() => obs.observe(el), 50);
            });
        }
    </script>
@endpush
