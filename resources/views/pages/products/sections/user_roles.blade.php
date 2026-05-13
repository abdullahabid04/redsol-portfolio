<section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">

        <div class="mb-12">
            <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-700">Users</span>
            <h2 class="font-display font-800 text-3xl text-gray-900 mt-2">
                {{ $section->settings['heading'] ?? 'Who Uses This Module' }}
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($section->settings['roles'] as $role)
                <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:border-crimson-200
                            hover:shadow-lg hover:shadow-crimson-500/5 transition-all duration-300">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-crimson-500/10 flex items-center justify-center text-xl">
                            {{ $role['icon'] }}
                        </div>
                        <h3 class="font-display font-700 text-gray-900 text-base">{{ $role['role'] }}</h3>
                    </div>
                    <ul class="space-y-2">
                        @foreach($role['responsibilities'] as $resp)
                            <li class="flex items-start gap-2">
                                <div class="w-1.5 h-1.5 rounded-full bg-crimson-400 mt-2 shrink-0"></div>
                                <span class="font-body text-gray-600 text-xs leading-relaxed">{{ $resp }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

    </div>
</section>
