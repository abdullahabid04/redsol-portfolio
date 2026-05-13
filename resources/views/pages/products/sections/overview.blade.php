<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="font-display font-800 text-3xl text-gray-900 mb-6">
            {{ $section->settings['heading'] ?? 'Module Overview' }}
        </h2>
        <p class="font-body text-gray-600 text-base leading-[1.9]">
            {{ $module->description }}
        </p>
    </div>
</section>
