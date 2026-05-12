@extends('admin.layouts.app')
@php
$isEdit     = isset($client) && $client->exists;
$formAction = $isEdit
    ? route('admin.clients.update', $client)
    : route('admin.clients.store');
$pageTitle  = $isEdit ? 'Edit Client' : 'Add New Client';
@endphp
@section('title', $pageTitle)
@section('page-title', $pageTitle)
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}"
       class="text-xs font-body text-gray-400 hover:text-crimson-500 transition-colors">
        Dashboard
    </a>
    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    <a href="{{ route('admin.clients.index') }}"
       class="text-xs font-body text-gray-400 hover:text-crimson-500 transition-colors">
        Clients
    </a>
    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    <span class="text-xs font-body text-gray-500">{{ $isEdit ? $client->name : 'New Client' }}</span>
@endsection
@section('content')
{{-- ══════════════════════════════════════════════════════
MAIN FORM — closes BEFORE Danger Zone
══════════════════════════════════════════════════════ --}}
<form
    method="POST"
    action="{{ $formAction }}"
    enctype="multipart/form-data"
    id="clientForm"
    novalidate
>
    @csrf
    @if($isEdit) @method('PUT') @endif

    {{-- ══════════════════════════════════════════════════════
        TOP ACTION BAR
    ══════════════════════════════════════════════════════ --}}
    <div class="flex items-center justify-between gap-4 mb-6">

        {{-- Back link --}}
        <a href="{{ route('admin.clients.index') }}"
           class="flex items-center gap-2 text-sm font-body text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Clients
        </a>

        {{-- Save buttons --}}
        <div class="flex items-center gap-2">
            {{-- Save as inactive / Save as active --}}
            @if(!$isEdit)
            <button type="submit" name="is_active" value="0"
                    class="px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-display font-600 text-sm
                           hover:bg-gray-50 hover:border-gray-300 transition-all">
                Save as Draft
            </button>
            @endif

            <button type="submit"
                    class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-crimson-500 text-white font-display font-700 text-sm
                           hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ $isEdit ? 'Save Changes' : 'Add Client' }}
            </button>
        </div>
    </div>


    {{-- ══════════════════════════════════════════════════════
        VALIDATION ERRORS BANNER
    ══════════════════════════════════════════════════════ --}}
    @if($errors->any())
        <div class="flex items-start gap-3 px-5 py-4 rounded-2xl bg-crimson-500/5 border border-crimson-500/20 mb-6">
            <svg class="w-5 h-5 text-crimson-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="font-display font-700 text-sm text-crimson-700 mb-2">
                    Please fix {{ $errors->count() }} error{{ $errors->count() !== 1 ? 's' : '' }} before saving
                </p>
                <ul class="space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="font-body text-xs text-crimson-600 flex items-center gap-1.5">
                            <span class="w-1 h-1 rounded-full bg-crimson-500 shrink-0"></span>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif


    {{-- ══════════════════════════════════════════════════════
        MAIN GRID — 2 column: content left, options right
    ══════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 xl:grid-cols-[1fr_300px] gap-5">

        {{-- ── LEFT COLUMN ──────────────────────────────────── --}}
        <div class="space-y-5">

            {{-- ── CARD: Basic Info ─────────────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                {{-- Card header --}}
                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-gray-900 text-sm tracking-wide">
                        Basic Information
                    </h3>
                </div>

                <div class="p-5 space-y-5">

                    {{-- Hospital / Clinic Name --}}
                    <div>
                        <label for="name"
                               class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-1.5">
                            Hospital / Clinic Name
                            <span class="text-crimson-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $isEdit ? $client->name : '') }}"
                            required
                            placeholder="e.g. DHQ Hospital Rahim Yar Khan"
                            class="w-full px-4 py-2.5 rounded-xl border font-body text-sm text-gray-900 placeholder-gray-400 bg-white transition-all
                                   {{ $errors->has('name')
                                       ? 'border-crimson-500 bg-red-50 focus:ring-2 focus:ring-crimson-500/10'
                                       : 'border-gray-200 hover:border-gray-300 focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10' }}
                                   focus:outline-none"
                        >
                        @error('name')
                            <p class="mt-1.5 flex items-center gap-1.5 text-xs font-body text-crimson-600">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- City + Province --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="city"
                                   class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-1.5">
                                City
                            </label>
                            <input
                                type="text"
                                id="city"
                                name="city"
                                value="{{ old('city', $isEdit ? $client->city : '') }}"
                                placeholder="e.g. Rahim Yar Khan"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-900 placeholder-gray-400 bg-white
                                       hover:border-gray-300 focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 focus:outline-none transition-all
                                       {{ $errors->has('city') ? 'border-crimson-500 bg-red-50' : '' }}"
                            >
                            @error('city')
                                <p class="mt-1.5 text-xs font-body text-crimson-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="province"
                                   class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-1.5">
                                Province
                            </label>
                            <select
                                id="province"
                                name="province"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 bg-white cursor-pointer
                                       hover:border-gray-300 focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 focus:outline-none transition-all
                                       {{ $errors->has('province') ? 'border-crimson-500 bg-red-50' : '' }}"
                            >
                                <option value="">Select province...</option>
                                @foreach([
                                    'Punjab'            => 'Punjab',
                                    'Sindh'             => 'Sindh',
                                    'KPK'               => 'Khyber Pakhtunkhwa',
                                    'Balochistan'       => 'Balochistan',
                                    'Islamabad'         => 'Islamabad (ICT)',
                                    'AJK'               => 'Azad Jammu & Kashmir',
                                    'Gilgit-Baltistan'  => 'Gilgit-Baltistan',
                                ] as $val => $label)
                                <option value="{{ $val }}"
                                    {{ old('province', $isEdit ? $client->province : '') === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                            @error('province')
                                <p class="mt-1.5 text-xs font-body text-crimson-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Website URL --}}
                    <div>
                        <label for="website_url"
                               class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-1.5">
                            Website URL
                            <span class="text-gray-400 font-400 normal-case tracking-normal ml-1">(optional)</span>
                        </label>
                        <div class="relative">
                            <div class="absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </div>
                            <input
                                type="url"
                                id="website_url"
                                name="website_url"
                                value="{{ old('website_url', $isEdit ? $client->website_url : '') }}"
                                placeholder="https://hospital.gov.pk"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-900 placeholder-gray-400 bg-white
                                       hover:border-gray-300 focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 focus:outline-none transition-all
                                       {{ $errors->has('website_url') ? 'border-crimson-500 bg-red-50' : '' }}"
                            >
                        </div>
                        @error('website_url')
                            <p class="mt-1.5 text-xs font-body text-crimson-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Year Deployed --}}
                    <div>
                        <label for="year_deployed"
                               class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-1.5">
                            Year Deployed
                            <span class="text-gray-400 font-400 normal-case tracking-normal ml-1">(optional)</span>
                        </label>
                        <input
                            type="number"
                            id="year_deployed"
                            name="year_deployed"
                            value="{{ old('year_deployed', $isEdit ? $client->year_deployed : '') }}"
                            min="2000"
                            max="{{ date('Y') }}"
                            placeholder="{{ date('Y') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-900 placeholder-gray-400 bg-white
                                   hover:border-gray-300 focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 focus:outline-none transition-all
                                   {{ $errors->has('year_deployed') ? 'border-crimson-500 bg-red-50' : '' }}"
                        >
                        @error('year_deployed')
                            <p class="mt-1.5 text-xs font-body text-crimson-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Notes --}}
                    <div>
                        <label for="notes"
                               class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-1.5">
                            Internal Notes
                            <span class="text-gray-400 font-400 normal-case tracking-normal ml-1">(not shown on site)</span>
                        </label>
                        <textarea
                            id="notes"
                            name="notes"
                            rows="3"
                            placeholder="Any internal notes about this client — AMC status, contact person, renewal date..."
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 placeholder-gray-400 bg-white resize-none
                                   hover:border-gray-300 focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 focus:outline-none transition-all
                                   {{ $errors->has('notes') ? 'border-crimson-500 bg-red-50' : '' }}"
                        >{{ old('notes', $isEdit ? $client->notes : '') }}</textarea>
                        @error('notes')
                            <p class="mt-1.5 text-xs font-body text-crimson-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>


            {{-- ── CARD: Logo ────────────────────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-gray-900 text-sm tracking-wide">Client Logo</h3>
                </div>

                <div class="p-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 items-start">

                        {{-- Upload area --}}
                        <div>
                            <label for="logo"
                                   class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-2">
                                Logo File
                                @if(!$isEdit) <span class="text-gray-400 font-400 normal-case tracking-normal ml-1">(optional — can upload later)</span> @endif
                            </label>

                            <label for="logo" class="block cursor-pointer group">
                                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center
                                            hover:border-crimson-500/40 hover:bg-crimson-500/2 transition-all">
                                    <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center mx-auto mb-3
                                                group-hover:bg-crimson-500/10 transition-colors">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-crimson-500 transition-colors"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <p class="font-body text-xs text-gray-500 group-hover:text-crimson-600 transition-colors">
                                        <span class="font-600">Click to upload</span> or drag & drop
                                    </p>
                                    <p class="font-body text-[10px] text-gray-400 mt-1">
                                        SVG or PNG with transparent background preferred · Max 1MB
                                    </p>
                                </div>
                                <input
                                    type="file"
                                    id="logo"
                                    name="logo"
                                    accept="image/*"
                                    class="hidden"
                                    onchange="previewLogo(this)"
                                >
                            </label>

                            @error('logo')
                                <p class="mt-1.5 flex items-center gap-1.5 text-xs font-body text-crimson-600">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror

                            {{-- Logo alt text --}}
                            <div class="mt-4">
                                <label for="logo_alt"
                                       class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-1.5">
                                    Logo Alt Text
                                    <span class="text-gray-400 font-400 normal-case tracking-normal ml-1">(for accessibility)</span>
                                </label>
                                <input
                                    type="text"
                                    id="logo_alt"
                                    name="logo_alt"
                                    value="{{ old('logo_alt', $isEdit ? $client->logo_alt : '') }}"
                                    placeholder="e.g. DHQ Hospital RYK Logo"
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-900 placeholder-gray-400 bg-white
                                           hover:border-gray-300 focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 focus:outline-none transition-all"
                                >
                            </div>
                        </div>

                        {{-- Preview --}}
                        <div>
                            <p class="font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-2">Preview</p>

                            {{-- New upload preview --}}
                            <div id="logoNewPreview" class="hidden mb-3">
                                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 flex items-center justify-center aspect-video relative">
                                    <img id="logoNewImg" src="" alt="New logo" class="max-h-20 max-w-full object-contain">
                                    <span class="absolute top-2 right-2 text-[10px] font-display font-700 px-2 py-1 rounded-lg bg-crimson-500 text-white">
                                        New
                                    </span>
                                </div>
                            </div>

                            {{-- Existing logo (edit mode) --}}
                            @if($isEdit && $client->logo_path)
                            <div id="logoCurrentWrap" class="mb-3">
                                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 flex items-center justify-center aspect-video relative">
                                    <img src="{{ $client->logoUrl() }}"
                                         alt="{{ $client->logo_alt ?? $client->name }}"
                                         class="max-h-20 max-w-full object-contain"
                                         id="logoCurrentImg">
                                    <span class="absolute top-2 right-2 text-[10px] font-display font-700 px-2 py-1 rounded-lg bg-green-500 text-white">
                                        Current
                                    </span>
                                </div>
                                {{-- Remove existing logo --}}
                                <label class="flex items-center gap-2 mt-2 cursor-pointer">
                                    <input type="checkbox" name="remove_logo" value="1"
                                           class="w-3.5 h-3.5 rounded border-gray-300 text-crimson-500 focus:ring-crimson-500/30 cursor-pointer"
                                           onchange="document.getElementById('logoCurrentWrap').style.opacity = this.checked ? '0.4' : '1'">
                                    <span class="font-body text-xs text-gray-500">Remove current logo</span>
                                </label>
                            </div>
                            @else
                            {{-- Empty placeholder --}}
                            <div id="logoEmptyState" class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl p-6 flex flex-col items-center justify-center aspect-video">
                                <svg class="w-8 h-8 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="font-body text-[10px] text-gray-400 text-center">No logo uploaded yet</p>
                            </div>
                            @endif

                            {{-- Tips --}}
                            <div class="mt-3 space-y-1.5">
                                @foreach([
                                    'SVG or PNG with transparent background works best',
                                    'Shown on the homepage ticker and clients page',
                                    'Avoid logos with white backgrounds — they won\'t show on white',
                                ] as $tip)
                                <div class="flex items-start gap-2">
                                    <svg class="w-3 h-3 text-crimson-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="font-body text-[10px] text-gray-400 leading-relaxed">{{ $tip }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>{{-- /left column --}}


        {{-- ── RIGHT COLUMN: Options sidebar ────────────────── --}}
        <div class="space-y-5">

            {{-- ── CARD: Classification ─────────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-gray-900 text-sm tracking-wide">Classification</h3>
                </div>

                <div class="p-5 space-y-4">

                    {{-- Type --}}
                    <div>
                        <label class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-2">
                            Client Type <span class="text-crimson-500">*</span>
                        </label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach(\App\Models\Client::TYPES as $val => $label)
                            @php
                                $selected = old('type', $isEdit ? $client->type : '') === $val;
                                $badgePreview = match($val) {
                                    'government'      => 'bg-blue-100 text-blue-700 border-blue-200',
                                    'private'         => 'bg-purple-100 text-purple-700 border-purple-200',
                                    'semi-government' => 'bg-orange-100 text-orange-700 border-orange-200',
                                    'ngo'             => 'bg-green-100 text-green-700 border-green-200',
                                    default           => 'bg-gray-100 text-gray-600 border-gray-200',
                                };
                            @endphp
                            <label class="relative cursor-pointer">
                                <input type="radio" name="type" value="{{ $val }}"
                                       {{ $selected ? 'checked' : '' }}
                                       class="peer sr-only" required>
                                <div class="flex flex-col items-center gap-1.5 px-3 py-3 rounded-xl border-2 text-center transition-all
                                            border-gray-200 peer-checked:border-crimson-500 peer-checked:bg-crimson-500/5
                                            hover:border-gray-300">
                                    <span class="inline-block text-[10px] font-display font-700 tracking-wide px-2 py-0.5 rounded border {{ $badgePreview }}">
                                        {{ $label }}
                                    </span>
                                    {{-- Checkmark when selected --}}
                                    <span class="hidden peer-checked:block">
                                        <svg class="w-3.5 h-3.5 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        @error('type')
                            <p class="mt-1.5 text-xs font-body text-crimson-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Sort Order --}}
                    <div>
                        <label for="sort_order"
                               class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-1.5">
                            Sort Order
                        </label>
                        <input
                            type="number"
                            id="sort_order"
                            name="sort_order"
                            value="{{ old('sort_order', $isEdit ? $client->sort_order : (\App\Models\Client::max('sort_order') ?? 0) + 1) }}"
                            min="1"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-900 bg-white
                                   hover:border-gray-300 focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 focus:outline-none transition-all"
                        >
                        <p class="font-body text-[10px] text-gray-400 mt-1.5">
                            Lower numbers appear first. Controls display order on the clients page and homepage ticker.
                        </p>
                    </div>

                </div>
            </div>


            {{-- ── CARD: Visibility ─────────────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-gray-900 text-sm tracking-wide">Visibility</h3>
                </div>

                <div class="p-5 space-y-4">

                    {{-- Active toggle --}}
                    <label class="flex items-start gap-4 cursor-pointer group">
                        <div class="relative mt-0.5 shrink-0">
                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old('is_active', $isEdit ? $client->is_active : true) ? 'checked' : '' }}
                                class="peer sr-only"
                                id="isActiveToggle"
                            >
                            {{-- Track --}}
                            <div class="w-10 h-5 rounded-full border-2 border-gray-200 bg-white transition-all
                                        peer-checked:bg-crimson-500 peer-checked:border-crimson-500"></div>
                            {{-- Thumb --}}
                            <div class="absolute top-0.5 left-0.5 w-4 h-4 rounded-full bg-gray-300 shadow-sm transition-all
                                        peer-checked:translate-x-5 peer-checked:bg-white"></div>
                        </div>
                        <div>
                            <div class="font-display font-700 text-gray-900 text-sm group-hover:text-crimson-600 transition-colors">
                                Active
                            </div>
                            <p class="font-body text-xs text-gray-400 mt-0.5 leading-relaxed">
                                Active clients appear on the public clients page and in the homepage ticker strip.
                            </p>
                        </div>
                    </label>

                    <div class="h-px bg-gray-100"></div>

                    {{-- Featured toggle --}}
                    <label class="flex items-start gap-4 cursor-pointer group">
                        <div class="relative mt-0.5 shrink-0">
                            <input
                                type="checkbox"
                                name="is_featured"
                                value="1"
                                {{ old('is_featured', $isEdit ? $client->is_featured : false) ? 'checked' : '' }}
                                class="peer sr-only"
                                id="isFeaturedToggle"
                            >
                            <div class="w-10 h-5 rounded-full border-2 border-gray-200 bg-white transition-all
                                        peer-checked:bg-crimson-500 peer-checked:border-crimson-500"></div>
                            <div class="absolute top-0.5 left-0.5 w-4 h-4 rounded-full bg-gray-300 shadow-sm transition-all
                                        peer-checked:translate-x-5 peer-checked:bg-white"></div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-display font-700 text-gray-900 text-sm group-hover:text-crimson-600 transition-colors">
                                    Featured
                                </span>
                                <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            </div>
                            <p class="font-body text-xs text-gray-400 mt-0.5 leading-relaxed">
                                Featured clients are highlighted on the homepage ticker with priority placement.
                            </p>
                        </div>
                    </label>

                </div>
            </div>


            {{-- ── CARD: Current status (edit only) ─────────── --}}
            @if($isEdit)
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-gray-900 text-sm tracking-wide">Record Info</h3>
                </div>

                <div class="p-5 space-y-3">
                    @foreach([
                        ['label' => 'Client ID',    'value' => '#' . $client->id],
                        ['label' => 'Location',     'value' => $client->locationString() ?: '—'],
                        ['label' => 'Type',         'value' => $client->typeLabel()],
                        ['label' => 'Year Deployed','value' => $client->year_deployed ?? '—'],
                        ['label' => 'Sort Order',   'value' => $client->sort_order],
                        ['label' => 'Created',      'value' => $client->created_at->format('M j, Y')],
                        ['label' => 'Last Updated', 'value' => $client->updated_at->diffForHumans()],
                    ] as $info)
                    <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                        <span class="font-body text-xs text-gray-400">{{ $info['label'] }}</span>
                        <span class="font-display font-600 text-xs text-gray-700">{{ $info['value'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>{{-- /right column --}}

    </div>{{-- /main grid --}}
</form> {{-- ✅ MAIN FORM CLOSES HERE --}}

{{-- ══════════════════════════════════════════════════════
DANGER ZONE — SEPARATE FORM, outside main form
══════════════════════════════════════════════════════ --}}
@if($isEdit)
<div class="mt-6 bg-white border border-red-100 rounded-2xl overflow-hidden">
    <div class="flex items-center gap-3 px-5 py-4 border-b border-red-100 bg-red-50/30">
        <div class="h-4 w-0.5 bg-red-400 rounded-full"></div>
        <h3 class="font-display font-700 text-gray-900 text-sm tracking-wide">Danger Zone</h3>
    </div>
    <div class="p-5">
        <p class="font-body text-xs text-gray-500 mb-4 leading-relaxed">
            Permanently delete <strong class="text-gray-700">{{ $client->name }}</strong>
            from the system. This removes the client and their logo from all pages. This action cannot be undone.
        </p>
        <form
            method="POST"
            action="{{ route('admin.clients.destroy', $client) }}"
            onsubmit="return confirm('Permanently delete {{ addslashes($client->name) }}? This cannot be undone.')"
            class="inline"
        >
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl
                           border border-red-200 text-red-600 font-display font-600 text-sm
                           hover:bg-red-50 hover:border-red-300 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete Client
            </button>
        </form>
    </div>
</div>
@endif

@endsection

@push('head')
<style>
    /* Custom checkbox/radio peer styling helpers */
    input[type="radio"].peer:checked ~ div {
        border-color: #e11d48;
        background-color: rgba(225,29,72,0.04);
    }
    input[type="radio"].peer:checked ~ div .check-icon {
        display: block;
    }

    /* Drag-over state for upload zone */
    .upload-zone.drag-over {
        border-color: rgba(225,29,72,0.5);
        background-color: rgba(225,29,72,0.04);
    }
</style>
@endpush

@push('scripts')
<script>
    // ── Logo preview ─────────────────────────────────────────────
    function previewLogo(input) {
        const file = input.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            const newPreview = document.getElementById('logoNewPreview');
            const newImg     = document.getElementById('logoNewImg');
            const emptyState = document.getElementById('logoEmptyState');

            newImg.src = e.target.result;
            newPreview.classList.remove('hidden');

            if (emptyState) emptyState.classList.add('hidden');

            // Auto-fill alt text if empty
            const altInput = document.getElementById('logo_alt');
            if (altInput && !altInput.value) {
                const nameInput = document.getElementById('name');
                if (nameInput && nameInput.value) {
                    altInput.value = nameInput.value + ' Logo';
                }
            }
        };
        reader.readAsDataURL(file);
    }

    // ── Auto-fill alt text when name is typed ────────────────────
    document.getElementById('name')?.addEventListener('input', function() {
        const altInput = document.getElementById('logo_alt');
        if (altInput && !altInput.value) {
            altInput.value = this.value ? this.value + ' Logo' : '';
        }
    });

    // ── Drag & drop on upload zone ───────────────────────────────
    const uploadLabel = document.querySelector('label[for="logo"] > div');
    const logoInput   = document.getElementById('logo');

    if (uploadLabel && logoInput) {
        ['dragenter','dragover'].forEach(evt => {
            uploadLabel.addEventListener(evt, (e) => {
                e.preventDefault();
                uploadLabel.classList.add('!border-crimson-500/50', '!bg-crimson-500/5');
            });
        });

        ['dragleave','drop'].forEach(evt => {
            uploadLabel.addEventListener(evt, (e) => {
                e.preventDefault();
                uploadLabel.classList.remove('!border-crimson-500/50', '!bg-crimson-500/5');
                if (evt === 'drop' && e.dataTransfer.files.length) {
                    logoInput.files = e.dataTransfer.files;
                    previewLogo(logoInput);
                }
            });
        });
    }

    // ── Form validation feedback ─────────────────────────────────
    document.getElementById('clientForm')?.addEventListener('submit', function(e) {
        const name = document.getElementById('name');
        const type = document.querySelector('input[name="type"]:checked');

        let valid = true;

        if (!name.value.trim()) {
            name.classList.add('border-crimson-500', 'bg-red-50');
            name.focus();
            valid = false;
        } else {
            name.classList.remove('border-crimson-500', 'bg-red-50');
        }

        if (!type) {
            // Highlight type section
            document.querySelector('[name="type"]')
                ?.closest('.grid')
                ?.classList.add('ring-2', 'ring-crimson-500/30', 'rounded-xl');
            valid = false;
        }

        if (!valid) e.preventDefault();
    });
</script>
@endpush