<x-app-layout>
    <!-- Page Hero -->
    <section class="pt-32 pb-20 bg-navy relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-br from-primary/10 to-cyan/10 rounded-full blur-[100px]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <nav class="flex justify-center mb-6 text-sm font-medium">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ url('/') }}" class="text-text-dark/60 hover:text-white transition-colors">Home</a></li>
                    <li><span class="text-text-dark/40">/</span></li>
                    <li><span class="text-white">Products</span></li>
                </ol>
            </nav>
            <h1 class="font-display font-extrabold text-5xl sm:text-6xl text-white mb-6" data-aos="fade-up">
                Our <span class="text-gradient">Products</span>
            </h1>
            <p class="text-xl text-text-dark/80 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                Discover our enterprise-grade digital solutions engineered to transform healthcare and allied educational institutions.
            </p>
        </div>
    </section>

    <!-- Product Showcase -->
    <section class="py-24 bg-midnight relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24">
            
            <!-- HIS Product -->
            <div class="flex flex-col lg:flex-row gap-12 items-center">
                <!-- Text Content -->
                <div class="w-full lg:w-1/2 order-2 lg:order-1" data-aos="fade-right">
                    <x-ui.badge color="success" class="mb-6">FLAGSHIP</x-ui.badge>
                    <h2 class="font-display font-bold text-4xl text-white mb-6">Health Information System (HIS)</h2>
                    <p class="text-text-dark/80 text-lg leading-relaxed mb-6">
                        The ultimate all-in-one digital infrastructure for modern hospitals. From the moment a patient walks in, through diagnostics, to final billing—REDSOL HIS ensures a seamless, paperless, and secure journey.
                    </p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center text-text-dark/70">
                            <svg class="w-5 h-5 text-success mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            15+ fully integrated modules (Clinical & Admin)
                        </li>
                        <li class="flex items-center text-text-dark/70">
                            <svg class="w-5 h-5 text-success mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Global standards compliant (HL7, DICOM, ICD-10)
                        </li>
                        <li class="flex items-center text-text-dark/70">
                            <svg class="w-5 h-5 text-success mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Advanced AI Voice Dictation for Reporting
                        </li>
                    </ul>
                    <x-ui.button href="{{ url('/products/his') }}" variant="primary">
                        Explore HIS Modules
                    </x-ui.button>
                </div>
                <!-- Visual -->
                <div class="w-full lg:w-1/2 order-1 lg:order-2" data-aos="fade-left">
                    <div class="relative rounded-2xl overflow-hidden aspect-video group">
                        <div class="absolute inset-0 bg-primary/20 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                        <!-- Placeholder Image -->
                        <div class="w-full h-full bg-steel flex items-center justify-center border border-white/10">
                            <svg class="w-24 h-24 text-white/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="absolute text-text-dark/40 font-mono tracking-widest text-sm">HIS DASHBOARD MOCKUP</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Separator -->
            <div class="w-full h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

            <!-- CMS Product -->
            <div class="flex flex-col lg:flex-row gap-12 items-center">
                <!-- Visual -->
                <div class="w-full lg:w-1/2" data-aos="fade-right">
                    <div class="relative rounded-2xl overflow-hidden aspect-video group">
                        <div class="absolute inset-0 bg-cyan/20 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                        <!-- Placeholder Image -->
                        <div class="w-full h-full bg-steel flex items-center justify-center border border-white/10">
                            <svg class="w-24 h-24 text-white/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            <span class="absolute text-text-dark/40 font-mono tracking-widest text-sm">CMS DASHBOARD MOCKUP</span>
                        </div>
                    </div>
                </div>
                <!-- Text Content -->
                <div class="w-full lg:w-1/2" data-aos="fade-left">
                    <x-ui.badge color="primary" class="mb-6">NEW PLATFORM</x-ui.badge>
                    <h2 class="font-display font-bold text-4xl text-white mb-6">Campus Management System (CMS)</h2>
                    <p class="text-text-dark/80 text-lg leading-relaxed mb-6">
                        Designed specifically for medical colleges, nursing schools, and allied health institutions. Manage admissions, academics, fee collection, and student portals in one unified ecosystem.
                    </p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center text-text-dark/70">
                            <svg class="w-5 h-5 text-cyan mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            End-to-End Academic Workflow
                        </li>
                        <li class="flex items-center text-text-dark/70">
                            <svg class="w-5 h-5 text-cyan mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Integrated Fee Management & HR
                        </li>
                        <li class="flex items-center text-text-dark/70">
                            <svg class="w-5 h-5 text-cyan mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Dedicated Student & Faculty Portals
                        </li>
                    </ul>
                    <x-ui.button href="{{ url('/products/campus-management-system') }}" variant="ghost" class="border-cyan text-cyan hover:bg-cyan/10">
                        Discover CMS
                    </x-ui.button>
                </div>
            </div>

        </div>
    </section>

    <!-- Custom Dev CTA -->
    <section class="py-24 bg-navy border-t border-white/5 relative">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="font-display font-bold text-3xl sm:text-4xl text-white mb-6">Looking for something unique?</h2>
            <p class="text-xl text-text-dark/70 mb-10 max-w-2xl mx-auto">
                If our off-the-shelf products don't fit your exact requirements, our software engineering team can build a completely custom solution.
            </p>
            <x-ui.button href="{{ url('/services/custom-software-development') }}" variant="primary">
                Explore Custom Development
            </x-ui.button>
        </div>
    </section>
</x-app-layout>
