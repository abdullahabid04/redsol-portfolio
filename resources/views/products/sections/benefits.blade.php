<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">

        <div class="mb-12">
            <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-700">Impact</span>
            <h2 class="font-display font-800 text-3xl text-gray-900 mt-2">
                {{ $section->settings['heading'] ?? 'Key Benefits' }}
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($section->settings['benefits'] as $benefit)
                <div class="flex gap-5 p-6 rounded-2xl border border-gray-100 hover:border-crimson-100
                            hover:shadow-md transition-all duration-300 group">
                    <div class="shrink-0">
                        <div class="w-12 h-12 rounded-xl bg-crimson-500 flex items-center justify-center
                                    text-white text-xl shadow-lg shadow-crimson-500/20 group-hover:scale-105
                                    transition-transform duration-200">
                            {{ $benefit['icon'] ?? '✓' }}
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between gap-3 mb-2">
                            <h3 class="font-display font-700 text-gray-900 text-base">{{ $benefit['title'] }}</h3>
                            @if(!empty($benefit['metric']))
                                <span class="shrink-0 text-xs font-display font-800 text-crimson-600
                                             bg-crimson-50 px-2.5 py-1 rounded-full border border-crimson-200">
                                    {{ $benefit['metric'] }}
                                </span>
                            @endif
                        </div>
                        <p class="font-body text-gray-600 text-sm leading-relaxed">{{ $benefit['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
