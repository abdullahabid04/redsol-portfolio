<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="font-display font-800 text-3xl text-gray-900 mb-4">
            {{ $section->settings['heading'] ?? 'Integration Points' }}
        </h2>
        <p class="font-body text-gray-500 text-sm mb-8">
            This module is designed to work seamlessly with the rest of the REDSOL HIS platform.
        </p>
        <div class="flex flex-wrap gap-3">
            @php
                $allModules = \App\Models\HisModule::published()
                    ->where('slug', '!=', $module->slug)
                    ->orderBy('sort_order')
                    ->pluck('name', 'slug');
            @endphp
            @foreach($allModules as $s => $n)
                <a href="{{ route('products.show', $s) }}"
                   class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-display font-600
                          bg-gray-100 text-gray-600 hover:bg-crimson-500 hover:text-white
                          transition-all duration-200 border border-gray-200">
                    {{ $n }}
                </a>
            @endforeach
        </div>
    </div>
</section>
