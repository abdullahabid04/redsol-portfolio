<x-app-layout>
    <section class="pt-32 pb-24 bg-navy relative min-h-screen flex items-center">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-1/4 -right-1/4 w-[800px] h-[800px] bg-primary/10 rounded-full blur-[150px]"></div>
            <div class="absolute -bottom-1/4 -left-1/4 w-[800px] h-[800px] bg-cyan/10 rounded-full blur-[150px]"></div>
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at center, #ffffff 1px, transparent 1px); background-size: 40px 40px;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-8 items-start">
                
                <!-- Left: Form Section -->
                <div class="lg:col-span-3" data-aos="fade-right">
                    <nav class="flex mb-6 text-sm font-medium">
                        <ol class="flex items-center space-x-2">
                            <li><a href="{{ url('/') }}" class="text-text-dark/60 hover:text-white transition-colors">Home</a></li>
                            <li><span class="text-text-dark/40">/</span></li>
                            <li><span class="text-white">Contact Us</span></li>
                        </ol>
                    </nav>
                    
                    <h1 class="font-display font-extrabold text-5xl sm:text-6xl text-white mb-4">
                        Let's Talk <span class="text-gradient">Digital Health</span>
                    </h1>
                    <p class="text-xl text-text-dark/80 mb-10 max-w-2xl">
                        Ready to digitize your hospital or campus? Send us a message and our implementation specialists will get back to you within 24 hours.
                    </p>

                    <!-- Livewire Form -->
                    <div class="bg-steel/50 backdrop-blur-md border border-white/10 rounded-[30px] p-6 sm:p-10 shadow-2xl relative overflow-hidden">
                        <!-- Decorative glow inside card -->
                        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full blur-[80px] pointer-events-none"></div>
                        <div class="relative z-10">
                            <livewire:contact-form />
                        </div>
                    </div>
                </div>

                <!-- Right: Contact Info & Address Card -->
                <div class="lg:col-span-2 lg:pt-16" data-aos="fade-left" data-aos-delay="200">
                    <x-ui.glass-card class="border-primary/20 bg-midnight/80">
                        <h3 class="font-display font-bold text-2xl text-white mb-8">Contact Information</h3>
                        
                        <div class="space-y-8">
                            <!-- Address -->
                            <div class="flex items-start">
                                <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center flex-shrink-0 mr-4">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-sans font-bold mb-1">Global Headquarters</h4>
                                    <p class="text-text-dark/70 text-sm leading-relaxed">
                                        123 Innovation Drive<br/>
                                        Tech Park, Suite 400<br/>
                                        Metropolis, NY 10001
                                    </p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-start">
                                <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center flex-shrink-0 mr-4">
                                    <svg class="w-6 h-6 text-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-sans font-bold mb-1">Call Us</h4>
                                    <p class="text-text-dark/70 text-sm mb-1">Sales: +1 (800) 123-4567</p>
                                    <p class="text-text-dark/70 text-sm">Support: +1 (800) 987-6543</p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start">
                                <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center flex-shrink-0 mr-4">
                                    <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-sans font-bold mb-1">Email Us</h4>
                                    <p class="text-text-dark/70 text-sm mb-1"><a href="mailto:sales@redsol.com" class="hover:text-gold transition-colors">sales@redsol.com</a></p>
                                    <p class="text-text-dark/70 text-sm"><a href="mailto:support@redsol.com" class="hover:text-gold transition-colors">support@redsol.com</a></p>
                                </div>
                            </div>
                        </div>

                        <!-- Map Placeholder -->
                        <div class="mt-8 rounded-xl overflow-hidden h-48 relative bg-white/5 group border border-white/10">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-text-dark/40 font-mono text-sm tracking-widest">MAP PLACEHOLDER</span>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-midnight to-transparent opacity-50 group-hover:opacity-30 transition-opacity"></div>
                        </div>
                    </x-ui.glass-card>
                </div>

            </div>
        </div>
    </section>
</x-app-layout>
