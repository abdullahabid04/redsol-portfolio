@extends('admin.layouts.app')
@php
$isEdit  = isset($testimonial) && $testimonial->exists;
$title   = $isEdit ? 'Edit Testimonial' : 'Add Testimonial';
$action  = $isEdit
    ? route('admin.testimonials.update', $testimonial)
    : route('admin.testimonials.store');
@endphp
@section('title', $title)
@section('page-title', $title)
@section('breadcrumb')
    <div class="flex items-center gap-2 text-xs font-body text-gray-400">
        <a href="{{ route('admin.testimonials.index') }}" class="hover:text-crimson-500 transition-colors">Testimonials</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-gray-600">{{ $isEdit ? $testimonial->author_name : 'New Testimonial' }}</span>
    </div>
@endsection
@section('content')<form method="POST" action="{{ $action }}" id="testimonialForm" novalidate enctype="multipart/form-data">
    @csrf
    @if($isEdit) @method('PUT') @endif<div class="flex items-center justify-between gap-4 mb-6">
        
        <a href="{{ route('admin.team.index') }}"
            class="flex items-center gap-2 text-sm font-body text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Team
        </a>
    
        <div class="flex items-center gap-2">
            <button type="submit" class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-crimson-500 text-white text-sm font-display font-700 hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                {{ $isEdit ? 'Save Changes' : 'Create Testimonial' }}
            </button>
        </div>
    </div>@if($errors->any())
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

    <input type="hidden" name="is_active" id="isActiveInput" value="{{ old('is_active', $isEdit ? ($testimonial->is_active ? '1' : '0') : '1') }}"><div class="grid grid-cols-1 xl:grid-cols-[1fr_340px] gap-5"><div class="space-y-5">

            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Author Identity</h2>
                </div>
                <div class="p-6 space-y-5">
                    
                    <div>
                        <label for="author_name" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Author Name <span class="text-crimson-500">*</span>
                        </label>
                        <input type="text" id="author_name" name="author_name" value="{{ old('author_name', $isEdit ? $testimonial->author_name : '') }}" placeholder="e.g. Dr. Muhammad Arif" required autofocus class="w-full px-4 py-3 rounded-xl border text-sm font-body text-gray-800 placeholder-gray-400 transition-all focus:outline-none focus:ring-1 @error('author_name') border-crimson-500 ring-crimson-500 bg-crimson-500/3 @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">
                        @error('author_name')
                            <p class="mt-1.5 text-xs font-body text-crimson-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="author_role" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                                Role / Title
                            </label>
                            <input type="text" id="author_role" name="author_role" value="{{ old('author_role', $isEdit ? $testimonial->author_role : '') }}" placeholder="e.g. Medical Superintendent" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-body text-gray-800 placeholder-gray-400 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
                        </div>
                        <div>
                            <label for="hospital" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                                Hospital / Company
                            </label>
                            <input type="text" id="hospital" name="hospital" value="{{ old('hospital', $isEdit ? $testimonial->hospital : '') }}" placeholder="e.g. DHQ Hospital RYK" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-body text-gray-800 placeholder-gray-400 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
                        </div>
                    </div>

                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="author_initials" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                                Avatar Initials
                                <span class="font-normal text-gray-400 ml-1">— auto-generated</span>
                            </label>
                            <input type="text" id="author_initials" name="author_initials" value="{{ old('author_initials', $isEdit ? $testimonial->author_initials : '') }}" placeholder="MA" maxlength="5" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-body text-gray-800 placeholder-gray-400 uppercase focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
                            <p class="mt-1.5 text-[10px] font-body text-gray-400">Shown if no photo is uploaded</p>
                        </div>
                        <div>
                            <label for="sort_order" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                                Sort Order
                            </label>
                            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $isEdit ? $testimonial->sort_order : 0) }}" min="0" max="999" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-body text-gray-800 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
                            <p class="mt-1.5 text-[10px] font-body text-gray-400">Lower numbers appear first</p>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Testimonial Quote</h2>
                    <span class="ml-auto font-body text-xs text-gray-400">The actual testimonial text</span>
                </div>
                <div class="p-6">
                    <textarea id="quote" name="quote" rows="6" placeholder="Write the testimonial exactly as the client said it. Keep it authentic, specific, and outcome-focused…" class="w-full px-4 py-3 rounded-xl border text-sm font-body text-gray-800 placeholder-gray-400 resize-y leading-relaxed transition-all focus:outline-none focus:ring-1 @error('quote') border-crimson-500 ring-crimson-500 bg-crimson-500/3 @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">{{ old('quote', $isEdit ? $testimonial->quote : '') }}</textarea>
                    <div class="flex items-center justify-between mt-2">
                        @error('quote')
                            <p class="text-xs font-body text-crimson-600 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                        @else <span></span> @enderror
                        <span class="text-[10px] font-body text-gray-400" id="quoteCount">{{ strlen(old('quote', $isEdit ? $testimonial->quote : '')) }}/500</span>
                    </div>
                    <p class="mt-3 text-[10px] font-body text-gray-400">Tip: Great testimonials mention a specific problem, the solution, and a measurable result.</p>
                </div>
            </div>

            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Rating & Media</h2>
                </div>
                <div class="p-6 space-y-5">
                    
                    <div>
                        <label class="block font-body text-xs font-600 text-gray-700 mb-2">
                            Star Rating <span class="text-crimson-500">*</span>
                        </label>
                        <div class="flex items-center gap-2" id="ratingStars">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" data-rating="{{ $i }}" class="star-btn w-8 h-8 rounded-lg flex items-center justify-center transition-all hover:bg-gray-100 @if($i <= (old('rating', $isEdit ? $testimonial->rating : 5) ?? 5)) text-amber-400 @else text-gray-300 @endif">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                </button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating', $isEdit ? $testimonial->rating : 5) }}">
                        @error('rating')
                            <p class="mt-1.5 text-xs font-body text-crimson-600">{{ $message }}</p>
                        @enderror
                    </div>

                    
                    <div>
                        <label class="block font-body text-xs font-600 text-gray-700 mb-2">
                            Author Photo (optional)
                        </label>
                        <div class="flex items-center gap-4">
                            
                            <div id="photoPreview" class="w-16 h-16 rounded-full bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden shrink-0">
                                @if($isEdit && $testimonial->photo)
                                    <img src="{{ $testimonial->photoUrl() }}" alt="{{ $testimonial->author_name }}" class="w-full h-full object-cover">
                                @else
                                    <span id="previewInitials" class="font-display font-700 text-gray-500 text-sm">{{ old('author_initials', $isEdit ? $testimonial->author_initials : 'MA') }}</span>
                                @endif
                            </div>
                            
                            <div class="flex-1">
                                <input type="file" id="photoInput" name="photo" accept="image/*" class="hidden" onchange="previewPhoto(this)">
                                <button type="button" onclick="document.getElementById('photoInput').click()" class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-display font-600 text-gray-600 hover:border-crimson-500/30 hover:text-crimson-600 transition-all">
                                    {{ $isEdit && $testimonial->photo ? 'Change Photo' : 'Upload Photo' }}
                                </button>
                                @if($isEdit && $testimonial->photo)
                                    <button type="button" onclick="removePhoto()" class="ml-2 text-xs font-body text-crimson-600 hover:underline">Remove</button>
                                    <input type="hidden" name="remove_photo" id="removePhotoInput" value="0">
                                @endif
                                <p class="mt-1.5 text-[10px] font-body text-gray-400">Square JPG/PNG, max 2MB. Shows instead of initials.</p>
                            </div>
                        </div>
                    </div>

                    
                    <div>
                        <label for="avatar_gradient" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                            Avatar Background Style
                        </label>
                        <select id="avatar_gradient" name="avatar_gradient" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-body text-gray-800 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all cursor-pointer">
                            <option value="">Default (gray)</option>
                            <option value="crimson" @selected(old('avatar_gradient', $isEdit ? $testimonial->avatar_gradient : '') === 'crimson')>Crimson gradient</option>
                            <option value="blue" @selected(old('avatar_gradient', $isEdit ? $testimonial->avatar_gradient : '') === 'blue')>Blue gradient</option>
                            <option value="emerald" @selected(old('avatar_gradient', $isEdit ? $testimonial->avatar_gradient : '') === 'emerald')>Emerald gradient</option>
                            <option value="amber" @selected(old('avatar_gradient', $isEdit ? $testimonial->avatar_gradient : '') === 'amber')>Amber gradient</option>
                        </select>
                        <p class="mt-1.5 text-[10px] font-body text-gray-400">Used for the initials avatar if no photo is uploaded</p>
                    </div>
                </div>
            </div>
        </div><div class="space-y-5">

            
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Status</h2>
                </div>
                <div class="p-5 space-y-3">
                    
                    <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 border border-gray-200">
                        <div>
                            <div class="font-body text-sm font-600 text-gray-800">Active</div>
                            <div class="font-body text-xs text-gray-400 mt-0.5">Visible on the public testimonials section</div>
                        </div>
                        <button type="button" id="activeSwitch" onclick="toggleActive()" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 focus:outline-none shrink-0">
                            <span id="activeSwitchKnob" class="inline-block h-4 w-4 transform rounded-full bg-white shadow transition-transform duration-200"></span>
                        </button>
                    </div>

                    
                    <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 border border-gray-200">
                        <div>
                            <div class="font-body text-sm font-600 text-gray-800">Featured</div>
                            <div class="font-body text-xs text-gray-400 mt-0.5">Highlight in hero/carousel sections</div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" id="featuredInput" value="1" @checked(old('is_featured', $isEdit ? $testimonial->is_featured : false)) class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-crimson-500"></div>
                        </label>
                    </div>

                    
                    <div class="flex items-center gap-2 px-1">
                        <span id="statusDot" class="w-2 h-2 rounded-full shrink-0"></span>
                        <span id="statusLabel" class="font-body text-xs text-gray-500"></span>
                    </div>
                </div>
            </div>

            
            <div class="bg-gray-50 border border-gray-200 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
                    <div class="h-4 w-0.5 bg-gray-400 rounded-full"></div>
                    <h2 class="font-display font-700 text-gray-900 text-sm">Live Preview</h2>
                    <span class="ml-auto font-body text-[10px] text-gray-400">Updates as you type</span>
                </div>
                <div class="p-5">
                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                        
                        <div class="flex items-center gap-1 mb-3" id="previewStars">
                            @for($s = 1; $s <= 5; $s++)
                                <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            @endfor
                        </div>

                        
                        <div class="font-display text-4xl text-crimson-500/10 leading-none mb-1 select-none">"</div>
                        <blockquote id="previewQuote" class="font-body text-sm text-gray-600 leading-relaxed italic mb-4 line-clamp-3">
                            "{{ old('quote', $isEdit ? $testimonial->quote : 'Your testimonial quote will appear here…') }}"
                        </blockquote>

                        
                        <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                            <div id="previewAvatar" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center shrink-0 font-display font-700 text-white text-xs">
                                {{ old('author_initials', $isEdit ? $testimonial->author_initials : 'MA') }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div id="previewName" class="font-display font-700 text-gray-900 text-sm truncate">
                                    {{ old('author_name', $isEdit ? $testimonial->author_name : 'Author Name') }}
                                </div>
                                <div id="previewRole" class="font-body text-xs text-gray-400 truncate">
                                    {{ old('author_role', $isEdit ? $testimonial->author_role : 'Role') }}{{ old('hospital', $isEdit ? $testimonial->hospital : '') ? ', ' . old('hospital', $isEdit ? $testimonial->hospital : '') : '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>@if($isEdit)
<div class="mt-6 bg-white border border-crimson-500/15 rounded-2xl overflow-hidden">
    <div class="flex items-center gap-3 px-5 py-4 border-b border-crimson-500/10">
        <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
        <h2 class="font-display font-700 text-crimson-600 text-sm">Danger Zone</h2>
    </div>
    <div class="p-5">
        <p class="font-body text-xs text-gray-500 mb-4 leading-relaxed">
            Deleting this testimonial is permanent and cannot be undone.
        </p>
        <form method="POST" 
              action="{{ route('admin.testimonials.destroy', $testimonial) }}" 
              onsubmit="return confirm('Permanently delete testimonial by {{ addslashes($testimonial->author_name) }}? This cannot be undone.')"
              class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl 
                           border border-crimson-500/25 bg-crimson-500/5 
                           text-sm font-display font-600 text-crimson-600 
                           hover:bg-crimson-500 hover:text-white hover:border-crimson-500 
                           transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete this testimonial
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

let isActive = document.getElementById('isActiveInput').value === '1';

function updateActiveUI() {
    const input  = document.getElementById('isActiveInput');
    const sw     = document.getElementById('activeSwitch');
    const knob   = document.getElementById('activeSwitchKnob');
    const dot    = document.getElementById('statusDot');
    const label  = document.getElementById('statusLabel');

    input.value = isActive ? '1' : '0';

    if (isActive) {
        sw.classList.add('bg-crimson-500');
        sw.classList.remove('bg-gray-300');
        knob.style.transform = 'translateX(20px)';
        dot.className = 'w-2 h-2 rounded-full shrink-0 bg-green-500';
        label.textContent = 'Visible on public site';
    } else {
        sw.classList.remove('bg-crimson-500');
        sw.classList.add('bg-gray-300');
        knob.style.transform = 'translateX(2px)';
        dot.className = 'w-2 h-2 rounded-full shrink-0 bg-gray-400';
        label.textContent = 'Hidden from public site';
    }
}
window.toggleActive = function () {
    isActive = !isActive;
    updateActiveUI();
};
updateActiveUI();

const nameInput = document.getElementById('author_name');
const initialsInput = document.getElementById('author_initials');
let initialsManuallyEdited = initialsInput.value.length > 0;

initialsInput.addEventListener('input', () => { initialsManuallyEdited = true; });

nameInput.addEventListener('input', () => {
    if (initialsManuallyEdited) return;
    const name = nameInput.value.trim();
    if (!name) return;
    const clean = name.replace(/^(Dr\.|Mr\.|Ms\.|Mrs\.)\s*/i, '');
    const words = clean.split(' ').filter(w => w);
    const initials = words.slice(0, 2).map(w => w[0]?.toUpperCase()).join('') || name.slice(0, 2).toUpperCase();
    initialsInput.value = initials;
    document.getElementById('previewAvatar').textContent = initials;
    document.getElementById('previewInitials')?.textContent = initials;
    updatePreview();
});

const quoteInput = document.getElementById('quote');
const quoteCount = document.getElementById('quoteCount');
quoteInput.addEventListener('input', () => {
    quoteCount.textContent = quoteInput.value.length + '/500';
    updatePreview();
});

function updatePreview() {
    document.getElementById('previewName').textContent = nameInput.value.trim() || 'Author Name';
    
    const role = document.getElementById('author_role').value.trim();
    const hospital = document.getElementById('hospital').value.trim();
    document.getElementById('previewRole').textContent = role + (hospital ? ', ' + hospital : '') || 'Role, Hospital';
    
    const quote = quoteInput.value.trim();
    document.getElementById('previewQuote').textContent = '"' + (quote || 'Your testimonial quote will appear here…') + '"';
}
['author_name','author_role','hospital','quote'].forEach(id => {
    document.getElementById(id)?.addEventListener('input', updatePreview);
});

const ratingInput = document.getElementById('ratingInput');
const starBtns = document.querySelectorAll('#ratingStars .star-btn');
const previewStars = document.getElementById('previewStars');

function updateStarsUI(rating) {
    starBtns.forEach((btn, i) => {
        const val = i + 1;
        btn.classList.toggle('text-amber-400', val <= rating);
        btn.classList.toggle('text-gray-300', val > rating);
    });
    // Update preview stars
    if (previewStars) {
        previewStars.innerHTML = Array.from({length: 5}, (_, i) => 
            `<svg class="w-4 h-4 ${i < rating ? 'text-amber-400' : 'text-gray-200'}" fill="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>`
        ).join('');
    }
}
starBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const rating = parseInt(btn.dataset.rating);
        ratingInput.value = rating;
        updateStarsUI(rating);
    });
});
updateStarsUI(parseInt(ratingInput.value) || 5);

window.previewPhoto = function(input) {
    const file = input.files[0];
    if (!file) return;
    
    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById('photoPreview');
        preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
        document.getElementById('previewAvatar').classList.add('hidden');
    };
    reader.readAsDataURL(file);
};

window.removePhoto = function() {
    document.getElementById('photoPreview').innerHTML = `<span id="previewInitials" class="font-display font-700 text-gray-500 text-sm">${initialsInput.value || 'MA'}</span>`;
    document.getElementById('photoInput').value = '';
    document.getElementById('removePhotoInput').value = '1';
    document.getElementById('previewAvatar').classList.remove('hidden');
};

const gradientSelect = document.getElementById('avatar_gradient');
const previewAvatar = document.getElementById('previewAvatar');
const gradientClasses = {
    'crimson': 'bg-gradient-to-br from-crimson-500 to-crimson-700',
    'blue':    'bg-gradient-to-br from-blue-500 to-blue-700',
    'emerald': 'bg-gradient-to-br from-emerald-500 to-emerald-700',
    'amber':   'bg-gradient-to-br from-amber-500 to-amber-700',
};
gradientSelect?.addEventListener('change', () => {
    Object.values(gradientClasses).forEach(cls => previewAvatar.classList.remove(cls));
    if (gradientClasses[gradientSelect.value]) {
        previewAvatar.classList.add(gradientClasses[gradientSelect.value]);
    } else {
        previewAvatar.className = 'w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center shrink-0 font-display font-700 text-gray-500 text-xs';
    }
});

document.getElementById('testimonialForm').addEventListener('submit', function(e) {
    const name  = nameInput.value.trim();
    const quote = quoteInput.value.trim();
    const rating = ratingInput.value;
    
    if (!name || !quote || !rating) {
        e.preventDefault();
        const firstEmpty = [nameInput, quoteInput, ratingInput].find(el => !el.value.trim());
        if (firstEmpty) {
            firstEmpty.focus();
            firstEmpty.classList.add('border-crimson-500', 'ring-crimson-500');
        }
    }
});
})();
</script>
@endpush