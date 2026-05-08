@extends('layouts.app')

@section('content')

    {{-- ═══════════════════════════════════════════════════
        PAGE HERO
    ════════════════════════════════════════════════════ --}}
    <section class="relative pt-36 pb-24 overflow-hidden bg-white">
        {{-- Diagonal red slash decoration --}}
        <div class="absolute top-0 right-0 w-[55%] h-full pointer-events-none overflow-hidden">
            <div class="absolute top-0 right-0 w-full h-full bg-gray-50" style="clip-path: polygon(12% 0, 100% 0, 100% 100%, 0% 100%)"></div>
            <div class="absolute top-0 right-0 w-full h-full" style="clip-path: polygon(12% 0, 100% 0, 100% 100%, 0% 100%); background: radial-gradient(ellipse 80% 70% at 80% 40%, rgba(225,29,72,0.06) 0%, transparent 70%)"></div>
        </div>
        <div class="absolute left-0 top-0 h-full w-1 bg-crimson-500"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-5">
                    <div class="h-px w-10 bg-crimson-500"></div>
                    <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">What We Offer</span>
                </div>
                <h1 class="font-display text-5xl lg:text-7xl font-800 text-gray-900 leading-[0.92] mb-7">
                    Services Built<br>
                    for <span class="relative inline-block">
                        <span class="red-gradient-text">Healthcare</span>
                        <svg class="absolute -bottom-1 left-0 w-full" height="5" viewBox="0 0 260 5" fill="none" preserveAspectRatio="none">
                            <path d="M0 2.5 Q65 0 130 2.5 Q195 5 260 2.5" stroke="#e11d48" stroke-width="2" fill="none" opacity="0.5"/>
                        </svg>
                    </span>
                </h1>
                <p class="font-body text-gray-500 text-lg leading-relaxed max-w-xl mb-10">
                    From full HIS implementation to custom patient portals and annual maintenance — everything your hospital needs to run on modern, integrated software.
                </p>

                {{-- Breadcrumb --}}
                <div class="flex items-center gap-2 text-sm font-body text-gray-400">
                    <a href="/" class="hover:text-crimson-500 transition-colors">Home</a>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-gray-900 font-medium">Services</span>
                </div>
            </div>
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════
        SECTION 1: CORE SERVICES — Large featured cards
    ════════════════════════════════════════════════════ --}}
    <section class="py-24 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="mb-14 reveal">
                <div class="flex items-center gap-3 mb-3">
                    <div class="h-px w-10 bg-crimson-500"></div>
                    <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">Core Services</span>
                </div>
                <h2 class="font-display text-4xl lg:text-5xl font-800 text-gray-900 leading-tight">
                    What We <span class="red-gradient-text">Implement</span>
                </h2>
            </div>

            {{-- Featured Big Cards --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                {{-- Card 1: HIS Implementation --}}
                <div class="group relative rounded-3xl overflow-hidden bg-gray-900 p-10 reveal reveal-delay-1 cursor-pointer hover:scale-[1.01] transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-crimson-500/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute top-0 right-0 w-48 h-48 rounded-full bg-crimson-500/5 blur-3xl group-hover:bg-crimson-500/15 transition-colors duration-500"></div>

                    <div class="relative">
                        <div class="flex items-start justify-between mb-8">
                            <div class="w-14 h-14 rounded-2xl bg-crimson-500/15 border border-crimson-500/25 flex items-center justify-center">
                                <svg class="w-7 h-7 text-crimson-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <span class="text-[10px] font-display font-600 tracking-wider uppercase px-3 py-1.5 rounded-full bg-crimson-500/15 text-crimson-400 border border-crimson-500/20">HIS Core</span>
                        </div>

                        <h3 class="font-display font-800 text-white text-2xl lg:text-3xl mb-4 group-hover:text-crimson-300 transition-colors">HIS Implementation</h3>
                        <p class="font-body text-gray-400 leading-relaxed mb-8">
                            End-to-end deployment of our Health Information System across your entire hospital. One database, 23+ integrated modules — from patient registration and billing to PACS, radiology, and pharmacy. ICD-10 coded, DICOM 3.0 compliant, and built around your workflows.
                        </p>

                        <div class="grid grid-cols-2 gap-3 mb-8">
                            @foreach(['ICD-10 & DICOM 3.0', 'One Database Architecture', 'IHE Protocol Standards', 'Voice Reporting (10 WS)', 'Multi-printer Support', 'CLSI Lab Standards'] as $feat)
                                <div class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-crimson-500 shrink-0"></div>
                                    <span class="text-gray-400 text-xs font-body">{{ $feat }}</span>
                                </div>
                            @endforeach
                        </div>

                        <a href="/contact" class="inline-flex items-center gap-2 text-sm font-display font-600 text-crimson-400 group-hover:text-crimson-300 transition-colors">
                            Request Implementation
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Card 2: Custom Software Dev --}}
                <div class="group relative rounded-3xl overflow-hidden bg-white border border-gray-200 p-10 reveal reveal-delay-2 cursor-pointer hover:scale-[1.01] hover:border-crimson-500/30 hover:shadow-2xl hover:shadow-crimson-500/8 transition-all duration-500">
                    <div class="absolute top-0 right-0 w-48 h-48 rounded-full bg-crimson-500/3 blur-3xl group-hover:bg-crimson-500/8 transition-colors duration-500"></div>

                    <div class="relative">
                        <div class="flex items-start justify-between mb-8">
                            <div class="w-14 h-14 rounded-2xl bg-crimson-500/8 border border-crimson-500/15 flex items-center justify-center">
                                <svg class="w-7 h-7 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                            </div>
                            <span class="text-[10px] font-display font-600 tracking-wider uppercase px-3 py-1.5 rounded-full bg-gray-100 text-gray-600 border border-gray-200">Custom Dev</span>
                        </div>

                        <h3 class="font-display font-800 text-gray-900 text-2xl lg:text-3xl mb-4 group-hover:text-crimson-500 transition-colors">Custom Hospital Software</h3>
                        <p class="font-body text-gray-500 leading-relaxed mb-8">
                            Bespoke hospital management systems built from scratch around your facility's unique clinical and administrative requirements. We handle architecture, UI/UX, testing, deployment and handover. Laravel, React, mobile — any stack you need.
                        </p>

                        <div class="grid grid-cols-2 gap-3 mb-8">
                            @foreach(['Patient Portals', 'Mobile Apps (iOS & Android)', 'Custom Workflows', 'API Integrations', 'Legacy System Migration', 'Multi-branch Systems'] as $feat)
                                <div class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-crimson-500 shrink-0"></div>
                                    <span class="text-gray-500 text-xs font-body">{{ $feat }}</span>
                                </div>
                            @endforeach
                        </div>

                        <a href="/contact" class="inline-flex items-center gap-2 text-sm font-display font-600 text-crimson-500 group-hover:text-crimson-600 transition-colors">
                            Discuss Your Project
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Three smaller cards row --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @php
                    $smallServices = [
                        [
                            'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                            'title' => 'AMC & Support',
                            'desc' => 'Year-round maintenance contracts with proactive monitoring, rapid issue resolution, and system updates. Your hospital never goes offline.',
                            'tag' => 'Support',
                            'href' => '/services/annual-maintenance',
                        ],
                        [
                            'icon' => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z',
                            'title' => 'LIMS / PACS / RIS Integration',
                            'desc' => 'Full lab, radiology, and imaging integration — analyzer interfaces, DICOM archiving, voice reporting, and web-based report access.',
                            'tag' => 'Integration',
                            'href' => '/services/lims-pacs-ris-integration',
                        ],
                        [
                            'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                            'title' => 'Healthcare IT Consulting',
                            'desc' => 'Expert advisory on HIS procurement, system architecture planning, workflow digitization strategy, and compliance readiness.',
                            'tag' => 'Advisory',
                            'href' => '/services/healthcare-it-consulting',
                        ],
                    ];
                @endphp

                @foreach($smallServices as $i => $svc)
                    <a href="{{ $svc['href'] }}"
                       class="group rounded-2xl p-7 bg-white border border-gray-200 hover:border-crimson-500/25 hover:shadow-xl hover:shadow-crimson-500/6 transition-all duration-400 reveal reveal-delay-{{ $i + 1 }}">
                        <div class="w-11 h-11 rounded-xl bg-crimson-500/8 border border-crimson-500/15 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $svc['icon'] }}"/>
                            </svg>
                        </div>
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-display font-700 text-gray-900 text-base group-hover:text-crimson-500 transition-colors">{{ $svc['title'] }}</h3>
                            <span class="text-[9px] font-display font-600 tracking-wider uppercase px-2 py-1 rounded-full bg-gray-100 text-gray-500 border border-gray-200 shrink-0 ml-2">{{ $svc['tag'] }}</span>
                        </div>
                        <p class="font-body text-gray-500 text-sm leading-relaxed">{{ $svc['desc'] }}</p>
                        <div class="mt-5 flex items-center gap-1.5 text-xs font-display font-600 text-crimson-500/50 group-hover:text-crimson-500 transition-colors">
                            Learn more
                            <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════
        SECTION 2: HIS MODULE CATEGORIES (from PDF)
    ════════════════════════════════════════════════════ --}}
    <section class="py-24 bg-gray-50 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-16 reveal">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="h-px w-10 bg-crimson-500"></div>
                    <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">Module Breakdown</span>
                    <div class="h-px w-10 bg-crimson-500"></div>
                </div>
                <h2 class="font-display text-4xl lg:text-5xl font-800 text-gray-900 leading-tight mb-4">
                    25 Modules Across<br><span class="red-gradient-text">Every Department</span>
                </h2>
                <p class="font-body text-gray-500 max-w-xl mx-auto">
                    Our HIS automates clinical, diagnostic, administrative, and imaging workflows — all connected on a single database.
                </p>
            </div>

            {{-- Module category grid --}}
            @php
                $categories = [
                    [
                        'cat' => 'Administration & Security',
                        'color' => 'red',
                        'modules' => [
                            ['name' => 'System Security & Administration', 'desc' => 'Role-based access, audit logs, terminal control, MAC/IP restrictions'],
                            ['name' => 'Front Desk / Inquiry & Information', 'desc' => 'Central patient information point with single-click family access'],
                            ['name' => 'Statistics Dashboard', 'desc' => 'Real-time hospital-wide KPIs, occupancy, revenue and clinical analytics'],
                            ['name' => 'HR Management', 'desc' => 'Staff records, shifts and human resources administration'],
                            ['name' => 'Assets Management', 'desc' => 'Hospital equipment and asset tracking throughout its lifecycle'],
                        ],
                    ],
                    [
                        'cat' => 'Patient Journey',
                        'color' => 'dark',
                        'modules' => [
                            ['name' => 'Patient Registration', 'desc' => 'UMRN-linked registration with family/dependents, wristbands, and CNIC integration'],
                            ['name' => 'Integrated Appointment System', 'desc' => 'OPD/IPD/VIP slot booking via helpdesk or consultant PA with automated queuing'],
                            ['name' => 'Patient Queue Management', 'desc' => 'Real-time serial token queue with senior citizen priority and clinic display'],
                            ['name' => 'Patient Welfare Management', 'desc' => 'Discount policies, welfare categories, document archiving for deserving patients'],
                            ['name' => 'Admission & Discharge System', 'desc' => 'Barcoded wristbands, bed management, IPD billing and follow-up tracking'],
                        ],
                    ],
                    [
                        'cat' => 'Clinical & Diagnostics',
                        'color' => 'red',
                        'modules' => [
                            ['name' => 'Outdoor Clinics & Consultant Practice', 'desc' => 'SOAP notes, CPOE, real-time medicine stock, inter-department referrals'],
                            ['name' => 'Emergency Center Management', 'desc' => 'Triage to discharge: vitals capture, pharmacy orders, episode summaries'],
                            ['name' => 'Nursing Counter / Wards', 'desc' => 'Bed management, vitals, medication dispensing, nursing notes fully integrated'],
                            ['name' => 'Operation Theatre Management', 'desc' => 'Surgery scheduling, pre/post-op checklists, anesthesia records, OT barcode tags'],
                            ['name' => 'Gynecology Management System', 'desc' => 'OB/GYN history, prenatal records, ultrasound interface, immunization alerts'],
                            ['name' => 'Dialysis Center Management', 'desc' => 'Dialysis session tracking, consumable management, and patient history'],
                            ['name' => 'Doctor Share', 'desc' => 'Automated consultant share calculations with dual ledger management'],
                        ],
                    ],
                    [
                        'cat' => 'Diagnostics & Imaging',
                        'color' => 'dark',
                        'modules' => [
                            ['name' => 'Laboratory (LIMS)', 'desc' => 'Barcode specimens, analyzer integration, SNOMED/LOINC codes, web reports'],
                            ['name' => 'Radiology (RIS)', 'desc' => 'Online order entry, worklists, voice recognition reporting, audit trails'],
                            ['name' => 'PACS', 'desc' => 'DICOM 3.0 capture, lossless compression, unlimited workstation licenses'],
                            ['name' => 'DICOM Image Compression', 'desc' => 'Best-in-class compression with lossless integrity and multi-server archiving'],
                            ['name' => 'Voice Report Generation', 'desc' => '10-workstation voice reporting integrated across lab and radiology'],
                        ],
                    ],
                    [
                        'cat' => 'Operations & Supply',
                        'color' => 'red',
                        'modules' => [
                            ['name' => 'Patient Billing System', 'desc' => 'Service billing, doctor share distribution, daily income statements'],
                            ['name' => 'Pharmacy Management', 'desc' => 'CPOE-integrated dispensing, formulary management, real-time stock'],
                            ['name' => 'Inventory Management', 'desc' => 'Warehouse, sub-stores, GRN, purchase orders, condemnation workflows'],
                        ],
                    ],
                ];
                $colorMap = [
                    'red'  => ['accent' => 'bg-crimson-500', 'icon_bg' => 'bg-crimson-500/10', 'icon_border' => 'border-crimson-500/20', 'icon_text' => 'text-crimson-500', 'cat_text' => 'text-crimson-600', 'cat_bg' => 'bg-crimson-500/8 border-crimson-500/15'],
                    'dark' => ['accent' => 'bg-gray-800',    'icon_bg' => 'bg-gray-100',        'icon_border' => 'border-gray-200',         'icon_text' => 'text-gray-600',    'cat_text' => 'text-gray-700',   'cat_bg' => 'bg-gray-100 border-gray-200'],
                ];
            @endphp

            <div class="space-y-6">
                @foreach($categories as $ci => $category)
                    @php $c = $colorMap[$category['color']]; @endphp
                    <div class="rounded-2xl bg-white border border-gray-200 overflow-hidden reveal reveal-delay-{{ ($ci % 3) + 1 }}">
                        {{-- Category header --}}
                        <div class="flex items-center gap-4 px-8 py-5 border-b border-gray-100 bg-white">
                            <div class="w-1 h-8 rounded-full {{ $c['accent'] }}"></div>
                            <h3 class="font-display font-700 text-gray-900 text-lg">{{ $category['cat'] }}</h3>
                            <span class="ml-auto text-xs font-body text-gray-400">{{ count($category['modules']) }} modules</span>
                        </div>

                        {{-- Module pills --}}
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($category['modules'] as $module)
                                <div class="group flex items-start gap-3 p-4 rounded-xl bg-gray-50 border border-gray-100 hover:border-crimson-500/20 hover:bg-crimson-500/3 transition-all duration-200 cursor-default">
                                    <div class="w-8 h-8 rounded-lg {{ $c['icon_bg'] }} border {{ $c['icon_border'] }} flex items-center justify-center shrink-0 mt-0.5">
                                        <svg class="w-3.5 h-3.5 {{ $c['icon_text'] }}" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-display font-600 text-gray-900 text-sm mb-1 group-hover:text-crimson-600 transition-colors">{{ $module['name'] }}</div>
                                        <div class="font-body text-gray-500 text-xs leading-relaxed">{{ $module['desc'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12 reveal">
                <a href="/products" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl border border-crimson-500/25 text-crimson-600 hover:bg-crimson-500/5 hover:border-crimson-500/40 text-sm font-display font-600 transition-all duration-300">
                    Explore All Products in Detail
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════
        SECTION 3: GENERAL FEATURES (from PDF)
    ════════════════════════════════════════════════════ --}}
    <section class="py-24 bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                {{-- Left: text --}}
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="h-px w-10 bg-crimson-500"></div>
                        <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">Platform-Wide Features</span>
                    </div>
                    <h2 class="font-display text-4xl lg:text-5xl font-800 text-gray-900 leading-tight mb-6">
                        Built-in, Right<br>Out of the <span class="red-gradient-text">Box</span>
                    </h2>
                    <p class="font-body text-gray-500 leading-relaxed mb-8">
                        Every REDSOL deployment ships with a full suite of cross-cutting capabilities that apply to every module — no add-ons, no hidden costs.
                    </p>
                    <a href="/contact" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-crimson-500 text-white text-sm font-display font-600 hover:bg-crimson-600 transition-colors hover:shadow-lg hover:shadow-crimson-500/25">
                        Book a Free Demo
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                {{-- Right: feature grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 reveal reveal-delay-2">
                    @php
                        $features = [
                            ['icon' => '🔐', 'title' => 'ICD-10 Coded', 'desc' => 'All CPT definitions mapped to ICD-10 codes across every module'],
                            ['icon' => '🖨️', 'title' => 'Multi-format Printing', 'desc' => 'Thermal, Half A4, and Full Page printing configurable per workstation'],
                            ['icon' => '📧', 'title' => 'Secure Email Reports', 'desc' => 'Direct secured email report delivery from within the system'],
                            ['icon' => '🔗', 'title' => 'One Database', 'desc' => 'PACS + HIS tightly integrated on a single unified database'],
                            ['icon' => '🏷️', 'title' => 'Custom Labels', 'desc' => 'Patient labels for encounters, labs, radiology, OT and more'],
                            ['icon' => '📋', 'title' => 'Document Scanning', 'desc' => 'Scan and attach documents directly to patient records'],
                            ['icon' => '🔔', 'title' => 'Patient Alerts', 'desc' => 'Customizable alerts on patient records visible to authorized staff'],
                            ['icon' => '🌐', 'title' => 'IHE & CLSI Standards', 'desc' => 'Full IHE protocol and CLSI standards for imaging and lab integration'],
                            ['icon' => '📞', 'title' => 'Voice Recognition', 'desc' => '10-workstation integrated voice reporting across lab and radiology'],
                            ['icon' => '📄', 'title' => 'Multilingual Rx', 'desc' => 'Prescriptions in English with other language support on request'],
                            ['icon' => '🔄', 'title' => 'Record Merging', 'desc' => 'Merge duplicate patient records across multiple MR numbers'],
                            ['icon' => '📚', 'title' => 'User Manuals', 'desc' => 'Custom user manuals and full staff training provided on go-live'],
                        ];
                    @endphp

                    @foreach($features as $i => $feat)
                        <div class="flex items-start gap-3 p-4 rounded-xl border border-gray-100 bg-gray-50 hover:border-crimson-500/20 hover:bg-crimson-500/3 transition-all duration-200">
                            <span class="text-xl leading-none mt-0.5">{{ $feat['icon'] }}</span>
                            <div>
                                <div class="font-display font-600 text-gray-900 text-sm mb-1">{{ $feat['title'] }}</div>
                                <div class="font-body text-gray-500 text-xs leading-relaxed">{{ $feat['desc'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════
        SECTION 4: PROCESS / HOW WE DELIVER
    ════════════════════════════════════════════════════ --}}
    <section class="py-24 bg-gray-900 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-16 reveal">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="h-px w-10 bg-crimson-500"></div>
                    <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">Delivery Process</span>
                    <div class="h-px w-10 bg-crimson-500"></div>
                </div>
                <h2 class="font-display text-4xl lg:text-5xl font-800 text-white leading-tight">
                    How We Deliver<br><span class="red-gradient-text">Every Project</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-px bg-gray-800 rounded-2xl overflow-hidden">
                @php
                    $steps = [
                        ['num' => '01', 'title' => 'Discovery & Consultation', 'desc' => 'We audit your existing workflows, map department requirements, and identify integration points before a single line of code is written.', 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
                        ['num' => '02', 'title' => 'System Configuration', 'desc' => 'We configure each HIS module to your hospital\'s specific departments, staff roles, printer setup, billing policies, and reporting formats.', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['num' => '03', 'title' => 'Staff Training', 'desc' => 'Hands-on training for all user groups — from front desk to radiologists and surgeons — with custom user manuals for every role.', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['num' => '04', 'title' => 'Go-Live & AMC', 'desc' => 'We support your launch day end-to-end, then transition into AMC — ongoing monitoring, updates, and dedicated support for the long term.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                    ];
                @endphp

                @foreach($steps as $i => $step)
                    <div class="bg-gray-900 p-8 reveal reveal-delay-{{ $i + 1 }} group hover:bg-gray-800 transition-colors duration-300">
                        <div class="flex items-start justify-between mb-6">
                            <div class="w-12 h-12 rounded-xl bg-crimson-500/15 border border-crimson-500/25 flex items-center justify-center group-hover:bg-crimson-500/25 transition-colors">
                                <svg class="w-5 h-5 text-crimson-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $step['icon'] }}"/>
                                </svg>
                            </div>
                            <span class="font-display font-800 text-3xl text-gray-800 group-hover:text-gray-700 transition-colors">{{ $step['num'] }}</span>
                        </div>
                        <h3 class="font-display font-700 text-white text-lg mb-3">{{ $step['title'] }}</h3>
                        <p class="font-body text-gray-400 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════
        SECTION 5: CTA
    ════════════════════════════════════════════════════ --}}
    <section class="py-24 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-6 text-center reveal">

            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-crimson-500/20 bg-crimson-500/5 mb-8">
                <span class="w-2 h-2 rounded-full bg-crimson-500 animate-pulse"></span>
                <span class="text-crimson-600 text-xs font-display tracking-widest uppercase font-600">Ready to Get Started?</span>
            </div>

            <h2 class="font-display text-4xl lg:text-6xl font-800 text-gray-900 leading-tight mb-6">
                Let's Talk About<br>
                <span class="red-gradient-text">Your Hospital</span>
            </h2>

            <p class="font-body text-gray-500 text-lg max-w-lg mx-auto mb-10">
                Whether you're evaluating HIS for the first time or replacing an existing system — we'll show you exactly what REDSOL can do for your facility.
            </p>

            <div class="flex flex-wrap gap-4 justify-center mb-14">
                <a href="/contact"
                   class="group flex items-center gap-3 px-10 py-4 rounded-2xl bg-crimson-500 text-white font-display font-700 text-sm hover:bg-crimson-600 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-crimson-500/25">
                    Book a Free Consultation
                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="/products"
                   class="group flex items-center gap-3 px-10 py-4 rounded-2xl border border-gray-200 text-gray-700 font-display font-600 text-sm hover:border-crimson-500/30 hover:text-crimson-600 transition-all duration-300">
                    Browse All Products
                </a>
            </div>

            {{-- Trust bar --}}
            <div class="flex flex-wrap justify-center gap-8 pt-10 border-t border-gray-100">
                @foreach([
                    ['icon' => '✓', 'text' => 'No setup fees'],
                    ['icon' => '✓', 'text' => 'Full training included'],
                    ['icon' => '✓', 'text' => '24/7 AMC support'],
                    ['icon' => '✓', 'text' => 'ICD-10 compliant'],
                    ['icon' => '✓', 'text' => '150+ hospitals deployed'],
                ] as $trust)
                    <div class="flex items-center gap-2 text-sm font-body text-gray-500">
                        <span class="text-crimson-500 font-bold text-base">{{ $trust['icon'] }}</span>
                        {{ $trust['text'] }}
                    </div>
                @endforeach
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
        .reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.75s cubic-bezier(0.16,1,0.3,1), transform 0.75s cubic-bezier(0.16,1,0.3,1);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.08s; }
        .reveal-delay-2 { transition-delay: 0.16s; }
        .reveal-delay-3 { transition-delay: 0.24s; }
    </style>
@endpush

@push('scripts')
    <script>
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
        }, { threshold: 0.08, rootMargin: '0px 0px -50px 0px' });
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
    </script>
@endpush
