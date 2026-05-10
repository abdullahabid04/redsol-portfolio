<section class="py-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-6">

        <div class="mb-10 text-center">
            <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-700">FAQs</span>
            <h2 class="font-display font-800 text-3xl text-gray-900 mt-2">
                {{ $section->settings['heading'] ?? 'Frequently Asked Questions' }}
            </h2>
        </div>

        <div class="space-y-3" x-data="{}">
            @foreach($section->settings['items'] as $faq)
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden"
                     x-data="{ open: false }">

                    <button @click="open = !open"
                            class="w-full flex items-center justify-between px-6 py-5 text-left
                                   hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-display font-600 text-gray-900 text-sm pr-4">{{ $faq['question'] }}</span>
                        <div class="shrink-0 w-6 h-6 rounded-full bg-crimson-50 border border-crimson-100
                                    flex items-center justify-center transition-all duration-200"
                             :class="open ? 'bg-crimson-500 border-crimson-500' : ''">
                            <svg class="w-3 h-3 transition-all duration-200"
                                 :class="open ? 'text-white rotate-45' : 'text-crimson-500'"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                      d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                    </button>

                    <div x-show="open" x-collapse class="border-t border-gray-50">
                        <div class="px-6 py-5">
                            <p class="font-body text-gray-600 text-sm leading-[1.85]">{{ $faq['answer'] }}</p>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>
