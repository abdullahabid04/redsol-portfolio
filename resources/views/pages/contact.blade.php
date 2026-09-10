@extends('layouts.app')

@section('content')
    <section class="pt-32 pb-24 bg-white relative min-h-screen flex items-center">
            <!-- Background Elements (matches other pages) -->
            <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
                <!-- Light subtle glow -->
                <div class="absolute top-0 right-0 w-[600px] h-[600px] rounded-full bg-crimson-500/10 blur-[140px]"></div>
                <div class="absolute -bottom-20 -left-20 w-[400px] h-[400px] rounded-full bg-crimson-500/10 blur-[120px]"></div>

                <!-- Light grid -->
                <div class="absolute inset-0 opacity-40" style="
                    background-image: linear-gradient(rgba(0,0,0,0.04) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(0,0,0,0.04) 1px, transparent 1px);
                    background-size: 48px 48px;">
                </div>

                <!-- Bottom fade -->
                <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-white to-transparent"></div>
            </div>

            <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 w-full">
                <div class="max-w-3xl mx-auto text-center mb-16 reveal reveal-delay-1">
                    <h1 class="font-display font-800 text-5xl sm:text-6xl text-gray-900 leading-tight mb-4">
                        Let's Talk <span class="red-gradient-text">Digital Health</span>
                    </h1>
                    <p class="font-body text-gray-600 text-lg leading-relaxed mb-10 max-w-2xl">
                        Ready to digitize your hospital or campus? Send us a message and our implementation specialists will
                        get back to you within 24 hours.
                    </p>    
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-8 items-start">

                    <!-- Left: Form Section -->
                    <div class="lg:col-span-3 reveal reveal-delay-1">
                        <div class="bg-white border border-gray-200 shadow-lg rounded-3xl p-6 sm:p-10 shadow-2xl relative overflow-hidden">
                            <!-- Decorative glow inside card -->
                            <div class="absolute top-0 right-0 w-64 h-64 bg-crimson-500/10 rounded-full blur-[100px] pointer-events-none"></div>
                            <div class="relative z-10">
                                
                                @if(session('success'))
                                    <div class="bg-green-50 border border-green-200 rounded-xl p-6 text-center animate-fade-in">
                                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-gray-900 font-display font-bold text-2xl mb-2">Message Sent!</h3>
                                        <p class="text-gray-600">{{ session('success') }}</p>
                                        <a href="{{ route('contact.create') }}" class="mt-6 text-crimson-500 hover:text-crimson-600 font-semibold transition-colors">
                                            Send another message
                                        </a>
                                    </div>
                                @else
                                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                                        @csrf

                                        @if(session('error'))
                                            <div class="p-4 bg-red-50 border border-red-200 rounded-lg text-red-600 text-sm mb-6">
                                                {{ session('error') }}
                                            </div>
                                        @enderror

                                        <!-- Row 1 -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Full Name -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                                <input type="text" name="full_name" value="{{ old('full_name') }}"
                                                    class="w-full px-4 py-3 rounded-xl bg-white border 
                                                    @error('full_name') border-red-400 @else border-gray-300 @enderror
                                                    text-gray-900 placeholder-gray-400
                                                    focus:ring-2 focus:ring-crimson-500 focus:border-crimson-500 outline-none transition"
                                                    placeholder="John Doe">
                                                @error('full_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                            </div>

                                            <!-- Email -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                                <input type="email" name="email" value="{{ old('email') }}"
                                                    class="w-full px-4 py-3 rounded-xl bg-white border 
                                                    @error('email') border-red-400 @else border-gray-300 @enderror
                                                    text-gray-900 placeholder-gray-400
                                                    focus:ring-2 focus:ring-crimson-500 focus:border-crimson-500 outline-none transition"
                                                    placeholder="john@hospital.com">
                                                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <!-- Row 2 -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Phone -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                                <input type="tel" name="phone" value="{{ old('phone') }}"
                                                    class="w-full px-4 py-3 rounded-xl bg-white border 
                                                    @error('phone') border-red-400 @else border-gray-300 @enderror
                                                    text-gray-900 placeholder-gray-400
                                                    focus:ring-2 focus:ring-crimson-500 focus:border-crimson-500 outline-none transition"
                                                    placeholder="+1 (555) 000-0000">
                                                @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                            </div>

                                            <!-- Company -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Hospital / Organization</label>
                                                <input type="text" name="company" value="{{ old('company') }}"
                                                    class="w-full px-4 py-3 rounded-xl bg-white border 
                                                    @error('company') border-red-400 @else border-gray-300 @enderror
                                                    text-gray-900 placeholder-gray-400
                                                    focus:ring-2 focus:ring-crimson-500 focus:border-crimson-500 outline-none transition"
                                                    placeholder="City General Hospital">
                                                @error('company') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <!-- Row 3 -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Country -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                                                <input type="text" name="country" value="{{ old('country') }}"
                                                    class="w-full px-4 py-3 rounded-xl bg-white border 
                                                    @error('country') border-red-400 @else border-gray-300 @enderror
                                                    text-gray-900 placeholder-gray-400
                                                    focus:ring-2 focus:ring-crimson-500 focus:border-crimson-500 outline-none transition"
                                                    placeholder="e.g. Pakistan">
                                                @error('country') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                            </div>

                                            <!-- Service -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">I am interested in... *</label>
                                                <select name="service_interest"
                                                    class="w-full px-4 py-3 rounded-xl bg-white border 
                                                    @error('service_interest') border-red-400 @else border-gray-300 @enderror
                                                    text-gray-900
                                                    focus:ring-2 focus:ring-crimson-500 focus:border-crimson-500 outline-none transition">
                                                    <option value="">Select a service</option>
                                                    <option value="his" {{ old('service_interest') == 'his' ? 'selected' : '' }}>Health Information System (HIS)</option>
                                                    <option value="cms" {{ old('service_interest') == 'cms' ? 'selected' : '' }}>Campus Management System (CMS)</option>
                                                    <option value="custom_dev" {{ old('service_interest') == 'custom_dev' ? 'selected' : '' }}>Custom Software Development</option>
                                                    <option value="other" {{ old('service_interest') == 'other' ? 'selected' : '' }}>Other Inquiry</option>
                                                </select>
                                                @error('service_interest') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <!-- Message -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Your Message *</label>
                                            <textarea name="message" rows="5"
                                                class="w-full px-4 py-3 rounded-xl bg-white border 
                                                @error('message') border-red-400 @else border-gray-300 @enderror
                                                text-gray-900 placeholder-gray-400
                                                focus:ring-2 focus:ring-crimson-500 focus:border-crimson-500 outline-none transition resize-none">{{ old('message') }}</textarea>
                                            @error('message') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Submit -->
                                        <div class="pt-2 flex justify-end items-center">
                                            <button type="submit"
                                                class="bg-crimson-500 text-white font-semibold py-3 px-8 rounded-xl 
                                                shadow-md hover:bg-crimson-600 hover:shadow-lg transition-all duration-300">
                                                Send Message
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right: Contact Info Card -->
                    <div class="lg:col-span-2 reveal reveal-delay-2">
                        <div
                            class="rounded-3xl bg-white border border-gray-200 p-8 shadow-lg hover:shadow-xl hover:border-crimson-500/20 transition-all duration-400">

                            <h3 class="font-display font-700 text-gray-900 text-2xl mb-8">Contact Information</h3>

                            <div class="space-y-7">
                                <!-- Address -->
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-crimson-500/10 border border-crimson-500/20 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-crimson-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-display font-600 text-gray-900 mb-1">Global Headquarters</h4>
                                        <p class="font-body text-gray-500 text-sm leading-relaxed">
                                            Head Office — Pakistan<br />
                                            F-Block, Punjab Society<br />
                                            Near Good Luck Travel & Tours<br />
                                            Lahore, Pakistan<br />
                                        </p>
                                        <div class="my-4 border-t border-gray-200"></div>
                                        <p class="font-body text-gray-500 text-sm leading-relaxed">
                                            US Office<br />
                                            30 N Gould St Ste R,<br />
                                            Sheridan, WY 82801, USA<br />
                                        </p>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-crimson-500/10 border border-crimson-500/20 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-crimson-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-display font-600 text-gray-900 mb-1">Call Us</h4>
                                        <p class="font-body text-gray-500 text-sm mb-1"><a href="tel:+923021408287"
                                                class="text-crimson-500 hover:text-crimson-600 transition-colors">+92 302 1408287</a></p>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-crimson-500/10 border border-crimson-500/20 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-crimson-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-display font-600 text-gray-900 mb-1">Email Us</h4>
                                        <p class="font-body text-gray-500 text-sm mb-1">
                                            <a href="mailto:info@redsoltechnologies.com"
                                                class="text-crimson-500 hover:text-crimson-600 transition-colors">info@redsoltechnologies.com</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Trust badges -->
                            <div class="mt-8 pt-6 border-t border-gray-100">
                                <div class="flex flex-wrap gap-3">
                                    @foreach(['24/7 Support', 'Free Consultation', 'HIPAA Compliant', 'ISO Certified'] as $badge)
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-display font-600 tracking-wider uppercase bg-crimson-500/10 text-crimson-600 border border-crimson-500/20">
                                            {{ $badge }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>@endsection

@push('scripts')
    <script>
        // Reuse the same reveal observer from your global scripts
        const revealObs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));
    </script>
@endpush