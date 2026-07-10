@extends('admin.layouts.app')
@php
    $isEdit = isset($member) && $member->exists;
    $title = $isEdit ? 'Edit Team Member' : 'Add Team Member';
    $action = $isEdit ? route('admin.team.update', $member) : route('admin.team.store');
@endphp
@section('title', $title)
@section('page-title', $title)
@section('breadcrumb')
    <div class="flex items-center gap-2 text-xs font-body text-gray-400">
        <a href="{{ route('admin.team.index') }}" class="hover:text-crimson-500 transition-colors">Team Members</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-600">{{ $isEdit ? $member->name : 'New Team Member' }}</span>
    </div>
@endsection
@section('content')<form method="POST" action="{{ $action }}" id="teamForm" novalidate
        enctype="multipart/form-data">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif
        <div class="flex items-center justify-between gap-4 mb-6">

            <a href="{{ route('admin.team.index') }}"
                class="flex items-center gap-2 text-sm font-body text-gray-500 hover:text-gray-900 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Team
            </a>

            <div class="flex items-center gap-2">

                <button type="button" id="toggleVisibleBtn"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-xl border transition-all text-sm font-display font-600"
                    onclick="toggleVisible()">

                </button>


                <button type="submit"
                    class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-crimson-500 text-white text-sm font-display font-700 hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ $isEdit ? 'Save Changes' : 'Add Member' }}
                </button>
            </div>
        </div>
        @if ($errors->any())
            <div class="flex items-start gap-3 px-5 py-4 rounded-2xl bg-crimson-500/5 border border-crimson-500/20 mb-6">
                <svg class="w-5 h-5 text-crimson-500 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="font-display font-700 text-sm text-crimson-700 mb-2">
                        Please fix {{ $errors->count() }} error{{ $errors->count() !== 1 ? 's' : '' }} before saving
                    </p>
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="font-body text-xs text-crimson-600 flex items-center gap-1.5">
                                <span class="w-1 h-1 rounded-full bg-crimson-500 shrink-0"></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif


        <input type="hidden" name="is_visible" id="isVisibleInput"
            value="{{ old('is_visible', $isEdit ? ($member->is_visible ? '1' : '0') : '1') }}">
        <div class="grid grid-cols-1 xl:grid-cols-[1fr_340px] gap-5">
            <div class="space-y-5">


                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                        <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                        <h2 class="font-display font-700 text-gray-900 text-sm">Basic Information</h2>
                    </div>
                    <div class="p-6 space-y-5">

                        <div>
                            <label for="name" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                                Full Name <span class="text-crimson-500">*</span>
                            </label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name', $isEdit ? $member->name : '') }}" placeholder="e.g. Dr. Muhammad Arif"
                                required autofocus
                                class="w-full px-4 py-3 rounded-xl border text-sm font-body text-gray-800 placeholder-gray-400 transition-all focus:outline-none focus:ring-1 @error('name') border-crimson-500 ring-crimson-500 bg-crimson-500/3 @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">
                            @error('name')
                                <p class="mt-1.5 text-xs font-body text-crimson-600 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="position" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                                    Job Title / Position <span class="text-crimson-500">*</span>
                                </label>
                                <input type="text" id="position" name="position"
                                    value="{{ old('position', $isEdit ? $member->position : '') }}"
                                    placeholder="e.g. CEO & Co-Founder" required
                                    class="w-full px-4 py-3 rounded-xl border text-sm font-body text-gray-800 placeholder-gray-400 transition-all focus:outline-none focus:ring-1 @error('position') border-crimson-500 ring-crimson-500 bg-crimson-500/3 @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">
                                @error('position')
                                    <p class="mt-1.5 text-xs font-body text-crimson-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="department" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                                    Department
                                </label>
                                <input type="text" id="department" name="department"
                                    value="{{ old('department', $isEdit ? $member->department : '') }}"
                                    placeholder="e.g. Executive Leadership"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-body text-gray-800 placeholder-gray-400 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
                            </div>
                        </div>


                        <div>
                            <label for="bio" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                                Professional Bio <span class="text-crimson-500">*</span>
                                <span class="font-normal text-gray-400 ml-1">— shown on the About page</span>
                            </label>
                            <textarea id="bio" name="bio" rows="4"
                                placeholder="Write a concise 3–4 sentence bio highlighting expertise, experience, and role at REDSOL…" required
                                class="w-full px-4 py-3 rounded-xl border text-sm font-body text-gray-800 placeholder-gray-400 resize-y leading-relaxed transition-all focus:outline-none focus:ring-1 @error('bio') border-crimson-500 ring-crimson-500 bg-crimson-500/3 @else border-gray-200 focus:border-crimson-500 focus:ring-crimson-500 @enderror">{{ old('bio', $isEdit ? $member->bio : '') }}</textarea>
                            <div class="flex items-center justify-between mt-1">
                                @error('bio')
                                    <p class="text-xs font-body text-crimson-600 flex items-center gap-1"><svg class="w-3 h-3"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>{{ $message }}</p>
                                @else
                                    <span></span>
                                @enderror
                                <span class="text-[10px] font-body text-gray-400"
                                    id="bioCount">{{ strlen(old('bio', $isEdit ? $member->bio : '')) }}/500</span>
                            </div>
                        </div>


                        <div>
                            <label for="sort_order" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                                Display Order
                            </label>
                            <input type="number" id="sort_order" name="sort_order"
                                value="{{ old('sort_order', $isEdit ? $member->sort_order : (\App\Models\TeamMember::max('sort_order') ?? 0) + 1) }}"
                                min="0" max="999"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-body text-gray-800 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
                            <p class="mt-1.5 text-[10px] font-body text-gray-400">Lower numbers appear first on the About
                                page</p>
                        </div>
                    </div>
                </div>


                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                        <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                        <h2 class="font-display font-700 text-gray-900 text-sm">Social Links</h2>
                        <span class="ml-auto font-body text-xs text-gray-400">Optional — LinkedIn, Twitter, etc.</span>
                    </div>
                    <div class="p-6">
                        <div id="socialLinksContainer" class="space-y-2 mb-3">
                            @php
                                $socialLinks = old('social_links', $isEdit ? $member->social_links ?? [] : []);
                                if (empty($socialLinks)) {
                                    $socialLinks = ['linkedin' => ''];
                                }
                            @endphp

                            @foreach ($socialLinks as $platform => $url)
                                <div class="social-row flex items-center gap-2 group/row">

                                    <select name="social_platforms[]"
                                        class="w-32 px-3 py-2.5 rounded-xl border border-gray-200 text-sm font-body text-gray-800 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
                                        <option value="linkedin" @selected($platform === 'linkedin')>LinkedIn</option>
                                        <option value="twitter" @selected($platform === 'twitter')>Twitter/X</option>
                                        <option value="facebook" @selected($platform === 'facebook')>Facebook</option>
                                        <option value="instagram" @selected($platform === 'instagram')>Instagram</option>
                                        <option value="email" @selected($platform === 'email')>Email</option>
                                        <option value="other" @selected($platform === 'other')>Other</option>
                                    </select>

                                    <input type="url" name="social_urls[]" value="{{ $url }}"
                                        placeholder="https://example.com/..."
                                        class="flex-1 px-3 py-2.5 rounded-xl border border-gray-200 text-sm font-body text-gray-800 placeholder-gray-400 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">

                                    <button type="button" onclick="removeSocialRow(this)"
                                        class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-300 hover:text-crimson-500 hover:border-crimson-500/30 hover:bg-crimson-500/5 transition-all shrink-0 opacity-0 group-hover/row:opacity-100">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                </div>
                            @endforeach
                        </div>
                        <button type="button" onclick="addSocialRow()"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-dashed border-gray-300 text-sm font-display font-600 text-gray-500 hover:border-crimson-500/40 hover:text-crimson-600 hover:bg-crimson-500/3 transition-all w-full justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Add social link
                        </button>
                        <p class="mt-3 text-[10px] font-body text-gray-400">Tip: Include only professional profiles. URLs
                            must start with https://</p>
                    </div>
                </div>


                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                        <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                        <h2 class="font-display font-700 text-gray-900 text-sm">Profile Photo</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 items-start">

                            <div>
                                <label for="photo" class="block font-body text-xs font-600 text-gray-700 mb-2">
                                    Photo File
                                    @if (!$isEdit)
                                        <span class="text-gray-400 font-400 normal-case tracking-normal ml-1">(optional —
                                            can upload later)</span>
                                    @endif
                                </label>
                                <label for="photo" class="block cursor-pointer group">
                                    <div
                                        class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-crimson-500/40 hover:bg-crimson-500/2 transition-all">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center mx-auto mb-3 group-hover:bg-crimson-500/10 transition-colors">
                                            <svg class="w-5 h-5 text-gray-400 group-hover:text-crimson-500 transition-colors"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <p
                                            class="font-body text-xs text-gray-500 group-hover:text-crimson-600 transition-colors">
                                            <span class="font-600">Click to upload</span> or drag & drop
                                        </p>
                                        <p class="font-body text-[10px] text-gray-400 mt-1">Portrait JPG/PNG, max 2MB · 3:4
                                            ratio recommended</p>
                                    </div>
                                    <input type="file" id="photo" name="photo" accept="image/*" class="hidden"
                                        onchange="previewPhoto(this)">
                                </label>
                                @error('photo')
                                    <p class="mt-1.5 flex items-center gap-1.5 text-xs font-body text-crimson-600">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror


                                <div class="mt-4">
                                    <label for="photo_alt" class="block font-body text-xs font-600 text-gray-700 mb-1.5">
                                        Alt Text
                                        <span class="text-gray-400 font-400 normal-case tracking-normal ml-1">(for
                                            accessibility)</span>
                                    </label>
                                    <input type="text" id="photo_alt" name="photo_alt"
                                        value="{{ old('photo_alt', $isEdit ? $member->photo_alt : '') }}"
                                        placeholder="e.g. Dr. Muhammad Arif, CEO of REDSOL"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-body text-gray-800 placeholder-gray-400 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
                                </div>
                            </div>


                            <div>
                                <p class="font-body text-xs font-600 text-gray-500 mb-2">Preview</p>

                                <div id="photoNewPreview" class="hidden mb-3">
                                    <div
                                        class="bg-gray-50 border border-gray-200 rounded-xl p-4 flex items-center justify-center aspect-[3/4] relative">
                                        <img id="photoNewImg" src="" alt="New photo"
                                            class="w-full h-full object-cover rounded-lg">
                                        <span
                                            class="absolute top-2 right-2 text-[10px] font-display font-700 px-2 py-1 rounded-lg bg-crimson-500 text-white">New</span>
                                    </div>
                                </div>

                                @if ($isEdit && $member->photo)
                                    <div id="photoCurrentWrap" class="mb-3">
                                        <div
                                            class="bg-gray-50 border border-gray-200 rounded-xl p-4 flex items-center justify-center aspect-[3/4] relative">
                                            <img src="{{ $member->photoUrl() }}"
                                                alt="{{ $member->photo_alt ?? $member->name }}"
                                                class="w-full h-full object-cover rounded-lg" id="photoCurrentImg">
                                            <span
                                                class="absolute top-2 right-2 text-[10px] font-display font-700 px-2 py-1 rounded-lg bg-green-500 text-white">Current</span>
                                        </div>

                                        <label class="flex items-center gap-2 mt-2 cursor-pointer">
                                            <input type="checkbox" name="remove_photo" value="1"
                                                class="w-3.5 h-3.5 rounded border-gray-300 text-crimson-500 focus:ring-crimson-500/30 cursor-pointer"
                                                onchange="document.getElementById('photoCurrentWrap').style.opacity = this.checked ? '0.4' : '1'">
                                            <span class="font-body text-xs text-gray-500">Remove current photo</span>
                                        </label>
                                    </div>
                                @else
                                    <div id="photoEmptyState"
                                        class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl p-4 flex flex-col items-center justify-center aspect-[3/4]">
                                        <svg class="w-8 h-8 text-gray-300 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="font-body text-[10px] text-gray-400 text-center">No photo uploaded yet
                                        </p>
                                    </div>
                                @endif


                                <div class="mt-3 space-y-1.5">
                                    @foreach (['Use a professional headshot with good lighting', 'Portrait orientation (3:4 ratio) works best', 'Avoid busy backgrounds — solid or blurred works well'] as $tip)
                                        <div class="flex items-start gap-2">
                                            <svg class="w-3 h-3 text-crimson-500 mt-0.5 shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span
                                                class="font-body text-[10px] text-gray-400 leading-relaxed">{{ $tip }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="space-y-5">


                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
                        <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                        <h2 class="font-display font-700 text-gray-900 text-sm">Visibility</h2>
                    </div>
                    <div class="p-5 space-y-4">

                        <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 border border-gray-200">
                            <div>
                                <div class="font-body text-sm font-600 text-gray-800">Visible</div>
                                <div class="font-body text-xs text-gray-400 mt-0.5">Shown on the public About page</div>
                            </div>
                            <button type="button" id="visibleSwitch" onclick="toggleVisible()"
                                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 focus:outline-none shrink-0">
                                <span id="visibleSwitchKnob"
                                    class="inline-block h-4 w-4 transform rounded-full bg-white shadow transition-transform duration-200"></span>
                            </button>
                        </div>


                        <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 border border-gray-200">
                            <div>
                                <div class="font-body text-sm font-600 text-gray-800">Leadership</div>
                                <div class="font-body text-xs text-gray-400 mt-0.5">Highlight in leadership section</div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_leadership" id="leadershipInput" value="1"
                                    @checked(old('is_leadership', $isEdit ? $member->is_leadership : false)) class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-crimson-500">
                                </div>
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
                        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">

                            <div id="previewPhotoBg"
                                class="h-32 bg-gray-100 rounded-lg mb-3 flex items-center justify-center">
                                @if ($isEdit && $member->photo)
                                    <img src="{{ $member->photoUrl() }}" alt="{{ $member->name }}"
                                        class="w-full h-full object-cover rounded-lg">
                                @else
                                    <span id="previewInitials"
                                        class="font-display font-800 text-gray-300 text-3xl">{{ $member->initials ?? 'MA' }}</span>
                                @endif
                            </div>

                            <div id="previewName"
                                class="font-display font-700 text-gray-900 text-base leading-tight mb-0.5">
                                {{ old('name', $isEdit ? $member->name : 'Team Member Name') }}</div>
                            <div id="previewPosition" class="font-body text-xs text-crimson-500 font-600 mb-1">
                                {{ old('position', $isEdit ? $member->position : 'Job Title') }}</div>
                            @if (old('department', $isEdit ? $member->department : ''))
                                <div id="previewDepartment" class="font-body text-[10px] text-gray-400 mb-2">
                                    {{ old('department', $isEdit ? $member->department : '') }}</div>
                            @endif

                            <p id="previewBio" class="font-body text-xs text-gray-500 leading-relaxed line-clamp-3">
                                {{ Str::limit(old('bio', $isEdit ? $member->bio : ''), 100) }}</p>

                            <div id="previewSocial" class="flex items-center gap-2 mt-3 pt-3 border-t border-gray-100">
                                @if (old('social_links.linkedin', $isEdit ? $member->social_links['linkedin'] ?? '' : ''))
                                    <svg class="w-3.5 h-3.5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                @if ($isEdit)
                    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                        <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
                            <div class="h-4 w-0.5 bg-gray-400 rounded-full"></div>
                            <h2 class="font-display font-700 text-gray-900 text-sm">Record Info</h2>
                        </div>
                        <div class="p-5 space-y-3">
                            @foreach ([['label' => 'Member ID', 'value' => '#' . $member->id], ['label' => 'Initials', 'value' => $member->initials], ['label' => 'Leadership', 'value' => $member->is_leadership ? 'Yes' : 'No'], ['label' => 'Sort Order', 'value' => $member->sort_order], ['label' => 'Created', 'value' => $member->created_at->format('M j, Y')], ['label' => 'Last Updated', 'value' => $member->updated_at->diffForHumans()]] as $info)
                                <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                                    <span class="font-body text-xs text-gray-400">{{ $info['label'] }}</span>
                                    <span class="font-display font-600 text-xs text-gray-700">{{ $info['value'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </form>
    @if ($isEdit && Auth::guard('admin')->user()->can('delete_any'))
        <div class="mt-6 bg-white border border-crimson-500/15 rounded-2xl overflow-hidden">
            <div class="flex items-center gap-3 px-5 py-4 border-b border-crimson-500/10">
                <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                <h2 class="font-display font-700 text-crimson-600 text-sm">Danger Zone</h2>
            </div>
            <div class="p-5">
                <p class="font-body text-xs text-gray-500 mb-4 leading-relaxed">
                    Permanently delete <strong class="text-gray-700">{{ $member->name }}</strong> from the team. This
                    removes them from the public About page immediately. This action cannot be undone.
                </p>
                <form method="POST" action="{{ route('admin.team.destroy', $member) }}"
                    onsubmit="return confirm('Permanently delete {{ addslashes($member->name) }} from the team? This cannot be undone.')"
                    class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-crimson-500/25 bg-crimson-500/5 text-sm font-display font-600 text-crimson-600 hover:bg-crimson-500 hover:text-white hover:border-crimson-500 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete Team Member
                    </button>
                </form>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script>
        (function() {
            'use strict';

            let isVisible = document.getElementById('isVisibleInput').value === '1';

            function updateVisibleUI() {
                const input = document.getElementById('isVisibleInput');
                const sw = document.getElementById('visibleSwitch');
                const knob = document.getElementById('visibleSwitchKnob');
                const dot = document.getElementById('statusDot');
                const label = document.getElementById('statusLabel');
                const topBtn = document.getElementById('toggleVisibleBtn');

                input.value = isVisible ? '1' : '0';

                if (isVisible) {
                    sw.classList.add('bg-crimson-500');
                    sw.classList.remove('bg-gray-300');
                    knob.style.transform = 'translateX(20px)';
                    dot.className = 'w-2 h-2 rounded-full shrink-0 bg-green-500';
                    label.textContent = 'Visible on public About page';
                    topBtn.textContent = 'Set Hidden';
                    topBtn.className =
                        'flex items-center gap-2 px-4 py-2.5 rounded-xl border transition-all text-sm font-display font-600 border-gray-200 text-gray-600 hover:border-gray-300 hover:text-gray-800';
                } else {
                    sw.classList.remove('bg-crimson-500');
                    sw.classList.add('bg-gray-300');
                    knob.style.transform = 'translateX(2px)';
                    dot.className = 'w-2 h-2 rounded-full shrink-0 bg-gray-400';
                    label.textContent = 'Hidden from public site';
                    topBtn.textContent = 'Set Visible';
                    topBtn.className =
                        'flex items-center gap-2 px-4 py-2.5 rounded-xl border transition-all text-sm font-display font-600 border-green-300 text-green-700 hover:bg-green-50';
                }
            }
            window.toggleVisible = function() {
                isVisible = !isVisible;
                updateVisibleUI();
            };
            updateVisibleUI();

            const nameInput = document.getElementById('name');
            const initialsPreview = document.getElementById('previewInitials');
            let initialsManuallyEdited = false;

            nameInput.addEventListener('input', () => {
                if (initialsManuallyEdited) return;
                const name = nameInput.value.trim();
                if (!name) return;
                const clean = name.replace(/^(Dr\.|Mr\.|Ms\.|Mrs\.)\s*/i, '');
                const words = clean.split(' ').filter(w => w);
                const initials = words.slice(0, 2).map(w => w[0]?.toUpperCase()).join('') || name.slice(0, 2)
                    .toUpperCase();
                if (initialsPreview) initialsPreview.textContent = initials;
                updatePreview();
            });

            const bioInput = document.getElementById('bio');
            const bioCount = document.getElementById('bioCount');
            bioInput.addEventListener('input', () => {
                bioCount.textContent = bioInput.value.length + '/500';
                updatePreview();
            });

            function updatePreview() {
                document.getElementById('previewName').textContent = nameInput.value.trim() || 'Team Member Name';
                document.getElementById('previewPosition').textContent = document.getElementById('position').value
                    .trim() || 'Job Title';

                const department = document.getElementById('department').value.trim();
                const previewDept = document.getElementById('previewDepartment');
                if (department) {
                    previewDept.textContent = department;
                    previewDept.style.display = 'block';
                } else {
                    previewDept.style.display = 'none';
                }

                const bio = bioInput.value.trim();
                document.getElementById('previewBio').textContent = bio ? (bio.length > 100 ? bio.substring(0, 100) +
                    '…' : bio) : 'Professional bio will appear here.';
            }
            ['name', 'position', 'department', 'bio'].forEach(id => {
                document.getElementById(id)?.addEventListener('input', updatePreview);
            });

            window.previewPhoto = function(input) {
                const file = input.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const newPreview = document.getElementById('photoNewPreview');
                    const newImg = document.getElementById('photoNewImg');
                    const emptyState = document.getElementById('photoEmptyState');

                    newImg.src = e.target.result;
                    newPreview.classList.remove('hidden');
                    if (emptyState) emptyState.classList.add('hidden');

                    // Update card preview
                    const previewBg = document.getElementById('previewPhotoBg');
                    previewBg.innerHTML =
                        `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover rounded-lg">`;
                };
                reader.readAsDataURL(file);
            };

            window.removePhoto = function() {
                document.getElementById('photoPreview').innerHTML =
                    `<span id="previewInitials" class="font-display font-800 text-gray-300 text-3xl">${document.getElementById('name').value.slice(0, 2).toUpperCase() || 'MA'}</span>`;
                document.getElementById('photoInput').value = '';
                document.getElementById('removePhotoInput').value = '1';
                document.getElementById('previewAvatar').classList.remove('hidden');
            };

            window.addSocialRow = function() {
                const container = document.getElementById('socialLinksContainer');
                const row = document.createElement('div');
                row.className = 'social-row flex items-center gap-2 group/row';
                row.innerHTML = `
        <select name="social_platforms[]" class="w-32 px-3 py-2.5 rounded-xl border border-gray-200 text-sm font-body text-gray-800 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
            <option value="linkedin">LinkedIn</option>
            <option value="twitter">Twitter/X</option>
            <option value="facebook">Facebook</option>
            <option value="instagram">Instagram</option>
            <option value="other">Other</option>
        </select>
        <input type="url" name="social_urls[]" placeholder="https://..." class="flex-1 px-3 py-2.5 rounded-xl border border-gray-200 text-sm font-body text-gray-800 placeholder-gray-400 focus:outline-none focus:border-crimson-500 focus:ring-1 focus:ring-crimson-500 transition-all">
        <button type="button" onclick="removeSocialRow(this)" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-300 hover:text-crimson-500 hover:border-crimson-500/30 hover:bg-crimson-500/5 transition-all shrink-0 opacity-0 group-hover/row:opacity-100">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    `;
                container.appendChild(row);
                row.querySelector('input').focus();
            };

            window.removeSocialRow = function(btn) {
                const container = document.getElementById('socialLinksContainer');
                const row = btn.closest('.social-row');
                if (container.querySelectorAll('.social-row').length > 1) {
                    row.remove();
                } else {
                    row.querySelector('input').value = '';
                }
            };

            document.getElementById('teamForm').addEventListener('submit', function(e) {
                const name = nameInput.value.trim();
                const position = document.getElementById('position').value.trim();
                const bio = bioInput.value.trim();

                if (!name || !position || !bio) {
                    e.preventDefault();
                    const firstEmpty = [nameInput, document.getElementById('position'), bioInput].find(el => !el
                        .value.trim());
                    if (firstEmpty) {
                        firstEmpty.focus();
                        firstEmpty.classList.add('border-crimson-500', 'ring-crimson-500');
                    }
                }
            });
        })();
    </script>
@endpush
