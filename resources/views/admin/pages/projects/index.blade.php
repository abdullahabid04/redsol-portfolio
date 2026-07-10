@extends('admin.layouts.app')

@section('title', 'Projects')
@section('page-title', 'Projects')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}"
        class="text-xs font-body text-gray-400 hover:text-crimson-500 transition-colors">Dashboard</a>
    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
    <span class="text-xs font-body text-gray-500">Projects</span>
@endsection

@section('content')

    @php
        $projects = $projects ?? collect([
            (object) ['id' => 1, 'title' => 'DHQ Hospital RYK — Full HIS Deployment', 'client' => 'DHQ Hospital RYK', 'location' => 'Rahim Yar Khan', 'industry' => 'Government', 'is_published' => true, 'is_featured' => true, 'year' => '2024', 'slug' => 'dhq-hospital-ryk'],
            (object) ['id' => 2, 'title' => 'Bahawal Victoria Hospital — LIMS & Radiology', 'client' => 'Bahawal Victoria Hospital', 'location' => 'Bahawalpur', 'industry' => 'Government', 'is_published' => true, 'is_featured' => false, 'year' => '2024', 'slug' => 'bahawal-victoria'],
            (object) ['id' => 3, 'title' => 'Allied Hospital Faisalabad — Emergency & OT', 'client' => 'Allied Hospital Faisalabad', 'location' => 'Faisalabad', 'industry' => 'Teaching', 'is_published' => true, 'is_featured' => false, 'year' => '2024', 'slug' => 'allied-hospital-faisalabad'],
            (object) ['id' => 4, 'title' => 'Shifa International — Patient Portal & App', 'client' => 'Shifa International', 'location' => 'Islamabad', 'industry' => 'Private', 'is_published' => true, 'is_featured' => true, 'year' => '2023', 'slug' => 'shifa-international'],
            (object) ['id' => 5, 'title' => 'Nishtar Hospital Multan — Full HIS Rollout', 'client' => 'Nishtar Hospital', 'location' => 'Multan', 'industry' => 'Teaching', 'is_published' => true, 'is_featured' => false, 'year' => '2023', 'slug' => 'nishtar-hospital-multan'],
            (object) ['id' => 6, 'title' => 'CMH Rawalpindi — Pharmacy & Inventory', 'client' => 'CMH Rawalpindi', 'location' => 'Rawalpindi', 'industry' => 'Government', 'is_published' => false, 'is_featured' => false, 'year' => '2022', 'slug' => 'cmh-rawalpindi'],
        ]);

        $industryColors = [
            'Government' => 'bg-crimson-500/10 text-crimson-600 border-crimson-500/20',
            'Teaching' => 'bg-gray-900/8 text-gray-700 border-gray-900/15',
            'Private' => 'bg-gray-100 text-gray-600 border-gray-200',
            'Diagnostic' => 'bg-crimson-500/10 text-crimson-600 border-crimson-500/20',
        ];
    @endphp

    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
        <div class="flex items-center gap-2 flex-wrap">
            @foreach(['all' => 'All', 'published' => 'Published', 'drafts' => 'Drafts', 'featured' => 'Featured'] as $val => $label)
                <a href="{{ request()->fullUrlWithQuery(['filter' => $val]) }}" class="px-3 py-1.5 rounded-lg text-xs font-display font-600 tracking-wide transition-all
                          {{ request('filter', 'all') === $val
                ? 'bg-crimson-500 text-white shadow-sm shadow-crimson-500/25'
                : 'bg-white text-gray-500 border border-gray-200 hover:border-gray-300 hover:text-gray-900' }}">
                    {{ $label }}
                </a>
            @endforeach

            <form action="{{ route('admin.projects.index') }}" method="GET" class="ml-1">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search projects..."
                        class="pl-9 pr-4 py-1.5 text-xs font-body border border-gray-200 rounded-lg bg-white text-gray-700 placeholder-gray-400
                                  focus:outline-none focus:border-crimson-500/40 focus:ring-2 focus:ring-crimson-500/10 w-44 transition-all">
                </div>
            </form>
        </div>

        <a href="{{ route('admin.projects.create') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-crimson-500 text-white font-display font-600 text-sm
                  hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25 shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Add Project
        </a>
    </div>

    
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th
                            class="text-left px-5 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">
                            Project</th>
                        <th
                            class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden md:table-cell">
                            Client</th>
                        <th
                            class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden lg:table-cell">
                            Industry</th>
                        <th
                            class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">
                            Status</th>
                        <th
                            class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden lg:table-cell">
                            Year</th>
                        <th
                            class="px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($projects as $project)
                        <tr class="hover:bg-gray-50/60 transition-colors group">

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    
                                    @if($project->is_featured)
                                        <svg class="w-3.5 h-3.5 text-amber-400 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    @endif
                                    <div>
                                        <div
                                            class="font-body text-sm font-600 text-gray-800 group-hover:text-crimson-600 transition-colors line-clamp-1">
                                            {{ $project->title }}
                                        </div>
                                        <div class="font-body text-xs text-gray-400 mt-0.5 hidden sm:block">
                                            {{ $project->location }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-4 hidden md:table-cell">
                                <span class="font-body text-sm text-gray-600">{{ $project->client }}</span>
                            </td>

                            <td class="px-4 py-4 hidden lg:table-cell">
                                <span
                                    class="inline-block text-[10px] font-display font-700 tracking-wide px-2 py-1 rounded-md border
                                             {{ $industryColors[$project->industry] ?? 'bg-gray-100 text-gray-500 border-gray-200' }}">
                                    {{ $project->industry }}
                                </span>
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex flex-col gap-1">
                                    @if($project->is_published)
                                        <span
                                            class="inline-flex items-center gap-1.5 text-[10px] font-700 font-display px-2 py-1 rounded-lg bg-green-50 text-green-600 border border-green-200 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Published
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 text-[10px] font-700 font-display px-2 py-1 rounded-lg bg-gray-100 text-gray-500 border border-gray-200 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Draft
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td class="px-4 py-4 hidden lg:table-cell">
                                <span class="font-body text-xs text-gray-400">{{ $project->year }}</span>
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex items-center justify-end gap-1.5">
                                    
                                    {{-- <a href="/projects/{{ $project->slug }}" target="_blank"
                                        class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-gray-700 hover:border-gray-300 transition-all"
                                        title="Preview on site">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a> --}}
                                    
                                    {{-- <form method="POST" action="{{ route('admin.projects.toggleFeatured', $project->id) }}">
                                        @csrf
                                        <button type="submit"
                                            title="{{ $project->is_featured ? 'Unfeature' : 'Set as featured' }}"
                                            class="w-7 h-7 rounded-lg border flex items-center justify-center transition-all
                                                       {{ $project->is_featured ? 'bg-amber-50 text-amber-500 border-amber-200 hover:bg-amber-100' : 'border-gray-200 text-gray-400 hover:text-amber-500 hover:border-amber-200' }}">
                                            <svg class="w-3.5 h-3.5"
                                                fill="{{ $project->is_featured ? 'currentColor' : 'none' }}"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </button>
                                    </form> --}}
                                    
                                    <a href="{{ route('admin.projects.edit', $project->id) }}"
                                        class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-crimson-500 hover:border-crimson-500/30 hover:bg-crimson-50 transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    
                                    <form method="POST" action="{{ route('admin.projects.destroy', $project->id) }}"
                                        onsubmit="return confirm('Delete this project?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                    <p class="font-display font-700 text-gray-500 text-sm">No projects yet</p>
                                    <a href="{{ route('admin.projects.create') }}"
                                        class="flex items-center gap-2 px-4 py-2 rounded-xl bg-crimson-500 text-white font-display font-600 text-xs hover:bg-crimson-600 transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Add first project
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($projects) && method_exists($projects, 'links') && $projects->hasPages())
            <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/50">
                {{ $projects->links() }}
            </div>
        @endif
    </div>

@endsection