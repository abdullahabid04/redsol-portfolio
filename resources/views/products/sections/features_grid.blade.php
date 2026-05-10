<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="font-display font-800 text-3xl text-gray-900 mb-10">
            {{ $section->settings['heading'] ?? 'Key Features' }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($module->features as $feature)
                <div class="flex items-start gap-3 bg-white rounded-2xl p-5 border border-gray-100
                            hover:border-crimson-200 hover:shadow-sm transition-all duration-200">
                    <div
                        class="w-6 h-6 rounded-full bg-crimson-500/10 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-crimson-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="font-body text-sm text-gray-700 leading-relaxed">
                        {{ $feature->feature_text }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</section>
