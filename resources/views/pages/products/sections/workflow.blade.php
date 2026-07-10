<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-6">

        <div class="mb-12">
            <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-700">Process</span>
            <h2 class="font-display font-800 text-3xl text-gray-900 mt-2">
                {{ $section->settings['heading'] ?? 'How It Works' }}
            </h2>
            @if(!empty($section->settings['subheading']))
                <p class="text-gray-500 font-body text-base mt-3 max-w-2xl">
                    {{ $section->settings['subheading'] }}
                </p>
            @endif
        </div>

        <div class="relative">
            
            <div
                class="absolute left-6 top-8 bottom-8 w-px bg-gradient-to-b from-crimson-200 via-crimson-400 to-crimson-200 hidden lg:block"></div>

            <div class="space-y-6">
                @foreach($section->settings['steps'] as $step)
                    <div class="flex gap-6 group">

                        
                        <div class="relative shrink-0">
                            <div class="w-12 h-12 rounded-full bg-crimson-500 text-white font-display font-900
                                        text-lg flex items-center justify-center shadow-lg shadow-crimson-500/25
                                        group-hover:scale-110 transition-transform duration-200 relative z-10">
                                {{ $loop->iteration }}
                            </div>
                        </div>

                        
                        <div class="flex-1 bg-gray-50 rounded-2xl p-6 border border-gray-100
                                    group-hover:border-crimson-100 group-hover:bg-crimson-50/30
                                    transition-all duration-300 pb-6">
                            <h3 class="font-display font-700 text-gray-900 text-base mb-2">
                                {{ $step['title'] }}
                            </h3>
                            <p class="font-body text-gray-600 text-sm leading-relaxed">
                                {{ $step['description'] }}
                            </p>
                            @if(!empty($step['note']))
                                <div class="mt-3 flex items-start gap-2">
                                    <svg class="w-4 h-4 text-amber-500 shrink-0 mt-0.5" fill="currentColor"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-xs font-body text-amber-700">{{ $step['note'] }}</span>
                                </div>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
