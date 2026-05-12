@extends('admin.layouts.app')

@section('title', 'Clients')
@section('page-title', 'Clients')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="text-xs font-body text-gray-400 hover:text-crimson-500 transition-colors">Dashboard</a>
    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-xs font-body text-gray-500">Clients</span>
@endsection

@section('content')

{{-- ══════════════════════════════════════════════
TOOLBAR — Search · Filter · Add button
══════════════════════════════════════════════ --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
    {{-- Filters --}}
    <div class="flex items-center gap-2 flex-wrap">
        @foreach(['all' => 'All', 'active' => 'Active', 'inactive' => 'Inactive'] as $val => $label)
        <a href="{{ request()->fullUrlWithQuery(['status' => $val === 'all' ? null : $val]) }}"
           class="px-3 py-1.5 rounded-lg text-xs font-display font-600 tracking-wide transition-all
                  {{ (request('status') === $val || ($val === 'all' && !request('status')))
                      ? 'bg-crimson-500 text-white shadow-sm shadow-crimson-500/25'
                      : 'bg-white text-gray-500 border border-gray-200 hover:border-gray-300 hover:text-gray-900' }}">
            {{ $label }}
        </a>
        @endforeach

        {{-- Type filter --}}
        <select name="type" onchange="window.location.href=this.value" class="px-3 py-1.5 rounded-lg text-xs font-display font-600 text-gray-500 border border-gray-200 bg-white cursor-pointer">
            <option value="{{ route('admin.clients.index') }}">All types</option>
            @foreach(\App\Models\Client::TYPES as $typeKey => $typeLabel)
                <option value="{{ route('admin.clients.index', ['type' => $typeKey]) }}"
                    @selected(request('type') === $typeKey)>
                    {{ $typeLabel }}
                </option>
            @endforeach
        </select>

        {{-- Search --}}
        <form action="{{ route('admin.clients.index') }}" method="GET" class="flex items-center gap-2 ml-1">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search clients..."
                       class="pl-9 pr-4 py-1.5 text-xs font-body border border-gray-200 rounded-lg bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:border-crimson-500/40 focus:ring-2 focus:ring-crimson-500/10 w-44 transition-all">
            </div>
        </form>
    </div>

    {{-- New client button --}}
    <a href="{{ route('admin.clients.create') }}"
       class="flex items-center gap-2 px-4 py-2 rounded-xl bg-crimson-500 text-white font-display font-600 text-sm
              hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25 shrink-0">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
        New Client
    </a>
</div>

{{-- ══════════════════════════════════════════════
CLIENTS TABLE
══════════════════════════════════════════════ --}}
<div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/50">
                    <th class="text-left px-5 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase w-8">#</th>
                    <th class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">Client</th>
                    <th class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden md:table-cell">Location</th>
                    <th class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden lg:table-cell">Type</th>
                    <th class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden xl:table-cell">Website</th>
                    <th class="text-center px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">Status</th>
                    <th class="text-right px-5 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($clients as $client)
                <tr class="group hover:bg-gray-50/60 transition-colors duration-150">
                    {{-- Sort order --}}
                    <td class="px-5 py-4">
                        <span class="font-body text-xs text-gray-400 w-4 text-center">{{ $client->sort_order ?: '—' }}</span>
                    </td>

                    {{-- Client name + logo --}}
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center shrink-0">
                                @if($client->logo_path)
                                    <img src="{{ $client->logoUrl() }}" alt="{{ $client->name }}" class="w-full h-full object-contain p-1">
                                @else
                                    <span class="font-display font-700 text-gray-400 text-sm">{{ strtoupper(substr($client->name, 0, 2)) }}</span>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <div class="font-body text-sm font-600 text-gray-900 group-hover:text-crimson-600 transition-colors truncate max-w-[180px]">
                                    {{ $client->name }}
                                </div>
                                @if($client->website_url)
                                    <a href="{{ $client->website_url }}" target="_blank" class="font-body text-[10px] text-crimson-500 hover:underline truncate block">
                                        {{ parse_url($client->website_url, PHP_URL_HOST) }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </td>

                    {{-- Location --}}
                    <td class="px-4 py-4 hidden md:table-cell">
                        <span class="font-body text-xs text-gray-500">
                            {{ $client->locationString() ?: '—' }}
                        </span>
                    </td>

                    {{-- Type badge --}}
                    <td class="px-4 py-4 hidden lg:table-cell">
                        <span class="inline-flex items-center text-[10px] font-display font-600 tracking-wide px-2 py-1 rounded-lg border {{ $client->typeBadgeClass() }}">
                            {{ $client->typeLabel() }}
                        </span>
                    </td>

                    {{-- Website (XL) --}}
                    <td class="px-4 py-4 hidden xl:table-cell">
                        @if($client->website_url)
                            <a href="{{ $client->website_url }}" target="_blank" class="font-body text-xs text-crimson-500 hover:underline truncate block max-w-[180px]">
                                {{ $client->website_url }}
                            </a>
                        @else
                            <span class="font-body text-xs text-gray-400">—</span>
                        @endif
                    </td>

                    {{-- Active toggle --}}
                    <td class="px-4 py-4 text-center">
                        <form method="POST" action="{{ route('admin.clients.toggle', $client->id) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    title="{{ $client->is_active ? 'Click to deactivate' : 'Click to activate' }}"
                                    class="inline-flex items-center gap-1.5 text-[10px] font-display font-700 px-2.5 py-1.5 rounded-lg border transition-all duration-200
                                           {{ $client->is_active
                                               ? 'bg-green-50 text-green-700 border-green-200 hover:bg-red-50 hover:text-crimson-600 hover:border-crimson-500/20'
                                               : 'bg-gray-100 text-gray-500 border-gray-200 hover:bg-green-50 hover:text-green-700 hover:border-green-200' }}
                                           group/toggle">
                                <span class="w-1.5 h-1.5 rounded-full {{ $client->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                <span class="group-hover/toggle:hidden">{{ $client->is_active ? 'Active' : 'Inactive' }}</span>
                                <span class="hidden group-hover/toggle:inline">{{ $client->is_active ? 'Deactivate?' : 'Activate?' }}</span>
                            </button>
                        </form>
                    </td>

                    {{-- Actions --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-1.5">
                            {{-- Edit --}}
                            <a href="{{ route('admin.clients.edit', $client->id) }}" title="Edit client"
                               class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-crimson-600 hover:border-crimson-500/30 hover:bg-crimson-500/5 transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            {{-- Delete --}}
                            <form method="POST" action="{{ route('admin.clients.destroy', $client->id) }}"
                                  onsubmit="return confirm('Remove {{ addslashes($client->name) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" title="Delete client"
                                        class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-16 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <p class="font-display font-700 text-gray-500 text-sm">No clients yet</p>
                            <p class="font-body text-xs text-gray-400 mt-1">Add your first client to get started.</p>
                            <a href="{{ route('admin.clients.create') }}"
                               class="mt-1 flex items-center gap-2 px-4 py-2 rounded-xl bg-crimson-500 text-white font-display font-600 text-xs hover:bg-crimson-600 transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Add first client
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($clients->hasPages())
    <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/50">
        {{ $clients->links() }}
    </div>
    @endif
</div>

@endsection