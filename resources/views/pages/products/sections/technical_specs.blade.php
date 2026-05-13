<section class="py-20 bg-gray-50">
    <div class="max-w-5xl mx-auto px-6">

        <div class="mb-10">
            <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-700">Technical</span>
            <h2 class="font-display font-800 text-3xl text-gray-900 mt-2">
                {{ $section->settings['heading'] ?? 'Technical Specifications' }}
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Specs table --}}
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <span class="font-display font-700 text-gray-700 text-sm">System Specifications</span>
                </div>
                <div class="divide-y divide-gray-50">
                    @foreach($section->settings['specs'] as $spec)
                        <div class="flex items-start px-6 py-4">
                            <span
                                class="w-44 shrink-0 font-display font-600 text-gray-500 text-xs uppercase tracking-wide pt-0.5">
                                {{ $spec['label'] }}
                            </span>
                            <span class="font-body text-gray-800 text-sm leading-relaxed">
                                {{ $spec['value'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Standards --}}
            <div>
                <h3 class="font-display font-700 text-gray-700 text-sm uppercase tracking-wide mb-4">
                    Supported Standards & Protocols
                </h3>
                <div class="flex flex-wrap gap-2 mb-8">
                    @foreach($section->settings['standards'] as $std)
                        <span class="px-3 py-2 bg-white border border-gray-200 rounded-xl
                                     font-display font-700 text-xs text-gray-700
                                     hover:border-crimson-300 hover:text-crimson-600 transition-colors duration-200">
                            {{ $std }}
                        </span>
                    @endforeach
                </div>

                @if(!empty($section->settings['requirements']))
                    <h3 class="font-display font-700 text-gray-700 text-sm uppercase tracking-wide mb-4">
                        System Requirements
                    </h3>
                    <ul class="space-y-2">
                        @foreach($section->settings['requirements'] as $req)
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-crimson-400 shrink-0 mt-0.5" fill="currentColor"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span class="font-body text-gray-600 text-sm">{{ $req }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>
</section>
