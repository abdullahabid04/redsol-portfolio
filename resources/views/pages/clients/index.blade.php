@extends('layouts.app')

@section('content')

    @php
                $stats = collect($stats ?? [
            ['value' => $hospitalCount . '+', 'label' => 'Hospitals Served'],
            ['value' => '4+', 'label' => 'Provinces'],
            ['value' => '12+', 'label' => 'Years Experience'],
            ['value' => '99%', 'label' => 'Retention Rate'],
        ])->map(function ($item, $index) use ($hospitalCount) {
            if ($index === 0) {
                $item['value'] = $hospitalCount . '+';
            }

            if ($index === 1) {
                $item['value'] = '4+';
            }

            return $item;
        })->values()->all();

                $highlights = [
            $stats[0]['value'] . ' Hospitals Served', 'Government & Private', 'Punjab & Sindh',
            'KPK & Balochistan', 'Teaching Hospitals', 'Diagnostic Labs',
            'Multi-branch Deployments', 'AMC Clients', 'Islamabad & Rawalpindi',
            '12+ Years of Trust', 'ICD-10 Compliant', 'DICOM Integrated',
        ];
        $tickerItems = array_merge($highlights, $highlights);

                $featured = $featured ?? collect();

                $clientsByType = $clientsByType ?? collect();
                $allClients = $clientsByType->flatMap(fn($group) => $group);
    @endphp
    
    <section class="relative pt-36 pb-20 bg-gray-900 overflow-hidden">
        <div class="absolute inset-0 pointer-events-none"
             style="background-image: linear-gradient(rgba(225,29,72,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(225,29,72,0.04) 1px, transparent 1px); background-size: 48px 48px;"></div>
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-900 to-transparent pointer-events-none"></div>
        <div class="absolute top-0 right-0 w-[600px] h-[600px] rounded-full bg-crimson-500/5 blur-[120px] pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-px w-10 bg-crimson-500"></div>
                <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">Our Clients</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-end">
                <div>
                    <h1 class="font-display text-5xl lg:text-7xl font-800 text-white leading-[0.92] mb-6">
                        {{ $stats[0]['value'] }} Hospitals.<br>
                        <span class="red-gradient-text">One Platform.</span><br>
                        <span class="text-gray-400">Across Pakistan.</span>
                    </h1>
                    <p class="font-body text-gray-400 text-lg leading-relaxed max-w-lg">
                        From district headquarters hospitals to private specialist centres — REDSOL runs the digital backbone of healthcare facilities across every province of Pakistan.
                    </p>
                </div>

                
                <div class="grid grid-cols-2 gap-px bg-white/5 rounded-2xl overflow-hidden">
                    @foreach($stats as $s)
                    <div class="bg-gray-900 px-6 py-8 text-center">
                        <div class="font-display font-800 text-3xl text-crimson-400 mb-1">{{ $s['value'] }}</div>
                        <div class="font-body text-gray-500 text-xs tracking-wide">{{ $s['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            
        </div>
    </section>
    
    <section class="bg-white border-b border-gray-100 py-5 overflow-hidden">
        <div class="flex gap-10 animate-[ticker_40s_linear_infinite] w-max">
            @foreach($tickerItems as $item)
            <div class="flex items-center gap-2.5 shrink-0">
                <div class="w-1.5 h-1.5 rounded-full bg-crimson-500"></div>
                <span class="font-body text-sm text-gray-500 whitespace-nowrap">{{ $item }}</span>
            </div>
            @endforeach
        </div>
    </section><section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-3 reveal">
                <div class="h-px flex-1 bg-gray-100 max-w-[60px]"></div>
                <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">Featured Clients</span>
                <div class="h-px flex-1 bg-gray-100"></div>
            </div>
            <p class="text-center font-body text-sm text-gray-400 mb-12 reveal">
                A selection of hospitals that have deployed REDSOL's full HIS platform across all departments.
            </p>

            
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-px bg-gray-100 border border-gray-100 rounded-3xl overflow-hidden reveal">
                @forelse($featured as $client)
                    @php
                        $badgeClass = $client->typeBadgeClass();
                        $labelTxt   = $client->typeLabel();
                        $initials   = collect(explode(' ', $client->name))->take(2)->map(fn($w) => strtoupper($w[0]))->implode('');
                    @endphp
                    <a href="{{ $client->website_url ?? '#' }}" target="_blank"
                       class="group bg-white p-8 flex flex-col items-center justify-center text-center
                              hover:bg-crimson-500/3 transition-all duration-300 relative overflow-hidden">

                        <div class="absolute top-0 left-0 right-0 h-0.5 bg-crimson-500 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>

                        
                        <div class="w-16 h-16 rounded-2xl bg-gray-100 border border-gray-200 flex items-center justify-center mb-4 overflow-hidden
                                    group-hover:bg-crimson-500/8 group-hover:border-crimson-500/20 transition-all duration-300">
                            @if($client->logo_path)
                                <img src="{{ $client->logoUrl() }}" 
                                     alt="{{ $client->logo_alt ?? $client->name }}"
                                     class="w-full h-full object-contain">
                            @else
                                <span class="font-display font-800 text-gray-400 text-lg group-hover:text-crimson-500 transition-colors">
                                    {{ $initials }}
                                </span>
                            @endif
                        </div>

                        <div class="font-display font-700 text-gray-900 text-sm leading-tight mb-1.5 group-hover:text-crimson-600 transition-colors">
                            {{ $client->name }}
                        </div>
                        <div class="font-body text-xs text-gray-400 mb-3">{{ $client->locationString() }}</div>

                        <div class="flex items-center gap-1.5 flex-wrap justify-center">
                            {{-- <span class="inline-block text-[10px] font-display font-600 tracking-wide px-2 py-0.5 rounded border {{ $badgeClass }}">
                                {{ $labelTxt }}
                            </span> --}}
                            @if($client->notes)
                            <span class="inline-block text-[10px] font-body text-gray-400 px-2 py-0.5 rounded bg-gray-50 border border-gray-200">
                                {{ $client->notes }}
                            </span>
                            @endif
                        </div>

                        @if($client->year_deployed)
                            <div class="mt-3 font-body text-[10px] text-gray-300">Since {{ $client->year_deployed }}</div>
                        @endif
                    </a>
                @empty
                    <div class="col-span-full py-12 text-center text-gray-500 font-body">
                        No featured clients yet. Add some in the admin panel!
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-3 reveal">
                <div class="h-px flex-1 bg-gray-100 max-w-[60px]"></div>
                <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">All Clients</span>
                <div class="h-px flex-1 bg-gray-100"></div>
            </div>

            <div class="grid gap-2 bg-gray-100 rounded-3xl overflow-hidden reveal">
                @forelse($allClients as $ci => $client)
                    @php
                        $initials = collect(explode(' ', $client->name))->take(2)->map(fn($w) => strtoupper($w[0]))->implode('');
                    @endphp
                    <a href="{{ $client->website_url ?? '#' }}" target="_blank"
                       class="group flex items-center gap-5 px-6 py-5 bg-white hover:bg-crimson-50 transition duration-200">

                        <span class="font-display font-700 text-[11px] text-gray-400 w-8 text-right">
                            {{ str_pad($ci + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <div class="w-10 h-10 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center shrink-0 overflow-hidden">
                            @if($client->logo_path)
                                <img src="{{ $client->logoUrl() }}" alt="{{ $client->logo_alt ?? $client->name }}" class="w-full h-full object-contain">
                            @else
                                <span class="font-display font-700 text-xs text-gray-500">{{ $initials }}</span>
                            @endif
                        </div>

                        <div class="min-w-0">
                            <div class="font-display font-700 text-sm text-gray-900 truncate">{{ $client->name }}</div>
                            <div class="font-body text-xs text-gray-500 mt-0.5">{{ $client->locationString() }}</div>
                        </div>

                        @if($client->notes)
                            <span class="hidden md:inline-flex items-center text-xs text-gray-500 bg-gray-50 border border-gray-200 rounded-full px-3 py-1">
                                {{ $client->notes }}
                            </span>
                        @endif

                        @if($client->year_deployed)
                            <span class="hidden lg:inline-flex items-center text-xs text-gray-500 px-3 py-1">
                                {{ $client->year_deployed }}
                            </span>
                        @endif

                        <svg class="w-4 h-4 text-gray-300 transition-colors shrink-0 group-hover:text-crimson-500"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @empty
                    <div class="py-12 text-center text-gray-500 font-body">
                        No clients available.
                    </div>
                @endforelse
            </div>
        </div>
    </section><section class="py-16 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                @php
                    $trustPoints = [
                        [
                            'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                            'title' => '99% Client Retention',
                            'desc' => 'Once deployed, hospitals stay. Our AMC clients renew year after year because the system keeps delivering measurable value.',
                        ],
                        [
                            'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z',
                            'title' => '24/7 AMC Support',
                            'desc' => 'Hospitals can\'t have downtime. Our AMC contracts guarantee response within hours, not days — from a team that knows your installation.',
                        ],
                        [
                            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                            'title' => 'Full Staff Training',
                            'desc' => 'Every deployment includes comprehensive training for all roles — from front desk to radiologists — with printed user manuals in Urdu and English.',
                        ],
                    ];
                @endphp

                @foreach($trustPoints as $i => $tp)
                    <div class="flex items-start gap-5 reveal reveal-delay-{{ $i + 1 }}">
                        <div
                            class="w-12 h-12 rounded-2xl bg-crimson-500/8 border border-crimson-500/15 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $tp['icon'] }}" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-display font-700 text-gray-900 text-base mb-2">{{ $tp['title'] }}</div>
                            <p class="font-body text-sm text-gray-500 leading-relaxed">{{ $tp['desc'] }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section><section class="py-24 bg-gray-900 border-t border-gray-800">
        <div class="max-w-4xl mx-auto px-6 text-center reveal">

            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-crimson-500/25 bg-crimson-500/8 mb-8">
                <span class="w-2 h-2 rounded-full bg-crimson-500 animate-pulse"></span>
                <span class="text-crimson-400 text-xs font-display tracking-widest uppercase font-600">Join {{ $hospitalCount }}+
                    Hospitals</span>
            </div>

            <h2 class="font-display text-4xl lg:text-5xl font-800 text-white leading-tight mb-5">
                Ready to Join Our<br>
                <span class="red-gradient-text">Growing Client Family?</span>
            </h2>

            <p class="font-body text-gray-400 text-lg max-w-xl mx-auto mb-10">
                Book a Free Demo and let's discuss how REDSOL can transform your hospital's operations — from day
                one.
            </p>

            <div class="flex flex-wrap gap-4 justify-center">
                <a href="/contact"
                    class="group flex items-center gap-3 px-10 py-4 rounded-2xl bg-crimson-500 text-white font-display font-700 text-sm
                              hover:bg-crimson-600 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-crimson-500/30">
                    Book a Free Demo
                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
                {{-- <a href="/projects" class="group flex items-center gap-3 px-10 py-4 rounded-2xl border border-white/15 text-gray-300 font-display font-600 text-sm
                              hover:border-crimson-500/40 hover:text-crimson-400 transition-all duration-300">
                    View Case Studies
                </a> --}}
            </div>

        </div>
    </section>

@endsection

@push('head')
    <style>
        @keyframes ticker {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), transform 0.75s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-delay-1 {
            transition-delay: 0.06s;
        }

        .reveal-delay-2 {
            transition-delay: 0.12s;
        }

        .reveal-delay-3 {
            transition-delay: 0.18s;
        }

        /* Filter hidden state */
    </style>
@endpush

@push('scripts')
    <script>
                const obs = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
        }, { threshold: 0.05, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));

            </script>
@endpush