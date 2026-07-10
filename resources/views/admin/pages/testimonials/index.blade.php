@extends('admin.layouts.app')

@section('title', 'Testimonials')
@section('page-title', 'Testimonials')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}"
        class="text-xs font-body text-gray-400 hover:text-crimson-500 transition-colors">Dashboard</a>
    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
    <span class="text-xs font-body text-gray-500">Testimonials</span>
@endsection

@section('content')<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 mb-6">
        
        <div
            class="col-span-2 sm:col-span-1 bg-gray-900 rounded-2xl px-5 py-4 flex items-center gap-4 relative overflow-hidden">
            <div class="absolute inset-0 opacity-25"
                style="background-image:linear-gradient(rgba(225,29,72,0.1) 1px,transparent 1px),linear-gradient(90deg,rgba(225,29,72,0.1) 1px,transparent 1px);background-size:20px 20px;">
            </div>
            <div class="relative">
                <div class="font-display font-800 text-3xl text-white leading-none">{{ $stats['total'] }}</div>
                <div class="font-body text-xs text-gray-400 mt-0.5">Total testimonials</div>
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
            <div class="font-display font-800 text-2xl text-gray-900 leading-none">{{ $stats['active'] }}</div>
            <div class="font-body text-xs text-gray-400 mt-0.5 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Active
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
            <div class="font-display font-800 text-2xl text-gray-900 leading-none">{{ $stats['featured'] }}</div>
            <div class="font-body text-xs text-gray-400 mt-0.5 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>Featured
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
        <div class="bg-white border border-gray-200 rounded-2xl px-4 py-4">
            <div class="font-display font-800 text-2xl text-gray-900 leading-none">—</div>
            <div class="font-body text-[10px] text-gray-400 mt-0.5 leading-tight">—</div>
        </div>
    </div>

    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
        
        <div class="flex items-center gap-2 flex-wrap">
            @foreach(['all' => 'All', 'active' => 'Active', 'inactive' => 'Inactive'] as $val => $label)
                <a href="{{ request()->fullUrlWithQuery(['status' => $val === 'all' ? null : $val]) }}" class="px-3 py-1.5 rounded-lg text-xs font-display font-600 tracking-wide transition-all
                          {{ (request('status') === $val || ($val === 'all' && !request('status')))
                ? 'bg-crimson-500 text-white shadow-sm shadow-crimson-500/25'
                : 'bg-white text-gray-500 border border-gray-200 hover:border-gray-300 hover:text-gray-900' }}">
                    {{ $label }}
                </a>
            @endforeach

            
            <form action="{{ route('admin.testimonials.index') }}" method="GET" class="flex items-center gap-2 ml-1">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search testimonials..."
                        class="pl-9 pr-4 py-1.5 text-xs font-body border border-gray-200 rounded-lg bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:border-crimson-500/40 focus:ring-2 focus:ring-crimson-500/10 w-44 transition-all">
                </div>
            </form>
        </div>

        
        <a href="{{ route('admin.testimonials.create') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-crimson-500 text-white font-display font-600 text-sm
                  hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25 shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Add Testimonial
        </a>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 mb-6">
        @forelse($testimonials as $testimonial)
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden group hover:border-crimson-500/20 hover:shadow-lg hover:shadow-crimson-500/5 transition-all duration-300"
                id="testimonial-{{ $testimonial->id }}">

                
                <div class="h-1 {{ $testimonial->is_active ? 'bg-green-400' : 'bg-gray-200' }}"></div>

                <div class="p-6">
                    
                    <div class="flex items-center gap-1 mb-4">
                        @foreach($testimonial->starsArray() as $filled)
                            <svg class="w-4 h-4 {{ $filled ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        @endforeach
                        <span class="ml-1 font-body text-xs text-gray-400">{{ $testimonial->rating }}/5</span>
                    </div>

                    
                    <div class="font-display text-5xl text-crimson-500/10 leading-none mb-1 select-none">"</div>
                    <blockquote class="font-body text-sm text-gray-600 leading-relaxed italic mb-5 line-clamp-3">
                        "{{ $testimonial->quote }}"
                    </blockquote>

                    
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <div class="w-9 h-9 rounded-full bg-gray-900 flex items-center justify-center shrink-0">
                            @if($testimonial->photo)
                                <img src="{{ $testimonial->photoUrl() }}" alt="{{ $testimonial->author_name }}"
                                    class="w-full h-full object-cover rounded-full">
                            @else
                                <span class="font-display font-700 text-white text-xs">{{ $testimonial->author_initials }}</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-display font-700 text-gray-900 text-sm truncate">{{ $testimonial->author_name }}
                            </div>
                            <div class="font-body text-xs text-gray-400 truncate">
                                {{ $testimonial->author_role }}{{ $testimonial->hospital ? ', ' . $testimonial->hospital : '' }}
                            </div>
                        </div>
                    </div>

                    
                    <div class="flex items-center gap-2 mt-4 pt-4 border-t border-gray-100">
                        
                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" title="Edit testimonial"
                            class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-crimson-600 hover:border-crimson-500/30 hover:bg-crimson-500/5 transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>

                        
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
                            onsubmit="return confirm('Delete this testimonial?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-8 h-8 rounded-xl border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white border border-gray-200 rounded-2xl py-20 flex flex-col items-center gap-3">
                <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center">
                    <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
                <p class="font-display font-700 text-gray-500">No testimonials yet</p>
                <p class="font-body text-xs text-gray-400">Add your first client testimonial to get started.</p>
            </div>
        @endforelse
    </div>

    
    @if($testimonials->hasPages())
        <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/50">
            {{ $testimonials->links() }}
        </div>
    @endif

@endsection