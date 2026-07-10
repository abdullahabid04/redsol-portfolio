@extends('admin.layouts.app')

@section('title', 'Team Members')
@section('page-title', 'Team Members')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}"
        class="text-xs font-body text-gray-400 hover:text-crimson-500 transition-colors">Dashboard</a>
    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
    <span class="text-xs font-body text-gray-500">Team Members</span>
@endsection

@section('content')<div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-3 mb-6">
        
        <div class="col-span-2 sm:col-span-1 bg-gray-900 rounded-2xl px-5 py-4 flex items-center gap-4 relative overflow-hidden">
            <div class="absolute inset-0 opacity-25"
                style="background-image:linear-gradient(rgba(225,29,72,0.1) 1px,transparent 1px),linear-gradient(90deg,rgba(225,29,72,0.1) 1px,transparent 1px);background-size:20px 20px;">
            </div>
            <div class="relative">
                <div class="font-display font-800 text-3xl text-white leading-none">{{ $stats['total'] }}</div>
                <div class="font-body text-xs text-gray-400 mt-0.5">Total members</div>
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
            <div class="font-display font-800 text-2xl text-gray-900 leading-none">{{ $stats['visible'] }}</div>
            <div class="font-body text-xs text-gray-400 mt-0.5 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Visible
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
            <div class="font-display font-800 text-2xl text-gray-900 leading-none">{{ $stats['hidden'] }}</div>
            <div class="font-body text-xs text-gray-400 mt-0.5 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Hidden
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
            <div class="font-display font-800 text-2xl text-gray-900 leading-none">{{ $stats['leadership'] }}</div>
            <div class="font-body text-xs text-gray-400 mt-0.5 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-crimson-500"></span>Leadership
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
            <div class="font-display font-800 text-2xl text-gray-900 leading-none">—</div>
            <div class="font-body text-[10px] text-gray-400 mt-0.5 leading-tight">—</div>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
            <div class="font-display font-800 text-2xl text-gray-900 leading-none">—</div>
            <div class="font-body text-[10px] text-gray-400 mt-0.5 leading-tight">—</div>
        </div>
    </div><div class="bg-white border border-gray-200 rounded-2xl p-4 mb-4">
        <form method="GET" action="{{ route('admin.team.index') }}"
            class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">

            
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search team members by name, role or bio…" class="w-full pl-9 pr-4 py-2.5 text-sm font-body text-gray-700
                              bg-gray-50 border border-gray-200 rounded-xl
                              focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500
                              placeholder-gray-400 transition-all">
            </div>

            
            <select name="status" class="px-3 py-2.5 text-sm font-body text-gray-700 bg-gray-50 border border-gray-200
                           rounded-xl focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500
                           transition-all cursor-pointer">
                <option value="">All statuses</option>
                <option value="visible" @selected(request('status') === 'visible')>Visible</option>
                <option value="hidden" @selected(request('status') === 'hidden')>Hidden</option>
            </select>

            
            <select name="leadership" class="px-3 py-2.5 text-sm font-body text-gray-700 bg-gray-50 border border-gray-200
                           rounded-xl focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500
                           transition-all cursor-pointer">
                <option value="">All roles</option>
                <option value="yes" @selected(request('leadership') === 'yes')>Leadership only</option>
            </select>

            
            <button type="submit" class="px-4 py-2.5 rounded-xl bg-gray-900 text-white text-sm font-display font-600
                           hover:bg-gray-800 transition-colors shrink-0">
                Filter
            </button>

            
            @if(request('search') || request('status') || request('leadership'))
                <a href="{{ route('admin.team.index') }}" class="px-4 py-2.5 rounded-xl border border-gray-200 text-gray-500 text-sm font-display font-600
                              hover:border-crimson-500/30 hover:text-crimson-600 transition-colors shrink-0">
                    Clear
                </a>
            @endif

            
            <div class="flex-1 hidden sm:block"></div>

            <a href="{{ route('admin.team.create') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-crimson-500 text-white
                              text-sm font-display font-600 hover:bg-crimson-600 transition-all
                              hover:shadow-lg hover:shadow-crimson-500/25 shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Add Member
            </a>
        </form>
    </div>@if(session('success'))
        <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-700
                        font-body text-sm mb-4">
            <svg class="w-4 h-4 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50 border border-crimson-500/20 text-crimson-700
                        font-body text-sm mb-4">
            <svg class="w-4 h-4 shrink-0 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            {{ session('error') }}
        </div>
    @endif<div class="flex items-center justify-between mb-3 px-1">
        <span class="font-body text-xs text-gray-400">
            Showing {{ $members->firstItem() ?? 0 }}–{{ $members->lastItem() ?? 0 }}
            of {{ $members->total() }} member{{ $members->total() !== 1 ? 's' : '' }}
            @if(request('search') || request('status') || request('leadership'))
                <span class="text-crimson-500 font-medium">(filtered)</span>
            @endif
        </span>

        <span class="font-body text-xs text-gray-400 hidden sm:block">
            Ordered by sort_order · drag to reorder
        </span>
    </div><div class="bg-white border border-gray-200 rounded-2xl overflow-hidden mb-4">
        @if($members->isEmpty())
            
            <div class="flex flex-col items-center justify-center py-20 px-6 text-center">
                <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="font-display font-700 text-gray-900 text-lg mb-2">No team members yet</h3>
                <p class="font-body text-sm text-gray-400 max-w-sm mb-6">
                    @if(request('search') || request('status') || request('leadership'))
                        No team members match your current filters. Try clearing them or adjusting your search.
                    @else
                        Add your first team member to populate the About page.
                    @endif
                </p>
                @if(request('search') || request('status') || request('leadership'))
                    <a href="{{ route('admin.team.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-sm font-display font-600
                                      text-gray-600 hover:border-crimson-500/30 hover:text-crimson-600 transition-colors">
                        Clear filters
                    </a>
                @else
                    <a href="{{ route('admin.team.create') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-crimson-500 text-white
                                      text-sm font-display font-600 hover:bg-crimson-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        Add first member
                    </a>
                @endif
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="text-left px-5 py-3.5 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase w-8">
                                #
                            </th>
                            <th class="text-left px-4 py-3.5 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">
                                Member
                            </th>
                            <th class="text-left px-4 py-3.5 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden md:table-cell">
                                Department
                            </th>
                            <th class="text-left px-4 py-3.5 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden lg:table-cell">
                                Bio Preview
                            </th>
                            <th class="text-center px-4 py-3.5 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">
                                Status
                            </th>
                            <th class="text-right px-5 py-3.5 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-50" id="memberTableBody">
                        @foreach($members as $member)
                                        <tr class="group hover:bg-gray-50/60 transition-colors duration-150" data-id="{{ $member->id }}">
                                            
                                            <td class="px-5 py-4">
                                                <span class="font-body text-xs text-gray-400 w-4 text-center">{{ $member->sort_order ?: '—' }}</span>
                                            </td>

                                            
                                            <td class="px-4 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-9 h-9 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center shrink-0 overflow-hidden">
                                                        @if($member->photo)
                                                            <img src="{{ $member->photoUrl() }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                                                        @else
                                                            <span class="font-display font-700 text-gray-400 text-sm">{{ $member->initials }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="min-w-0">
                                                        <div class="font-body text-sm font-600 text-gray-900 group-hover:text-crimson-600 transition-colors truncate max-w-[180px]">
                                                            {{ $member->name }}
                                                        </div>
                                                        <div class="font-body text-xs text-crimson-500 font-600">{{ $member->position }}</div>
                                                        @if($member->linkedin_url)
                                                            <a href="{{ $member->linkedin_url }}" target="_blank" class="font-body text-[10px] text-gray-400 hover:text-blue-500 transition-colors truncate block">
                                                                LinkedIn
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            
                                            <td class="px-4 py-4 hidden md:table-cell">
                                                <span class="font-body text-xs text-gray-500">{{ $member->department ?: '—' }}</span>
                                            </td>

                                            
                                            <td class="px-4 py-4 hidden lg:table-cell max-w-[220px]">
                                                <span class="font-body text-xs text-gray-500 line-clamp-2">{{ Str::limit($member->bio, 100) }}</span>
                                            </td>

                                            
                                            <td class="px-4 py-4 text-center">
                                                <form method="POST" action="{{ route('admin.team.toggle', $member->id) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        title="{{ $member->is_visible ? 'Click to hide' : 'Click to show' }}"
                                                        class="inline-flex items-center gap-1.5 text-[10px] font-display font-700 px-2.5 py-1.5 rounded-lg border transition-all duration-200
                                                               {{ $member->is_visible
                            ? 'bg-green-50 text-green-700 border-green-200 hover:bg-red-50 hover:text-crimson-600 hover:border-crimson-500/20'
                            : 'bg-gray-100 text-gray-500 border-gray-200 hover:bg-green-50 hover:text-green-700 hover:border-green-200' }}
                                                               group/toggle">
                                                        <span class="w-1.5 h-1.5 rounded-full {{ $member->is_visible ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                                        <span class="group-hover/toggle:hidden">{{ $member->is_visible ? 'Visible' : 'Hidden' }}</span>
                                                        <span class="hidden group-hover/toggle:inline">{{ $member->is_visible ? 'Hide?' : 'Show?' }}</span>
                                                    </button>
                                                </form>
                                            </td>

                                            
                                            <td class="px-5 py-4">
                                                <div class="flex items-center justify-end gap-1.5">
                                                    
                                                    <a href="{{ route('admin.team.edit', $member->id) }}" title="Edit member"
                                                        class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-crimson-600 hover:border-crimson-500/30 hover:bg-crimson-500/5 transition-all">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>

                                                    
                                                    <form method="POST" action="{{ route('admin.team.destroy', $member->id) }}"
                                                          onsubmit="return confirm('Remove {{ addslashes($member->name) }} from the team?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" title="Delete member"
                                                            class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>@if($members->hasPages())
        <div class="flex items-center justify-between px-1">
            <span class="font-body text-xs text-gray-400">
                Page {{ $members->currentPage() }} of {{ $members->lastPage() }}
            </span>
            <div class="flex items-center gap-1">
                
                @if($members->onFirstPage())
                    <span class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center
                                         text-gray-300 cursor-not-allowed">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $members->previousPageUrl() }}" class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center
                                      text-gray-500 hover:border-crimson-500/30 hover:text-crimson-600 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                @endif

                
                @foreach($members->getUrlRange(max(1, $members->currentPage() - 2), min($members->lastPage(), $members->currentPage() + 2)) as $page => $url)
                        <a href="{{ $url }}" class="w-8 h-8 rounded-lg border flex items-center justify-center
                                          text-xs font-display font-700 transition-all
                                          {{ $page === $members->currentPage()
                    ? 'bg-crimson-500 text-white border-crimson-500'
                    : 'border-gray-200 text-gray-500 hover:border-crimson-500/30 hover:text-crimson-600' }}">
                            {{ $page }}
                        </a>
                @endforeach

                
                @if($members->hasMorePages())
                    <a href="{{ $members->nextPageUrl() }}" class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center
                                      text-gray-500 hover:border-crimson-500/30 hover:text-crimson-600 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @else
                    <span class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center
                                         text-gray-300 cursor-not-allowed">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                @endif
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script>
                document.querySelectorAll('[data-flash]').forEach(el => {
            setTimeout(() => {
                el.style.transition = 'opacity 0.4s ease';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 400);
            }, 4000);
        });
    </script>
@endpush