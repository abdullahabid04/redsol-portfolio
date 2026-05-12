@extends('admin.layouts.app')

@section('title', 'Products')
@section('page-title', 'Products')

@section('breadcrumb')
    <span class="text-xs font-body text-gray-400">Manage HIS modules and product listings</span>
@endsection

@section('content')

    {{-- ══════════════════════════════════════════════
    SUMMARY BAR
    ══════════════════════════════════════════════ --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 xl:grid-cols-6 gap-3 mb-6">

        {{-- Total --}}
        <div
            class="col-span-2 sm:col-span-1 bg-gray-900 rounded-2xl px-5 py-4 flex items-center gap-4 relative overflow-hidden">
            <div class="absolute inset-0 opacity-25"
                style="background-image:linear-gradient(rgba(225,29,72,0.1) 1px,transparent 1px),linear-gradient(90deg,rgba(225,29,72,0.1) 1px,transparent 1px);background-size:20px 20px;">
            </div>
            <div class="relative">
                <div class="font-display font-800 text-3xl text-white leading-none">{{ $stats['total'] }}</div>
                <div class="font-body text-xs text-gray-400 mt-0.5">Total modules</div>
            </div>
        </div>

        {{-- Active --}}
        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
            <div class="font-display font-800 text-2xl text-gray-900 leading-none">{{ $stats['active'] }}</div>
            <div class="font-body text-xs text-gray-400 mt-0.5 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Active
            </div>
        </div>

        {{-- Inactive --}}
        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
            <div class="font-display font-800 text-2xl text-gray-900 leading-none">{{ $stats['inactive'] }}</div>
            <div class="font-body text-xs text-gray-400 mt-0.5 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>Inactive
            </div>
        </div>

        {{-- Category counts --}}
        @foreach($categoryCounts as $catKey => $count)
            <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
                <div class="font-display font-800 text-2xl text-gray-900 leading-none">
                    {{ $count }}
                </div>
                <div class="font-body text-[10px] text-gray-400 mt-0.5 leading-tight">
                    {{ \Illuminate\Support\Str::words(\App\Models\Product::CATEGORIES[$catKey] ?? $catKey, 2, '') }}
                </div>
            </div>
        @endforeach

    </div>


    {{-- ══════════════════════════════════════════════
    TOOLBAR — Search · Filter · Add button
    ══════════════════════════════════════════════ --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-4 mb-4">
        <form method="GET" action="{{ route('admin.products.index') }}"
            class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">

            {{-- Search --}}
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search modules by name, tagline or description…" class="w-full pl-9 pr-4 py-2.5 text-sm font-body text-gray-700
                              bg-gray-50 border border-gray-200 rounded-xl
                              focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500
                              placeholder-gray-400 transition-all">
            </div>

            {{-- Category filter --}}
            <select name="category" class="px-3 py-2.5 text-sm font-body text-gray-700 bg-gray-50 border border-gray-200
                           rounded-xl focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500
                           transition-all cursor-pointer">
                <option value="">All categories</option>
                @foreach(\App\Models\Product::CATEGORIES as $catKey => $catLabel)
                    <option value="{{ $catKey }}" @selected(request('category') === $catKey)>{{ $catLabel }}</option>
                @endforeach
            </select>

            {{-- Status filter --}}
            <select name="status" class="px-3 py-2.5 text-sm font-body text-gray-700 bg-gray-50 border border-gray-200
                           rounded-xl focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500
                           transition-all cursor-pointer">
                <option value="">All statuses</option>
                <option value="active" @selected(request('status') === 'active')>Active</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
            </select>

            {{-- Apply --}}
            <button type="submit" class="px-4 py-2.5 rounded-xl bg-gray-900 text-white text-sm font-display font-600
                           hover:bg-gray-800 transition-colors shrink-0">
                Filter
            </button>

            {{-- Clear (only shown when filters active) --}}
            @if(request('search') || request('category') || request('status'))
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2.5 rounded-xl border border-gray-200 text-gray-500 text-sm font-display font-600
                                  hover:border-crimson-500/30 hover:text-crimson-600 transition-colors shrink-0">
                    Clear
                </a>
            @endif

            {{-- Spacer --}}
            <div class="flex-1 hidden sm:block"></div>

            <a href="{{ route('admin.products.create') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-crimson-500 text-white
                              text-sm font-display font-600 hover:bg-crimson-600 transition-all
                              hover:shadow-lg hover:shadow-crimson-500/25 shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Add Product
            </a>
        </form>
    </div>


    {{-- ══════════════════════════════════════════════
    FLASH MESSAGES
    ══════════════════════════════════════════════ --}}
    @if(session('success'))
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
    @endif


    {{-- ══════════════════════════════════════════════
    RESULTS COUNT
    ══════════════════════════════════════════════ --}}
    <div class="flex items-center justify-between mb-3 px-1">
        <span class="font-body text-xs text-gray-400">
            Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}
            of {{ $products->total() }} module{{ $products->total() !== 1 ? 's' : '' }}
            @if(request('search') || request('category') || request('status'))
                <span class="text-crimson-500 font-medium">(filtered)</span>
            @endif
        </span>

        {{-- Sort order hint --}}
        <span class="font-body text-xs text-gray-400 hidden sm:block">
            Ordered by sort_order · drag to reorder
        </span>
    </div>


    {{-- ══════════════════════════════════════════════
    PRODUCTS TABLE
    ══════════════════════════════════════════════ --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden mb-4">

        @if($products->isEmpty())
            {{-- Empty state --}}
            <div class="flex flex-col items-center justify-center py-20 px-6 text-center">
                <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <h3 class="font-display font-700 text-gray-900 text-lg mb-2">No products found</h3>
                <p class="font-body text-sm text-gray-400 max-w-sm mb-6">
                    @if(request('search') || request('category') || request('status'))
                        No modules match your current filters. Try clearing them or adjusting your search.
                    @else
                        No HIS modules have been added yet.
                    @endif
                </p>
                @if(request('search') || request('category') || request('status'))
                    <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-sm font-display font-600
                                              text-gray-600 hover:border-crimson-500/30 hover:text-crimson-600 transition-colors">
                        Clear filters
                    </a>
                @else
                    <a href="{{ route('admin.products.create') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-crimson-500 text-white
                                              text-sm font-display font-600 hover:bg-crimson-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        Add first product
                    </a>
                @endif
            </div>

        @else

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th
                                class="text-left px-5 py-3.5 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase w-8">
                                #
                            </th>
                            <th
                                class="text-left px-4 py-3.5 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">
                                Module
                            </th>
                            <th
                                class="text-left px-4 py-3.5 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden lg:table-cell">
                                Category
                            </th>
                            <th
                                class="text-left px-4 py-3.5 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden xl:table-cell">
                                Tagline
                            </th>
                            <th
                                class="text-left px-4 py-3.5 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden md:table-cell">
                                Features
                            </th>
                            <th
                                class="text-center px-4 py-3.5 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">
                                Status
                            </th>
                            <th
                                class="text-right px-5 py-3.5 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-50" id="productTableBody">
                        @foreach($products as $product)
                                <tr class="group hover:bg-gray-50/60 transition-colors duration-150" data-id="{{ $product->id }}">

                                    {{-- Sort handle + order number --}}
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-2">
                                            <button type="button"
                                                class="sort-handle cursor-grab active:cursor-grabbing text-gray-300
                                                                           hover:text-gray-500 transition-colors opacity-0 group-hover:opacity-100"
                                                title="Drag to reorder">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M8 6a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm8-16a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                                </svg>
                                            </button>
                                            <span class="font-body text-xs text-gray-400 w-4 text-center">
                                                {{ $product->sort_order ?: '—' }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- Module name + icon --}}
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3">
                                            {{-- Icon bubble --}}
                                            <div class="w-9 h-9 rounded-xl bg-gray-50 border border-gray-200
                                                                        flex items-center justify-center text-lg leading-none
                                                                        shrink-0 group-hover:border-crimson-500/20 transition-colors">
                                                {{ $product->icon ?? '📦' }}
                                            </div>
                                            <div class="min-w-0">
                                                <div
                                                    class="font-body text-sm font-600 text-gray-900
                                                                            group-hover:text-crimson-600 transition-colors truncate max-w-[180px]">
                                                    {{ $product->name }}
                                                </div>
                                                <div class="font-body text-[10px] text-gray-400 font-mono mt-0.5">
                                                    /products/{{ $product->slug }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Category badge --}}
                                    <td class="px-4 py-4 hidden lg:table-cell">
                                        @php
                                            $catColors = [
                                                'administration' => 'bg-gray-900/8 text-gray-700 border-gray-900/15',
                                                'patient-journey' => 'bg-crimson-500/8 text-crimson-700 border-crimson-500/20',
                                                'clinical' => 'bg-blue-50 text-blue-700 border-blue-200',
                                                'diagnostics' => 'bg-purple-50 text-purple-700 border-purple-200',
                                                'operations' => 'bg-amber-50 text-amber-700 border-amber-200',
                                            ];
                                            $catColor = $catColors[$product->category] ?? 'bg-gray-100 text-gray-600 border-gray-200';
                                        @endphp
                                        <span class="inline-flex items-center text-[10px] font-display font-600
                                                                     tracking-wide px-2 py-1 rounded-lg border {{ $catColor }}">
                                            {{ $product->categoryLabel() }}
                                        </span>
                                    </td>

                                    {{-- Tagline --}}
                                    <td class="px-4 py-4 hidden xl:table-cell max-w-[220px]">
                                        <span class="font-body text-xs text-gray-500 italic line-clamp-2">
                                            {{ $product->tagline ?: '—' }}
                                        </span>
                                    </td>

                                    {{-- Feature count --}}
                                    <td class="px-4 py-4 hidden md:table-cell">
                                        @php $featureCount = is_array($product->features) ? count($product->features) : 0; @endphp
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="font-body text-xs text-gray-500">
                                                {{ $featureCount }} feature{{ $featureCount !== 1 ? 's' : '' }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- Active toggle --}}
                                    <td class="px-4 py-4 text-center">
                                        <form method="POST" action="{{ route('admin.products.toggle', $product->id) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                title="{{ $product->is_active ? 'Click to deactivate' : 'Click to activate' }}" class="inline-flex items-center gap-1.5 text-[10px] font-display font-700
                                                                                       px-2.5 py-1.5 rounded-lg border transition-all duration-200
                                                                                       {{ $product->is_active
                            ? 'bg-green-50 text-green-700 border-green-200 hover:bg-red-50 hover:text-crimson-600 hover:border-crimson-500/20'
                            : 'bg-gray-100 text-gray-500 border-gray-200 hover:bg-green-50 hover:text-green-700 hover:border-green-200' }}
                                                                                       group/toggle">
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full
                                                                                                     {{ $product->is_active ? 'bg-green-500' : 'bg-gray-400' }}">
                                                </span>
                                                <span class="group-hover/toggle:hidden">
                                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                                <span class="hidden group-hover/toggle:inline">
                                                    {{ $product->is_active ? 'Deactivate?' : 'Activate?' }}
                                                </span>
                                            </button>
                                        </form>

                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-end gap-1.5">

                                            {{-- View on site --}}
                                            <a href="{{ $product->href ?? '/products/' . $product->slug }}" target="_blank"
                                                title="View on public site" class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center
                                                                  text-gray-400 hover:text-gray-700 hover:border-gray-300 transition-all
                                                                  opacity-0 group-hover:opacity-100">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                            </a>

                                            <a href="{{ route('admin.products.edit', $product->id) }}" title="Edit product" class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center
                                                                              text-gray-400 hover:text-crimson-600 hover:border-crimson-500/30
                                                                              hover:bg-crimson-500/5 transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            @if(Auth::guard('admin')->user()->can('delete_any'))
                                                {{-- Delete --}}
                                                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}"
                                                    onsubmit="return confirm('Delete \'{{ addslashes($product->name) }}\'? This cannot be undone.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete product" class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center
                                                                                           text-gray-400 hover:text-crimson-600 hover:border-crimson-500/30
                                                                                           hover:bg-crimson-500/5 transition-all">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif

                                        </div>
                                    </td>

                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endif
    </div>


    {{-- ══════════════════════════════════════════════
    PAGINATION
    ══════════════════════════════════════════════ --}}
    @if($products->hasPages())
        <div class="flex items-center justify-between px-1">
            <span class="font-body text-xs text-gray-400">
                Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
            </span>
            <div class="flex items-center gap-1">

                {{-- Previous --}}
                @if($products->onFirstPage())
                    <span class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center
                                                 text-gray-300 cursor-not-allowed">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center
                                              text-gray-500 hover:border-crimson-500/30 hover:text-crimson-600 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                @endif

                {{-- Page numbers --}}
                @foreach($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                    <a href="{{ $url }}" class="w-8 h-8 rounded-lg border flex items-center justify-center
                                              text-xs font-display font-700 transition-all
                                              {{ $page === $products->currentPage()
                        ? 'bg-crimson-500 text-white border-crimson-500'
                        : 'border-gray-200 text-gray-500 hover:border-crimson-500/30 hover:text-crimson-600' }}">
                        {{ $page }}
                    </a>
                @endforeach

                {{-- Next --}}
                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center
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
        // ── Auto-dismiss flash messages after 4s ─────────────────
        document.querySelectorAll('[data-flash]').forEach(el => {
            setTimeout(() => {
                el.style.transition = 'opacity 0.4s ease';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 400);
            }, 4000);
        });
    </script>
@endpush