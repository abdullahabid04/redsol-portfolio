<x-app-layout>
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
        <!-- tsParticles Container -->
        <div id="tsparticles" class="absolute inset-0 z-0"></div>
        
        <!-- Gradient Mesh Background -->
        <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-[600px] h-[600px] bg-primary/20 rounded-full blur-[150px] animate-blob"></div>
            <div class="absolute top-1/3 right-1/4 w-[500px] h-[500px] bg-cyan/20 rounded-full blur-[150px] animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-1/4 left-1/2 w-[700px] h-[700px] bg-neon-red/10 rounded-full blur-[150px] animate-blob animation-delay-4000"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mt-12">
            <!-- Hero Badge -->
            <div class="mb-8" data-aos="fade-up" data-aos-duration="1000">
                <x-ui.badge color="success" class="px-4 py-1.5 text-sm">
                    <span class="mr-2 inline-block w-2 h-2 rounded-full bg-success animate-pulse"></span>
                    Trusted by 100+ Hospitals
                </x-ui.badge>
            </div>

            <!-- Headline -->
            <h1 class="font-display font-extrabold text-5xl sm:text-6xl md:text-7xl tracking-tight text-white mb-6 leading-tight max-w-5xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                Transform Healthcare with <br/>
                <span class="text-gradient">Intelligent HIS</span>
            </h1>

            <!-- Sub-headline -->
            <p class="font-sans text-xl text-text-dark/80 mb-10 max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="400">
                A comprehensive, clinical, and administrative suite designed to digitize modern hospitals and allied health campuses.
            </p>

            <!-- CTAs -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="600">
                <x-ui.button href="{{ url('/products/his') }}" variant="primary">
                    Explore HIS Modules
                </x-ui.button>
                <x-ui.button href="{{ url('/contact') }}" variant="ghost">
                    Request a Demo
                </x-ui.button>
            </div>

            <!-- Floating Stat Bubbles -->
            <div class="hidden md:block absolute top-[15%] left-[5%] glass-card p-4 animate-float" data-aos="zoom-in" data-aos-delay="800">
                <div class="text-3xl font-display font-bold text-white">15+</div>
                <div class="text-xs text-text-dark/60 uppercase tracking-widest mt-1">Modules</div>
            </div>
            
            <div class="hidden md:block absolute bottom-[20%] right-[10%] glass-card p-4 animate-float" style="animation-delay: 2s;" data-aos="zoom-in" data-aos-delay="1000">
                <div class="text-3xl font-display font-bold text-white">10M+</div>
                <div class="text-xs text-text-dark/60 uppercase tracking-widest mt-1">Patient Records</div>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center animate-bounce">
            <span class="text-xs text-text-dark/50 uppercase tracking-widest mb-2 font-mono">Scroll</span>
            <svg class="w-5 h-5 text-text-dark/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </section>

    <!-- Trusted By Marquee -->
    <section class="py-10 border-y border-white/5 bg-navy/50 backdrop-blur-sm overflow-hidden relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 text-center">
            <h3 class="text-xs text-text-dark/50 uppercase tracking-widest font-mono">Trusted by leading healthcare institutions</h3>
        </div>
        <div class="flex overflow-hidden group">
            <!-- Marquee Content -->
            <div class="flex space-x-16 px-8 animate-marquee whitespace-nowrap group-hover:animation-pause">
                <!-- Placeholders for Logos -->
                @for ($i = 0; $i < 8; $i++)
                    <div class="w-40 h-16 bg-white/5 rounded-lg flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-500">
                        <span class="font-display font-bold text-white/30 text-xl tracking-wider">HOSPITAL</span>
                    </div>
                @endfor
            </div>
            <div class="flex space-x-16 px-8 animate-marquee whitespace-nowrap group-hover:animation-pause" aria-hidden="true">
                @for ($i = 0; $i < 8; $i++)
                    <div class="w-40 h-16 bg-white/5 rounded-lg flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-500">
                        <span class="font-display font-bold text-white/30 text-xl tracking-wider">HOSPITAL</span>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section class="py-24 bg-midnight relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="font-display font-bold text-4xl sm:text-5xl text-white mb-6">Built for Modern Healthcare</h2>
                <p class="text-text-dark/80 text-lg max-w-2xl mx-auto">Our systems are architected with security, compliance, and user-experience at the core.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center mb-6 shadow-[0_0_20px_rgba(192,57,43,0.2)]">
                        <svg class="w-7 h-7 text-neon-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-white mb-4">Integrated Platform</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed">
                        A fully unified suite where clinical, diagnostic, and administrative modules share a single source of truth for seamless patient journeys.
                    </p>
                </x-ui.glass-card>

                <!-- Card 2 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 rounded-2xl bg-cyan/10 flex items-center justify-center mb-6 shadow-[0_0_20px_rgba(0,212,255,0.2)]">
                        <svg class="w-7 h-7 text-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-white mb-4">IHE/CLSI Compliant</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed">
                        Built on international healthcare data standards including HL7, DICOM, ICD-10, and SNOMED CT for complete interoperability.
                    </p>
                </x-ui.glass-card>

                <!-- Card 3 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 rounded-2xl bg-gold/10 flex items-center justify-center mb-6 shadow-[0_0_20px_rgba(243,156,18,0.2)]">
                        <svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-white mb-4">Voice Reporting</h3>
                    <p class="text-text-dark/70 text-sm leading-relaxed">
                        Integrated medical voice dictation for radiology and pathology, significantly reducing report turnaround times and human error.
                    </p>
                </x-ui.glass-card>
            </div>
        </div>
    </section>

    <!-- NEW Modules Teaser -->
    <section class="py-24 bg-navy relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- CMS Teaser -->
                <div class="relative group" data-aos="fade-right">
                    <div class="absolute inset-0 bg-cyan/5 rounded-[30px] -skew-y-2 transform group-hover:skew-y-0 transition-transform duration-500"></div>
                    <div class="relative p-10 bg-steel/80 backdrop-blur-xl border border-white/10 rounded-[30px] h-full flex flex-col justify-between overflow-hidden">
                        <!-- BG Decoration -->
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-cyan/20 blur-[60px]"></div>
                        
                        <div>
                            <div class="mb-6 flex justify-between items-start">
                                <div class="w-16 h-16 rounded-2xl bg-cyan/10 flex items-center justify-center border border-cyan/30">
                                    <svg class="w-8 h-8 text-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                                </div>
                                <x-ui.badge color="success" class="animate-pulse">NEW PRODUCT</x-ui.badge>
                            </div>
                            
                            <h3 class="font-display font-bold text-3xl text-white mb-4">Campus Management System</h3>
                            <p class="text-text-dark/70 text-base leading-relaxed mb-8">
                                A comprehensive CMS tailored for educational institutions, medical colleges, and nursing schools. Manage academic workflows alongside clinical HIS systems.
                            </p>
                        </div>
                        
                        <a href="{{ url('/products/campus-management-system') }}" class="inline-flex items-center text-cyan font-bold hover:text-white transition-colors group/link">
                            Explore CMS 
                            <svg class="ml-2 w-5 h-5 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Custom Dev Teaser -->
                <div class="relative group" data-aos="fade-left">
                    <div class="absolute inset-0 bg-primary/5 rounded-[30px] skew-y-2 transform group-hover:skew-y-0 transition-transform duration-500"></div>
                    <div class="relative p-10 bg-steel/80 backdrop-blur-xl border border-white/10 rounded-[30px] h-full flex flex-col justify-between overflow-hidden">
                        <!-- BG Decoration -->
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-primary/20 blur-[60px]"></div>
                        
                        <div>
                            <div class="mb-6 flex justify-between items-start">
                                <div class="w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center border border-primary/30">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                </div>
                                <x-ui.badge color="primary">SERVICE</x-ui.badge>
                            </div>
                            
                            <h3 class="font-display font-bold text-3xl text-white mb-4">Custom Software Dev</h3>
                            <p class="text-text-dark/70 text-base leading-relaxed mb-8">
                                Bespoke software development partner. Full customization of the HIS platform or ground-up development of new healthcare digital systems.
                            </p>
                        </div>
                        
                        <a href="{{ url('/services/custom-software-development') }}" class="inline-flex items-center text-primary font-bold hover:text-white transition-colors group/link">
                            Discover Services 
                            <svg class="ml-2 w-5 h-5 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 bg-midnight relative border-y border-white/5 overflow-hidden">
        <!-- Floating orbs -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute left-1/4 top-1/4 w-64 h-64 bg-primary/10 rounded-full blur-[100px]"></div>
            <div class="absolute right-1/4 bottom-1/4 w-64 h-64 bg-cyan/10 rounded-full blur-[100px]"></div>
            <!-- Grid overlay -->
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at center, #ffffff 1px, transparent 1px); background-size: 40px 40px;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12 text-center" id="stats-container">
                <div class="stat-item">
                    <div class="font-display font-black text-5xl md:text-7xl text-gradient mb-2 counter" data-target="150">0</div>
                    <div class="w-12 h-1 bg-primary mx-auto mb-4"></div>
                    <div class="text-text-dark/80 font-sans font-medium uppercase tracking-wider text-sm">Hospitals</div>
                </div>
                <div class="stat-item">
                    <div class="font-display font-black text-5xl md:text-7xl text-gradient mb-2 counter" data-target="15">0</div>
                    <div class="w-12 h-1 bg-primary mx-auto mb-4"></div>
                    <div class="text-text-dark/80 font-sans font-medium uppercase tracking-wider text-sm">Modules</div>
                </div>
                <div class="stat-item">
                    <div class="font-display font-black text-5xl md:text-7xl text-gradient mb-2 counter" data-target="25">0</div>
                    <div class="w-12 h-1 bg-primary mx-auto mb-4"></div>
                    <div class="text-text-dark/80 font-sans font-medium uppercase tracking-wider text-sm">Cities</div>
                </div>
                <div class="stat-item">
                    <div class="font-display font-black text-5xl md:text-7xl text-gradient mb-2 counter" data-target="10">0</div>
                    <div class="w-12 h-1 bg-primary mx-auto mb-4"></div>
                    <div class="text-text-dark/80 font-sans font-medium uppercase tracking-wider text-sm">Years Exp.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Banner -->
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary to-neon-red z-0"></div>
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxyZWN0IHdpZHRoPSI4IiBoZWlnaHQ9IjgiIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIi8+PHBhdGggZD0iTTAgMGg4djhIMHoiIGZpbGw9Im5vbmUiLz48L3N2Zz4=')]"></div>
        
        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center" data-aos="zoom-in">
            <h2 class="font-display font-bold text-4xl sm:text-5xl text-white mb-8">Digitize Your Hospital Today</h2>
            <p class="text-white/80 text-xl mb-10 max-w-2xl mx-auto">Join the leading healthcare institutions transforming patient care with REDSOL HIS.</p>
            <x-ui.button href="{{ url('/contact') }}" variant="ghost" class="border-white text-white hover:bg-white hover:text-primary !px-10 !py-4 text-lg">
                Schedule a Consultation
            </x-ui.button>
        </div>
    </section>

    <!-- Page Specific Scripts -->
    @push('scripts')
    <script type="module">
        import { tsParticles } from "tsparticles-engine";
        import { loadFull } from "tsparticles";

        // Initialize tsParticles for Hero background
        async function initParticles() {
            await loadFull(tsParticles);
            await tsParticles.load("tsparticles", {
                fpsLimit: 60,
                interactivity: {
                    events: {
                        onHover: { enable: true, mode: "repulse" },
                        resize: true,
                    },
                    modes: {
                        repulse: { distance: 100, duration: 0.4 },
                    },
                },
                particles: {
                    color: { value: ["#C0392B", "#E74C3C", "#00D4FF"] },
                    links: {
                        color: "#ffffff",
                        distance: 150,
                        enable: true,
                        opacity: 0.1,
                        width: 1,
                    },
                    collisions: { enable: false },
                    move: {
                        direction: "none",
                        enable: true,
                        outModes: { default: "bounce" },
                        random: false,
                        speed: 1,
                        straight: false,
                    },
                    number: { density: { enable: true, area: 800 }, value: 80 },
                    opacity: { value: 0.5 },
                    shape: { type: "circle" },
                    size: { value: { min: 1, max: 3 } },
                },
                detectRetina: true,
            });
        }
        
        // Only load on desktop for performance
        if (window.innerWidth > 768) {
            initParticles();
        }

        // GSAP Counter Animation for Stats
        if(window.gsap && window.ScrollTrigger) {
            window.ScrollTrigger.create({
                trigger: "#stats-container",
                start: "top 80%",
                onEnter: () => {
                    const counters = document.querySelectorAll('.counter');
                    counters.forEach(counter => {
                        const target = parseInt(counter.getAttribute('data-target'));
                        window.gsap.to(counter, {
                            innerHTML: target,
                            duration: 2,
                            snap: { innerHTML: 1 },
                            ease: "power2.out"
                        });
                    });
                },
                once: true
            });
        }
    </script>
    @endpush
</x-app-layout>
