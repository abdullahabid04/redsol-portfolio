<x-app-layout>
    @section('title', 'About Us')
    @section('meta_description', 'Learn about REDSOL - our mission to digitize healthcare and our journey as a leading HIS provider.')
    <!-- Page Hero -->
    <section class="pt-32 pb-20 bg-navy relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-primary/10 rounded-full blur-[150px]"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan/10 rounded-full blur-[100px]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Breadcrumbs -->
            <nav class="flex justify-center mb-6 text-sm font-medium">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ url('/') }}" class="text-text-dark/60 hover:text-white transition-colors">Home</a></li>
                    <li><span class="text-text-dark/40">/</span></li>
                    <li><span class="text-white">About Us</span></li>
                </ol>
            </nav>
            <h1 class="font-display font-extrabold text-5xl sm:text-6xl text-white mb-6" data-aos="fade-up">
                About <span class="text-gradient">REDSOL HIS</span>
            </h1>
            <p class="text-xl text-text-dark/80 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                Pioneering the future of digital healthcare through innovation, integration, and intelligent design.
            </p>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-24 bg-midnight relative z-10 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Mission -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-right">
                    <div class="w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center mb-8 shadow-[0_0_25px_rgba(192,57,43,0.2)]">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-3xl text-white mb-4">Our Mission</h3>
                    <p class="text-text-dark/70 text-lg leading-relaxed">
                        To empower healthcare providers with cutting-edge technology that streamlines workflows, reduces clinical errors, and ultimately improves patient outcomes. We strive to make digital transformation accessible and seamless for hospitals of all sizes.
                    </p>
                </x-ui.glass-card>

                <!-- Vision -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-left">
                    <div class="w-16 h-16 rounded-2xl bg-cyan/10 flex items-center justify-center mb-8 shadow-[0_0_25px_rgba(0,212,255,0.2)]">
                        <svg class="w-8 h-8 text-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-3xl text-white mb-4">Our Vision</h3>
                    <p class="text-text-dark/70 text-lg leading-relaxed">
                        To be the global standard in health information systems, creating a fully interoperable healthcare ecosystem where data flows securely and intelligently between patients, providers, and allied educational institutions.
                    </p>
                </x-ui.glass-card>
            </div>
        </div>
    </section>

    <!-- The Story / Timeline -->
    <section class="py-24 bg-surface-light dark:bg-[#111827]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16">
                <!-- Story -->
                <div class="w-full lg:w-1/2" data-aos="fade-up">
                    <h2 class="font-display font-bold text-4xl text-navy dark:text-white mb-6">Our Story</h2>
                    <div class="space-y-6 text-text-light dark:text-text-dark/80 text-lg leading-relaxed">
                        <p>
                            Founded by a team of visionary technologists and healthcare professionals, REDSOL emerged from a critical realization: modern hospitals were being held back by fragmented, legacy software systems.
                        </p>
                        <p>
                            We began our journey by developing a robust Patient Registration and Billing module, focusing heavily on user experience and data security. The success of this initial launch propelled us to expand our suite into a comprehensive Health Information System (HIS).
                        </p>
                        <p>
                            Today, REDSOL HIS encompasses over 15 fully integrated modules, serving hundreds of hospitals. We've also bridged the gap between clinical practice and medical education with our newly launched Campus Management System (CMS), ensuring the next generation of healthcare professionals learns on state-of-the-art infrastructure.
                        </p>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="w-full lg:w-1/2">
                    <div class="relative border-l-2 border-primary/30 pl-8 space-y-12">
                        <div class="relative" data-aos="fade-left" data-aos-delay="100">
                            <div class="absolute -left-[41px] top-1 w-5 h-5 rounded-full bg-primary ring-4 ring-primary/20"></div>
                            <h4 class="font-display font-bold text-2xl text-navy dark:text-white mb-2">2016</h4>
                            <p class="text-text-light dark:text-text-dark/70">REDSOL Founded. Initial core development of HMIS begins.</p>
                        </div>
                        <div class="relative" data-aos="fade-left" data-aos-delay="200">
                            <div class="absolute -left-[41px] top-1 w-5 h-5 rounded-full bg-cyan ring-4 ring-cyan/20"></div>
                            <h4 class="font-display font-bold text-2xl text-navy dark:text-white mb-2">2018</h4>
                            <p class="text-text-light dark:text-text-dark/70">Launch of integrated LIMS and RIS modules.</p>
                        </div>
                        <div class="relative" data-aos="fade-left" data-aos-delay="300">
                            <div class="absolute -left-[41px] top-1 w-5 h-5 rounded-full bg-gold ring-4 ring-gold/20"></div>
                            <h4 class="font-display font-bold text-2xl text-navy dark:text-white mb-2">2021</h4>
                            <p class="text-text-light dark:text-text-dark/70">Expanded to 50+ partner hospitals. Introduction of AI-assisted reporting.</p>
                        </div>
                        <div class="relative" data-aos="fade-left" data-aos-delay="400">
                            <div class="absolute -left-[41px] top-1 w-5 h-5 rounded-full bg-success ring-4 ring-success/20"></div>
                            <h4 class="font-display font-bold text-2xl text-navy dark:text-white mb-2">2025</h4>
                            <p class="text-text-light dark:text-text-dark/70">Launch of v2.0 Platform and the Campus Management System (CMS).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Standards & Compliance -->
    <section class="py-20 bg-navy relative z-10 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-display font-bold text-3xl text-white mb-10">Global Healthcare Standards</h2>
            <div class="flex flex-wrap justify-center gap-4" data-aos="zoom-in">
                <span class="px-6 py-3 rounded-full bg-white/5 border border-white/10 text-white font-mono tracking-wider font-bold shadow-[0_0_15px_rgba(255,255,255,0.05)] hover:bg-white/10 hover:-translate-y-1 transition-all">HL7</span>
                <span class="px-6 py-3 rounded-full bg-white/5 border border-white/10 text-white font-mono tracking-wider font-bold shadow-[0_0_15px_rgba(255,255,255,0.05)] hover:bg-white/10 hover:-translate-y-1 transition-all">IHE</span>
                <span class="px-6 py-3 rounded-full bg-white/5 border border-white/10 text-white font-mono tracking-wider font-bold shadow-[0_0_15px_rgba(255,255,255,0.05)] hover:bg-white/10 hover:-translate-y-1 transition-all">DICOM</span>
                <span class="px-6 py-3 rounded-full bg-white/5 border border-white/10 text-white font-mono tracking-wider font-bold shadow-[0_0_15px_rgba(255,255,255,0.05)] hover:bg-white/10 hover:-translate-y-1 transition-all">ICD-10</span>
                <span class="px-6 py-3 rounded-full bg-white/5 border border-white/10 text-white font-mono tracking-wider font-bold shadow-[0_0_15px_rgba(255,255,255,0.05)] hover:bg-white/10 hover:-translate-y-1 transition-all">CLSI</span>
                <span class="px-6 py-3 rounded-full bg-white/5 border border-white/10 text-white font-mono tracking-wider font-bold shadow-[0_0_15px_rgba(255,255,255,0.05)] hover:bg-white/10 hover:-translate-y-1 transition-all">SNOMED CT</span>
            </div>
        </div>
    </section>

    <!-- Leadership Team -->
    <section class="py-24 bg-midnight">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="font-display font-bold text-4xl text-white mb-4">Leadership Team</h2>
                <p class="text-text-dark/70 text-lg">The minds behind the technology.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @for($i=1; $i<=4; $i++)
                <div class="text-center group" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="relative w-48 h-48 mx-auto mb-6 rounded-full p-1 bg-white/5 group-hover:bg-gradient-to-br from-primary to-neon-red transition-all duration-300">
                        <div class="w-full h-full rounded-full bg-steel flex items-center justify-center overflow-hidden border-4 border-midnight">
                            <svg class="w-20 h-20 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
                        </div>
                    </div>
                    <h4 class="font-display font-bold text-xl text-white mb-1">John Doe {{ $i }}</h4>
                    <p class="text-primary text-sm font-bold uppercase tracking-wider">Executive Director</p>
                </div>
                @endfor
            </div>
        </div>
    </section>
</x-app-layout>
