@extends('admin.layouts.app')

@section('title', 'Contact Enquiries')
@section('page-title', 'Contact Enquiries')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="text-xs font-body text-gray-400 hover:text-crimson-500 transition-colors">Dashboard</a>
    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-xs font-body text-gray-500">Enquiries</span>
@endsection

@section('content')


<div class="grid grid-cols-3 gap-4 mb-5">
    @foreach([
        ['label'=>'Total','value'=>$totalContacts,'color'=>'gray'],
        ['label'=>'Unread','value'=>$unreadCount,'color'=>'crimson'],
        ['label'=>'Read','value'=>$readCount,'color'=>'green'],
    ] as $s)
    <div class="bg-white border border-gray-200 rounded-2xl px-5 py-4 flex items-center gap-4">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0
                    {{ $s['color']==='crimson' ? 'bg-crimson-500/10 border border-crimson-500/20' : ($s['color']==='green' ? 'bg-green-50 border border-green-200' : 'bg-gray-100 border border-gray-200') }}">
            <svg class="w-4 h-4 {{ $s['color']==='crimson' ? 'text-crimson-500' : ($s['color']==='green' ? 'text-green-500' : 'text-gray-500') }}"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <div>
            <div class="font-display font-800 text-2xl text-gray-900 leading-none">{{ $s['value'] }}</div>
            <div class="font-body text-xs text-gray-400 mt-0.5">{{ $s['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>


<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
    <div class="flex items-center gap-2 flex-wrap">
        @foreach(['all'=>'All Enquiries','unread'=>'Unread','read'=>'Read'] as $val => $label)
        <a href="{{ request()->fullUrlWithQuery(['filter' => $val]) }}"
           class="px-3 py-1.5 rounded-lg text-xs font-display font-600 tracking-wide transition-all
                  {{ (request('filter','all') === $val)
                      ? 'bg-crimson-500 text-white shadow-sm shadow-crimson-500/25'
                      : 'bg-white text-gray-500 border border-gray-200 hover:border-gray-300 hover:text-gray-900' }}">
            {{ $label }}
        </a>
        @endforeach
    </div>

    <div class="flex items-center gap-2">
        <form action="{{ route('admin.contacts.index') }}" method="GET" class="flex items-center gap-2">
            <input type="hidden" name="filter" value="{{ request('filter', 'all') }}">
            <div class="flex items-center border border-gray-200 rounded-lg bg-white focus-within:border-crimson-500/40 focus-within:ring-2 focus-within:ring-crimson-500/10 transition-all overflow-hidden">
                <svg class="w-3.5 h-3.5 text-gray-400 ml-3 shrink-0 pointer-events-none"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by name or subject..."
                       class="flex-1 pl-2 pr-4 py-2 text-xs font-body bg-transparent text-gray-700 placeholder-gray-400 focus:outline-none border-none w-44 transition-all">
            </div>
        </form>

        @if($unreadCount > 0)
        <form method="POST" action="{{ route('admin.contacts.markAllRead') }}">
            @csrf
            <button type="submit"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-200 text-xs font-display font-600 text-gray-500 hover:text-gray-900 hover:bg-gray-50 transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Mark all read
            </button>
        </form>
        @endif
    </div>
</div>


<div class="grid grid-cols-1 xl:grid-cols-[1fr_420px] gap-5" x-data="{ selected: null }">
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-100 bg-gray-50/50">
            <span class="font-display font-700 text-gray-900 text-sm">
                {{ $contacts->count() }} Enquir{{ $contacts->count() === 1 ? 'y' : 'ies' }}
            </span>
            @if($unreadCount > 0)
            <span class="font-display font-700 text-[10px] text-white bg-crimson-500 px-2 py-0.5 rounded-md">
                {{ $unreadCount }} unread
            </span>
            @endif
        </div>

        <div class="divide-y divide-gray-50">
            @forelse($contacts as $contact)
            <div 
                @click.prevent="selected = @js([
                    'id' => $contact->id,
                    'name' => $contact->name,
                    'email' => $contact->email,
                    'phone' => $contact->phone ?? '',
                    'company' => $contact->company ?? '',
                    'subject' => $contact->subject,
                    'message' => $contact->message,
                    'is_read' => (bool) $contact->is_read,
                    'created_at' => $contact->created_at->format('M j, Y · g:i A')
                ])"
                class="flex items-start gap-3.5 px-5 py-4 cursor-pointer transition-all group
                       {{ !$contact->is_read ? 'bg-crimson-500/2' : '' }}
                       hover:bg-gray-50">

                <div class="w-9 h-9 rounded-xl shrink-0 flex items-center justify-center font-display font-700 text-sm
                            {{ !$contact->is_read ? 'bg-crimson-500 text-white' : 'bg-gray-100 text-gray-600' }}">
                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2 mb-0.5">
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="font-body text-sm font-600 text-gray-800 truncate">{{ $contact->name }}</span>
                            @if(!$contact->is_read)
                            <span class="w-1.5 h-1.5 rounded-full bg-crimson-500 shrink-0"></span>
                            @endif
                        </div>
                        <span class="font-body text-[10px] text-gray-400 shrink-0">{{ $contact->created_at->format('M j, Y · g:i A') }}</span>
                    </div>
                    <div class="font-body text-xs font-500 text-gray-700 truncate mb-0.5">{{ $contact->subject }}</div>
                    <div class="font-body text-xs text-gray-400 truncate">{{ Str::limit($contact->message, 60) }}</div>
                </div>
            </div>
            @empty
            <div class="px-5 py-16 text-center">
                <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <p class="font-display font-700 text-gray-500 text-sm">No enquiries yet</p>
                <p class="font-body text-xs text-gray-400 mt-1">They'll appear here when submitted from the site.</p>
            </div>
            @endforelse
        </div>
    </div>

    
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden self-start sticky top-24">

        
        <template x-if="!selected">
            <div class="flex flex-col items-center justify-center py-20 px-8 text-center">
                <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <p class="font-display font-700 text-gray-500 text-sm">Select an enquiry</p>
                <p class="font-body text-xs text-gray-400 mt-1">Click any enquiry on the left to read the full message.</p>
            </div>
        </template>

        
        <template x-if="selected">
            <div>
                
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-crimson-500 flex items-center justify-center font-display font-700 text-white shrink-0"
                             x-text="selected.name.charAt(0).toUpperCase()"></div>
                        <div class="flex-1 min-w-0">
                            <div class="font-display font-700 text-gray-900 text-sm" x-text="selected.name"></div>
                            <div class="font-body text-xs text-gray-400 truncate" x-text="selected.email"></div>
                        </div>
                        <span class="text-[10px] font-body text-gray-400 shrink-0" x-text="selected.created_at"></span>
                    </div>
                </div>

                
                <div class="px-5 py-5">
                    <div class="mb-4">
                        <div class="font-body text-[10px] font-600 text-gray-400 tracking-widest uppercase mb-1">Subject</div>
                        <div class="font-display font-700 text-gray-900 text-base leading-tight" x-text="selected.subject"></div>
                    </div>

                    <template x-if="selected.company">
                        <div class="mb-4">
                            <div class="font-body text-[10px] font-600 text-gray-400 tracking-widest uppercase mb-1">Company</div>
                            <div class="font-body text-sm text-gray-700" x-text="selected.company"></div>
                        </div>
                    </template>

                    <template x-if="selected.phone">
                        <div class="mb-4">
                            <div class="font-body text-[10px] font-600 text-gray-400 tracking-widest uppercase mb-1">Phone</div>
                            <div class="font-body text-sm text-gray-700" x-text="selected.phone"></div>
                        </div>
                    </template>

                    <div class="mb-5">
                        <div class="font-body text-[10px] font-600 text-gray-400 tracking-widest uppercase mb-2">Message</div>
                        <div class="bg-gray-50 border border-gray-100 rounded-xl px-4 py-4 font-body text-sm text-gray-700 leading-relaxed whitespace-pre-wrap" x-text="selected.message"></div>
                    </div>

                    
                    <div class="flex gap-2">
                        <a :href="'mailto:' + selected.email + '?subject=Re: ' + encodeURIComponent(selected.subject)"
                           class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-crimson-500 text-white font-display font-600 text-sm
                                  hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                            Reply via Email
                        </a>
                        <form :action="'/admin/contacts/' + selected.id + '/toggle-read'" method="POST">
                            @csrf
                            <button type="submit"
                                    class="px-3 py-2.5 rounded-xl border border-gray-200 text-gray-500 font-display font-600 text-sm hover:bg-gray-50 transition-all"
                                    x-text="selected.is_read ? 'Mark Unread' : 'Mark Read'">
                            </button>
                        </form>
                    </div>

                    
                    <form :action="'/admin/contacts/' + selected.id" method="POST" class="mt-2"
                          onsubmit="return confirm('Delete this enquiry? This cannot be undone.')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-xl border border-red-100 text-red-500 font-body text-xs font-500 hover:bg-red-50 transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Delete Enquiry
                        </button>
                    </form>
                </div>
            </div>
        </template>

    </div>

</div>
@endsection