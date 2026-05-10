<section class="py-20 bg-gray-900">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <h2 class="font-display font-900 text-3xl lg:text-4xl text-white mb-4">
            {{ $section->settings['heading'] ?? 'Ready to modernise this workflow?' }}
        </h2>
        <p class="font-body text-gray-400 text-base mb-8">
            {{ $section->settings['sub'] ?? '' }}
        </p>
        <a href="{{ $section->settings['btn_link'] ?? '/contact' }}"
           class="inline-flex items-center gap-2 px-8 py-4 rounded-xl font-display font-700
                  bg-crimson-500 text-white hover:bg-crimson-600 transition-all duration-200
                  hover:shadow-2xl hover:shadow-crimson-500/30 text-base">
            {{ $section->settings['btn_label'] ?? 'Schedule a Demo' }}
        </a>
    </div>
</section>
