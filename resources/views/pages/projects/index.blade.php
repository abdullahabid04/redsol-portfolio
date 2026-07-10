@extends('layouts.app')

@section('content')

                @php
    // Pull from controller — fallback to empty collection for safety
    $projects = $projects ?? Illuminate\Support\Collection::make();
    $featured = $featured ?? Illuminate\Support\Collection::make();

    // Safe total: works for both Paginator and Collection
    $total = $total ?? (method_exists($projects, 'total') ? $projects->total() : $projects->count());

    // Stats for the hero bar
    $statsBar = [
        [$total . '+', 'Projects Delivered'],
        [$hospitalCount . '+', 'Hospitals Served'],
        ['12+', 'Years Experience'],
    ];

    // Filter types matching Project::CLIENT_TYPES
    $filterTypes = [
        '' => 'All Projects',
        'government' => 'Government',
        'private' => 'Private',
        'semi-government' => 'Semi-Government',
        'ngo' => 'NGO',
    ];
        
    $activeType = request('type', '');
    $activeSearch = request('search', '');
                @endphp<section class="relative pt-36 pb-24 bg-gray-900 overflow-hidden">


                        <div class="absolute inset-0 pointer-events-none"
                             style="background-image: linear-gradient(rgba(225,29,72,0.04) 1px, transparent 1px),
                                    linear-gradient(90deg, rgba(225,29,72,0.04) 1px, transparent 1px);
                                    background-size: 48px 48px;">
                        </div>


                        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full bg-crimson-500/5
                                    blur-[120px] pointer-events-none"></div>
                        <div class="absolute -bottom-20 -left-20 w-[300px] h-[300px] rounded-full bg-crimson-500/4
                                    blur-[100px] pointer-events-none"></div>


                        <div class="absolute bottom-0 left-0 right-0 h-28 bg-gradient-to-t from-gray-900
                                    to-transparent pointer-events-none"></div>

                        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">


                            <div class="flex items-center gap-3 mb-6">
                                <div class="h-px w-10 bg-crimson-500"></div>
                                <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">
                                    Our Work
                                </span>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-end">

                                <div>
                                    <h1 class="font-display text-5xl lg:text-7xl font-800 text-white leading-[0.92] mb-6">
                                        Real Hospitals.<br>
                                        <span class="red-gradient-text">Real Results.</span><br>
                                        <span class="text-gray-400">Proven at Scale.</span>
                                    </h1>
                                    <p class="font-body text-gray-400 text-lg leading-relaxed max-w-lg mb-8">
                                        From government district hospitals to private specialist centres — here's
                                        how REDSOL has transformed healthcare operations across Pakistan.
                                    </p>
                                    <div class="flex flex-wrap gap-3">
                                        <a href="#projects"
                                           class="flex items-center gap-2.5 px-6 py-3 rounded-2xl bg-crimson-500 text-white
                                                  font-display font-600 text-sm hover:bg-crimson-600 transition-all
                                                  hover:shadow-xl hover:shadow-crimson-500/30 hover:scale-105">
                                            Browse Projects
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                      d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </a>
                                        <a href="/contact"
                                           class="flex items-center gap-2.5 px-6 py-3 rounded-2xl border border-white/15
                                                  text-gray-300 font-display font-600 text-sm hover:border-crimson-500/40
                                                  hover:text-crimson-400 transition-all">
                                            Discuss Your Project
                                        </a>
                                    </div>
                                </div>


                                <div class="grid grid-cols-3 gap-px bg-white/5 rounded-2xl overflow-hidden">
                                    @foreach($statsBar as $s)
                                        <div class="bg-gray-900 px-6 py-8 text-center">
                                            <div class="font-display font-800 text-3xl text-crimson-400 mb-1">{{ $s[0] }}</div>
                                            <div class="font-body text-gray-500 text-xs tracking-wide leading-snug">{{ $s[1] }}</div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                        </div>
                    </section><section class="bg-white border-b border-gray-100 py-5 overflow-hidden">
                        <div class="flex gap-10 w-max" style="animation: ticker 35s linear infinite;">
                            @php
    // Merge featured clients and duplicate for ticker effect
    $tickerClients = $featuredClients->pluck('name')->toArray();
    $tickerClients = array_merge($tickerClients, $tickerClients);
                            @endphp
                            @forelse($tickerClients as $client)
                                <div class="flex items-center gap-2.5 shrink-0">
                                    <div class="w-1.5 h-1.5 rounded-full bg-crimson-500"></div>
                                    <span class="font-body text-sm text-gray-500 whitespace-nowrap">{{ $client }}</span>
                                </div>
                            @empty
                                <p class="text-gray-500">No featured clients available.</p>
                            @endforelse
                        </div>
                    </section>
                    
                    @if($featured->isNotEmpty())
                        <section class="py-24 bg-white">
                            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                                <div class="flex items-end justify-between mb-14 reveal">
                                    <div>
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="h-px w-10 bg-crimson-500"></div>
                                            <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">
                                                Featured Projects
                                            </span>
                                        </div>
                                        <h2 class="font-display text-4xl lg:text-5xl font-800 text-gray-900 leading-tight">
                                            Landmark<br>
                                            <span class="red-gradient-text">Deployments</span>
                                        </h2>
                                    </div>
                                    <a href="#projects"
                                       class="hidden md:flex items-center gap-2 text-sm font-display font-600
                                              text-crimson-500 hover:text-crimson-600 transition-colors">
                                        All projects
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>


                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    @foreach($featured->take(4) as $i => $project)
                                        <a href="{{ route('projects.show', $project->slug) }}"
                                           class="group relative rounded-3xl overflow-hidden card-hover
                                                  {{ $i === 0 ? 'lg:col-span-2' : '' }} reveal reveal-delay-{{ ($i % 3) + 1 }}">


                                            <div class="relative {{ $i === 0 ? 'h-[420px]' : 'h-[280px]' }} overflow-hidden">
                                                @if($project->featured_image)
                                                    <img src="{{ asset('storage/' . $project->featured_image) }}"
                                                         alt="{{ $project->featured_image_alt ?? $project->title }}"
                                                         class="w-full h-full object-cover transition-transform duration-700
                                                                group-hover:scale-105">
                                                @else

                                                    <div class="w-full h-full bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900
                                                                flex items-center justify-center">
                                                        <svg class="w-16 h-16 text-crimson-500/20" fill="none"
                                                             stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                        </svg>
                                                    </div>
                                                @endif


                                                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>


                                                <div class="absolute top-5 left-5">
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full
                                                                 bg-white/10 backdrop-blur-sm border border-white/15
                                                                 text-[10px] font-display font-600 tracking-wider uppercase text-white">
                                                        {{ $project->clientTypeLabel() }}
                                                    </span>
                                                </div>


                                                <div class="absolute top-5 right-5">
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full
                                                                 bg-crimson-500/80 backdrop-blur-sm
                                                                 text-[10px] font-display font-600 tracking-wider uppercase text-white">
                                                        Featured
                                                    </span>
                                                </div>


                                                <div class="absolute bottom-0 left-0 right-0 p-7">


                                                    @if($project->locationString())
                                                        <div class="flex items-center gap-1.5 mb-3">
                                                            <svg class="w-3.5 h-3.5 text-crimson-400" fill="none"
                                                                 stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            </svg>
                                                            <span class="font-body text-xs text-gray-400">
                                                                {{ $project->locationString() }}
                                                            </span>
                                                        </div>
                                                    @endif

                                                    <h3 class="font-display font-800 text-white leading-tight mb-2
                                                               group-hover:text-crimson-300 transition-colors
                                                               {{ $i === 0 ? 'text-3xl lg:text-4xl' : 'text-xl' }}">
                                                        {{ $project->title }}
                                                    </h3>

                                                    <p class="font-body text-gray-400 text-sm leading-relaxed
                                                              {{ $i === 0 ? 'max-w-2xl' : '' }} line-clamp-2 mb-5">
                                                        {{ $project->summaryPreview(140) }}
                                                    </p>


                                                    @if($project->stats && count($project->stats))
                                                        <div class="flex flex-wrap gap-2 mb-5">
                                                            @foreach(array_slice($project->stats, 0, 3) as $key => $val)
                                                                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl
                                                                            bg-white/8 border border-white/10">
                                                                    <span class="font-display font-700 text-sm text-crimson-400">
                                                                        {{ $val }}
                                                                    </span>
                                                                    <span class="font-body text-xs text-gray-500">
                                                                        {{ ucwords(str_replace('_', ' ', $key)) }}
                                                                    </span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif


                                                    <div class="flex items-center gap-4">
                                                        @if($project->moduleCount())
                                                            <div class="flex items-center gap-1.5 text-xs font-body text-gray-400">
                                                                <svg class="w-3.5 h-3.5 text-crimson-500" fill="none"
                                                                     stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                                                </svg>
                                                                {{ $project->moduleCount() }} modules deployed
                                                            </div>
                                                        @endif
                                                        @if($project->completion_date)
                                                            <div class="flex items-center gap-1.5 text-xs font-body text-gray-400">
                                                                <svg class="w-3.5 h-3.5 text-crimson-500" fill="none"
                                                                     stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                                </svg>
                                                                {{ $project->completion_date->format('Y') }}
                                                            </div>
                                                        @endif
                                                        <div class="ml-auto flex items-center gap-1.5 text-xs font-display
                                                                    font-600 text-crimson-400 group-hover:gap-2.5 transition-all">
                                                            View case study
                                                            <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform"
                                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                            </svg>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>

                            </div>
                        </section>
                    @endif<section id="projects" class="py-24 bg-gray-50 border-t border-gray-200">
                        <div class="max-w-7xl mx-auto px-6 lg:px-8">


                            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 reveal">
                                <div>
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="h-px w-10 bg-crimson-500"></div>
                                        <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">
                                            All Projects
                                        </span>
                                    </div>
                                    <h2 class="font-display text-4xl lg:text-5xl font-800 text-gray-900 leading-tight">
                                        Every Deployment,<br>
                                        <span class="red-gradient-text">Every Hospital</span>
                                    </h2>
                                </div>


                                <form method="GET" action="{{ route('projects.index') }}"
                                      class="flex items-center gap-2 w-full md:w-auto">
                                    <input type="hidden" name="type" value="{{ $activeType }}">
                                    <div class="relative flex-1 md:w-72">
                                        <svg class="absolute left-3.5 inset-y-0 my-auto w-4 h-4 text-gray-400 pointer-events-none" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>

                                        <input type="text" name="search" value="{{ $activeSearch }}" placeholder="Search hospitals or projects…" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white
                                                      text-sm font-body text-gray-800 placeholder-gray-400
                                                      focus:outline-none focus:border-crimson-500 focus:ring-1
                                                      focus:ring-crimson-500 transition-all">
                                    </div>
                                    <button type="submit"
                                            class="px-5 py-3 rounded-xl bg-crimson-500 text-white text-sm font-display
                                                   font-600 hover:bg-crimson-600 transition-all hover:shadow-lg
                                                   hover:shadow-crimson-500/25 shrink-0">
                                        Search
                                    </button>
                                    @if($activeSearch || $activeType)
                                        <a href="{{ route('projects.index') }}"
                                           class="px-4 py-3 rounded-xl border border-gray-200 text-sm font-display
                                                  font-600 text-gray-500 hover:border-crimson-500/30 hover:text-crimson-600
                                                  transition-all shrink-0">
                                            Clear
                                        </a>
                                    @endif
                                </form>
                            </div>


                            <div class="flex flex-wrap gap-2 mb-10 reveal">
                                @foreach($filterTypes as $typeKey => $typeLabel)
                                                <a href="{{ route('projects.index', array_merge(request()->except('type', 'page'), ['type' => $typeKey])) }}"
                                                   class="px-4 py-2 rounded-xl text-xs font-display font-600 tracking-wide border
                                                          transition-all duration-200
                                                          {{ $activeType === $typeKey
            ? 'bg-crimson-500 text-white border-crimson-500'
            : 'bg-white text-gray-600 border-gray-200 hover:border-crimson-500/30 hover:text-crimson-600' }}">
                                                    {{ $typeLabel }}
                                                </a>
                                @endforeach
                            </div>


                            @if($activeSearch || $activeType)
                                <p class="font-body text-sm text-gray-400 mb-8 reveal">
                                    Showing {{ $projects->total() }} result{{ $projects->total() !== 1 ? 's' : '' }}
                                    @if($activeSearch)
                                        for "<span class="text-gray-700 font-medium">{{ $activeSearch }}</span>"
                                    @endif
                                    @if($activeType)
                                        in <span class="text-gray-700 font-medium">{{ $filterTypes[$activeType] ?? $activeType }}</span>
                                    @endif
                                </p>
                            @endif



                            @if($projects->isEmpty())


                                <div class="flex flex-col items-center justify-center py-24 text-center reveal">
                                    <div class="w-20 h-20 rounded-3xl bg-gray-200 flex items-center justify-center mb-6">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <h3 class="font-display font-800 text-gray-900 text-2xl mb-3">No projects found</h3>
                                    <p class="font-body text-gray-400 max-w-sm mb-8">
                                        No projects match your current filters. Try clearing the search or selecting a different type.
                                    </p>
                                    <a href="{{ route('projects.index') }}"
                                       class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-crimson-500 text-white
                                              font-display font-600 text-sm hover:bg-crimson-600 transition-all">
                                        View all projects
                                    </a>
                                </div>

                            @else

                                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                                    @foreach($projects as $i => $project)
                                        <a href="{{ route('projects.show', $project->slug) }}"
                                           class="group bg-white rounded-3xl overflow-hidden card-hover reveal reveal-delay-{{ ($i % 3) + 1 }}">


                                            <div class="relative h-52 overflow-hidden">
                                                @if($project->featured_image)
                                                    <img src="{{ asset('storage/' . $project->featured_image) }}"
                                                         alt="{{ $project->featured_image_alt ?? $project->title }}"
                                                         class="w-full h-full object-cover transition-transform duration-700
                                                                group-hover:scale-105">
                                                @else
                                                    <div class="w-full h-full bg-gradient-to-br from-gray-900 via-gray-800
                                                                to-gray-900 flex items-center justify-center">
                                                        <svg class="w-12 h-12 text-crimson-500/20" fill="none"
                                                             stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                        </svg>
                                                    </div>
                                                @endif


                                                <div class="absolute inset-0 bg-gradient-to-t from-black/60
                                                            via-transparent to-transparent"></div>


                                                <div class="absolute top-4 left-4">
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg
                                                                 bg-white/10 backdrop-blur-sm border border-white/15
                                                                 text-[10px] font-display font-600 tracking-wider
                                                                 uppercase text-white">
                                                        {{ $project->clientTypeLabel() }}
                                                    </span>
                                                </div>


                                                @if($project->is_featured)
                                                    <div class="absolute top-4 right-4">
                                                        <span class="w-2 h-2 rounded-full bg-crimson-500 block
                                                                     ring-2 ring-crimson-500/30 ring-offset-1
                                                                     ring-offset-transparent"
                                                              title="Featured project"></span>
                                                    </div>
                                                @endif


                                                @if($project->completion_date)
                                                    <div class="absolute bottom-4 right-4">
                                                        <span class="font-display font-700 text-xs text-white/70">
                                                            {{ $project->completion_date->format('Y') }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="p-6">


                                                <div class="flex items-center gap-2 mb-3">
                                                    <svg class="w-3.5 h-3.5 text-crimson-500 shrink-0" fill="none"
                                                         stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                    </svg>
                                                    <span class="font-body text-xs text-gray-500 truncate">
                                                        {{ $project->client_name }}
                                                        @if($project->locationString())
                                                            · {{ $project->locationString() }}
                                                        @endif
                                                    </span>
                                                </div>


                                                <h3 class="font-display font-700 text-gray-900 text-lg leading-snug mb-3
                                                           group-hover:text-crimson-600 transition-colors line-clamp-2">
                                                    {{ $project->title }}
                                                </h3>


                                                <p class="font-body text-gray-500 text-sm leading-relaxed mb-5 line-clamp-2">
                                                    {{ $project->summaryPreview(120) }}
                                                </p>


                                                @if($project->stats && count($project->stats))
                                                    <div class="flex flex-wrap gap-2 mb-5">
                                                        @foreach(array_slice($project->stats, 0, 2) as $key => $val)
                                                            <div class="flex items-center gap-1 px-2.5 py-1.5 rounded-lg
                                                                        bg-crimson-500/5 border border-crimson-500/10">
                                                                <span class="font-display font-700 text-xs text-crimson-600">
                                                                    {{ $val }}
                                                                </span>
                                                                <span class="font-body text-[10px] text-gray-400">
                                                                    {{ ucwords(str_replace('_', ' ', $key)) }}
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif


                                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">


                                                    @if($project->moduleCount())
                                                        <div class="flex items-center gap-1.5 text-xs font-body text-gray-400">
                                                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none"
                                                                 stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                                            </svg>
                                                            {{ $project->moduleCount() }} modules
                                                        </div>
                                                    @endif


                                                    <div class="flex items-center gap-1 text-xs font-display font-600
                                                                text-crimson-500 opacity-0 group-hover:opacity-100
                                                                transition-all group-hover:gap-2">
                                                        View case study
                                                        <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform"
                                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                        </svg>
                                                    </div>
                                                </div>

                                            </div>
                                        </a>
                                    @endforeach
                                </div>

                                @if($projects instanceof \Illuminate\Pagination\Paginator || $projects instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                    @if($projects->hasPages())
                                        <div class="mt-12 flex items-center justify-center gap-2 reveal">

                                            @if($projects->onFirstPage())
                                                <span class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-300 cursor-not-allowed">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                                    </svg>
                                                </span>
                                            @else
                                                <a href="{{ $projects->previousPageUrl() }}"
                                                   class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-crimson-500/30 hover:text-crimson-600 hover:bg-crimson-500/3 transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                                    </svg>
                                                </a>
                                            @endif

                                            @foreach($projects->getUrlRange(
                                                max(1, $projects->currentPage() - 2),
                                                min($projects->lastPage(), $projects->currentPage() + 2)
                                            ) as $page => $url)
                                                @if($page === $projects->currentPage())
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

                                            @if($projects->hasMorePages())
                                                <a href="{{ $projects->nextPageUrl() }}"
                                                   class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-crimson-500/30 hover:text-crimson-600 hover:bg-crimson-500/3 transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                    </svg>
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
                                @endif



                            @endif

                        </div>
                    </section><section class="py-20 bg-white border-t border-gray-200">
                        <div class="max-w-7xl mx-auto px-6 lg:px-8">
                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-px bg-gray-100 rounded-3xl overflow-hidden">
                                @php
                                    $projectStats = $projectStats ?? [
                                        [$hospitalCount . '+', 'Hospitals across Pakistan', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                                        [$moduleCount . '+', 'HIS modules deployed', 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                                        ['99%', 'Client retention rate', 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                                        ['12+', 'Years in healthcare tech', 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                                    ];
                                @endphp
                                @foreach($projectStats as [$num, $label, $icon])
                                        <div class="bg-white px-8 py-10 flex flex-col items-center text-center reveal">
                                            <div class="w-12 h-12 rounded-2xl bg-crimson-500/8 border border-crimson-500/15
                                                        flex items-center justify-center mb-4">
                                                <svg class="w-5 h-5 text-crimson-500" fill="none"
                                                     stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="1.5" d="{{ $icon }}"/>
                                                </svg>
                                            </div>
                                            <div class="stat-number font-display font-800 text-5xl leading-none mb-2">
                                                {{ $num }}
                                            </div>
                                            <div class="font-body text-gray-500 text-sm">{{ $label }}</div>
                                        </div>
                                @endforeach
                            </div>
                        </div>
                    </section><section class="py-24 bg-gray-900 border-t border-gray-800">
                        <div class="max-w-4xl mx-auto px-6 text-center reveal">

                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border
                                        border-crimson-500/25 bg-crimson-500/8 mb-8">
                                <span class="w-2 h-2 rounded-full bg-crimson-500 animate-pulse-slow"></span>
                                <span class="text-crimson-400 text-xs font-display tracking-widest uppercase font-600">
                                    Your hospital could be next
                                </span>
                            </div>

                            <h2 class="font-display text-4xl lg:text-5xl font-800 text-white leading-tight mb-5">
                                Ready to Transform<br>
                                <span class="red-gradient-text">Your Hospital?</span>
                            </h2>

                            <p class="font-body text-gray-400 text-lg max-w-xl mx-auto mb-10 leading-relaxed">
                                Join {{ $hospitalCount }}+ hospitals already running on REDSOL. Schedule a free consultation
                                and see how we can digitise your entire hospital workflow.
                            </p>

                            <div class="flex flex-wrap gap-4 justify-center mb-14">
                                <a href="/contact"
                                   class="group flex items-center gap-3 px-10 py-4 rounded-2xl bg-crimson-500 text-white
                                          font-display font-700 text-sm hover:bg-crimson-600 transition-all duration-300
                                          hover:scale-105 hover:shadow-xl hover:shadow-crimson-500/30">
                                    Book a Free Demo
                                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                              d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                                <a href="/services"
                                   class="group flex items-center gap-3 px-10 py-4 rounded-2xl border border-white/15
                                          text-gray-300 font-display font-600 text-sm hover:border-crimson-500/40
                                          hover:text-crimson-400 transition-all duration-300">
                                    View Our Services
                                </a>
                            </div>


                            @php
                                $trustItems = $trustItems ?? ['Full training included', '24/7 AMC support', 'ICD-10 compliant'];
                            @endphp
                            <div class="flex flex-wrap justify-center gap-8 pt-10 border-t border-white/8">
                                @foreach($trustItems as $trust)
                                    <div class="flex items-center gap-2 text-sm font-body text-gray-500">
                                        <svg class="w-4 h-4 text-crimson-500 shrink-0" fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M5 13l4 4L19 7"/>
                                        </svg>
                                        {{ $trust }}
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </section>

@endsection


@push('head')
    <style>
        @keyframes ticker {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Scroll reveal — same observer pattern as the rest of the site
        const revealObs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));
    </script>
@endpush