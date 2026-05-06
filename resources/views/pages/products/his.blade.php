<x-app-layout>
    @section('title', 'HIS Modules')
    @section('meta_description', 'Explore the 15+ integrated clinical and administrative modules of REDSOL Health Information System.')
    <!-- Page Hero -->
    <section class="pt-32 pb-20 bg-navy relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-primary/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 left-1/4 w-[400px] h-[400px] bg-neon-red/10 rounded-full blur-[120px]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <nav class="flex justify-center mb-6 text-sm font-medium">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ url('/') }}" class="text-text-dark/60 hover:text-white transition-colors">Home</a></li>
                    <li><span class="text-text-dark/40">/</span></li>
                    <li><a href="{{ url('/products') }}" class="text-text-dark/60 hover:text-white transition-colors">Products</a></li>
                    <li><span class="text-text-dark/40">/</span></li>
                    <li><span class="text-white">HIS</span></li>
                </ol>
            </nav>
            <x-ui.badge color="success" class="mb-4">FLAGSHIP PRODUCT</x-ui.badge>
            <h1 class="font-display font-extrabold text-5xl sm:text-6xl text-white mb-6" data-aos="fade-up">
                Health Information <span class="text-gradient">System</span>
            </h1>
            <p class="text-xl text-text-dark/80 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                A fully integrated, interoperable suite of clinical and administrative modules designed to digitize the entire patient journey.
            </p>
        </div>
    </section>

    <!-- Core Modules Grid -->
    <section class="py-24 bg-midnight relative z-10 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="font-display font-bold text-4xl text-white mb-4">Complete Hospital Management</h2>
                <p class="text-text-dark/70 text-lg max-w-2xl mx-auto">15+ powerful modules working in perfect synchronization.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Module 1 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="font-display font-bold text-xl text-white mb-3">Patient Registration (EMR)</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed">
                        Centralized electronic medical records, demographic tracking, barcode generation, and biometric integration for quick patient identification.
                    </p>
                </x-ui.glass-card>

                <!-- Module 2 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="150">
                    <h3 class="font-display font-bold text-xl text-white mb-3">OPD & IPD Management</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed">
                        Seamless workflow from outpatient appointments to inpatient admission, ward allocation, bed management, and discharge summaries.
                    </p>
                </x-ui.glass-card>

                <!-- Module 3 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="font-display font-bold text-xl text-white mb-3">Pharmacy & POS</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed">
                        Complete drug inventory management, batch/expiry tracking, intelligent reorder levels, and a fast POS system for retail pharmacy sales.
                    </p>
                </x-ui.glass-card>

                <!-- Module 4 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="250">
                    <h3 class="font-display font-bold text-xl text-white mb-3">Laboratory (LIMS)</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed">
                        Machine interfacing for automated result fetching, sample tracking with barcodes, and integrated quality control protocols.
                    </p>
                </x-ui.glass-card>

                <!-- Module 5 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="font-display font-bold text-xl text-white mb-3">Radiology (RIS/PACS)</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed">
                        DICOM viewer integration, modality worklists, and AI-powered voice dictation for extremely fast and accurate radiological reporting.
                    </p>
                </x-ui.glass-card>

                <!-- Module 6 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="350">
                    <h3 class="font-display font-bold text-xl text-white mb-3">Billing & Insurance</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed">
                        Dynamic rate lists, corporate panel billing, tax configurations, and automated insurance claims processing via API integrations.
                    </p>
                </x-ui.glass-card>

                <!-- Module 7 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="400">
                    <h3 class="font-display font-bold text-xl text-white mb-3">HR & Payroll</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed">
                        Staff attendance tracking via biometric devices, duty rosters, automated payroll generation, and leave management.
                    </p>
                </x-ui.glass-card>

                <!-- Module 8 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="450">
                    <h3 class="font-display font-bold text-xl text-white mb-3">General Inventory</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed">
                        Manage surgical items, consumables, and fixed assets across multiple stores with multi-level approval workflows for purchase orders.
                    </p>
                </x-ui.glass-card>

                <!-- Module 9 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="500">
                    <h3 class="font-display font-bold text-xl text-white mb-3">OT Management</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed">
                        Operation theatre scheduling, surgical team assignment, pre/post-op notes, and surgical item consumption tracking.
                    </p>
                </x-ui.glass-card>
            </div>
        </div>
    </section>

    <!-- Technical Specs -->
    <section class="py-24 bg-navy relative border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16 items-center">
                <div class="w-full lg:w-1/2" data-aos="fade-right">
                    <h2 class="font-display font-bold text-4xl text-white mb-6">Enterprise Architecture</h2>
                    <p class="text-text-dark/80 text-lg leading-relaxed mb-8">
                        REDSOL HIS is built on modern, secure, and highly scalable technologies ensuring your hospital's data is always accessible and protected.
                    </p>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center border border-primary/20 mr-4">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-bold mb-1">Bank-Grade Security</h4>
                                <p class="text-text-dark/60 text-sm">Role-based access control (RBAC), end-to-end encryption, and comprehensive audit logs for HIPAA compliance.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg bg-cyan/10 flex items-center justify-center border border-cyan/20 mr-4">
                                <svg class="w-5 h-5 text-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-bold mb-1">Cloud or On-Premise</h4>
                                <p class="text-text-dark/60 text-sm">Flexible deployment options. Host on AWS/Azure for multi-branch sync or deploy on local servers for strict data sovereignty.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2" data-aos="fade-left">
                    <div class="bg-steel/50 border border-white/10 rounded-2xl p-8 backdrop-blur-md">
                        <h4 class="font-display font-bold text-white mb-6 text-xl">Technology Stack</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-white/5 border border-white/10 rounded-xl text-center">
                                <span class="block text-primary font-bold mb-1">Backend</span>
                                <span class="text-text-dark/60 text-sm">Laravel & PHP 8</span>
                            </div>
                            <div class="p-4 bg-white/5 border border-white/10 rounded-xl text-center">
                                <span class="block text-cyan font-bold mb-1">Frontend</span>
                                <span class="text-text-dark/60 text-sm">Filament, Livewire, Alpine</span>
                            </div>
                            <div class="p-4 bg-white/5 border border-white/10 rounded-xl text-center">
                                <span class="block text-gold font-bold mb-1">Database</span>
                                <span class="text-text-dark/60 text-sm">MySQL 8.0</span>
                            </div>
                            <div class="p-4 bg-white/5 border border-white/10 rounded-xl text-center">
                                <span class="block text-success font-bold mb-1">Caching</span>
                                <span class="text-text-dark/60 text-sm">Redis</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary to-neon-red z-0"></div>
        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
            <h2 class="font-display font-bold text-4xl text-white mb-8">Ready to see REDSOL HIS in action?</h2>
            <x-ui.button href="{{ url('/contact') }}" variant="ghost" class="border-white text-white hover:bg-white hover:text-primary !px-10 !py-4 text-lg">
                Request a Live Demo
            </x-ui.button>
        </div>
    </section>
</x-app-layout>
