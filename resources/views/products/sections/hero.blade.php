<section class="relative pt-24 pb-16 overflow-hidden {{ $module->card_bg }}">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row lg:items-center gap-8">
            <div class="flex-1">
                <span class="inline-block text-[11px] font-display font-700 tracking-widest uppercase
                             px-3 py-1.5 rounded-full border border-current/20 mb-6
                             {{ $module->badge_bg }} {{ $module->badge_text }}">
                    {{ $module->cat_label }}
                </span>
                <div class="flex items-start gap-5 mb-4">
                    <span class="text-6xl leading-none">{{ $module->icon }}</span>
                    <h1 class="font-display font-900 text-4xl lg:text-5xl leading-tight {{ $module->card_text }}">
                        {{ $module->name }}
                    </h1>
                </div>
                <p class="text-lg font-body {{ in_array($module->category, ['administration','diagnostics']) ? 'text-gray-300' : 'text-gray-500' }} mb-8 max-w-2xl">
                    {{ $module->tagline }}
                </p>
                @if($section->settings['show_cta'] ?? true)
                    <a href="{{ $section->settings['cta_link'] ?? '/contact' }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-display font-700
                              bg-crimson-500 text-white hover:bg-crimson-600 transition-all duration-200
                              hover:shadow-xl hover:shadow-crimson-500/30">
                        {{ $section->settings['cta_label'] ?? 'Request a Demo' }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
