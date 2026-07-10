@extends('admin.layouts.app')

@section('title', isset($post) ? 'Edit Post' : 'New Blog Post')
@section('page-title', isset($post) ? 'Edit Post' : 'New Blog Post')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="text-xs font-body text-gray-400 hover:text-crimson-500 transition-colors">Dashboard</a>
    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="{{ route('admin.blog.index') }}" class="text-xs font-body text-gray-400 hover:text-crimson-500 transition-colors">Blog Posts</a>
    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-xs font-body text-gray-500">{{ isset($post) ? 'Edit' : 'New Post' }}</span>
@endsection

@section('content')

@php
    $isEdit = isset($post) && $post->exists;
    $admin = Auth::guard('admin')->user();
@endphp<form method="POST"
      action="{{ $isEdit ? route('admin.blog.update', $post) : route('admin.blog.store') }}"
      enctype="multipart/form-data"
      id="blogForm"
      novalidate>
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="grid grid-cols-1 xl:grid-cols-[1fr_320px] gap-5">
        
        <div class="space-y-5">

            
            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <label class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-2">
                    Post Title <span class="text-crimson-500">*</span>
                </label>
                <input type="text"
                       name="title"
                       id="title"
                       value="{{ old('title', $isEdit ? $post->title : '') }}"
                       required
                       placeholder="e.g. Why Every Hospital Needs a Unified HIS in 2025"
                       class="w-full px-4 py-3 rounded-xl border font-display font-600 text-xl text-gray-900 placeholder-gray-300 bg-white transition-all
                              {{ $errors->has('title') ? 'border-crimson-500 bg-red-50' : 'border-gray-200 hover:border-gray-300 focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10' }}"
                       oninput="autoSlug(this.value)">
                @error('title')
                    <p class="mt-1.5 text-xs text-crimson-600 font-body">{{ $message }}</p>
                @enderror
            </div>

            
            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <label class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-2">URL Slug</label>
                <div class="flex items-center gap-0 border border-gray-200 rounded-xl overflow-hidden focus-within:border-crimson-500 focus-within:ring-2 focus-within:ring-crimson-500/10 transition-all {{ $errors->has('slug') ? 'border-crimson-500' : '' }}">
                    <span class="px-3 py-3 bg-gray-50 border-r border-gray-200 text-xs font-body text-gray-400 shrink-0">/blog/</span>
                    <input type="text"
                           name="slug"
                           id="slug"
                           value="{{ old('slug', $isEdit ? $post->slug : '') }}"
                           placeholder="why-every-hospital-needs-unified-his"
                           class="flex-1 px-3 py-3 text-sm font-body text-gray-700 bg-white focus:outline-none">
                </div>
                @error('slug') <p class="mt-1.5 text-xs text-crimson-600 font-body">{{ $message }}</p> @enderror
            </div>

            
            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <label class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-2">
                    Excerpt <span class="text-gray-400 font-400 normal-case tracking-normal">(shown on blog listing)</span>
                </label>
                <textarea name="excerpt"
                          rows="2"
                          placeholder="A short description that appears on the blog listing page and in SEO previews..."
                          class="w-full px-4 py-3 rounded-xl border font-body text-sm text-gray-700 placeholder-gray-400 bg-white resize-none transition-all
                                 {{ $errors->has('excerpt') ? 'border-crimson-500 bg-red-50' : 'border-gray-200 hover:border-gray-300 focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 focus:outline-none' }}">{{ old('excerpt', $isEdit ? $post->excerpt : '') }}</textarea>
                @error('excerpt') <p class="mt-1.5 text-xs text-crimson-600 font-body">{{ $message }}</p> @enderror
            </div>

            
            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <label class="block font-body text-xs font-600 text-gray-500 tracking-widest uppercase mb-3">
                    Content <span class="text-crimson-500">*</span>
                </label>

                
                <div class="flex flex-wrap gap-1 mb-3 pb-3 border-b border-gray-100">
                    @foreach([
                        ['cmd'=>'bold',           'icon'=>'<strong>B</strong>',          'title'=>'Bold'],
                        ['cmd'=>'italic',         'icon'=>'<em>I</em>',                  'title'=>'Italic'],
                        ['cmd'=>'underline',      'icon'=>'<u>U</u>',                    'title'=>'Underline'],
                        ['cmd'=>'separator',      'icon'=>'',                            'title'=>''],
                        ['cmd'=>'h2',             'icon'=>'H2',                          'title'=>'Heading 2'],
                        ['cmd'=>'h3',             'icon'=>'H3',                          'title'=>'Heading 3'],
                        ['cmd'=>'separator',      'icon'=>'',                            'title'=>''],
                        ['cmd'=>'insertUnorderedList','icon'=>'&#8226; List',            'title'=>'Bullet list'],
                        ['cmd'=>'insertOrderedList',  'icon'=>'1. List',                'title'=>'Numbered list'],
                        ['cmd'=>'separator',      'icon'=>'',                            'title'=>''],
                        ['cmd'=>'createLink',     'icon'=>'&#128279; Link',              'title'=>'Insert link'],
                        ['cmd'=>'unlink',         'icon'=>'&#128279;&#x20E0; Unlink',   'title'=>'Remove link'],
                        ['cmd'=>'separator',      'icon'=>'',                            'title'=>''],
                        ['cmd'=>'blockquote',     'icon'=>'&#10078; Quote',              'title'=>'Blockquote'],
                        ['cmd'=>'code',           'icon'=>'&lt;/&gt; Code',              'title'=>'Code block'],
                    ] as $btn)
                        @if($btn['cmd'] === 'separator')
                            <div class="w-px h-6 bg-gray-200 mx-1 self-center"></div>
                        @else
                            <button type="button"
                                    onclick="execCmd('{{ $btn['cmd'] }}')"
                                    title="{{ $btn['title'] }}"
                                    class="px-2.5 py-1.5 rounded-lg text-xs font-body text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                {!! $btn['icon'] !!}
                            </button>
                        @endif
                    @endforeach
                </div>

                
                <div id="editor"
                     contenteditable="true"
                     class="min-h-[360px] px-4 py-4 rounded-xl border border-gray-200 focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 focus:outline-none font-body text-sm text-gray-700 leading-relaxed prose-editor"
                     style="line-height:1.8;">
                    {!! old('body', $isEdit ? $post->body : '') !!}
                </div>
                
                <textarea name="body" id="body" class="hidden">{{ old('body', $isEdit ? $post->body : '') }}</textarea>
                @error('body') <p class="mt-1.5 text-xs text-crimson-600 font-body">{{ $message }}</p> @enderror
            </div>

        </div>

        
        <div class="space-y-5">

            
            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-gray-900 text-sm">Publish</h3>
                </div>

                <div class="space-y-3 mb-5">
                    
                    <div>
                        <label class="font-body text-xs text-gray-500 mb-1 block">Status</label>
                        <select name="is_published"
                                class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all cursor-pointer">
                            <option value="0" {{ old('is_published', $isEdit ? ($post->is_published ? '1' : '0') : '0') == '0' ? 'selected' : '' }}>Draft</option>
                            <option value="1" {{ old('is_published', $isEdit ? ($post->is_published ? '1' : '0') : '0') == '1' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>

                    
                    <div>
                        <label class="font-body text-xs text-gray-500 mb-1 block">Publish Date</label>
                        <input type="datetime-local"
                               name="published_at"
                               value="{{ old('published_at', $isEdit && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                               class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all">
                    </div>

                    
                    <div>
                        <label class="font-body text-xs text-gray-500 mb-1 block">Est. Read Time (mins)</label>
                        <input type="number"
                               name="read_time"
                               value="{{ old('read_time', $isEdit ? $post->read_time_minutes : 5) }}"
                               min="1" max="60"
                               class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all">
                    </div>
                </div>

                
                <div class="flex gap-2">
                    <button type="submit"
                            class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-crimson-500 text-white font-display font-600 text-sm
                                   hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ $isEdit ? 'Update' : 'Publish' }}
                    </button>
                    <a href="{{ route('admin.blog.index') }}"
                       class="px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-display font-600 text-sm hover:bg-gray-50 transition-all">
                        Cancel
                    </a>
                </div>
            </div>

            
            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-gray-900 text-sm">Category</h3>
                </div>
                <select name="category"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all cursor-pointer">
                    <option value="">Select category...</option>
                    @foreach(['HIS Implementation','PACS & Radiology','Digital Health','LIMS & Lab','Case Studies','Healthcare IT'] as $cat)
                    <option value="{{ $cat }}" {{ old('category', $isEdit ? $post->category : '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category') <p class="mt-1.5 text-xs text-crimson-600 font-body">{{ $message }}</p> @enderror
            </div>

            
            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-gray-900 text-sm">Cover Image</h3>
                </div>

                
                @if($isEdit && $post->featured_image)
                <div class="mb-3 relative rounded-xl overflow-hidden aspect-video bg-gray-100">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->featured_image_alt ?? $post->title }}" class="w-full h-full object-cover">
                    <div class="absolute top-2 right-2">
                        <span class="text-[10px] font-display font-700 px-2 py-1 rounded-lg bg-black/60 text-white">Current</span>
                    </div>
                </div>
                @endif

                <label class="block w-full cursor-pointer">
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-crimson-500/40 hover:bg-crimson-500/2 transition-all group">
                        <svg class="w-8 h-8 text-gray-300 group-hover:text-crimson-400 mx-auto mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="font-body text-xs text-gray-500 group-hover:text-crimson-600">
                            <span class="font-600">Click to upload</span> or drag & drop
                        </p>
                        <p class="font-body text-[10px] text-gray-400 mt-1">PNG, JPG, WebP · Max 2MB · 16:9 recommended</p>
                    </div>
                    <input type="file" name="cover_image" accept="image/*" class="hidden" onchange="previewImage(this)">
                </label>
                <div id="imagePreview" class="mt-3 hidden rounded-xl overflow-hidden aspect-video bg-gray-100">
                    <img id="previewImg" src="" alt="Preview" class="w-full h-full object-cover">
                </div>
            </div>

            
            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-gray-900 text-sm">SEO</h3>
                </div>
                <div class="space-y-3">
                    <div>
                        <label class="font-body text-xs text-gray-500 mb-1 block">Meta Title</label>
                        <input type="text" name="meta_title"
                               value="{{ old('meta_title', $isEdit ? $post->meta_title : '') }}"
                               placeholder="Override page title for search engines..."
                               class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 placeholder-gray-400 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all">
                    </div>
                    <div>
                        <label class="font-body text-xs text-gray-500 mb-1 block">Meta Description</label>
                        <textarea name="meta_description" rows="2"
                                  placeholder="150–160 characters for Google preview..."
                                  class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 placeholder-gray-400 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all resize-none">{{ old('meta_description', $isEdit ? $post->meta_description : '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>@if($isEdit)
<div class="mt-6 bg-white border border-red-100 rounded-2xl overflow-hidden">
    <div class="flex items-center gap-3 px-5 py-4 border-b border-red-100">
        <div class="h-4 w-0.5 bg-red-400 rounded-full"></div>
        <h3 class="font-display font-700 text-gray-900 text-sm">Danger Zone</h3>
    </div>
    <div class="p-5">
        <p class="font-body text-xs text-gray-500 mb-3">Permanently delete this post. This action cannot be undone.</p>
        <form method="POST" action="{{ route('admin.blog.destroy', $post) }}"
              onsubmit="return confirm('Are you absolutely sure? This post will be permanently deleted.')"
              class="inline">
            @csrf @method('DELETE')
            <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-red-200 text-red-600 font-display font-600 text-sm
                           hover:bg-red-50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Delete This Post
            </button>
        </form>
    </div>
</div>
@endif

@endsection

@push('head')
<style>
    .prose-editor h2 { font-family:'Syne',sans-serif; font-size:1.25rem; font-weight:700; color:#0f0f0f; margin:1.25rem 0 .5rem; }
    .prose-editor h3 { font-family:'Syne',sans-serif; font-size:1.05rem; font-weight:700; color:#111827; margin:1rem 0 .4rem; }
    .prose-editor p  { margin-bottom:.875rem; }
    .prose-editor ul { list-style:disc; padding-left:1.25rem; margin:.75rem 0; }
    .prose-editor ol { list-style:decimal; padding-left:1.25rem; margin:.75rem 0; }
    .prose-editor li { margin-bottom:.35rem; }
    .prose-editor blockquote { border-left:3px solid #e11d48; padding:.75rem 1rem; background:#fff1f2; border-radius:0 .5rem .5rem 0; margin:.875rem 0; font-style:italic; }
    .prose-editor a  { color:#e11d48; text-decoration:underline; }
    .prose-editor strong { font-weight:700; }
    .prose-editor pre,.prose-editor code { background:#f3f4f6; border:1px solid #e5e7eb; padding:.2em .4em; border-radius:4px; font-size:.875em; font-family:'Courier New',monospace; color:#e11d48; }
</style>
@endpush

@push('scripts')
<script>
(function () {
'use strict';

const titleInput = document.getElementById('title');
const slugInput = document.getElementById('slug');
let slugManuallyEdited = slugInput.value.length > 0;

slugInput.addEventListener('input', () => { slugManuallyEdited = true; });

function toSlug(str) {
    return str.toLowerCase().trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .replace(/^-|-$/g, '');
}

titleInput.addEventListener('input', () => {
    if (slugManuallyEdited) return;
    slugInput.value = toSlug(titleInput.value);
});

function execCmd(cmd) {
    const editor = document.getElementById('editor');
    editor.focus();
    
    if (cmd === 'h2') {
        document.execCommand('formatBlock', false, 'h2');
    } else if (cmd === 'h3') {
        document.execCommand('formatBlock', false, 'h3');
    } else if (cmd === 'blockquote') {
        document.execCommand('formatBlock', false, 'blockquote');
    } else if (cmd === 'code') {
        document.execCommand('formatBlock', false, 'pre');
    } else if (cmd === 'createLink') {
        const url = prompt('Enter URL:');
        if (url) document.execCommand('createLink', false, url);
    } else {
        document.execCommand(cmd, false, null);
    }
    syncBody();
}

const editor = document.getElementById('editor');
const body = document.getElementById('body');

function syncBody() {
    body.value = editor.innerHTML;
}

editor.addEventListener('input', syncBody);
document.getElementById('blogForm').addEventListener('submit', (e) => {
    syncBody();
    // Client-side validation
    const required = [
        { el: document.getElementById('title'), label: 'Post title' },
        { el: document.getElementById('slug'), label: 'Slug' },
        { el: editor, label: 'Content' },
    ];
    
    let firstError = null;
    required.forEach(({ el, label }) => {
        if (el === editor) {
            if (!el.textContent.trim()) {
                el.classList.add('border-crimson-500', 'ring-1', 'ring-crimson-500');
                if (!firstError) firstError = el;
            } else {
                el.classList.remove('border-crimson-500', 'ring-1', 'ring-crimson-500');
            }
        } else {
            if (!el.value.trim()) {
                el.classList.add('border-crimson-500', 'ring-1', 'ring-crimson-500');
                if (!firstError) firstError = el;
            } else {
                el.classList.remove('border-crimson-500', 'ring-1', 'ring-crimson-500');
            }
        }
    });
    
    if (firstError) {
        e.preventDefault();
        firstError.focus?.();
        firstError.scrollIntoView?.({ behavior: 'smooth', block: 'center' });
    }
});

function previewImage(input) {
    const file = input.files[0];
    if (!file) return;
    
    const reader = new FileReader();
    reader.onload = e => {
        const preview = document.getElementById('previewImg');
        const previewWrap = document.getElementById('imagePreview');
        preview.src = e.target.result;
        previewWrap.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}

window.execCmd = execCmd;
window.previewImage = previewImage;

})();
</script>
@endpush