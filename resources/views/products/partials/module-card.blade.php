<div class="module-card group rounded-3xl border border-gray-100 overflow-hidden mb-5 reveal
            transition-all duration-500 hover:shadow-2xl hover:shadow-black/8 hover:-translate-y-1"
     data-cat="{{ $module->category }}">

    <div class="{{ $module->card_bg }} p-8 lg:p-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Identity --}}
            <div class="lg:col-span-1">
                <div class="flex items-start gap-4 mb-6">
                    <div class="text-4xl leading-none">{{ $module->icon }}</div>
                    <div class="flex-1">
                        <span class="inline-block text-[10px] font-display font-600 tracking-wider uppercase
                                     px-2.5 py-1 rounded-full border border-current/20 mb-2
                                     {{ $module->badge_bg }} {{ $module->badge_text }}">
                            {{ $module->cat_label }}
                        </span>
                        <h3 class="font-display font-800 {{ $module->card_text }} text-xl leading-tight">
                            {{ $module->name }}
                        </h3>
                    </div>
                </div>

                <p class="{{ in_array($module->category, ['administration','diagnostics']) ? 'text-gray-400' : 'text-gray-500' }}
                           font-body text-sm leading-relaxed mb-6 italic">
                    "{{ $module->tagline }}"
                </p>

                <a href="{{ route('products.show', $module->slug) }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-display font-600
                          bg-crimson-500 text-white hover:bg-crimson-600 transition-all duration-200
                          hover:shadow-lg hover:shadow-crimson-500/25">
                    View Full Details
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                              d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            {{-- Description --}}
            <div class="lg:col-span-1">
                <p class="{{ in_array($module->category, ['administration','diagnostics']) ? 'text-gray-400' : 'text-gray-600' }}
                           font-body text-sm leading-[1.85]">
                    {{ $module->description }}
                </p>
            </div>

            {{-- Features --}}
            <div class="lg:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-4 h-px {{ $module->accent_bg }}"></div>
                    <span class="text-gray-400 text-xs font-display tracking-widest uppercase font-600">
                        Key Features
                    </span>
                </div>
                <ul class="space-y-2.5">
                    @foreach($module->features as $feature)
                        <li class="flex items-start gap-2.5">
                            <svg class="w-3.5 h-3.5 text-crimson-500 mt-0.5 shrink-0"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="{{ in_array($module->category, ['administration','diagnostics']) ? 'text-gray-400' : 'text-gray-600' }}
                                         font-body text-xs leading-relaxed">
                                {{ $feature->feature_text }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
