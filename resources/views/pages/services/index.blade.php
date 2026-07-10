@extends('layouts.app')

@section('content')<section class="relative pt-32 pb-20 overflow-hidden bg-white">
                        
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
                            </div>
                        </div>
                    </section><section class="py-24 bg-white border-t border-gray-100">
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

                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                                @foreach($services as $index => $svc)
                                    
                                    @php
        $isDark = ($index === 0);
        $cardBg = $isDark ? 'bg-gray-900' : 'bg-white border border-gray-200';
        $titleClass = $isDark ? 'text-white group-hover:text-crimson-300' : 'text-gray-900 group-hover:text-crimson-500';
        $descClass = $isDark ? 'text-gray-400' : 'text-gray-500';
        $featClass = $isDark ? 'text-gray-400' : 'text-gray-500';
        $iconBg = $isDark ? 'bg-crimson-500/15 border-crimson-500/25' : 'bg-crimson-500/8 border-crimson-500/15';
        $iconColor = $isDark ? 'text-crimson-400' : 'text-crimson-500';
        $tagBg = $isDark ? 'bg-crimson-500/15 text-crimson-400 border-crimson-500/20' : 'bg-gray-100 text-gray-600 border-gray-200';
        $linkColor = $isDark ? 'text-crimson-400 group-hover:text-crimson-300' : 'text-crimson-500 group-hover:text-crimson-600';
        $hoverShadow = $isDark ? '' : 'hover:border-crimson-500/30 hover:shadow-2xl hover:shadow-crimson-500/8';
                                    @endphp

                                    <div
                                        class="group relative rounded-3xl overflow-hidden {{ $cardBg }} p-10 reveal reveal-delay-{{ $index + 1 }} cursor-pointer hover:scale-[1.01] transition-all duration-500 {{ $hoverShadow }}">
                                        
                                        @if($isDark)
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br from-crimson-500/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                            </div>
                                            <div
                                                class="absolute top-0 right-0 w-48 h-48 rounded-full bg-crimson-500/5 blur-3xl group-hover:bg-crimson-500/15 transition-colors duration-500">
                                            </div>
                                        @else
                                            <div
                                                class="absolute top-0 right-0 w-48 h-48 rounded-full bg-crimson-500/3 blur-3xl group-hover:bg-crimson-500/8 transition-colors duration-500">
                                            </div>
                                        @endif

                                        <div class="relative">
                                            <div class="flex items-start justify-between mb-8">
                                                <div class="w-14 h-14 rounded-2xl {{ $iconBg }} flex items-center justify-center">
                                                    {!! $svc->icon !!} 
                                                </div>
                                                <span
                                                    class="text-[10px] font-display font-600 tracking-wider uppercase px-3 py-1.5 rounded-full {{ $tagBg }}">
                                                    {{ $svc->tag }}
                                                </span>
                                            </div>

                                            <h3 class="font-display font-800 {{ $titleClass }} text-2xl lg:text-3xl mb-4 transition-colors">
                                                {{ $svc->name }}
                                            </h3>

                                            <p class="font-body {{ $descClass }} leading-relaxed mb-8">
                                                {{ $svc->description }}
                                            </p>

                                            
                                            @if($svc->features && is_array($svc->features) && count($svc->features) > 0)
                                                <div class="grid grid-cols-2 gap-3 mb-8">
                                                    @foreach($svc->features as $feat)
                                                        <div class="flex items-center gap-2">
                                                            <div class="w-1.5 h-1.5 rounded-full bg-crimson-500 shrink-0"></div>
                                                            <span class="{{ $featClass }} text-xs font-body">{{ $feat }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <a href="{{ $svc->href ?? '/contact' }}"
                                                class="inline-flex items-center gap-2 text-sm font-display font-600 {{ $linkColor }} transition-colors">
                                                {{ $svc->cta_text ?? 'Learn More' }}
                                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($smallServices as $i => $svc)
                                <a href="/services/{{ $svc->slug }}"
                                       class="group rounded-2xl p-7 bg-white border border-gray-200 hover:border-crimson-500/25 hover:shadow-xl hover:shadow-crimson-500/6 transition-all duration-400 reveal reveal-delay-{{ $i + 1 }}">
                                        <div class="w-11 h-11 rounded-xl bg-crimson-500/8 border border-crimson-500/15 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-5 h-5 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $svc->icon }}"/>
                                            </svg>
                                        </div>
                                        <div class="flex items-center justify-between mb-3">
                                            <h3 class="font-display font-700 text-gray-900 text-base group-hover:text-crimson-500 transition-colors">{{ $svc->name }}</h3>
                                            <span class="text-[9px] font-display font-600 tracking-wider uppercase px-2 py-1 rounded-full bg-gray-100 text-gray-500 border border-gray-200 shrink-0 ml-2">{{ $svc->tag }}</span>
                                        </div>
                                        <p class="font-body text-gray-500 text-sm leading-relaxed">{{ $svc->description }}</p>
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
                    </section><section class="py-24 bg-gray-50 border-t border-gray-200">
                        <div class="max-w-7xl mx-auto px-6 lg:px-8">

                            <div class="text-center mb-16 reveal">
                                <div class="flex items-center justify-center gap-3 mb-4">
                                    <div class="h-px w-10 bg-crimson-500"></div>
                                    <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">Module
                                        Breakdown</span>
                                    <div class="h-px w-10 bg-crimson-500"></div>
                                </div>
                                <h2 class="font-display text-4xl lg:text-5xl font-800 text-gray-900 leading-tight mb-4">
                                    {{ $moduleCount }} Modules Across<br><span class="red-gradient-text">Every Department</span>
                                </h2>
                                <p class="font-body text-gray-500 max-w-xl mx-auto">
                                    Our HIS automates clinical, diagnostic, administrative, and imaging workflows — all connected on a
                                    single database.
                                </p>
                            </div>

                            
                            @php
    // Load published modules, grouped by category, preserving sort_order
    $modules = \App\Models\Product::published()
        ->orderBy('sort_order')
        ->get();

    $groupedModules = $modules->groupBy('category');

    // Define category display order (customize as needed)
    $categoryOrder = [
        'administration',
        'patient-journey',
        'clinical',
        'diagnostics',
        'operations',
    ];
                            @endphp

                            <div class="space-y-6">
                                @foreach($categoryOrder as $ci => $catKey)
                                    @if(isset($groupedModules[$catKey]) && $groupedModules[$catKey]->isNotEmpty())
                                                                    @php
                                        $modsInCat = $groupedModules[$catKey];
                                        $firstMod = $modsInCat->first();

                                        // Use module's theme fields (with fallbacks for safety)
                                        $accent = $firstMod->accent_bg ?? 'bg-crimson-500';
                                        $badgeBg = $firstMod->badge_bg ?? 'bg-crimson-500/10';
                                        $badgeText = $firstMod->badge_text ?? 'text-crimson-600';
                                        $badgeBorder = $firstMod->badge_border ?? 'border-crimson-500/20';
                                        $iconBg = $firstMod->icon_bg ?? 'bg-crimson-500/10';
                                        $iconBorder = $firstMod->icon_border ?? 'border-crimson-500/20';
                                        $iconText = $firstMod->icon_text ?? 'text-crimson-500';
                                        $cardHover = $firstMod->card_hover ?? 'hover:border-crimson-500/20 hover:bg-crimson-500/3';

                                        // Category label: use cat_label from DB or fallback
                                        $catLabel = $firstMod->cat_label ?? ucfirst(str_replace('-', ' ', $catKey));
                                                                    @endphp

                                                                    <div
                                                                        class="rounded-2xl bg-white border border-gray-200 overflow-hidden reveal reveal-delay-{{ ($ci % 3) + 1 }}">
                                                                        
                                                                        <div class="flex items-center gap-4 px-8 py-5 border-b border-gray-100 bg-white">
                                                                            <div class="w-1 h-8 rounded-full {{ $accent }}"></div>
                                                                            <h3 class="font-display font-700 text-gray-900 text-lg">{{ $catLabel }}</h3>
                                                                            <span class="ml-auto text-xs font-body text-gray-400">{{ $modsInCat->count() }} modules</span>
                                                                        </div>

                                                                        
                                                                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                                                            @foreach($modsInCat as $module)
                                                                                                                    @php
                                                                                // Per-module overrides (if stored in DB)
                                                                                $mBadgeBg = $module->badge_bg ?? $badgeBg;
                                                                                $mBadgeText = $module->badge_text ?? $badgeText;
                                                                                $mIconBg = $module->icon_bg ?? $iconBg;
                                                                                $mIconBorder = $module->icon_border ?? $iconBorder;
                                                                                $mIconText = $module->icon_text ?? $iconText;
                                                                                $mCardHover = $module->card_hover ?? $cardHover;
                                                                                                                    @endphp
                                                                                                                    <div
                                                                                                                        class="group flex items-start gap-3 p-4 rounded-xl bg-gray-50 border border-gray-100 {{ $mCardHover }} transition-all duration-200 cursor-default">
                                                                                                                    <div
                                                                                                                        class="w-8 h-8 rounded-lg {{ $mIconBg }} border {{ $mIconBorder }} flex items-center justify-center shrink-0 mt-0.5 text-lg leading-none">
                                                                                                                        <span class="{{ $mIconText }}">{{ $module->icon ?? '🧩' }}</span>
                                                                                                                    </div>
                                                                                                                        <div>
                                                                                                                            <div
                                                                                                                                class="font-display font-600 text-gray-900 text-sm mb-1 group-hover:text-crimson-600 transition-colors">
                                                                                                                                {{ $module->name }}
                                                                                                                            </div>
                                                                                                                            <div class="font-body text-gray-500 text-xs leading-relaxed">
                                                                                                                                {{ $module->tagline }}
                                                                                                                            </div>

                                                                                                                            
                                                                                                                            @if($module->relationLoaded('features') && $module->features->isNotEmpty())
                                                                                                                                <div class="mt-2 flex flex-wrap gap-1">
                                                                                                                                    @foreach($module->features->take(2) as $feat)
                                                                                                                                        <span
                                                                                                                                            class="text-[10px] px-1.5 py-0.5 rounded bg-gray-200 text-gray-600">{{ $feat->name }}</span>
                                                                                                                                    @endforeach
                                                                                                                                    @if($module->features->count() > 2)
                                                                                                                                        <span class="text-[10px] text-gray-400">+{{ $module->features->count() - 2 }}
                                                                                                                                            more</span>
                                                                                                                                    @endif
                                                                                                                                </div>
                                                                                                                            @endif
                                                                                                                        </div>
                                                                                                                    </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="text-center mt-12 reveal">
                                <a href="/products"
                                    class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl border border-crimson-500/25 text-crimson-600 hover:bg-crimson-500/5 hover:border-crimson-500/40 text-sm font-display font-600 transition-all duration-300">
                                    Explore All Products in Detail
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </section><section class="py-24 bg-white border-t border-gray-200">
                        <div class="max-w-7xl mx-auto px-6 lg:px-8">

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                                
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
                    </section><section class="py-24 bg-gray-900 border-t border-gray-800">
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
                    </section><section class="py-24 bg-white border-t border-gray-100">
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
                                    Book a Free Demo
                                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                                <a href="/products"
                                   class="group flex items-center gap-3 px-10 py-4 rounded-2xl border border-gray-200 text-gray-700 font-display font-600 text-sm hover:border-crimson-500/30 hover:text-crimson-600 transition-all duration-300">
                                    Browse All Products
                                </a>
                            </div>

                            
                            <div class="flex flex-wrap justify-center gap-8 pt-10 border-t border-gray-100">
                                @foreach([
        ['icon' => '✓', 'text' => 'Full training included'],
        ['icon' => '✓', 'text' => '24/7 AMC support'],
        ['icon' => '✓', 'text' => 'ICD-10 compliant'],
        ['icon' => '✓', 'text' => $hospitalCount . '+ hospitals deployed'],
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
