@extends('admin.layouts.app')
@php
$isEdit  = isset($project) && $project->exists;
$title   = $isEdit ? 'Edit Project' : 'New Project';
$action  = $isEdit
    ? route('admin.projects.update', $project)
    : route('admin.projects.store');

// Helper for field values with proper null handling
$val = fn(string $field, $fallback = '') =>
    old($field, $isEdit ? ($project->{$field} ?? $fallback) : $fallback);

$valJson = fn(string $field) =>
    old($field, $isEdit ? ($project->{$field} ?? []) : []);
@endphp
@section('title', $title)
@section('page-title', $title)
@section('breadcrumb')
    <div class="flex items-center gap-2 text-xs font-body text-gray-400">
        <a href="{{ route('admin.projects.index') }}"
           class="hover:text-crimson-500 transition-colors">Projects</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-gray-600">{{ $isEdit ? $project->title : 'New Project' }}</span>
    </div>
@endsection
@section('content')<form method="POST"
      action="{{ $action }}"
      enctype="multipart/form-data"
      id="projectForm"
      novalidate>
    @csrf
    @if($isEdit) @method('PUT') @endif

    
    <input type="hidden" name="is_active" id="isActiveInput"
           value="{{ old('is_active', $isEdit ? ($project->is_active ? '1' : '0') : '1') }}">
    <input type="hidden" name="is_featured" id="isFeaturedInput"
           value="{{ old('is_featured', $isEdit ? ($project->is_featured ? '1' : '0') : '0') }}"><div class="flex flex-wrap items-center justify-between gap-3 mb-6">

        <a href="{{ route('admin.projects.index') }}"
           class="flex items-center gap-2 text-sm font-body text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to projects
        </a>

        <div class="flex items-center gap-2">

            
            <button type="button" id="topToggleBtn" onclick="toggleActive()"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-xl border text-sm font-display font-600 transition-all">
            </button>

            {{-- @if($isEdit && $project->slug)
                <a href="{{ route('public.projects.show', $project->slug) }}"
                   target="_blank"
                   class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200
                          text-sm font-display font-600 text-gray-600
                          hover:border-gray-300 hover:text-gray-900 transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Preview
                </a>
            @endif --}}

            <button type="submit"
                    class="flex items-center gap-2 px-6 py-2.5 rounded-xl bg-crimson-500 text-white
                           text-sm font-display font-700 hover:bg-crimson-600 transition-all
                           hover:shadow-lg hover:shadow-crimson-500/25 focus:outline-none
                           focus:ring-2 focus:ring-crimson-500 focus:ring-offset-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                {{ $isEdit ? 'Save Changes' : 'Create Project' }}
            </button>
        </div>
    </div>@if($errors->any())
        <div class="flex items-start gap-3 px-5 py-4 rounded-2xl bg-crimson-500/5
                    border border-crimson-500/20 mb-5">
            <svg class="w-5 h-5 text-crimson-500 shrink-0 mt-0.5" fill="none"
                 stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="font-display font-700 text-sm text-crimson-700 mb-1.5">
                    {{ $errors->count() }} error{{ $errors->count() !== 1 ? 's' : '' }} — please fix before saving
                </p>
                <ul class="space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="font-body text-xs text-crimson-600 flex items-center gap-1.5">
                            <span class="w-1 h-1 rounded-full bg-crimson-400 shrink-0"></span>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif<div class="grid grid-cols-1 xl:grid-cols-[1fr_320px] gap-5"><div class="space-y-5">


            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="w-1 h-5 bg-crimson-500 rounded-full shrink-0"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Project Info</h2>
                </div>

                <div class="p-6 space-y-5">

                    
                    <div>
                        <label for="title"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Project Title <span class="text-crimson-500">*</span>
                        </label>
                        <input type="text" id="title" name="title"
                               value="{{ $val('title') }}"
                               placeholder="e.g. HIS Full Deployment — DHQ Hospital Rahim Yar Khan"
                               required autofocus
                               class="w-full px-4 py-3 rounded-xl border text-sm font-body text-gray-800
                                      placeholder-gray-400 transition-all focus:outline-none focus:ring-1
                                      @error('title') border-crimson-500 ring-crimson-500 bg-crimson-500/3
                                      @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">
                        @error('title')
                            <p class="mt-1.5 text-xs text-crimson-600 flex items-center gap-1 font-body">
                                <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    
                    <div>
                        <label for="slug"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Slug <span class="text-crimson-500">*</span>
                            <span class="font-normal text-gray-400 ml-1">— auto-generated from title</span>
                        </label>
                        <div class="flex">
                            <span class="px-3 py-3 bg-gray-50 border border-r-0 border-gray-200
                                         rounded-l-xl text-xs font-mono text-gray-400 shrink-0 whitespace-nowrap">
                                /projects/
                            </span>
                            <input type="text" id="slug" name="slug"
                                   value="{{ $val('slug') }}"
                                   placeholder="dhq-hospital-ryk"
                                   class="flex-1 min-w-0 px-4 py-3 rounded-r-xl border text-sm font-mono
                                          text-gray-700 placeholder-gray-400 transition-all
                                          focus:outline-none focus:ring-1
                                          @error('slug') border-crimson-500 ring-crimson-500 bg-crimson-500/3
                                          @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">
                        </div>
                        @error('slug')
                            <p class="mt-1.5 text-xs text-crimson-600 font-body">{{ $message }}</p>
                        @enderror
                    </div>

                    
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="summary"
                                   class="font-body text-xs font-600 text-gray-700">
                                Summary <span class="text-crimson-500">*</span>
                            </label>
                            <span id="summaryCount" class="text-[10px] font-body text-gray-400">
                                {{ strlen($val('summary')) }} chars
                            </span>
                        </div>
                        <textarea id="summary" name="summary" rows="3"
                                  placeholder="A concise 2–3 sentence description shown on the project listing card…"
                                  required
                                  class="w-full px-4 py-3 rounded-xl border text-sm font-body
                                         text-gray-800 placeholder-gray-400 resize-none leading-relaxed
                                         transition-all focus:outline-none focus:ring-1
                                         @error('summary') border-crimson-500 ring-crimson-500 bg-crimson-500/3
                                         @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">{{ $val('summary') }}</textarea>
                        @error('summary')
                            <p class="mt-1.5 text-xs text-crimson-600 font-body">{{ $message }}</p>
                        @enderror
                    </div>

                    
                    <div>
                        <label for="description"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Full Description
                            <span class="font-normal text-gray-400 ml-1">— shown on the project detail page</span>
                        </label>
                        <textarea id="description" name="description" rows="7"
                                  placeholder="Detailed case study — background, scope, challenges, and solution…"
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-body
                                         text-gray-800 placeholder-gray-400 resize-y leading-relaxed
                                         transition-all focus:outline-none focus:border-crimson-500
                                         focus:ring-1 focus:ring-crimson-500">{{ $val('description') }}</textarea>
                    </div>

                </div>
            </div>


            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="w-1 h-5 bg-crimson-500 rounded-full shrink-0"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Client / Hospital</h2>
                </div>

                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

                    
                    <div class="sm:col-span-2">
                        <label for="client_name"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Hospital / Organisation Name <span class="text-crimson-500">*</span>
                        </label>
                        <input type="text" id="client_name" name="client_name"
                               value="{{ $val('client_name') }}"
                               placeholder="e.g. DHQ Hospital Rahim Yar Khan"
                               required
                               class="w-full px-4 py-3 rounded-xl border text-sm font-body text-gray-800
                                      placeholder-gray-400 transition-all focus:outline-none focus:ring-1
                                      @error('client_name') border-crimson-500 ring-crimson-500 bg-crimson-500/3
                                      @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">
                        @error('client_name')
                            <p class="mt-1.5 text-xs text-crimson-600 font-body">{{ $message }}</p>
                        @enderror
                    </div>

                    
                    <div>
                        <label for="client_city"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">City</label>
                        <input type="text" id="client_city" name="client_city"
                               value="{{ $val('client_city') }}"
                               placeholder="e.g. Rahim Yar Khan"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm
                                      font-body text-gray-800 placeholder-gray-400
                                      focus:outline-none focus:border-crimson-500 focus:ring-1
                                      focus:ring-crimson-500 transition-all">
                    </div>

                    
                    <div>
                        <label for="client_province"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">Province</label>
                        <input type="text" id="client_province" name="client_province"
                               value="{{ $val('client_province') }}"
                               placeholder="e.g. Punjab"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm
                                      font-body text-gray-800 placeholder-gray-400
                                      focus:outline-none focus:border-crimson-500 focus:ring-1
                                      focus:ring-crimson-500 transition-all">
                    </div>

                    
                    <div>
                        <label for="client_type"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Organisation Type <span class="text-crimson-500">*</span>
                        </label>
                        <select id="client_type" name="client_type" required
                                class="w-full px-4 py-3 rounded-xl border text-sm font-body text-gray-800
                                       cursor-pointer transition-all focus:outline-none focus:ring-1
                                       @error('client_type') border-crimson-500 ring-crimson-500
                                       @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">
                            <option value="" disabled @selected(!$val('client_type'))>Choose type…</option>
                            @foreach(\App\Models\Project::CLIENT_TYPES as $typeKey => $typeLabel)
                                <option value="{{ $typeKey }}"
                                    @selected($val('client_type') === $typeKey)>
                                    {{ $typeLabel }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_type')
                            <p class="mt-1.5 text-xs text-crimson-600 font-body">{{ $message }}</p>
                        @enderror
                    </div>

                    
                    <div>
                        <label for="testimonial_id"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Linked Testimonial
                            <span class="font-normal text-gray-400 ml-1">— optional</span>
                        </label>
                        <select id="testimonial_id" name="testimonial_id"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm
                                       font-body text-gray-800 cursor-pointer transition-all
                                       focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500">
                            <option value="">No testimonial linked</option>
                            @foreach(\App\Models\Testimonial::active()->ordered()->get() as $t)
                                <option value="{{ $t->id }}"
                                    @selected($val('testimonial_id') == $t->id)>
                                    {{ $t->author_name }} — {{ $t->hospital }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1.5 text-[10px] font-body text-gray-400">
                            Links a quote from the Testimonials section to this project page.
                        </p>
                    </div>

                </div>
            </div>


            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="w-1 h-5 bg-crimson-500 rounded-full shrink-0"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Timeline</h2>
                </div>

                <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-5">

                    <div>
                        <label for="start_date"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Start Date
                        </label>
                        <input type="date" id="start_date" name="start_date"
                               value="{{ $val('start_date') }}"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm
                                      font-body text-gray-800 focus:outline-none focus:border-crimson-500
                                      focus:ring-1 focus:ring-crimson-500 transition-all cursor-pointer">
                    </div>

                    <div>
                        <label for="completion_date"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Completion Date
                        </label>
                        <input type="date" id="completion_date" name="completion_date"
                               value="{{ $val('completion_date') }}"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm
                                      font-body text-gray-800 focus:outline-none focus:border-crimson-500
                                      focus:ring-1 focus:ring-crimson-500 transition-all cursor-pointer">
                    </div>

                    <div>
                        <label for="duration_months"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Duration (months)
                            <span class="font-normal text-gray-400 ml-1">— auto-calculated</span>
                        </label>
                        <input type="number" id="duration_months" name="duration_months"
                               value="{{ $val('duration_months') }}"
                               min="0" max="120"
                               placeholder="Auto"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm
                                      font-body text-gray-800 placeholder-gray-400
                                      focus:outline-none focus:border-crimson-500 focus:ring-1
                                      focus:ring-crimson-500 transition-all">
                        <p class="mt-1.5 text-[10px] font-body text-gray-400">
                            Calculated from dates if left blank
                        </p>
                    </div>

                </div>
            </div>


            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-1 h-5 bg-crimson-500 rounded-full shrink-0"></div>
                        <h2 class="font-display font-700 text-gray-900 text-sm">Modules Deployed</h2>
                    </div>
                    <span id="moduleSelectedCount"
                          class="font-body text-xs text-gray-400">
                        0 selected
                    </span>
                </div>

                <div class="p-6">
                    <p class="font-body text-xs text-gray-500 mb-4">
                        Select every HIS module that was deployed as part of this project.
                    </p>

                    @php
                        $deployedModules = $valJson('modules_deployed');
                        $allProducts     = \App\Models\Product::active()->ordered()->get()
                                            ->groupBy('category');
                    @endphp

                    <div class="space-y-5">
                        @foreach($allProducts as $catKey => $catProducts)
                            <div>
                                
                                <p class="font-body text-[10px] font-700 text-gray-400 tracking-widest
                                          uppercase mb-2">
                                    {{ \App\Models\Product::CATEGORIES[$catKey] ?? $catKey }}
                                </p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5">
                                    @foreach($catProducts as $prod)
                                        <label class="module-checkbox flex items-center gap-2.5 px-3 py-2.5
                                                      rounded-xl border border-gray-200 cursor-pointer
                                                      transition-all hover:border-crimson-500/30
                                                      hover:bg-crimson-500/3 group has-[:checked]:border-crimson-500
                                                      has-[:checked]:bg-crimson-500/5">
                                            <input type="checkbox"
                                                   name="modules_deployed[]"
                                                   value="{{ $prod->slug }}"
                                                   @checked(in_array($prod->slug, $deployedModules))
                                                   class="w-3.5 h-3.5 rounded border-gray-300 text-crimson-500
                                                          focus:ring-crimson-500 focus:ring-offset-0
                                                          accent-crimson-500">
                                            <span class="text-lg leading-none">{{ $prod->icon ?? '📦' }}</span>
                                            <span class="font-body text-xs text-gray-700 group-has-[:checked]:text-crimson-700
                                                         group-has-[:checked]:font-600 transition-colors leading-tight">
                                                {{ $prod->name }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="w-1 h-5 bg-gray-400 rounded-full shrink-0"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Services Provided</h2>
                </div>

                <div class="p-6">
                    @php $deployedServices = $valJson('services_provided'); @endphp
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5">
                        @foreach(\App\Models\Service::active()->ordered()->get() as $svc)
                            <label class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl border
                                          border-gray-200 cursor-pointer transition-all
                                          hover:border-crimson-500/30 hover:bg-crimson-500/3
                                          has-[:checked]:border-crimson-500 has-[:checked]:bg-crimson-500/5">
                                <input type="checkbox"
                                       name="services_provided[]"
                                       value="{{ $svc->slug }}"
                                       @checked(in_array($svc->slug, $deployedServices))
                                       class="w-3.5 h-3.5 rounded border-gray-300 accent-crimson-500
                                              focus:ring-crimson-500 focus:ring-offset-0">
                                <span class="font-body text-xs text-gray-700 has-[:checked]:text-crimson-700
                                             has-[:checked]:font-600 transition-colors">
                                    {{ $svc->name }}
                                </span>
                                <span class="ml-auto text-[9px] font-display font-600 tracking-wide
                                             text-gray-400 uppercase">
                                    {{ $svc->tag }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>


            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="w-1 h-5 bg-crimson-500 rounded-full shrink-0"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Project Outcomes</h2>
                    <span class="ml-auto font-body text-xs text-gray-400">
                        Shown as bullet points on the detail page
                    </span>
                </div>

                <div class="p-6">
                    <div id="outcomesContainer" class="space-y-2 mb-3">
                        @php
                            $outcomes = $valJson('outcomes');
                            if (empty($outcomes)) $outcomes = [''];
                        @endphp
                        @foreach($outcomes as $outcome)
                            <div class="outcome-row flex items-center gap-2 group/row">
                                <div class="w-5 h-5 rounded-md bg-crimson-500/10 border border-crimson-500/20
                                            flex items-center justify-center shrink-0">
                                    <svg class="w-3 h-3 text-crimson-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <input type="text" name="outcomes[]"
                                       value="{{ $outcome }}"
                                       placeholder="e.g. Patient registration time reduced by 70%"
                                       class="flex-1 px-3 py-2.5 rounded-xl border border-gray-200 text-sm
                                              font-body text-gray-800 placeholder-gray-400 transition-all
                                              focus:outline-none focus:border-crimson-500 focus:ring-1
                                              focus:ring-crimson-500">
                                <button type="button" onclick="removeRow(this, 'outcomesContainer')"
                                        class="w-7 h-7 rounded-lg border border-gray-200 flex items-center
                                               justify-center text-gray-300 hover:text-crimson-500
                                               hover:border-crimson-500/30 hover:bg-crimson-500/5
                                               transition-all shrink-0 opacity-0 group-hover/row:opacity-100">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('outcomesContainer', 'outcomes[]', 'e.g. Patient registration time reduced by 70%')"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-dashed
                                   border-gray-300 text-sm font-display font-600 text-gray-500 w-full
                                   justify-center hover:border-crimson-500/40 hover:text-crimson-600
                                   hover:bg-crimson-500/3 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                  d="M12 4v16m8-8H4"/>
                        </svg>
                        Add outcome
                    </button>
                </div>
            </div>


            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="w-1 h-5 bg-gray-400 rounded-full shrink-0"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Stats / Key Numbers</h2>
                    <span class="ml-auto font-body text-xs text-gray-400">Shown on the project card</span>
                </div>

                <div class="p-6">
                    <p class="font-body text-xs text-gray-500 mb-4">
                        Add key numbers that showcase the project's scale.
                        Each stat has a label and a value.
                    </p>

                    @php
                        $stats = old('stats', $isEdit ? ($project->stats ?? []) : []);
                        // Convert associative to indexed for the form
                        $statsRows = [];
                        if (is_array($stats)) {
                            foreach ($stats as $k => $v) {
                                $statsRows[] = ['key' => $k, 'value' => $v];
                            }
                        }
                        if (empty($statsRows)) {
                            $statsRows = [
                                ['key' => 'beds', 'value' => ''],
                                ['key' => 'departments', 'value' => ''],
                                ['key' => 'staff_trained', 'value' => ''],
                            ];
                        }
                    @endphp

                    <div id="statsContainer" class="space-y-2 mb-3">
                        @foreach($statsRows as $stat)
                            <div class="stat-row flex items-center gap-2 group/row">
                                <input type="text"
                                       name="stat_keys[]"
                                       value="{{ $stat['key'] }}"
                                       placeholder="Label (e.g. beds)"
                                       class="w-32 shrink-0 px-3 py-2.5 rounded-xl border border-gray-200
                                              text-sm font-body text-gray-700 placeholder-gray-400
                                              focus:outline-none focus:border-crimson-500 focus:ring-1
                                              focus:ring-crimson-500 transition-all bg-gray-50">
                                <span class="text-gray-400 text-sm shrink-0">→</span>
                                <input type="text"
                                       name="stat_values[]"
                                       value="{{ $stat['value'] }}"
                                       placeholder="Value (e.g. 400+)"
                                       class="flex-1 px-3 py-2.5 rounded-xl border border-gray-200
                                              text-sm font-body text-gray-800 placeholder-gray-400
                                              focus:outline-none focus:border-crimson-500 focus:ring-1
                                              focus:ring-crimson-500 transition-all">
                                <button type="button" onclick="removeStatRow(this)"
                                        class="w-7 h-7 rounded-lg border border-gray-200 flex items-center
                                               justify-center text-gray-300 hover:text-crimson-500
                                               hover:border-crimson-500/30 hover:bg-crimson-500/5
                                               transition-all shrink-0 opacity-0 group-hover/row:opacity-100">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" onclick="addStatRow()"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-dashed
                                   border-gray-300 text-sm font-display font-600 text-gray-500 w-full
                                   justify-center hover:border-crimson-500/40 hover:text-crimson-600
                                   hover:bg-crimson-500/3 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                  d="M12 4v16m8-8H4"/>
                        </svg>
                        Add stat
                    </button>

                    <p class="mt-3 text-[10px] font-body text-gray-400">
                        Suggested labels: beds, departments, staff_trained, modules, years_running
                    </p>
                </div>
            </div>


            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="w-1 h-5 bg-gray-300 rounded-full shrink-0"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">SEO</h2>
                    <span class="ml-auto font-body text-xs text-gray-400">Optional</span>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label for="meta_title"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">Meta Title</label>
                        <input type="text" id="meta_title" name="meta_title"
                               value="{{ $val('meta_title') }}"
                               placeholder="Leave blank to use project title"
                               maxlength="70"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm
                                      font-body text-gray-800 placeholder-gray-400 transition-all
                                      focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500">
                        <p class="mt-1 text-[10px] font-body text-gray-400">Recommended: 50–60 characters</p>
                    </div>
                    <div>
                        <label for="meta_description"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">Meta Description</label>
                        <textarea id="meta_description" name="meta_description" rows="3"
                                  placeholder="Leave blank to use summary"
                                  maxlength="165"
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm
                                         font-body text-gray-800 placeholder-gray-400 resize-none
                                         transition-all focus:outline-none focus:border-crimson-500
                                         focus:ring-1 focus:ring-crimson-500">{{ $val('meta_description') }}</textarea>
                        <p class="mt-1 text-[10px] font-body text-gray-400">Recommended: 150–160 characters</p>
                    </div>
                </div>
            </div>


        </div><div class="space-y-5">


            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
                    <div class="w-1 h-5 bg-crimson-500 rounded-full shrink-0"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Status</h2>
                </div>
                <div class="p-5 space-y-3">

                    
                    <div class="flex items-center justify-between p-3.5 rounded-xl bg-gray-50 border border-gray-200">
                        <div>
                            <div class="font-body text-sm font-600 text-gray-800">Active</div>
                            <div class="font-body text-xs text-gray-400 mt-0.5">
                                Visible on projects page
                            </div>
                        </div>
                        <button type="button" id="activeSwitch" onclick="toggleActive()"
                                class="relative inline-flex h-6 w-11 items-center rounded-full
                                       transition-colors duration-200 focus:outline-none shrink-0">
                            <span id="activeSwitchKnob"
                                  class="inline-block h-4 w-4 transform rounded-full bg-white
                                         shadow-sm transition-transform duration-200">
                            </span>
                        </button>
                    </div>

                    
                    <div class="flex items-center justify-between p-3.5 rounded-xl bg-gray-50 border border-gray-200">
                        <div>
                            <div class="font-body text-sm font-600 text-gray-800">Featured</div>
                            <div class="font-body text-xs text-gray-400 mt-0.5">
                                Shown in homepage / featured section
                            </div>
                        </div>
                        <button type="button" id="featuredSwitch" onclick="toggleFeatured()"
                                class="relative inline-flex h-6 w-11 items-center rounded-full
                                       transition-colors duration-200 focus:outline-none shrink-0">
                            <span id="featuredSwitchKnob"
                                  class="inline-block h-4 w-4 transform rounded-full bg-white
                                         shadow-sm transition-transform duration-200">
                            </span>
                        </button>
                    </div>

                    
                    <div class="flex items-center gap-2 px-1">
                        <span id="statusDot" class="w-2 h-2 rounded-full shrink-0"></span>
                        <span id="statusLabel" class="font-body text-xs text-gray-500"></span>
                    </div>

                </div>
            </div>


            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
                    <div class="w-1 h-5 bg-gray-400 rounded-full shrink-0"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Display</h2>
                </div>
                <div class="p-5">
                    <label for="sort_order"
                           class="block font-body text-xs font-600 text-gray-700 mb-1.5">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order"
                           value="{{ $val('sort_order', $isEdit ? $project->sort_order : (\App\Models\Project::max('sort_order') ?? 0) + 1) }}"
                           min="0" max="999"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm
                                  font-body text-gray-800 focus:outline-none focus:border-crimson-500
                                  focus:ring-1 focus:ring-crimson-500 transition-all">
                    <p class="mt-1.5 text-[10px] font-body text-gray-400">Lower numbers appear first</p>
                </div>
            </div>


            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
                    <div class="w-1 h-5 bg-crimson-500 rounded-full shrink-0"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Featured Image</h2>
                </div>
                <div class="p-5">

                    
                    @if($isEdit && $project->featured_image)
                        <div class="mb-4 rounded-xl overflow-hidden border border-gray-200">
                            <img src="{{ asset('storage/' . $project->featured_image) }}"
                                 alt="{{ $project->featured_image_alt ?? $project->title }}"
                                 class="w-full h-32 object-cover">
                        </div>
                    @endif

                    
                    <div id="imageDropzone"
                         class="relative border-2 border-dashed border-gray-200 rounded-xl
                                p-6 text-center cursor-pointer transition-all
                                hover:border-crimson-500/40 hover:bg-crimson-500/3"
                         onclick="document.getElementById('featured_image').click()">
                        <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="font-body text-xs text-gray-500 mb-1">
                            Click to upload or drag & drop
                        </p>
                        <p class="font-body text-[10px] text-gray-400">JPG, PNG, WebP — max 2MB</p>
                        <div id="imagePreviewWrap" class="hidden mt-3">
                            <img id="imagePreviewEl" src="" alt="Preview"
                                 class="w-full h-24 object-cover rounded-lg border border-gray-200">
                            <p id="imagePreviewName"
                               class="mt-1 text-[10px] font-body text-gray-500 truncate"></p>
                        </div>
                    </div>

                    <input type="file" id="featured_image" name="featured_image"
                           accept="image/jpeg,image/png,image/webp"
                           class="hidden">

                    <div class="mt-3">
                        <label for="featured_image_alt"
                               class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Alt Text
                        </label>
                        <input type="text" id="featured_image_alt" name="featured_image_alt"
                               value="{{ $val('featured_image_alt') }}"
                               placeholder="Describe the image for accessibility"
                               class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm
                                      font-body text-gray-800 placeholder-gray-400 transition-all
                                      focus:outline-none focus:border-crimson-500 focus:ring-1
                                      focus:ring-crimson-500">
                    </div>
                </div>
            </div>


            
            <div class="bg-gray-50 border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
                    <div class="w-1 h-5 bg-gray-300 rounded-full shrink-0"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Card Preview</h2>
                    <span class="ml-auto font-body text-[10px] text-gray-400">Live</span>
                </div>
                <div class="p-4">
                    <div class="rounded-xl border border-gray-200 bg-white overflow-hidden shadow-sm">
                        
                        <div id="previewImageBg"
                             class="h-24 bg-gray-100 flex items-center justify-center border-b border-gray-100">
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="p-4">
                            <p id="previewType"
                               class="text-[10px] font-display font-600 text-crimson-500 uppercase
                                      tracking-widest mb-1">
                                {{ $val('client_type') ?: 'Type' }}
                            </p>
                            <h3 id="previewTitle"
                                class="font-display font-700 text-gray-900 text-sm leading-snug mb-1.5">
                                {{ $val('title') ?: 'Project title' }}
                            </h3>
                            <p id="previewClient"
                               class="font-body text-xs text-gray-500 mb-2">
                                {{ $val('client_name') ?: 'Client name' }}
                                @if($val('client_city'))
                                    · {{ $val('client_city') }}
                                @endif
                            </p>
                            <p id="previewSummary"
                               class="font-body text-xs text-gray-400 leading-relaxed line-clamp-2">
                                {{ $val('summary') ?: 'Project summary will appear here.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</form>@if($isEdit && Auth::guard('admin')->user()->can('delete_any'))
<div class="mt-6 bg-white border border-crimson-500/15 rounded-2xl overflow-hidden">
    <div class="flex items-center gap-3 px-5 py-4 border-b border-crimson-500/10">
        <div class="w-1 h-5 bg-crimson-500 rounded-full shrink-0"></div>
        <h2 class="font-display font-700 text-crimson-600 text-sm">Danger Zone</h2>
    </div>
    <div class="p-5">
        <p class="font-body text-xs text-gray-500 mb-4 leading-relaxed">
            Permanently delete this project. This cannot be undone and the
            public page will return a 404 immediately.
        </p>
        <form method="POST"
              action="{{ route('admin.projects.destroy', $project) }}"
              onsubmit="return confirm('Permanently delete \'{{ addslashes($project->title) }}\'?')"
              class="inline">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5
                           rounded-xl border border-crimson-500/25 bg-crimson-500/5
                           text-sm font-display font-600 text-crimson-600
                           hover:bg-crimson-500 hover:text-white hover:border-crimson-500
                           transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete this project
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

    // ══════════════════════════════════════════════
    // ACTIVE TOGGLE
    // ══════════════════════════════════════════════
    let isActive   = document.getElementById('isActiveInput').value === '1';
    let isFeatured = document.getElementById('isFeaturedInput').value === '1';

    function updateActiveUI() {
        const input    = document.getElementById('isActiveInput');
        const sw       = document.getElementById('activeSwitch');
        const knob     = document.getElementById('activeSwitchKnob');
        const dot      = document.getElementById('statusDot');
        const label    = document.getElementById('statusLabel');
        const topBtn   = document.getElementById('topToggleBtn');

        input.value = isActive ? '1' : '0';

        if (isActive) {
            sw.classList.add('bg-crimson-500');
            sw.classList.remove('bg-gray-300');
            knob.style.transform = 'translateX(20px)';
            dot.className = 'w-2 h-2 rounded-full shrink-0 bg-green-500';
            label.textContent = 'Active — visible on the public site';
            topBtn.textContent = 'Set Inactive';
            topBtn.className = 'flex items-center gap-2 px-4 py-2.5 rounded-xl border text-sm font-display font-600 transition-all border-gray-200 text-gray-600 hover:border-gray-300';
        } else {
            sw.classList.remove('bg-crimson-500');
            sw.classList.add('bg-gray-300');
            knob.style.transform = 'translateX(2px)';
            dot.className = 'w-2 h-2 rounded-full shrink-0 bg-gray-400';
            label.textContent = 'Inactive — hidden from the public site';
            topBtn.textContent = 'Set Active';
            topBtn.className = 'flex items-center gap-2 px-4 py-2.5 rounded-xl border text-sm font-display font-600 transition-all border-green-300 text-green-700 hover:bg-green-50';
        }
    }

    function updateFeaturedUI() {
        const input = document.getElementById('isFeaturedInput');
        const sw    = document.getElementById('featuredSwitch');
        const knob  = document.getElementById('featuredSwitchKnob');

        input.value = isFeatured ? '1' : '0';

        if (isFeatured) {
            sw.classList.add('bg-crimson-500');
            sw.classList.remove('bg-gray-300');
            knob.style.transform = 'translateX(20px)';
        } else {
            sw.classList.remove('bg-crimson-500');
            sw.classList.add('bg-gray-300');
            knob.style.transform = 'translateX(2px)';
        }
    }

    window.toggleActive   = () => { isActive   = !isActive;   updateActiveUI(); };
    window.toggleFeatured = () => { isFeatured = !isFeatured; updateFeaturedUI(); };

    updateActiveUI();
    updateFeaturedUI();


    // ══════════════════════════════════════════════
    // SLUG AUTO-GENERATION
    // ══════════════════════════════════════════════
    const titleInput = document.getElementById('title');
    const slugInput  = document.getElementById('slug');
    let slugEdited   = slugInput.value.length > 0;

    slugInput.addEventListener('input', () => { slugEdited = true; });

    function toSlug(str) {
        return str.toLowerCase().trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
    }

    titleInput.addEventListener('input', () => {
        updatePreview();
        if (slugEdited) return;
        slugInput.value = toSlug(titleInput.value);
    });


    // ══════════════════════════════════════════════
    // CHARACTER COUNTER — summary
    // ══════════════════════════════════════════════
    const summaryEl    = document.getElementById('summary');
    const summaryCount = document.getElementById('summaryCount');

    summaryEl.addEventListener('input', () => {
        summaryCount.textContent = summaryEl.value.length + ' chars';
        updatePreview();
    });


    // ══════════════════════════════════════════════
    // LIVE PREVIEW SYNC
    // ══════════════════════════════════════════════
    function updatePreview() {
        const previewTitle   = document.getElementById('previewTitle');
        const previewClient  = document.getElementById('previewClient');
        const previewSummary = document.getElementById('previewSummary');
        const previewType    = document.getElementById('previewType');

        previewTitle.textContent  = titleInput.value.trim() || 'Project title';
        previewSummary.textContent = summaryEl.value.trim() || 'Project summary will appear here.';

        const clientName = document.getElementById('client_name').value.trim();
        const clientCity = document.getElementById('client_city').value.trim();
        previewClient.textContent = (clientName || 'Client name') + (clientCity ? ' · ' + clientCity : '');

        const typeSelect = document.getElementById('client_type');
        previewType.textContent = typeSelect.options[typeSelect.selectedIndex]?.text || 'Type';
    }

    document.getElementById('client_name').addEventListener('input', updatePreview);
    document.getElementById('client_city').addEventListener('input', updatePreview);
    document.getElementById('client_type').addEventListener('change', updatePreview);


    // ══════════════════════════════════════════════
    // IMAGE UPLOAD PREVIEW
    // ══════════════════════════════════════════════
    const fileInput      = document.getElementById('featured_image');
    const dropzone       = document.getElementById('imageDropzone');
    const previewWrap    = document.getElementById('imagePreviewWrap');
    const previewEl      = document.getElementById('imagePreviewEl');
    const previewName    = document.getElementById('imagePreviewName');
    const previewImageBg = document.getElementById('previewImageBg');

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            previewEl.src   = e.target.result;
            previewName.textContent = file.name;
            previewWrap.classList.remove('hidden');

            // Update card preview image area
            previewImageBg.innerHTML = `
                <img src="${e.target.result}" alt="Preview"
                     class="w-full h-full object-cover">
            `;
        };
        reader.readAsDataURL(file);
    });

    // Drag & drop
    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('border-crimson-500', 'bg-crimson-500/5');
    });
    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('border-crimson-500', 'bg-crimson-500/5');
    });
    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-crimson-500', 'bg-crimson-500/5');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            fileInput.files = dt.files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });


    // ══════════════════════════════════════════════
    // MODULE SELECTED COUNT
    // ══════════════════════════════════════════════
    function updateModuleCount() {
        const checked = document.querySelectorAll('input[name="modules_deployed[]"]:checked').length;
        document.getElementById('moduleSelectedCount').textContent =
            checked + ' module' + (checked !== 1 ? 's' : '') + ' selected';
    }

    document.querySelectorAll('input[name="modules_deployed[]"]')
            .forEach(cb => cb.addEventListener('change', updateModuleCount));
    updateModuleCount(); // run on load for edit mode


    // ══════════════════════════════════════════════
    // GENERIC ADD ROW (outcomes)
    // ══════════════════════════════════════════════
    window.addRow = function (containerId, inputName, placeholder) {
        const container = document.getElementById(containerId);
        const row = document.createElement('div');
        const rowClass = containerId === 'outcomesContainer' ? 'outcome-row' : 'generic-row';
        row.className = `${rowClass} flex items-center gap-2 group/row`;
        row.innerHTML = `
            <div class="w-5 h-5 rounded-md bg-crimson-500/10 border border-crimson-500/20 flex items-center justify-center shrink-0">
                <svg class="w-3 h-3 text-crimson-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
            </div>
            <input type="text" name="${inputName}" placeholder="${placeholder}"
                   class="flex-1 px-3 py-2.5 rounded-xl border border-gray-200 text-sm font-body
                          text-gray-800 placeholder-gray-400 transition-all focus:outline-none
                          focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500">
            <button type="button" onclick="removeRow(this, '${containerId}')"
                    class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center
                           text-gray-300 hover:text-crimson-500 hover:border-crimson-500/30
                           hover:bg-crimson-500/5 transition-all shrink-0 opacity-0 group-hover/row:opacity-100">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;
        container.appendChild(row);
        row.querySelector('input').focus();
    };

    window.removeRow = function (btn, containerId) {
        const container = document.getElementById(containerId);
        const row = btn.closest('[class*="-row"]');
        if (container.querySelectorAll('[class*="-row"]').length > 1) {
            row.remove();
        } else {
            row.querySelector('input').value = '';
        }
    };


    // ══════════════════════════════════════════════
    // STATS ROWS
    // ══════════════════════════════════════════════
    window.addStatRow = function () {
        const container = document.getElementById('statsContainer');
        const row = document.createElement('div');
        row.className = 'stat-row flex items-center gap-2 group/row';
        row.innerHTML = `
            <input type="text" name="stat_keys[]" placeholder="Label (e.g. beds)"
                   class="w-32 shrink-0 px-3 py-2.5 rounded-xl border border-gray-200 text-sm
                          font-body text-gray-700 placeholder-gray-400 focus:outline-none
                          focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all bg-gray-50">
            <span class="text-gray-400 text-sm shrink-0">→</span>
            <input type="text" name="stat_values[]" placeholder="Value (e.g. 400+)"
                   class="flex-1 px-3 py-2.5 rounded-xl border border-gray-200 text-sm
                          font-body text-gray-800 placeholder-gray-400 focus:outline-none
                          focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
            <button type="button" onclick="removeStatRow(this)"
                    class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center
                           text-gray-300 hover:text-crimson-500 hover:border-crimson-500/30
                           hover:bg-crimson-500/5 transition-all shrink-0 opacity-0 group-hover/row:opacity-100">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;
        container.appendChild(row);
        row.querySelector('input').focus();
    };

    window.removeStatRow = function (btn) {
        const container = document.getElementById('statsContainer');
        const row = btn.closest('.stat-row');
        if (container.querySelectorAll('.stat-row').length > 1) {
            row.remove();
        } else {
            row.querySelectorAll('input').forEach(i => i.value = '');
        }
    };


    // ══════════════════════════════════════════════
    // DURATION AUTO-CALC FROM DATES
    // ══════════════════════════════════════════════
    const startDate      = document.getElementById('start_date');
    const completionDate = document.getElementById('completion_date');
    const durationInput  = document.getElementById('duration_months');

    function calcDuration() {
        if (!startDate.value || !completionDate.value) return;
        const start = new Date(startDate.value);
        const end   = new Date(completionDate.value);
        if (end < start) return;
        const months = (end.getFullYear() - start.getFullYear()) * 12
                     + (end.getMonth() - start.getMonth());
        if (!durationInput.value) {
            durationInput.value = months;
        }
    }

    startDate.addEventListener('change', calcDuration);
    completionDate.addEventListener('change', calcDuration);


    // ══════════════════════════════════════════════
    // CLIENT-SIDE VALIDATION
    // ══════════════════════════════════════════════
    document.getElementById('projectForm').addEventListener('submit', function (e) {
        const required = [
            { el: document.getElementById('title'),       label: 'Project title' },
            { el: document.getElementById('slug'),        label: 'Slug' },
            { el: document.getElementById('summary'),     label: 'Summary' },
            { el: document.getElementById('client_name'), label: 'Client name' },
            { el: document.getElementById('client_type'), label: 'Organisation type' },
        ];

        let firstError = null;
        required.forEach(({ el }) => {
            el.classList.remove('border-crimson-500', 'ring-1', 'ring-crimson-500');
            if (!el.value.trim()) {
                el.classList.add('border-crimson-500', 'ring-1', 'ring-crimson-500');
                if (!firstError) firstError = el;
            }
        });

        if (firstError) {
            e.preventDefault();
            firstError.focus();
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

})();
</script>
@endpush