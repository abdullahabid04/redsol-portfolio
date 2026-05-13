<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-6">

        <div class="mb-10">
            <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-700">Documentation</span>
            <h2 class="font-display font-800 text-3xl text-gray-900 mt-2">
                {{ $section->settings['heading'] ?? 'Quick Start Guide' }}
            </h2>
            @if(!empty($section->settings['intro']))
                <p class="font-body text-gray-500 text-base mt-3">{{ $section->settings['intro'] }}</p>
            @endif
        </div>

        <div class="space-y-4" x-data="{ open: 0 }">
            @foreach($section->settings['sections'] as $idx => $doc)
                <div class="border border-gray-100 rounded-2xl overflow-hidden"
                     x-data="{ open: {{ $idx === 0 ? 'true' : 'false' }} }">

                    <button @click="open = !open"
                            class="w-full flex items-center justify-between px-6 py-5 text-left
                                   hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-crimson-500/10 text-crimson-600
                                         flex items-center justify-center text-sm font-display font-800">
                                {{ $idx + 1 }}
                            </span>
                            <span class="font-display font-700 text-gray-900 text-base">{{ $doc['title'] }}</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200"
                             :class="{ 'rotate-180': open }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-collapse class="border-t border-gray-100">
                        <div class="px-6 py-5">
                            <p class="font-body text-gray-600 text-sm leading-[1.85] mb-4">{{ $doc['content'] }}</p>
                            @if(!empty($doc['steps']))
                                <ol class="space-y-2 mt-3">
                                    @foreach($doc['steps'] as $step)
                                        <li class="flex items-start gap-3">
                                            <span class="shrink-0 w-5 h-5 rounded-full bg-crimson-100 text-crimson-700
                                                         flex items-center justify-center text-xs font-display font-800 mt-0.5">
                                                {{ $loop->iteration }}
                                            </span>
                                            <span class="font-body text-gray-600 text-sm">{{ $step }}</span>
                                        </li>
                                    @endforeach
                                </ol>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        @if(!empty($section->settings['note']))
            <div class="mt-6 flex items-start gap-3 p-4 bg-amber-50 rounded-xl border border-amber-200">
                <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                          clip-rule="evenodd"/>
                </svg>
                <p class="font-body text-amber-800 text-sm">{{ $section->settings['note'] }}</p>
            </div>
        @endif

    </div>
</section>
