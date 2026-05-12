@extends('admin.layouts.app')
@php
$isEdit  = isset($service) && $service->exists;
$title   = $isEdit ? 'Edit Service' : 'Add Service';
$action  = $isEdit
    ? route('admin.services.update', $service)
    : route('admin.services.store');
@endphp
@section('title', $title)
@section('page-title', $title)
@section('breadcrumb')
    <div class="flex items-center gap-2 text-xs font-body text-gray-400">
        <a href="{{ route('admin.services.index') }}" class="hover:text-crimson-500 transition-colors">Services</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-gray-600">{{ $isEdit ? $service->name : 'New Service' }}</span>
    </div>
@endsection
@section('content')
{{-- ══════════════════════════════════════════════
MAIN FORM — closes BEFORE Danger Zone
══════════════════════════════════════════════ --}}
<form method="POST" action="{{ $action }}" id="serviceForm" novalidate>
    @csrf
    @if($isEdit) @method('PUT') @endif

    {{-- ══════════════════════════════════════════════
    TOP ACTION BAR
    ═══════════════════════════════════════════════ --}}
    <div class="flex items-center justify-between gap-4 mb-6">

        {{-- Back link --}}
        <a href="{{ route('admin.services.index') }}"
           class="flex items-center gap-2 text-sm font-body text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Services
        </a>

        {{-- Save buttons --}}
        <div class="flex items-center gap-2">
            {{-- Save as inactive / Save as active --}}
            <button type="button" id="toggleActiveBtn" class="flex items-center gap-2 px-4 py-2.5 rounded-xl border transition-all text-sm font-display font-600" onclick="toggleActive()">
                {{-- text/style set by JS on load --}}
            </button>

            <button type="submit" class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-crimson-500 text-white text-sm font-display font-700 hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                {{ $isEdit ? 'Save Changes' : 'Create Service' }}
            </button>
        </div>
    </div>
    

    {{-- ══════════════════════════════════════════════
    VALIDATION ERRORS BANNER
    ═══════════════════════════════════════════════ --}}
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

    <input type="hidden" name="is_active" id="isActiveInput" value="{{ old('is_active', $isEdit ? ($service->is_active ? '1' : '0') : '1') }}">

    {{-- ══════════════════════════════════════════════
    TWO-COLUMN LAYOUT
    ═══════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 xl:grid-cols-[1fr_340px] gap-5">

        {{-- ────────────────────────────────────────
        LEFT COLUMN — main fields
        ──────────────────────────────────────── --}}
        <div class="space-y-5">

            {{-- ── IDENTITY ──────────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Identity</h2>
                </div>
                <div class="p-6 space-y-5">
                    {{-- Name --}}
                    <div>
                        <label for="name" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Service Name <span class="text-crimson-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $isEdit ? $service->name : '') }}" placeholder="e.g. Enterprise HIS Integration" required autofocus class="w-full px-4 py-3 rounded-xl border text-sm font-body text-gray-800 placeholder-gray-400 transition-all focus:outline-none focus:ring-1 @error('name') border-crimson-500 ring-crimson-500 bg-crimson-500/3 @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">
                        @error('name')
                            <p class="mt-1.5 text-xs font-body text-crimson-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div>
                        <label for="slug" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Slug <span class="text-crimson-500">*</span>
                            <span class="font-normal text-gray-400 ml-1">— auto-generated from name</span>
                        </label>
                        <div class="flex items-center gap-0">
                            <span class="px-3 py-3 bg-gray-50 border border-r-0 border-gray-200 rounded-l-xl text-xs font-mono text-gray-400 shrink-0">/services/</span>
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $isEdit ? $service->slug : '') }}" placeholder="enterprise-his-integration" class="flex-1 px-4 py-3 rounded-r-xl border text-sm font-mono text-gray-700 placeholder-gray-400 transition-all focus:outline-none focus:ring-1 @error('slug') border-crimson-500 ring-crimson-500 bg-crimson-500/3 @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">
                        </div>
                        @error('slug')
                            <p class="mt-1.5 text-xs font-body text-crimson-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tagline --}}
                    <div>
                        <label for="tagline" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Tagline <span class="text-crimson-500">*</span>
                            <span class="font-normal text-gray-400 ml-1">— shown in italic on the service card</span>
                        </label>
                        <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $isEdit ? $service->tagline : '') }}" placeholder="e.g. Seamless data exchange between clinical systems & lab analyzers" maxlength="160" class="w-full px-4 py-3 rounded-xl border text-sm font-body text-gray-800 placeholder-gray-400 transition-all focus:outline-none focus:ring-1 @error('tagline') border-crimson-500 ring-crimson-500 bg-crimson-500/3 @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">
                        <div class="flex items-center justify-between mt-1">
                            @error('tagline')
                                <p class="text-xs font-body text-crimson-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                            @else <span></span> @enderror
                            <span class="text-[10px] font-body text-gray-400" id="taglineCount">{{ strlen(old('tagline', $isEdit ? $service->tagline : '')) }}/160</span>
                        </div>
                    </div>

                    {{-- Icon + Sort order --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="icon" class="block font-body text-xs font-600 text-gray-700 mb-1.5">Icon Emoji</label>
                            <div class="flex items-center gap-2">
                                <div id="iconPreview" class="w-10 h-10 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center text-xl shrink-0">{{ old('icon', $isEdit ? $service->icon : '📦') }}</div>
                                <input type="text" id="icon" name="icon" value="{{ old('icon', $isEdit ? $service->icon : '') }}" placeholder="📦" maxlength="10" class="flex-1 px-4 py-3 rounded-xl border border-gray-200 text-sm font-body text-gray-800 placeholder-gray-400 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
                            </div>
                            <p class="mt-1.5 text-[10px] font-body text-gray-400">Paste any emoji from your keyboard</p>
                        </div>
                        <div>
                            <label for="sort_order" class="block font-body text-xs font-600 text-gray-700 mb-1.5">Sort Order</label>
                            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $isEdit ? $service->sort_order : 0) }}" min="0" max="999" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-body text-gray-800 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
                            <p class="mt-1.5 text-[10px] font-body text-gray-400">Lower numbers appear first</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── DESCRIPTION ───────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Description</h2>
                    <span class="ml-auto font-body text-xs text-gray-400">Shown in the middle column on the public services page</span>
                </div>
                <div class="p-6">
                    <textarea id="description" name="description" rows="8" placeholder="Write a detailed 4–6 sentence description explaining the service scope, target audience, and key deliverables…" class="w-full px-4 py-3 rounded-xl border text-sm font-body text-gray-800 placeholder-gray-400 resize-y leading-relaxed transition-all focus:outline-none focus:ring-1 @error('description') border-crimson-500 ring-crimson-500 bg-crimson-500/3 @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">{{ old('description', $isEdit ? $service->description : '') }}</textarea>
                    <div class="flex items-center justify-between mt-2">
                        @error('description')
                            <p class="text-xs font-body text-crimson-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                        @else <span></span> @enderror
                        <span class="text-[10px] font-body text-gray-400" id="descCount">{{ strlen(old('description', $isEdit ? $service->description : '')) }} chars</span>
                    </div>
                </div>
            </div>

            {{-- ── KEY FEATURES ───────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Key Features</h2>
                    <span class="ml-auto font-body text-xs text-gray-400">Shown as bullet points on the service card</span>
                </div>
                <div class="p-6">
                    <div id="featuresContainer" class="space-y-2 mb-3">
                        @php
                            $features = old('features', $isEdit ? ($service->features ?? []) : []);
                            if (empty($features)) $features = [''];
                        @endphp
                        @foreach($features as $i => $feat)
                            <div class="feature-row flex items-center gap-2 group/row">
                                <div class="w-5 h-5 rounded-md bg-crimson-500/10 border border-crimson-500/20 flex items-center justify-center shrink-0">
                                    <svg class="w-3 h-3 text-crimson-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                <input type="text" name="features[]" value="{{ $feat }}" placeholder="e.g. Real-time HL7/FHIR data synchronization" class="flex-1 px-3 py-2.5 rounded-xl border border-gray-200 text-sm font-body text-gray-800 placeholder-gray-400 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
                                <button type="button" onclick="removeFeature(this)" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-300 hover:text-crimson-500 hover:border-crimson-500/30 hover:bg-crimson-500/5 transition-all shrink-0 opacity-0 group-hover/row:opacity-100">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addFeature()" class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-dashed border-gray-300 text-sm font-display font-600 text-gray-500 hover:border-crimson-500/40 hover:text-crimson-600 hover:bg-crimson-500/3 transition-all w-full justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Add feature
                    </button>
                    <p class="mt-3 text-[10px] font-body text-gray-400">Tip: aim for 6–10 features. Each should be a concrete capability.</p>
                </div>
            </div>

            {{-- ── SEO ───────────────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="h-4 w-0.5 bg-gray-400 rounded-full"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">SEO</h2>
                    <span class="ml-auto font-body text-xs text-gray-400">Optional — falls back to name/tagline</span>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label for="meta_title" class="block font-body text-xs font-600 text-gray-700 mb-1.5">Meta Title</label>
                        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $isEdit ? $service->meta_title : '') }}" placeholder="Leave blank to use service name" maxlength="70" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-body text-gray-800 placeholder-gray-400 transition-all focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500">
                        <p class="mt-1 text-[10px] font-body text-gray-400">Recommended: 50–60 characters</p>
                    </div>
                    <div>
                        <label for="meta_description" class="block font-body text-xs font-600 text-gray-700 mb-1.5">Meta Description</label>
                        <textarea id="meta_description" name="meta_description" rows="3" placeholder="Leave blank to use tagline" maxlength="165" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-body text-gray-800 placeholder-gray-400 resize-none transition-all focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500">{{ old('meta_description', $isEdit ? $service->meta_description : '') }}</textarea>
                        <p class="mt-1 text-[10px] font-body text-gray-400">Recommended: 150–160 characters</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ────────────────────────────────────────
        RIGHT COLUMN — settings sidebar
        ──────────────────────────────────────── --}}
        <div class="space-y-5">

            {{-- ── STATUS ────────────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Status</h2>
                </div>
                <div class="p-5 space-y-3">
                    <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 border border-gray-200">
                        <div>
                            <div class="font-body text-sm font-600 text-gray-800">Active</div>
                            <div class="font-body text-xs text-gray-400 mt-0.5">Visible on the public services page</div>
                        </div>
                        <button type="button" id="activeSwitch" onclick="toggleActive()" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 focus:outline-none shrink-0">
                            <span id="activeSwitchKnob" class="inline-block h-4 w-4 transform rounded-full bg-white shadow transition-transform duration-200"></span>
                        </button>
                    </div>
                    <div class="flex items-center gap-2 px-1">
                        <span id="statusDot" class="w-2 h-2 rounded-full shrink-0"></span>
                        <span id="statusLabel" class="font-body text-xs text-gray-500"></span>
                    </div>
                </div>
            </div>

            {{-- ── TAG ───────────────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Tag</h2>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label for="tag" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Service Tag <span class="text-crimson-500">*</span>
                        </label>
                        <select id="tag" name="tag" required class="w-full px-4 py-3 rounded-xl border text-sm font-body text-gray-800 transition-all focus:outline-none focus:ring-1 cursor-pointer @error('tag') border-crimson-500 ring-crimson-500 bg-crimson-500/3 @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">
                            <option value="" disabled @selected(!$isEdit)>Choose a tag…</option>
                            @foreach(\App\Models\Service::TAGS as $serviceTag)
                                <option value="{{ $serviceTag }}" @selected(old('tag', $isEdit ? $service->tag : '') === $serviceTag)>{{ $serviceTag }}</option>
                            @endforeach
                        </select>
                        @error('tag')
                            <p class="mt-1.5 text-xs font-body text-crimson-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center gap-2 px-1 mt-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-crimson-500 shrink-0"></span>
                        <span class="font-body text-[10px] text-gray-400">Used for grouping & filtering on the frontend</span>
                    </div>
                </div>
            </div>

            {{-- ── PUBLIC URL ─────────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
                    <div class="h-4 w-0.5 bg-gray-400 rounded-full"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Public URL</h2>
                </div>
                <div class="p-5">
                    <label for="href" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                        Override URL path <span class="font-normal text-gray-400 ml-1">— optional</span>
                    </label>
                    <input type="text" id="href" name="href" value="{{ old('href', $isEdit ? $service->href : '') }}" placeholder="/services/enterprise-his-integration" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-mono text-gray-700 placeholder-gray-400 transition-all focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500">
                    <p class="mt-2 text-[10px] font-body text-gray-400 leading-relaxed">
                        Leave blank — auto-generated as <code class="bg-gray-100 px-1 rounded">/services/{slug}</code> when saved.
                    </p>
                </div>
            </div>

            {{-- ── LIVE PREVIEW CARD ──────────────── --}}
            <div class="bg-gray-50 border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
                    <div class="h-4 w-0.5 bg-gray-400 rounded-full"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Live Preview</h2>
                    <span class="ml-auto font-body text-[10px] text-gray-400">Updates as you type</span>
                </div>
                <div class="p-5">
                    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                        <div class="flex items-center gap-2.5 mb-3">
                            <div id="previewIcon" class="w-9 h-9 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center text-xl leading-none shrink-0">
                                {{ old('icon', $isEdit ? $service->icon : '📦') }}
                            </div>
                            <div>
                                <div id="previewName" class="font-display font-700 text-gray-900 text-sm leading-tight">
                                    {{ old('name', $isEdit ? $service->name : 'Service Name') }}
                                </div>
                                <div id="previewTag" class="text-[10px] text-gray-400 mt-0.5">
                                    {{ old('tag', $isEdit ? $service->tag : 'Tag') }}
                                </div>
                            </div>
                        </div>
                        <p id="previewTagline" class="font-body text-xs text-gray-500 italic mb-3 leading-relaxed">
                            "{{ old('tagline', $isEdit ? $service->tagline : 'Tagline will appear here') }}"
                        </p>
                        <div id="previewFeatures" class="space-y-1">
                            @foreach(array_slice(old('features', $isEdit ? ($service->features ?? []) : []), 0, 3) as $f)
                                @if($f)
                                    <div class="flex items-center gap-1.5 text-[10px] text-gray-500">
                                        <svg class="w-2.5 h-2.5 text-crimson-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        {{ $f }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form> {{-- ✅ MAIN FORM CLOSES HERE --}}

{{-- ══════════════════════════════════════════════
DANGER ZONE — SEPARATE FORM, outside main form
══════════════════════════════════════════════ --}}
@if($isEdit && Auth::guard('admin')->user()->can('delete_any'))
    <div class="mt-6 bg-white border border-crimson-500/15 rounded-2xl overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-crimson-500/10">
            <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
            <h2 class="font-display font-700 text-crimson-600 text-sm">Danger Zone</h2>
        </div>
        <div class="p-5">
            <p class="font-body text-xs text-gray-500 mb-4 leading-relaxed">
                Deleting this service is permanent and cannot be undone. The public service page will return a 404 immediately.
            </p>
            <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Permanently delete \'{{ addslashes($service->name) }}\'? This cannot be undone.')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-crimson-500/25 bg-crimson-500/5 text-sm font-display font-600 text-crimson-600 hover:bg-crimson-500 hover:text-white hover:border-crimson-500 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Delete this service
                </button>
            </form>
        </div>
    </div>
@endif
@endsection

@push('scripts')
<script>
(function () {
'use strict';

// ── Initial state ─────────────────────────────────────────
let isActive = document.getElementById('isActiveInput').value === '1';

// ── Active toggle ─────────────────────────────────────────
function updateActiveUI() {
    const input  = document.getElementById('isActiveInput');
    const sw     = document.getElementById('activeSwitch');
    const knob   = document.getElementById('activeSwitchKnob');
    const dot    = document.getElementById('statusDot');
    const label  = document.getElementById('statusLabel');
    const topBtn = document.getElementById('toggleActiveBtn');

    input.value = isActive ? '1' : '0';

    if (isActive) {
        sw.classList.add('bg-crimson-500');
        sw.classList.remove('bg-gray-300');
        knob.style.transform = 'translateX(20px)';
        dot.className = 'w-2 h-2 rounded-full shrink-0 bg-green-500';
        label.textContent = 'This service is active and visible on the public site';
        topBtn.textContent = 'Set Inactive';
        topBtn.className = 'flex items-center gap-2 px-4 py-2.5 rounded-xl border transition-all text-sm font-display font-600 border-gray-200 text-gray-600 hover:border-gray-300 hover:text-gray-800';
    } else {
        sw.classList.remove('bg-crimson-500');
        sw.classList.add('bg-gray-300');
        knob.style.transform = 'translateX(2px)';
        dot.className = 'w-2 h-2 rounded-full shrink-0 bg-gray-400';
        label.textContent = 'This service is inactive and hidden from the public site';
        topBtn.textContent = 'Set Active';
        topBtn.className = 'flex items-center gap-2 px-4 py-2.5 rounded-xl border transition-all text-sm font-display font-600 border-green-300 text-green-700 hover:bg-green-50';
    }
}

window.toggleActive = function () {
    isActive = !isActive;
    updateActiveUI();
};
updateActiveUI();

// ── Slug auto-generation from name ────────────────────────
const nameInput = document.getElementById('name');
const slugInput = document.getElementById('slug');
let slugManuallyEdited = slugInput.value.length > 0;

slugInput.addEventListener('input', () => { slugManuallyEdited = true; });

nameInput.addEventListener('input', () => {
    if (slugManuallyEdited) return;
    slugInput.value = nameInput.value.toLowerCase().trim().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');

    const hrefInput = document.getElementById('href');
    if (!hrefInput.value || hrefInput.value.startsWith('/services/')) {
        hrefInput.value = '/services/' + slugInput.value;
    }
    updatePreview();
});

// ── Icon preview ──────────────────────────────────────────
const iconInput = document.getElementById('icon');
iconInput.addEventListener('input', () => {
    const val = iconInput.value.trim() || '📦';
    document.getElementById('iconPreview').textContent = val;
    document.getElementById('previewIcon').textContent = val;
});

// ── Character counters ────────────────────────────────────
const taglineInput = document.getElementById('tagline');
const taglineCount = document.getElementById('taglineCount');
taglineInput.addEventListener('input', () => {
    taglineCount.textContent = taglineInput.value.length + '/160';
    updatePreview();
});

const descInput = document.getElementById('description');
const descCount = document.getElementById('descCount');
descInput.addEventListener('input', () => { descCount.textContent = descInput.value.length + ' chars'; });

// ── Tag sync ──────────────────────────────────────────────
const tagSelect = document.getElementById('tag');
tagSelect.addEventListener('change', () => {
    document.getElementById('previewTag').textContent = tagSelect.value || 'Tag';
});

// ── Live preview update ───────────────────────────────────
function updatePreview() {
    document.getElementById('previewName').textContent = nameInput.value.trim() || 'Service Name';
    const tagline = taglineInput.value.trim();
    document.getElementById('previewTagline').textContent = '"' + (tagline || 'Tagline will appear here') + '"';
}
nameInput.addEventListener('input', updatePreview);
taglineInput.addEventListener('input', updatePreview);

// ── Features — sync preview (first 3) ────────────────────
function syncFeaturePreview() {
    const container = document.getElementById('previewFeatures');
    const inputs    = document.querySelectorAll('#featuresContainer input[name="features[]"]');
    const items     = [];
    inputs.forEach(inp => { if (inp.value.trim()) items.push(inp.value.trim()); });

    container.innerHTML = items.slice(0, 3).map(f => `
        <div class="flex items-center gap-1.5 text-[10px] text-gray-500">
            <svg class="w-2.5 h-2.5 shrink-0 text-crimson-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
            ${f}
        </div>
    `).join('');
}
document.getElementById('featuresContainer').addEventListener('input', syncFeaturePreview);

// ── Add feature row ───────────────────────────────────────
window.addFeature = function () {
    const container = document.getElementById('featuresContainer');
    const row = document.createElement('div');
    row.className = 'feature-row flex items-center gap-2 group/row';
    row.innerHTML = `
        <div class="w-5 h-5 rounded-md bg-crimson-500/10 border border-crimson-500/20 flex items-center justify-center shrink-0">
            <svg class="w-3 h-3 text-crimson-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
        </div>
        <input type="text" name="features[]" placeholder="e.g. Real-time HL7/FHIR data synchronization" class="flex-1 px-3 py-2.5 rounded-xl border border-gray-200 text-sm font-body text-gray-800 placeholder-gray-400 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
        <button type="button" onclick="removeFeature(this)" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-300 hover:text-crimson-500 hover:border-crimson-500/30 hover:bg-crimson-500/5 transition-all shrink-0 opacity-0 group-hover/row:opacity-100">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    `;
    container.appendChild(row);
    row.querySelector('input').focus();
    row.querySelector('input').addEventListener('input', syncFeaturePreview);
};

// ── Remove feature row ────────────────────────────────────
window.removeFeature = function (btn) {
    const container = document.getElementById('featuresContainer');
    const row = btn.closest('.feature-row');
    if (container.querySelectorAll('.feature-row').length > 1) {
        row.remove();
        syncFeaturePreview();
    } else {
        row.querySelector('input').value = '';
        syncFeaturePreview();
    }
};

// ── Form validation before submit ────────────────────────
document.getElementById('serviceForm').addEventListener('submit', function (e) {
    const name     = nameInput.value.trim();
    const slug     = slugInput.value.trim();
    const tag      = tagSelect.value.trim();

    if (!name || !slug || !tag) {
        e.preventDefault();
        const firstEmpty = [nameInput, slugInput, tagSelect].find(el => !el.value.trim());
        if (firstEmpty) {
            firstEmpty.focus();
            firstEmpty.classList.add('border-crimson-500', 'ring-crimson-500');
        }
    }
});
})();
</script>
@endpush