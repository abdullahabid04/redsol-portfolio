@extends('admin.layouts.app')

@section('title', 'Blog Posts')
@section('page-title', 'Blog Posts')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}"
        class="text-xs font-body text-gray-400 hover:text-crimson-500 transition-colors">Dashboard</a>
    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
    <span class="text-xs font-body text-gray-500">Blog Posts</span>
@endsection

@section('content')

    {{-- ══════════════════════════════════════════════
    OVERVIEW CARDS
    ══════════════════════════════════════════════ --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 mb-6">
        {{-- Total Posts - Dark Card --}}
        <div
            class="col-span-2 sm:col-span-1 bg-gray-900 rounded-2xl px-5 py-4 flex items-center gap-4 relative overflow-hidden">
            <div class="absolute inset-0 opacity-25"
                style="background-image:linear-gradient(rgba(225,29,72,0.1) 1px,transparent 1px),linear-gradient(90deg,rgba(225,29,72,0.1) 1px,transparent 1px);background-size:20px 20px;">
            </div>
            <div class="relative">
                <div class="font-display font-800 text-3xl text-white leading-none">{{ $posts->total() }}</div>
                <div class="font-body text-xs text-gray-400 mt-0.5">Total posts</div>
            </div>
        </div>

        {{-- Published --}}
        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
            <div class="font-display font-800 text-2xl text-gray-900 leading-none">
                {{ $posts->filter(fn($p) => $p->status === 'published')->count() }}
            </div>
            <div class="font-body text-xs text-gray-400 mt-0.5 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Published
            </div>
        </div>

        {{-- Drafts --}}
        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
            <div class="font-display font-800 text-2xl text-gray-900 leading-none">
                {{ $posts->filter(fn($p) => $p->status === 'draft')->count() }}
            </div>
            <div class="font-body text-xs text-gray-400 mt-0.5 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Drafts
            </div>
        </div>

        {{-- Category counts (calculated from current page) --}}
        @php
            $categoryCounts = $posts->groupBy('category')->map->count();
        @endphp
        @foreach($categoryCounts as $category => $count)
            <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
                <div class="font-display font-800 text-2xl text-gray-900 leading-none">{{ $count }}</div>
                <div class="font-body text-[10px] text-gray-400 mt-0.5 leading-tight">
                    {{ \Illuminate\Support\Str::limit($category, 15) }}
                </div>
            </div>
        @endforeach
    </div>

    {{-- Toolbar --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
        {{-- Filters --}}
        <div class="flex items-center gap-2 flex-wrap">
            @foreach(['all', 'published', 'draft'] as $filter)
                <a href="{{ request()->fullUrlWithQuery(['status' => $filter === 'all' ? null : $filter]) }}" class="px-3 py-1.5 rounded-lg text-xs font-display font-600 tracking-wide transition-all
                          {{ (request('status') === $filter || ($filter === 'all' && !request('status')))
                ? 'bg-crimson-500 text-white shadow-sm shadow-crimson-500/25'
                : 'bg-white text-gray-500 border border-gray-200 hover:border-gray-300 hover:text-gray-900' }}">
                    {{ ucfirst($filter) }}
                </a>
            @endforeach

            {{-- Search --}}
            <form action="{{ route('admin.blog.index') }}" method="GET" class="flex items-center gap-2 ml-1">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search posts..."
                        class="pl-9 pr-4 py-1.5 text-xs font-body border border-gray-200 rounded-lg bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:border-crimson-500/40 focus:ring-2 focus:ring-crimson-500/10 w-44 transition-all">
                </div>
            </form>
        </div>

        {{-- New post button --}}
        <a href="{{ route('admin.blog.create') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-crimson-500 text-white font-display font-600 text-sm
                  hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25 shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            New Post
        </a>
    </div>

    {{-- Table card --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th
                            class="text-left px-5 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">
                            Title</th>
                        <th
                            class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden md:table-cell">
                            Category</th>
                        <th
                            class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">
                            Status</th>
                        <th
                            class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden lg:table-cell">
                            Author</th>
                        <th
                            class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden lg:table-cell">
                            Date</th>
                        <th
                            class="px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50/60 transition-colors group">

                            {{-- Title --}}
                            <td class="px-5 py-3.5">
                                <span
                                    class="font-body text-sm font-500 text-gray-800 group-hover:text-crimson-600 transition-colors line-clamp-1 block max-w-xs">
                                    {{ $post->title }}
                                </span>
                            </td>

                            {{-- Category --}}
                            <td class="px-4 py-3.5 hidden md:table-cell">
                                <span
                                    class="text-[10px] font-display font-600 tracking-wide px-2 py-1 rounded-md bg-gray-100 text-gray-500">
                                    {{ $post->category ?? '—' }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-3.5">
                                @if($post->status === 'published')
                                    <span
                                        class="inline-flex items-center gap-1.5 text-[10px] font-700 font-display px-2 py-1 rounded-lg bg-green-50 text-green-600 border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Published
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 text-[10px] font-700 font-display px-2 py-1 rounded-lg bg-gray-100 text-gray-500 border border-gray-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Draft
                                    </span>
                                @endif
                            </td>

                            {{-- Author --}}
                            <td class="px-4 py-3.5 hidden lg:table-cell">
                                <span class="font-body text-xs text-gray-500">
                                    {{ $post->author?->name ?? '—' }}
                                </span>
                            </td>

                            {{-- Date --}}
                            <td class="px-4 py-3.5 hidden lg:table-cell">
                                <span class="font-body text-xs text-gray-400">
                                    {{ $post->published_at?->format('M j, Y') ?? 'Not set' }}
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-4 py-3.5">
                                <div class="flex items-center justify-end gap-1.5">
                                    {{-- Preview --}}
                                    <a href="/blog/{{ $post->slug }}" target="_blank"
                                        class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-gray-700 hover:border-gray-300 transition-all"
                                        title="Preview">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    {{-- Edit --}}
                                    <a href="{{ route('admin.blog.edit', $post->id) }}"
                                        class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-crimson-500 hover:border-crimson-500/30 hover:bg-crimson-50 transition-all"
                                        title="Edit">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    {{-- Delete --}}
                                    <form method="POST" action="{{ route('admin.blog.destroy', $post->id) }}"
                                        onsubmit="return confirm('Delete this post? This cannot be undone.')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all"
                                            title="Delete">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-display font-700 text-gray-500 text-sm">No blog posts yet</p>
                                        <p class="font-body text-xs text-gray-400 mt-1">Create your first post to get started.
                                        </p>
                                    </div>
                                    <a href="{{ route('admin.blog.create') }}"
                                        class="mt-1 flex items-center gap-2 px-4 py-2 rounded-xl bg-crimson-500 text-white font-display font-600 text-xs hover:bg-crimson-600 transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Write first post
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($posts->hasPages())
            <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/50">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

@endsection