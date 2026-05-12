@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <span class="text-xs font-body text-gray-400">Overview of your REDSOL platform</span>
@endsection

@section('content')

    @php
        $admin = Auth::guard('admin')->user();

        // ── Live counts from actual models ────────────────────────────────
        $blogTotal    = \App\Models\BlogPost::count();
        $blogDrafts   = \App\Models\BlogPost::where('status', 'draft')->count();
        $blogPublished= \App\Models\BlogPost::where('status', 'published')->count();

        $contactTotal  = \App\Models\ContactSubmission::notSpam()->count();
        $contactUnread = \App\Models\ContactSubmission::unreadCount();

        $testimonialTotal    = \App\Models\Testimonial::count();
        $testimonialActive   = \App\Models\Testimonial::active()->count();

        $clientTotal    = \App\Models\Client::count();
        $clientFeatured = \App\Models\Client::featured()->count();

        $demoTotal = \App\Models\DemoRequest::count();
        $demoNew   = \App\Models\DemoRequest::newCount();

        $serviceTotal  = \App\Models\Service::count();
        $serviceActive = \App\Models\Service::active()->count();
        $productTotal  = \App\Models\Product::count();
        $productActive = \App\Models\Product::active()->count();

        $teamTotal   = \App\Models\TeamMember::count();
        $teamVisible = \App\Models\TeamMember::visible()->count();

        // ── Stat cards ────────────────────────────────────────────────────
        $stats = [
            [
                'label'  => 'Blog Posts',
                'value'  => $blogTotal,
                'sub'    => $blogDrafts . ' draft' . ($blogDrafts !== 1 ? 's' : ''),
                'change' => $blogPublished . ' published',
                'up'     => true,
                'icon'   => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                'href'   => route('admin.blog.index'),
                'color'  => 'crimson',
            ],
            [
                'label'  => 'Contact Enquiries',
                'value'  => $contactTotal,
                'sub'    => $contactUnread . ' unread',
                'change' => $contactUnread . ' new',
                'up'     => $contactUnread > 0,
                'icon'   => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                'href'   => route('admin.contacts.index'),
                'color'  => 'black',
            ],
            [
                'label'  => 'Demo Requests',
                'value'  => $demoTotal,
                'sub'    => $demoNew . ' awaiting response',
                'change' => $demoNew . ' new',
                'up'     => $demoNew > 0,
                'icon'   => 'M15 10l4.553-2.069A1 1 0 0121 8.845v6.309a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z',
                'href'   => route('admin.demo-requests.index'),
                'color'  => 'black',
            ],
            [
                'label'  => 'Clients',
                'value'  => $clientTotal,
                'sub'    => $clientFeatured . ' featured in ticker',
                'change' => $clientFeatured . ' featured',
                'up'     => true,
                'icon'   => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                'href'   => route('admin.clients.index'),
                'color'  => 'gray',
            ],
        ];

        $recentPosts = \App\Models\BlogPost::with('author')->latest()->take(5)->get();
        $recentContacts = \App\Models\ContactSubmission::notSpam()->latest()->take(6)->get();
    @endphp


    {{-- ══════════════════════════════════════════════
    WELCOME BANNER
    ══════════════════════════════════════════════ --}}
    <div class="mb-6 rounded-2xl bg-gray-900 px-7 py-6 flex items-center justify-between gap-6 relative overflow-hidden">
        <div class="absolute inset-0 opacity-40"
            style="background-image:linear-gradient(rgba(225,29,72,0.07) 1px,transparent 1px),linear-gradient(90deg,rgba(225,29,72,0.07) 1px,transparent 1px);background-size:32px 32px;">
        </div>
        <div class="absolute -right-16 -top-16 w-56 h-56 rounded-full border border-crimson-500/10 pointer-events-none"></div>
        <div class="absolute -right-8  -top-8  w-32 h-32 rounded-full border border-crimson-500/10 pointer-events-none"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-1">
                <div class="w-2 h-2 rounded-full bg-green-400" style="animation:pulse 2s ease-in-out infinite;"></div>
                <span class="font-body text-xs text-gray-500 tracking-wide">System operational</span>
            </div>
            <h2 class="font-display font-800 text-2xl text-white">
                Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }},
                <span class="text-crimson-500">{{ $admin->name }}</span> 👋
            </h2>
            <p class="font-body text-sm text-gray-500 mt-1">
                {{ now()->format('l, F j, Y') }} · Logged in as
                <span class="inline-flex items-center gap-1.5 ml-1 px-2 py-0.5 rounded-md text-xs font-display font-600 border {{ $admin->roleBadgeClass() }}">
                    {{ $admin->roleLabel() }}
                </span>
            </p>
        </div>

        <div class="hidden md:flex items-center gap-3 relative z-10 shrink-0">
            <a href="{{ route('admin.blog.create') }}"
               class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-crimson-500 text-white font-display font-600 text-sm
                      hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/30">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                New Blog Post
            </a>
            {{-- <a href="{{ route('admin.contacts.index') }}"
               class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/8 border border-white/10 text-white font-display font-600 text-sm
                      hover:bg-white/12 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                View Enquiries
            </a> --}}
        </div>
    </div>


    {{-- ══════════════════════════════════════════════
    STAT CARDS
    ══════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        @foreach($stats as $stat)
            @php
                $isRed   = $stat['color'] === 'crimson';
                $isBlack = $stat['color'] === 'black';
            @endphp
            <a href="{{ $stat['href'] }}"
               class="group bg-white border border-gray-200 rounded-2xl p-5
                      hover:border-crimson-500/25 hover:shadow-lg hover:shadow-crimson-500/5
                      transition-all duration-300">

                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0
                                {{ $isRed   ? 'bg-crimson-500/10 border border-crimson-500/20' :
                                   ($isBlack ? 'bg-gray-900/8 border border-gray-900/15' :
                                               'bg-gray-100 border border-gray-200') }}">
                        <svg class="w-4 h-4 {{ $isRed ? 'text-crimson-500' : ($isBlack ? 'text-gray-900' : 'text-gray-500') }}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $stat['icon'] }}"/>
                        </svg>
                    </div>
                    <span class="text-[10px] font-display font-700 px-2 py-1 rounded-lg
                                 {{ $stat['up']
                                     ? 'bg-green-50 text-green-600 border border-green-200'
                                     : 'bg-red-50 text-crimson-600 border border-red-200' }}">
                        {{ $stat['change'] }}
                    </span>
                </div>

                <div class="font-display font-800 text-3xl text-gray-900 leading-none mb-1">
                    {{ $stat['value'] }}
                </div>
                <div class="font-body text-sm font-500 text-gray-600 mb-0.5">{{ $stat['label'] }}</div>
                <div class="font-body text-xs text-gray-400">{{ $stat['sub'] }}</div>

                <div class="mt-4 flex items-center gap-1 text-xs font-display font-600 text-gray-400
                            group-hover:text-crimson-500 transition-colors">
                    View all
                    <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </div>
            </a>
        @endforeach
    </div>


    {{-- ══════════════════════════════════════════════
    MAIN GRID — Recent Posts + Recent Contacts
    ══════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 xl:grid-cols-[1fr_420px] gap-6 mb-6">

        {{-- ── Recent Blog Posts ─────────────────── --}}
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-gray-900 text-sm tracking-wide">Recent Blog Posts</h3>
                </div>
                <a href="{{ route('admin.blog.index') }}"
                   class="font-body text-xs text-gray-400 hover:text-crimson-500 transition-colors flex items-center gap-1">
                    View all
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left px-5 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">Title</th>
                            <th class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">Author</th>
                            <th class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">Status</th>
                            <th class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden sm:table-cell">Date</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentPosts as $post)
                            <tr class="hover:bg-gray-50/70 transition-colors group">
                                {{-- Title --}}
                                <td class="px-5 py-3.5 max-w-[220px]">
                                    <span class="font-body text-sm font-500 text-gray-800
                                                 group-hover:text-crimson-600 transition-colors line-clamp-1">
                                        {{ $post->title }}
                                    </span>
                                    @if($post->category)
                                        <span class="font-body text-[10px] text-gray-400">{{ $post->category }}</span>
                                    @endif
                                </td>

                                {{-- Author --}}
                                <td class="px-4 py-3.5">
                                    <span class="font-body text-xs text-gray-500">
                                        {{ $post->author?->name ?? '—' }}
                                    </span>
                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-3.5">
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-700 font-display px-2 py-1 rounded-lg border
                                                 {{ $post->statusBadgeClass() }}">
                                        <span class="w-1.5 h-1.5 rounded-full
                                                     {{ $post->isPublished() ? 'bg-green-500' : 'bg-gray-400' }}">
                                        </span>
                                        {{ $post->statusLabel() }}
                                    </span>
                                </td>

                                {{-- Date --}}
                                <td class="px-4 py-3.5 hidden sm:table-cell">
                                    <span class="font-body text-xs text-gray-400">
                                        {{ $post->published_at
                                            ? $post->published_at->format('M j, Y')
                                            : 'Not published' }}
                                    </span>
                                </td>

                                {{-- Edit link --}}
                                <td class="px-4 py-3.5">
                                    <a href="{{ route('admin.blog.edit', $post->id) }}"
                                       class="opacity-0 group-hover:opacity-100 transition-opacity
                                              text-xs font-display font-600 text-crimson-500 hover:text-crimson-600
                                              flex items-center gap-1">
                                        Edit
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-8 text-center font-body text-sm text-gray-400">
                                    No blog posts yet.
                                    <a href="{{ route('admin.blog.create') }}" class="text-crimson-500 hover:underline ml-1">
                                        Write the first one.
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/50">
                <a href="{{ route('admin.blog.create') }}"
                   class="flex items-center gap-2 text-xs font-display font-600 text-crimson-500 hover:text-crimson-600 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Write a new blog post
                </a>
            </div>
        </div>


        {{-- ── Recent Enquiries ──────────────────── --}}
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-gray-900 text-sm tracking-wide">Recent Enquiries</h3>
                    @if($contactUnread > 0)
                        <span class="font-display font-700 text-[10px] text-white bg-crimson-500 px-1.5 py-0.5 rounded-md">
                            {{ $contactUnread }}
                        </span>
                    @endif  {{-- ✅ FIXED: Added missing @endif --}}
                </div>
                <a href="{{ route('admin.contacts.index') }}"
                   class="font-body text-xs text-gray-400 hover:text-crimson-500 transition-colors flex items-center gap-1">
                    View all
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="divide-y divide-gray-50">
                @forelse($recentContacts as $contact)
                    @php
                        $isUnread = in_array($contact->status, [
                            \App\Models\ContactSubmission::STATUS_NEW,
                            \App\Models\ContactSubmission::STATUS_READ,
                        ]) && $contact->status === \App\Models\ContactSubmission::STATUS_NEW;
                    @endphp
                    <div class="flex items-start gap-3 px-5 py-3.5 hover:bg-gray-50/70 transition-colors group
                                {{ $isUnread ? 'bg-crimson-500/2' : '' }}">

                        {{-- Avatar initial --}}
                        <div class="w-8 h-8 rounded-lg shrink-0 flex items-center justify-center font-display font-700 text-sm
                                    {{ $isUnread ? 'bg-crimson-500 text-white' : 'bg-gray-100 text-gray-600' }}">
                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-0.5">
                                <span class="font-body text-sm font-600 text-gray-800 truncate">
                                    {{ $contact->name }}
                                </span>
                                @if($isUnread)
                                    <span class="w-1.5 h-1.5 rounded-full bg-crimson-500 shrink-0"></span>
                                @endif  {{-- ✅ FIXED: Added missing @endif --}}
                            </div>

                            <div class="font-body text-xs text-gray-500 truncate mb-0.5">
                                {{ $contact->subject ?? $contact->email }}
                            </div>

                            <div class="flex items-center gap-2">
                                <span class="inline-flex text-[10px] font-display font-600 px-1.5 py-0.5 rounded border
                                             {{ $contact->statusBadgeClass() }}">
                                    {{ $contact->statusLabel() }}
                                </span>
                                <span class="font-body text-[10px] text-gray-400">
                                    {{ $contact->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        <a href="{{ route('admin.contacts.show', $contact->id) }}"
                           class="opacity-0 group-hover:opacity-100 transition-opacity shrink-0
                                  w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center
                                  text-gray-400 hover:text-crimson-500 hover:border-crimson-500/30">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                @empty
                    <div class="px-5 py-8 text-center font-body text-sm text-gray-400">
                        No enquiries yet.
                    </div>
                @endforelse
            </div>
        </div>

    </div>


    {{-- ══════════════════════════════════════════════
    BOTTOM ROW — Quick Actions + Content Overview + System Info
    ══════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

        {{-- Quick Actions --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-5">
            <div class="flex items-center gap-3 mb-4">
                <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                <h3 class="font-display font-700 text-gray-900 text-sm">Quick Actions</h3>
            </div>
            <div class="space-y-2">
                @php
                    $quickActions = [
                        [
                            'label' => 'Write Blog Post',
                            'href'  => route('admin.blog.create'),
                            'icon'  => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                            'red'   => true,
                        ],
                        [
                            'label' => 'Add Testimonial',
                            'href'  => route('admin.testimonials.create'),
                            'icon'  => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
                            'red'   => false,
                        ],
                        [
                            'label' => 'Add Team Member',
                            'href'  => route('admin.team.create'),
                            'icon'  => 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z',
                            'red'   => false,
                        ],
                        [
                            'label' => 'Add Client',
                            'href'  => route('admin.clients.create'),
                            'icon'  => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                            'red'   => false,
                        ],
                        // [
                        //     'label' => 'View Enquiries',
                        //     'href'  => route('admin.contacts.index'),
                        //     'icon'  => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                        //     'red'   => false,
                        // ],
                        // [
                        //     'label' => 'View Demo Requests',
                        //     'href'  => route('admin.demo-requests.index'),
                        //     'icon'  => 'M15 10l4.553-2.069A1 1 0 0121 8.845v6.309a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z',
                        //     'red'   => false,
                        // ],
                    ];
                @endphp

                @foreach($quickActions as $action)
                    <a href="{{ $action['href'] }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl border transition-all group
                              {{ $action['red']
                                  ? 'border-crimson-500/20 bg-crimson-500/5 hover:bg-crimson-500/10 hover:border-crimson-500/30'
                                  : 'border-gray-100 hover:border-gray-200 hover:bg-gray-50' }}">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0
                                    {{ $action['red']
                                        ? 'bg-crimson-500 text-white'
                                        : 'bg-gray-100 text-gray-500 group-hover:bg-gray-200' }}">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $action['icon'] }}"/>
                            </svg>
                        </div>
                        <span class="font-body text-sm font-500 {{ $action['red'] ? 'text-crimson-700' : 'text-gray-700' }}">
                            {{ $action['label'] }}
                        </span>
                        <svg class="w-3.5 h-3.5 ml-auto text-gray-300 group-hover:text-gray-500 transition-colors"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>


        {{-- Content Overview --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-5">
            <div class="flex items-center gap-3 mb-4">
                <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                <h3 class="font-display font-700 text-gray-900 text-sm">Content Overview</h3>
            </div>

            @php
                $contentItems = [
                    ['label' => 'Blog Posts', 'total' => $blogTotal, 'active' => $blogPublished, 'sub' => 'published', 'href' => route('admin.blog.index')],
                    ['label' => 'Services', 'total' => $serviceTotal, 'active' => $serviceActive, 'sub' => 'active', 'href' => route('admin.services.index')],
                    ['label' => 'Products', 'total' => $productTotal, 'active' => $productActive, 'sub' => 'active', 'href' => route('admin.products.index')],
                    ['label' => 'Team Members', 'total' => $teamTotal, 'active' => $teamVisible, 'sub' => 'visible', 'href' => route('admin.team.index')],
                    ['label' => 'Clients', 'total' => $clientTotal, 'active' => \App\Models\Client::active()->count(), 'sub' => 'active', 'href' => route('admin.clients.index')],
                    ['label' => 'Testimonials', 'total' => $testimonialTotal, 'active' => $testimonialActive, 'sub' => 'active', 'href' => route('admin.testimonials.index')],
                ];
            @endphp

            <div class="space-y-3">
                @foreach($contentItems as $item)
                    <a href="{{ $item['href'] }}" class="flex items-center gap-3 group">
                        <span class="font-body text-sm text-gray-600 w-28 shrink-0
                                     group-hover:text-crimson-600 transition-colors">
                            {{ $item['label'] }}
                        </span>
                        <div class="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-crimson-500 rounded-full transition-all"
                                 style="width:{{ $item['total'] > 0 ? round(($item['active'] / $item['total']) * 100) : 0 }}%">
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <span class="font-display font-700 text-xs text-gray-900">
                                {{ $item['active'] }}
                            </span>
                            <span class="font-body text-[10px] text-gray-400 ml-0.5">
                                / {{ $item['total'] }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>


        {{-- System Info --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5 relative overflow-hidden">
            <div class="absolute inset-0 opacity-30"
                 style="background-image:linear-gradient(rgba(225,29,72,0.08) 1px,transparent 1px),linear-gradient(90deg,rgba(225,29,72,0.08) 1px,transparent 1px);background-size:28px 28px;">
            </div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-5">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-white text-sm">System Info</h3>
                </div>

                <div class="space-y-3">
                    @foreach([
                        ['label' => 'PHP Version',   'val' => phpversion()],
                        ['label' => 'Laravel',       'val' => app()->version()],
                        ['label' => 'Environment',   'val' => ucfirst(app()->environment())],
                        ['label' => 'Your Role',     'val' => $admin->roleLabel()],
                        ['label' => 'Last Login',    'val' => $admin->last_login_at?->diffForHumans() ?? 'First login'],
                        ['label' => 'Session',       'val' => 'Active'],
                    ] as $info)
                        <div class="flex items-center justify-between">
                            <span class="font-body text-xs text-gray-500">{{ $info['label'] }}</span>
                            <span class="font-display font-600 text-xs
                                         {{ $info['label'] === 'Environment' && app()->isProduction()
                                             ? 'text-green-400'
                                             : 'text-gray-300' }}">
                                {{ $info['val'] }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 pt-4 border-t border-white/5 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="font-body text-xs text-gray-500">New enquiries</span>
                        <span class="font-display font-700 text-xs
                                     {{ $contactUnread > 0 ? 'text-crimson-400' : 'text-gray-500' }}">
                            {{ $contactUnread }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-body text-xs text-gray-500">New demo requests</span>
                        <span class="font-display font-700 text-xs
                                     {{ $demoNew > 0 ? 'text-crimson-400' : 'text-gray-500' }}">
                            {{ $demoNew }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 pt-1">
                        <div class="w-2 h-2 rounded-full bg-green-400"></div>
                        <span class="font-body text-xs text-gray-500">All systems operational</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection