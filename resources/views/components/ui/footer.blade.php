<footer class="relative border-t border-gray-200 pt-20 pb-10 mt-32 bg-gray-900">
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to-black pointer-events-none"></div>
    <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">


            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-4">

                    <div class="w-45 h-full">
                        <div class="w-full h-full flex items-center justify-center">
                            <img src="{{ asset('images/logo.svg') }}" alt="REDSOL Logo"
                                class="w-full h-full object-contain">
                        </div>
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Transforming healthcare through intelligent software. Building the digital infrastructure hospitals
                    trust.
                </p>
                <div class="flex gap-3">
                    @foreach (['linkedin', 'twitter', 'facebook'] as $social)
                        <a href="#"
                            class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-gray-500 hover:text-crimson-500 hover:border-crimson-500/30 transition-all duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                @if ($social === 'linkedin')
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                @elseif($social === 'twitter')
                                    <path
                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                @else
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                @endif
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>


            <div>
                <h4 class="font-display font-600 text-white text-sm tracking-wider uppercase mb-5">Company</h4>
                <ul class="space-y-3">
                    @foreach (['About Us' => '/about', 'Our Team' => '/about#team', 'Clients' => '/clients', 'Blog' => '/blog', 'Contact' => '/contact'] as $label => $href)
                        <li><a href="{{ $href }}"
                                class="text-sm text-gray-400 hover:text-crimson-400 transition-colors font-body">{{ $label }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>


            <div>
                <h4 class="font-display font-600 text-white text-sm tracking-wider uppercase mb-5">Services</h4>
                <ul class="space-y-3">
                    @forelse($services ?? [] as $service)
                        <li>
                            <a href="{{ $service->href }}"
                                class="text-sm text-gray-400 hover:text-crimson-400 transition-colors font-body">
                                {{ $service->name }}
                            </a>
                        </li>
                    @empty
                        <li><span class="text-sm text-gray-500">No services available</span></li>
                    @endforelse
                </ul>
            </div>


            <div>
                <h4 class="font-display font-600 text-white text-sm tracking-wider uppercase mb-5">Contact</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <svg class="w-4 h-4 text-crimson-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <div>
                            <span
                                class="text-[10px] font-display tracking-widest uppercase text-crimson-500/80 block mb-0.5">Head
                                Office — Pakistan</span>
                            <span class="text-sm text-gray-400 font-body leading-relaxed">
                                F-Block, Punjab Society,<br>
                                Near Good Luck Travel & Tours,<br>
                                Lahore, Pakistan
                            </span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-4 h-4 text-crimson-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <div>
                            <span
                                class="text-[10px] font-display tracking-widest uppercase text-crimson-500/80 block mb-0.5">US
                                Office</span>
                            <span class="text-sm text-gray-400 font-body leading-relaxed">
                                30 N Gould St Ste R,<br>
                                Sheridan, WY 82801, USA
                            </span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-4 h-4 text-crimson-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="mailto:info@redsoltechnologies.com"
                            class="text-sm text-gray-400 hover:text-crimson-400 transition-colors font-body">info@redsoltechnologies.com</a>
                    </li>

                    {{-- Phone --}}
                    <li class="flex items-start gap-3">
                        <svg class="w-4 h-4 text-crimson-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span class="text-sm text-gray-400 font-body">+92 302 1408287</span>
                    </li>
                </ul>
            </div>
        </div>


        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-xs text-gray-500 font-body">© {{ date('Y') }} REDSOL. All rights reserved. We Think In
                New Dimensions.</p>
            <div class="flex gap-6">
                <a href="/privacy"
                    class="text-xs text-gray-500 hover:text-crimson-400 transition-colors font-body">Privacy Policy</a>
                <a href="/terms" class="text-xs text-gray-500 hover:text-crimson-400 transition-colors font-body">Terms
                    of Use</a>
            </div>
        </div>
    </div>
</footer>
