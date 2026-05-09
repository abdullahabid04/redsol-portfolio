@extends('layouts.app')

@section('content')

    {{-- ═══════════════════════════════════════════════════
        ABOUT PAGE — No hero slides, so nav starts nav-glass
        Theme: white bg, crimson accents, Syne + DM Sans
    ════════════════════════════════════════════════════ --}}

    {{-- ─── PAGE HERO ─────────────────────────────────────── --}}
    <section class="relative pt-32 pb-20 overflow-hidden">

        {{-- Decorative red circle (top right) --}}
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full border border-crimson-500/10 pointer-events-none"></div>
        <div class="absolute -top-12 -right-12 w-56 h-56 rounded-full border border-crimson-500/8 pointer-events-none"></div>

        {{-- Vertical rule --}}
        <div class="absolute left-1/2 top-0 w-px h-full bg-gradient-to-b from-transparent via-crimson-500/10 to-transparent pointer-events-none hidden lg:block"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                {{-- Left --}}
                <div>
                    {{-- Label --}}
                    <div class="flex items-center gap-3 mb-6" style="opacity:0;animation:fadeUp .6s ease .1s forwards;">
                        <div class="h-px w-10 bg-crimson-500"></div>
                        <span class="text-crimson-500 text-xs font-display font-600 tracking-widest uppercase">About REDSOL</span>
                    </div>

                    <h1 class="font-display text-5xl lg:text-6xl xl:text-7xl font-800 leading-[0.92] text-gray-900 mb-6"
                        style="opacity:0;animation:fadeUp .7s ease .22s forwards;">
                        We Build What<br>
                        Hospitals <span class="red-gradient-text">Depend On</span>
                    </h1>

                    <p class="font-body text-gray-500 text-lg leading-relaxed max-w-lg mb-10"
                       style="opacity:0;animation:fadeUp .7s ease .38s forwards;">
                        For over a decade, REDSOL has been engineering healthcare software that runs the clinical and administrative backbone of hospitals across Pakistan.
                    </p>

                    {{-- Quick stats row --}}
                    <div class="flex flex-wrap gap-8 pt-8 border-t border-gray-100"
                         style="opacity:0;animation:fadeUp .7s ease .52s forwards;">
                        @php
                            $heroStats = [
                                ['num' => 150, 'suf' => '+', 'lbl' => 'Hospitals'],
                                ['num' => 23,  'suf' => '+', 'lbl' => 'HIS Modules'],
                                ['num' => 12,  'suf' => '+', 'lbl' => 'Years'],
                                ['num' => 99,  'suf' => '%', 'lbl' => 'Retention'],
                            ];
                        @endphp
                        @foreach($heroStats as $s)
                            <div>
                                <div class="stat-number text-3xl font-display font-800 leading-none mb-1">
                                    <span data-target="{{ $s['num'] }}">0</span>{{ $s['suf'] }}
                                </div>
                                <div class="text-xs font-body font-500 text-gray-400 tracking-wide uppercase">{{ $s['lbl'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right — quote card --}}
                <div class="reveal" style="opacity:0;animation:fadeUp .7s ease .3s forwards;">
                    <div class="relative">
                        {{-- Main card --}}
                        <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-sm relative overflow-hidden">
                            {{-- Red left border accent --}}
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-crimson-500 rounded-l-2xl"></div>

                            {{-- Big quote mark --}}
                            <div class="font-display text-8xl text-crimson-500/10 leading-none absolute top-4 right-6 select-none">"</div>

                            <p class="font-body text-gray-600 text-lg leading-relaxed italic mb-6 relative z-10">
                                "Technology should serve the healer, not complicate their work. That principle drives every line of code we write."
                            </p>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-crimson-500 flex items-center justify-center">
                                    <span class="text-white text-xs font-display font-700">RS</span>
                                </div>
                                <div>
                                    <div class="font-display font-700 text-gray-900 text-sm">REDSOL</div>
                                    <div class="font-body text-gray-400 text-xs">Founding Philosophy</div>
                                </div>
                            </div>
                        </div>

                        {{-- Floating badge bottom-left --}}
                        <div class="absolute -bottom-4 -left-4 bg-gray-900 text-white rounded-xl px-4 py-3 shadow-lg">
                            <div class="font-display font-800 text-crimson-400 text-lg leading-none">2012</div>
                            <div class="font-body text-xs text-gray-400 mt-0.5">Est. Pakistan</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- ─── RED STATS BAR ──────────────────────────────────── --}}
    <div class="bg-gray-900 py-14 relative overflow-hidden">
        {{-- Subtle grid on dark --}}
        <div class="absolute inset-0 opacity-5"
             style="background-image:linear-gradient(rgba(225,29,72,.4) 1px,transparent 1px),linear-gradient(90deg,rgba(225,29,72,.4) 1px,transparent 1px);background-size:40px 40px;">
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-0 divide-x divide-white/5">
                @php
                    $bigStats = [
                        ['n'=>150, 's'=>'+', 'l'=>'Hospitals Deployed',   'icon'=>'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                        ['n'=>23,  's'=>'+', 'l'=>'HIS Modules',          'icon'=>'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                        ['n'=>12,  's'=>'+', 'l'=>'Years Experience',     'icon'=>'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                        ['n'=>99,  's'=>'%', 'l'=>'Client Retention',     'icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                    ];
                @endphp
                @foreach($bigStats as $i => $st)
                    <div class="flex flex-col items-center text-center px-8 py-4 reveal reveal-delay-{{ $i+1 }}">
                        <div class="w-10 h-10 rounded-xl bg-crimson-500/10 border border-crimson-500/20 flex items-center justify-center mb-3">
                            <svg class="w-4 h-4 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $st['icon'] }}"/>
                            </svg>
                        </div>
                        <div class="stat-number text-4xl lg:text-5xl font-display font-800 leading-none mb-1">
                            <span data-target="{{ $st['n'] }}">0</span>{{ $st['s'] }}
                        </div>
                        <div class="font-body text-xs text-gray-500 tracking-widest uppercase font-500">{{ $st['l'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    {{-- ─── OUR STORY ───────────────────────────────────────── --}}
    <section class="py-28 relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

                {{-- Image side --}}
                <div class="relative reveal">
                    <img
                        src="https://images.unsplash.com/photo-1551190822-a9333d879b1f?w=900&q=80&auto=format"
                        alt="REDSOL Story"
                        class="w-full aspect-[4/5] object-cover rounded-2xl"
                    >
                    {{-- Red accent block --}}
                    <div class="absolute -bottom-5 -right-5 w-2/3 h-2/3 bg-crimson-500/6 rounded-2xl -z-10 border border-crimson-500/10"></div>

                    {{-- Floating year card --}}
                    <div class="absolute bottom-6 left-6 bg-gray-900 rounded-xl px-5 py-4 shadow-xl border border-white/5">
                        <div class="font-display font-800 text-crimson-400 text-3xl leading-none mb-1">2012</div>
                        <div class="font-body text-gray-400 text-xs tracking-wide uppercase">Year Founded</div>
                    </div>

                    {{-- Floating modules card --}}
                    <div class="absolute top-6 right-6 bg-white rounded-xl px-4 py-3 shadow-lg border border-gray-100">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-crimson-500 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-display font-700 text-gray-900 text-sm leading-none">23+ Modules</div>
                                <div class="font-body text-gray-400 text-xs mt-0.5">One Platform</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content side --}}
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="h-px w-10 bg-crimson-500"></div>
                        <span class="text-crimson-500 text-xs font-display font-600 tracking-widest uppercase">Our Story</span>
                    </div>
                    <h2 class="font-display text-4xl lg:text-5xl font-800 leading-[0.95] text-gray-900 mb-6">
                        Built From the<br>
                        <span class="red-gradient-text">Inside of Healthcare</span>
                    </h2>

                    <div class="space-y-4 font-body text-gray-500 leading-relaxed">
                        <p>REDSOL was founded with a single, clear purpose — to bring genuine digital transformation to Pakistani hospitals. At the time, most facilities were running on paper-based systems or outdated, disconnected software that created data silos across departments.</p>

                        {{-- Inline highlight --}}
                        <div class="border-l-2 border-crimson-500 pl-5 py-1 my-6">
                            <p class="text-gray-700 italic font-500">"We didn't build a software company that happened to serve healthcare. We built a healthcare company that happens to write software."</p>
                        </div>

                        <p>Starting with a core Hospital Information System, we grew module by module — Laboratory, Radiology, PACS, Emergency, OT, Pharmacy — always guided by real feedback from the doctors, nurses, and administrators using these systems daily.</p>

                        <p>Today, REDSOL's platform serves 150+ hospitals across Pakistan, processing millions of patient interactions every year — in government hospitals, private chains, specialty centers, and teaching institutions.</p>

                        <p>We remain proudly independent — still led by the same engineering and healthcare vision that started it all in Lahore.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- ─── MISSION / VISION / COMMITMENT ─────────────────── --}}
    <section class="py-24 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-14 reveal">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="h-px w-10 bg-crimson-500"></div>
                    <span class="text-crimson-500 text-xs font-display font-600 tracking-widest uppercase">What Drives Us</span>
                    <div class="h-px w-10 bg-crimson-500"></div>
                </div>
                <h2 class="font-display text-4xl lg:text-5xl font-800 leading-[0.95] text-gray-900">
                    Mission. Vision. <span class="red-gradient-text">Purpose.</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                    $mvv = [
                        [
                            'num' => '01',
                            'icon' => 'M22 12h-4l-3 9L9 3l-3 9H2',
                            'title' => 'Our Mission',
                            'text' => 'To deliver reliable, fully-integrated healthcare software that empowers hospitals to provide faster, safer, and more efficient patient care — without complexity or compromise.',
                        ],
                        [
                            'num' => '02',
                            'icon' => 'M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                            'title' => 'Our Vision',
                            'text' => 'A Pakistan where every hospital — government or private, urban or rural — runs on digital infrastructure that meets international standards. We work every day to close that gap.',
                        ],
                        [
                            'num' => '03',
                            'icon' => 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z',
                            'title' => 'Our Commitment',
                            'text' => 'We don\'t disappear after go-live. Every client gets long-term support through AMC contracts, dedicated response, and continuous system updates — because hospitals can\'t afford downtime.',
                        ],
                    ];
                @endphp
                @foreach($mvv as $i => $card)
                    <div class="card-hover group bg-white rounded-2xl p-8 reveal reveal-delay-{{ $i+1 }} relative overflow-hidden">
                        {{-- Red top bar on hover --}}
                        <div class="absolute top-0 left-0 right-0 h-0.5 bg-crimson-500 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>

                        {{-- Number --}}
                        <div class="font-display text-5xl font-800 text-gray-100 leading-none mb-5 select-none group-hover:text-crimson-500/10 transition-colors">
                            {{ $card['num'] }}
                        </div>

                        {{-- Icon --}}
                        <div class="w-11 h-11 rounded-xl bg-crimson-500/8 border border-crimson-500/15 flex items-center justify-center mb-5 group-hover:bg-crimson-500/15 group-hover:border-crimson-500/30 transition-all">
                            <svg class="w-5 h-5 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $card['icon'] }}"/>
                            </svg>
                        </div>

                        <h3 class="font-display text-xl font-700 text-gray-900 mb-3 tracking-wide">{{ $card['title'] }}</h3>
                        <p class="font-body text-gray-500 text-sm leading-relaxed">{{ $card['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ─── CORE VALUES ─────────────────────────────────────── --}}
    <section class="py-28">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 items-start">

                {{-- Left: header --}}
                <div class="lg:sticky lg:top-28 reveal">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="h-px w-10 bg-crimson-500"></div>
                        <span class="text-crimson-500 text-xs font-display font-600 tracking-widest uppercase">Core Values</span>
                    </div>
                    <h2 class="font-display text-4xl lg:text-5xl font-800 leading-[0.95] text-gray-900 mb-6">
                        The Principles<br>We Build<br>
                        <span class="red-gradient-text">Everything On</span>
                    </h2>
                    <p class="font-body text-gray-500 leading-relaxed text-sm">
                        These aren't poster-worthy platitudes. They're the standards every engineer, trainer, and support staff at REDSOL is held to — every single day.
                    </p>
                </div>

                {{-- Right: values list --}}
                <div class="lg:col-span-2 border border-gray-100 rounded-2xl overflow-hidden divide-y divide-gray-100">
                    @php
                        $values = [
                            ['title' => 'Clinical First',           'desc' => 'Every design decision starts with one question: does this make the clinician\'s job easier? Software that confuses healthcare workers costs lives.'],
                            ['title' => 'Reliability Over Features','desc' => 'A system that works 99.99% of the time is more valuable than one packed with features that occasionally fail. Hospitals need certainty.'],
                            ['title' => 'Honest Engineering',       'desc' => 'We don\'t promise timelines we can\'t meet or features we can\'t deliver. Our clients trust us because we say what we mean and deliver what we say.'],
                            ['title' => 'Long-Term Partnership',    'desc' => 'We measure success in years, not project closures. The best indicator of our work is how long clients stay — and they stay a long time.'],
                            ['title' => 'Continuous Improvement',   'desc' => 'Healthcare evolves. Standards change. We ship updates proactively, not reactively — keeping your system ahead of clinical and regulatory needs.'],
                            ['title' => 'Local Expertise',          'desc' => 'We understand Pakistani hospital operations, infrastructure constraints, and regulatory requirements from the ground up — not from a textbook.'],
                        ];
                    @endphp
                    @foreach($values as $i => $v)
                        <div class="group flex items-start gap-5 px-7 py-6 hover:bg-gray-50 transition-colors reveal reveal-delay-{{ ($i % 3) + 1 }}">
                            {{-- Number --}}
                            <span class="font-display font-800 text-gray-200 text-2xl leading-none shrink-0 group-hover:text-crimson-500/25 transition-colors pt-0.5 w-8">
                        {{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}
                    </span>
                            <div>
                                <h3 class="font-display font-700 text-gray-900 text-lg mb-1 tracking-wide group-hover:text-crimson-600 transition-colors">
                                    {{ $v['title'] }}
                                </h3>
                                <p class="font-body text-gray-500 text-sm leading-relaxed">{{ $v['desc'] }}</p>
                            </div>
                            {{-- Arrow --}}
                            <svg class="w-4 h-4 text-gray-200 shrink-0 mt-1.5 group-hover:text-crimson-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    {{-- ─── TEAM ────────────────────────────────────────────── --}}
    <section id="team" class="py-24 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="flex items-end justify-between flex-wrap gap-6 mb-14 reveal">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-px w-10 bg-crimson-500"></div>
                        <span class="text-crimson-500 text-xs font-display font-600 tracking-widest uppercase">Our Team</span>
                    </div>
                    <h2 class="font-display text-4xl lg:text-5xl font-800 leading-[0.95] text-gray-900">
                        The People <span class="red-gradient-text">Behind</span><br>the Platform
                    </h2>
                </div>
                <p class="font-body text-gray-500 text-sm leading-relaxed max-w-xs">
                    Engineers, trainers, and support staff united by a commitment to healthcare technology that actually works.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $team = [
                        ['name'=>'Tariq Mahmood',  'role'=>'CEO & Co-Founder',     'bio'=>'15+ years in healthcare IT. Drove REDSOL from a single HIS module to a 23-module platform used by 150+ hospitals.', 'initials'=>'TM', 'color'=>'bg-crimson-500'],
                        ['name'=>'Dr. Amna Khalid','role'=>'Chief Medical Officer', 'bio'=>'MBBS with 10 years of hospital experience. Ensures every module meets real clinical workflow requirements.',          'initials'=>'AK', 'color'=>'bg-gray-800'],
                        ['name'=>'Usman Raza',     'role'=>'CTO & Lead Architect',  'bio'=>'Systems architect specializing in DICOM, HL7, and ICD-10 integration across complex hospital environments.',         'initials'=>'UR', 'color'=>'bg-gray-700'],
                        ['name'=>'Sana Mirza',     'role'=>'Head of Implementation','bio'=>'Leads hospital deployments and training. Has personally onboarded 80+ facilities across Pakistan.',                   'initials'=>'SM', 'color'=>'bg-crimson-600'],
                    ];
                @endphp
                @foreach($team as $i => $member)
                    <div class="card-hover group bg-white rounded-2xl overflow-hidden reveal reveal-delay-{{ $i+1 }}">
                        {{-- Photo placeholder --}}
                        <div class="aspect-[3/4] {{ $member['color'] }} flex items-center justify-center relative overflow-hidden">
                            {{-- Initials --}}
                            <span class="font-display font-800 text-white/20 text-7xl select-none">{{ $member['initials'] }}</span>

                            {{-- Red bar on hover --}}
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-crimson-500 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                        </div>

                        {{-- Info --}}
                        <div class="p-5 border-t border-gray-100">
                            <div class="font-display font-700 text-gray-900 text-base mb-0.5">{{ $member['name'] }}</div>
                            <div class="font-body text-crimson-500 text-xs font-600 mb-3 tracking-wide">{{ $member['role'] }}</div>
                            <p class="font-body text-gray-400 text-xs leading-relaxed">{{ $member['bio'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ─── WHY REDSOL ─────────────────────────────────────── --}}
    <section class="py-28">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

                {{-- Left: checklist --}}
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="h-px w-10 bg-crimson-500"></div>
                        <span class="text-crimson-500 text-xs font-display font-600 tracking-widest uppercase">Why Choose Us</span>
                    </div>
                    <h2 class="font-display text-4xl lg:text-5xl font-800 leading-[0.95] text-gray-900 mb-10">
                        What Makes<br>
                        <span class="red-gradient-text">REDSOL Different</span>
                    </h2>

                    <div class="border border-gray-100 rounded-2xl overflow-hidden divide-y divide-gray-100">
                        @php
                            $whys = [
                                ['title'=>'One Integrated Platform',    'desc'=>'Every module runs on a single database. No silos, no integration headaches, no duplicate patient records.'],
                                ['title'=>'Local, Responsive Support',  'desc'=>'Our support team is in Pakistan, speaks your language, and understands your hospital environment. Response in hours, not days.'],
                                ['title'=>'IHE & CLSI Standards',       'desc'=>'Fully compliant with international imaging and laboratory standards — seamless integration with analyzers and modalities.'],
                                ['title'=>'ICD-10 & DICOM Native',      'desc'=>'Built-in ICD-10 coding and full DICOM 3.0 support for all imaging modalities. No bolt-on required.'],
                                ['title'=>'Proven at Scale',            'desc'=>'150+ deployments from small clinics to large government hospitals. We\'ve solved every implementation challenge.'],
                                ['title'=>'No Vendor Lock-In',          'desc'=>'Your data is yours. Proper documentation, export capabilities, and transparent contracts — no hidden gotchas.'],
                            ];
                        @endphp
                        @foreach($whys as $w)
                            <div class="group flex items-start gap-4 px-6 py-5 hover:bg-gray-50 transition-colors">
                                <div class="w-6 h-6 rounded-full bg-crimson-500 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-display font-700 text-gray-900 text-sm mb-0.5 group-hover:text-crimson-600 transition-colors">{{ $w['title'] }}</div>
                                    <p class="font-body text-gray-500 text-xs leading-relaxed">{{ $w['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right: image + badge --}}
                <div class="relative reveal">
                    <img
                        src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=900&q=80&auto=format"
                        alt="Why REDSOL"
                        class="w-full aspect-square object-cover rounded-2xl"
                    >
                    {{-- Red accent --}}
                    <div class="absolute -top-5 -left-5 w-2/3 h-2/3 bg-crimson-500/5 rounded-2xl -z-10 border border-crimson-500/10"></div>

                    {{-- Floating stat badge --}}
                    <div class="absolute top-6 right-6 bg-crimson-500 text-white rounded-xl px-5 py-4 shadow-lg shadow-crimson-500/30 text-center">
                        <div class="font-display font-800 text-3xl leading-none">150+</div>
                        <div class="font-body text-xs text-crimson-100 mt-0.5 tracking-wide">Hospitals Trust Us</div>
                    </div>

                    {{-- Floating uptime badge --}}
                    <div class="absolute bottom-6 left-6 bg-white rounded-xl px-4 py-3 shadow-lg border border-gray-100">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                            <div>
                                <div class="font-display font-700 text-gray-900 text-sm">99.9% Uptime</div>
                                <div class="font-body text-gray-400 text-xs">System reliability</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ─── CTA SECTION ─────────────────────────────────────── --}}
    <section class="py-24 px-6">
        <div class="max-w-5xl mx-auto reveal">
            <div class="cta-bg rounded-3xl p-12 lg:p-16 text-center relative overflow-hidden">

                {{-- Glow orbs --}}
                <div class="absolute -top-16 -left-16 w-48 h-48 rounded-full bg-crimson-500/8 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-16 -right-16 w-48 h-48 rounded-full bg-gray-900/5 blur-3xl pointer-events-none"></div>

                <div class="relative z-10">
                <span class="inline-block text-crimson-500 text-xs font-display font-600 tracking-widest uppercase mb-5 px-4 py-1.5 rounded-full border border-crimson-500/20 bg-crimson-500/5">
                    Ready to Work Together?
                </span>

                    <h2 class="font-display text-4xl lg:text-5xl font-800 leading-[0.95] text-gray-900 mb-5">
                        Let's Build Something<br>
                        <span class="red-gradient-text">Meaningful Together</span>
                    </h2>

                    <p class="font-body text-gray-500 text-lg max-w-xl mx-auto mb-10 leading-relaxed">
                        Ready to see what REDSOL can do for your hospital? Book a free consultation and let's talk.
                    </p>

                    <div class="flex flex-wrap gap-4 justify-center">
                        <a href="/contact"
                           class="group flex items-center gap-3 px-8 py-4 rounded-xl bg-crimson-500 text-white font-display font-700 text-sm hover:bg-crimson-600 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-crimson-500/30">
                            Book a Free Consultation
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <a href="/products"
                           class="flex items-center gap-3 px-8 py-4 rounded-xl border border-gray-200 text-gray-600 font-display font-600 text-sm hover:border-crimson-500/30 hover:text-crimson-600 hover:bg-crimson-500/5 transition-all duration-300">
                            View Our Products
                        </a>
                    </div>

                    {{-- Trust row --}}
                    <div class="flex flex-wrap justify-center gap-8 mt-12 pt-10 border-t border-gray-200/60">
                        @foreach(['No setup fees', 'Full training included', '24/7 AMC support', 'ICD-10 compliant'] as $trust)
                            <div class="flex items-center gap-2 font-body text-gray-500 text-sm">
                                <svg class="w-4 h-4 text-crimson-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
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
        /* Page-specific: hero animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Sticky values sidebar on large screens */
        @media (min-width: 1024px) {
            .lg\:sticky { position: sticky; }
            .lg\:top-28 { top: 7rem; }
        }

        /* Team card color placeholders */
        .aspect-\[3\/4\] { aspect-ratio: 3/4; }
    </style>
@endpush
