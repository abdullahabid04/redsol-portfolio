<section class="py-16 bg-gray-900">
    <div class="max-w-5xl mx-auto px-6">

        @if(!empty($section->settings['heading']))
            <h2 class="font-display font-800 text-2xl text-white text-center mb-12">
                {{ $section->settings['heading'] }}
            </h2>
        @endif

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($section->settings['stats'] as $stat)
                <div class="text-center">
                    <div class="font-display font-900 text-4xl lg:text-5xl text-crimson-400 mb-2 leading-none">
                        {{ $stat['value'] }}
                    </div>
                    <div class="font-body text-gray-400 text-sm leading-snug">
                        {{ $stat['label'] }}
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
