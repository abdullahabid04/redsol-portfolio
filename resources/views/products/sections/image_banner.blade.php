<section class="py-12 bg-white">
    <div class="max-w-5xl mx-auto px-6">

        @if(!empty($section->settings['heading']))
            <h2 class="font-display font-800 text-2xl text-gray-900 mb-6">
                {{ $section->settings['heading'] }}
            </h2>
        @endif

        <div class="rounded-3xl overflow-hidden border border-gray-100 shadow-xl shadow-black/5">
            <img src="{{ $section->settings['image_url'] }}"
                 alt="{{ $section->settings['image_alt'] ?? $module->name }}"
                 class="w-full object-cover"
                 style="max-height: 480px;">
        </div>

        @if(!empty($section->settings['caption']))
            <p class="text-center font-body text-gray-400 text-sm mt-4 italic">
                {{ $section->settings['caption'] }}
            </p>
        @endif

    </div>
</section>
