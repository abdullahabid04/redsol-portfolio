<x-app-layout>
    <!-- Page Hero -->
    <section class="pt-32 pb-20 bg-navy relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <!-- Subtle grid background -->
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at center, #ffffff 1px, transparent 1px); background-size: 40px 40px;"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-primary/5 rounded-full blur-[150px]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <nav class="flex justify-center mb-6 text-sm font-medium">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ url('/') }}" class="text-text-dark/60 hover:text-white transition-colors">Home</a></li>
                    <li><span class="text-text-dark/40">/</span></li>
                    <li><span class="text-white">Services</span></li>
                </ol>
            </nav>
            <h1 class="font-display font-extrabold text-5xl sm:text-6xl text-white mb-6" data-aos="fade-up">
                Professional <span class="text-gradient">Services</span>
            </h1>
            <p class="text-xl text-text-dark/80 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                End-to-end deployment, training, and integration services to ensure your HIS implementation is a resounding success.
            </p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-24 bg-midnight relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Implementation -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 rounded-2xl bg-cyan/10 flex items-center justify-center mb-6 shadow-[0_0_25px_rgba(0,212,255,0.2)]">
                        <svg class="w-8 h-8 text-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-white mb-4">Implementation</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed mb-6">
                        Flawless on-site or remote deployment of the REDSOL HIS platform. We handle server provisioning, network configurations, and database setup.
                    </p>
                    <div x-data="{ expanded: false }" class="mt-auto border-t border-white/10 pt-4">
                        <button @click="expanded = !expanded" class="flex items-center justify-between w-full text-left focus:outline-none group">
                            <span class="text-white font-sans font-medium text-sm group-hover:text-cyan transition-colors">View Process Steps</span>
                            <svg :class="{'rotate-180': expanded}" class="w-4 h-4 text-white/50 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="expanded" x-collapse x-cloak class="mt-4 text-sm text-text-dark/60 space-y-2 pb-2">
                            <p>1. Infrastructure Assessment</p>
                            <p>2. Hardware Procurement & Setup</p>
                            <p>3. Software Installation & Configuration</p>
                            <p>4. Pre-launch System Audit</p>
                        </div>
                    </div>
                </x-ui.glass-card>

                <!-- Training -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center mb-6 shadow-[0_0_25px_rgba(192,57,43,0.2)]">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-white mb-4">Training</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed mb-6">
                        Comprehensive hands-on training for hospital staff, administrators, and doctors to ensure maximum adoption and efficiency.
                    </p>
                    <div x-data="{ expanded: false }" class="mt-auto border-t border-white/10 pt-4">
                        <button @click="expanded = !expanded" class="flex items-center justify-between w-full text-left focus:outline-none group">
                            <span class="text-white font-sans font-medium text-sm group-hover:text-primary transition-colors">View Process Steps</span>
                            <svg :class="{'rotate-180': expanded}" class="w-4 h-4 text-white/50 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="expanded" x-collapse x-cloak class="mt-4 text-sm text-text-dark/60 space-y-2 pb-2">
                            <p>1. Needs Analysis & Role Mapping</p>
                            <p>2. Creation of Custom Manuals</p>
                            <p>3. On-site Departmental Training</p>
                            <p>4. Certification & Go-live Support</p>
                        </div>
                    </div>
                </x-ui.glass-card>

                <!-- Support -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 rounded-2xl bg-gold/10 flex items-center justify-center mb-6 shadow-[0_0_25px_rgba(243,156,18,0.2)]">
                        <svg class="w-8 h-8 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-white mb-4">24/7 Support</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed mb-6">
                        Round-the-clock technical assistance and SLA-backed maintenance to guarantee zero downtime for critical hospital operations.
                    </p>
                    <div x-data="{ expanded: false }" class="mt-auto border-t border-white/10 pt-4">
                        <button @click="expanded = !expanded" class="flex items-center justify-between w-full text-left focus:outline-none group">
                            <span class="text-white font-sans font-medium text-sm group-hover:text-gold transition-colors">View Process Steps</span>
                            <svg :class="{'rotate-180': expanded}" class="w-4 h-4 text-white/50 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="expanded" x-collapse x-cloak class="mt-4 text-sm text-text-dark/60 space-y-2 pb-2">
                            <p>1. Dedicated Support Portal</p>
                            <p>2. L1/L2 Remote Troubleshooting</p>
                            <p>3. Emergency On-site Dispatch</p>
                            <p>4. Monthly Maintenance Reports</p>
                        </div>
                    </div>
                </x-ui.glass-card>

                <!-- Integration -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 rounded-2xl bg-success/10 flex items-center justify-center mb-6 shadow-[0_0_25px_rgba(46,204,113,0.2)]">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-white mb-4">Integration Services</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed mb-6">
                        Seamlessly connect REDSOL HIS with third-party diagnostic machines, PACS servers, accounting software, and government portals.
                    </p>
                    <div x-data="{ expanded: false }" class="mt-auto border-t border-white/10 pt-4">
                        <button @click="expanded = !expanded" class="flex items-center justify-between w-full text-left focus:outline-none group">
                            <span class="text-white font-sans font-medium text-sm group-hover:text-success transition-colors">View Process Steps</span>
                            <svg :class="{'rotate-180': expanded}" class="w-4 h-4 text-white/50 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="expanded" x-collapse x-cloak class="mt-4 text-sm text-text-dark/60 space-y-2 pb-2">
                            <p>1. API & Protocol Assessment</p>
                            <p>2. Middleware Development</p>
                            <p>3. Sandbox Testing</p>
                            <p>4. Production Deployment</p>
                        </div>
                    </div>
                </x-ui.glass-card>

                <!-- Data Migration -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 rounded-2xl bg-neon-red/10 flex items-center justify-center mb-6 shadow-[0_0_25px_rgba(231,76,60,0.2)]">
                        <svg class="w-8 h-8 text-neon-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-white mb-4">Data Migration</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed mb-6">
                        Secure transition from legacy systems or paper records. We map, clean, and migrate your historical data into the new platform without data loss.
                    </p>
                    <div x-data="{ expanded: false }" class="mt-auto border-t border-white/10 pt-4">
                        <button @click="expanded = !expanded" class="flex items-center justify-between w-full text-left focus:outline-none group">
                            <span class="text-white font-sans font-medium text-sm group-hover:text-neon-red transition-colors">View Process Steps</span>
                            <svg :class="{'rotate-180': expanded}" class="w-4 h-4 text-white/50 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="expanded" x-collapse x-cloak class="mt-4 text-sm text-text-dark/60 space-y-2 pb-2">
                            <p>1. Data Extraction</p>
                            <p>2. Cleansing & Transformation</p>
                            <p>3. Mock Migration Run</p>
                            <p>4. Final Cut-over</p>
                        </div>
                    </div>
                </x-ui.glass-card>

                <!-- Custom Dev Highlight -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="300">
                    <div class="absolute inset-0 bg-primary/5 rounded-[20px] skew-y-2 transform group-hover:skew-y-0 transition-transform duration-500"></div>
                    <div class="relative p-8 sm:p-10 bg-steel/80 backdrop-blur-xl border border-primary/30 rounded-[20px] h-full flex flex-col justify-between overflow-hidden shadow-[0_0_30px_rgba(192,57,43,0.15)]">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-primary/20 blur-[60px]"></div>
                        <div>
                            <x-ui.badge color="primary" class="mb-6">SPECIALIZED</x-ui.badge>
                            <h3 class="font-display font-bold text-3xl text-white mb-4">Custom Software Dev</h3>
                            <p class="text-text-dark/70 text-base leading-relaxed mb-8">
                                Need something completely unique? We build bespoke healthcare software solutions tailored precisely to your clinical workflows.
                            </p>
                        </div>
                        <a href="{{ url('/services/custom-software-development') }}" class="inline-flex items-center text-primary font-bold hover:text-white transition-colors group/link text-lg">
                            Explore Custom Dev 
                            <svg class="ml-2 w-6 h-6 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Process CTA -->
    <section class="py-24 bg-navy relative border-y border-white/5">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="font-display font-bold text-4xl text-white mb-6">Ready to start your digital transformation?</h2>
            <p class="text-xl text-text-dark/70 mb-10">Our deployment specialists are ready to analyze your hospital's needs.</p>
            <x-ui.button href="{{ url('/contact') }}" variant="primary" class="!px-10 !py-4 text-lg">
                Schedule a Consultation
            </x-ui.button>
        </div>
    </section>
</x-app-layout>
