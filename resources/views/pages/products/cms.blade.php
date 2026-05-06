<x-app-layout>
    <!-- Page Hero -->
    <section class="pt-32 pb-20 bg-navy relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-cyan/10 rounded-full blur-[150px]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <nav class="flex justify-center mb-6 text-sm font-medium">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ url('/') }}" class="text-text-dark/60 hover:text-white transition-colors">Home</a></li>
                    <li><span class="text-text-dark/40">/</span></li>
                    <li><a href="{{ url('/products') }}" class="text-text-dark/60 hover:text-white transition-colors">Products</a></li>
                    <li><span class="text-text-dark/40">/</span></li>
                    <li><span class="text-white">CMS</span></li>
                </ol>
            </nav>
            <x-ui.badge color="primary" class="mb-4">NEW PRODUCT</x-ui.badge>
            <h1 class="font-display font-extrabold text-5xl sm:text-6xl text-white mb-6" data-aos="fade-up">
                Campus Management <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan to-blue-500">System</span>
            </h1>
            <p class="text-xl text-text-dark/80 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                A unified platform tailored for Medical Colleges and Nursing Schools to manage academics, administration, and finance.
            </p>
        </div>
    </section>

    <!-- Main Features -->
    <section class="py-24 bg-midnight relative z-10 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16 items-center mb-24">
                <!-- Visual -->
                <div class="w-full lg:w-1/2" data-aos="fade-right">
                    <div class="relative rounded-2xl overflow-hidden aspect-[4/3] group shadow-[0_0_50px_rgba(0,212,255,0.1)]">
                        <div class="absolute inset-0 bg-cyan/20 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                        <div class="w-full h-full bg-steel flex items-center justify-center border border-white/10">
                            <span class="text-text-dark/40 font-mono tracking-widest text-sm text-center">
                                <svg class="w-16 h-16 mx-auto mb-4 text-white/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                CMS DASHBOARD MOCKUP
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Content -->
                <div class="w-full lg:w-1/2" data-aos="fade-left">
                    <h2 class="font-display font-bold text-4xl text-white mb-6">Streamline Institutional Workflows</h2>
                    <p class="text-text-dark/80 text-lg leading-relaxed mb-8">
                        The REDSOL CMS is built specifically for the unique needs of medical and allied health education, bridging the gap between classroom academics and clinical rotations.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-12 h-12 rounded-xl bg-cyan/10 flex items-center justify-center border border-cyan/20 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-lg mb-1">Admissions & Student Lifecycle</h4>
                                <p class="text-text-dark/60 text-sm">Online applicant portals, merit list generation, document verification, and complete student profile management.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 rounded-xl bg-cyan/10 flex items-center justify-center border border-cyan/20 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-lg mb-1">Fee & Finance Management</h4>
                                <p class="text-text-dark/60 text-sm">Automated fee challan generation, online payment gateways, scholarship management, and strict financial reporting.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-12 h-12 rounded-xl bg-cyan/10 flex items-center justify-center border border-cyan/20 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-lg mb-1">Academics & Examination</h4>
                                <p class="text-text-dark/60 text-sm">Curriculum planning, clinical rotation scheduling, internal assessments, and automated gradebook generation.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <x-ui.glass-card class="border-cyan/10" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="text-white font-bold mb-2">Student Portal</h4>
                    <p class="text-text-dark/60 text-sm">Dedicated mobile-friendly dashboard for students to view attendance, download assignments, and pay fees.</p>
                </x-ui.glass-card>
                
                <x-ui.glass-card class="border-cyan/10" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="text-white font-bold mb-2">Faculty Dashboard</h4>
                    <p class="text-text-dark/60 text-sm">Tools for professors to mark attendance, upload course materials, and grade assessments securely.</p>
                </x-ui.glass-card>

                <x-ui.glass-card class="border-cyan/10" data-aos="fade-up" data-aos-delay="300">
                    <h4 class="text-white font-bold mb-2">Hostel & Transport</h4>
                    <p class="text-text-dark/60 text-sm">Complete tracking of room allocations, mess fees, and daily transport route management.</p>
                </x-ui.glass-card>

                <x-ui.glass-card class="border-cyan/10" data-aos="fade-up" data-aos-delay="400">
                    <h4 class="text-white font-bold mb-2">Library Integration</h4>
                    <p class="text-text-dark/60 text-sm">Digital cataloging, book issuance tracking with barcode scanning, and fine calculations.</p>
                </x-ui.glass-card>
            </div>
        </div>
    </section>

    <!-- Integration CTA -->
    <section class="py-24 bg-navy border-t border-white/5 relative">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <x-ui.badge color="success" class="mb-6">POWERFUL SYNERGY</x-ui.badge>
            <h2 class="font-display font-bold text-3xl sm:text-4xl text-white mb-6">Seamlessly integrated with REDSOL HIS</h2>
            <p class="text-xl text-text-dark/70 mb-10 max-w-2xl mx-auto">
                For teaching hospitals, our CMS connects directly with the HIS platform, allowing medical students to safely access anonymized clinical data for research and learning.
            </p>
            <div class="flex justify-center gap-4">
                <x-ui.button href="{{ url('/contact') }}" variant="primary" class="!bg-gradient-to-br !from-cyan !to-blue-600 shadow-[0_0_20px_rgba(0,212,255,0.4)]">
                    Request CMS Demo
                </x-ui.button>
            </div>
        </div>
    </section>
</x-app-layout>
