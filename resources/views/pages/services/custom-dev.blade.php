<x-app-layout>
    @section('title', 'Custom Software Development')
    @section('meta_description', 'REDSOL provides specialized software engineering for healthcare, including mobile apps and legacy system modernization.')
    <!-- Page Hero -->
    <section class="pt-32 pb-20 bg-navy relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <!-- Tech Grid Background -->
            <div class="absolute inset-0 opacity-20" style="background-image: linear-gradient(#1A1A2E 2px, transparent 2px), linear-gradient(90deg, #1A1A2E 2px, transparent 2px), linear-gradient(#1A1A2E 1px, transparent 1px), linear-gradient(90deg, #1A1A2E 1px, #ffffff 1px); background-size: 50px 50px, 50px 50px, 10px 10px, 10px 10px; background-position: -2px -2px, -2px -2px, -1px -1px, -1px -1px;"></div>
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-primary/10 rounded-full blur-[150px]"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <nav class="flex justify-center mb-6 text-sm font-medium">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ url('/') }}" class="text-text-dark/60 hover:text-white transition-colors">Home</a></li>
                    <li><span class="text-text-dark/40">/</span></li>
                    <li><a href="{{ url('/services') }}" class="text-text-dark/60 hover:text-white transition-colors">Services</a></li>
                    <li><span class="text-text-dark/40">/</span></li>
                    <li><span class="text-white">Custom Dev</span></li>
                </ol>
            </nav>
            <x-ui.badge color="primary" class="mb-4">SPECIALIZED SERVICE</x-ui.badge>
            <h1 class="font-display font-extrabold text-5xl sm:text-6xl text-white mb-6" data-aos="fade-up">
                Bespoke Software <span class="text-gradient">Engineering</span>
            </h1>
            <p class="text-xl text-text-dark/80 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                Transforming complex healthcare challenges into elegant, scalable digital solutions. From mobile patient apps to AI-driven clinical tools.
            </p>
        </div>
    </section>

    <!-- Capabilities Grid -->
    <section class="py-24 bg-midnight relative z-10 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="font-display font-bold text-4xl text-white mb-4">Our Engineering Capabilities</h2>
                <p class="text-text-dark/70 text-lg max-w-2xl mx-auto">Full-stack development tailored to the strict compliance and performance needs of the healthcare sector.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Capability 1 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 rounded-xl bg-cyan/10 flex items-center justify-center mb-6 border border-cyan/20">
                        <svg class="w-7 h-7 text-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-white mb-3">Mobile Health Apps</h3>
                    <p class="text-text-dark/70 text-base leading-relaxed">
                        Native and cross-platform mobile applications for patient engagement, telemedicine, remote monitoring, and doctor rounding.
                    </p>
                </x-ui.glass-card>

                <!-- Capability 2 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6 border border-primary/20">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-white mb-3">Legacy System Modernization</h3>
                    <p class="text-text-dark/70 text-base leading-relaxed">
                        Securely migrate your outdated, monolithic hospital software to a modern microservices architecture in the cloud without losing historical data.
                    </p>
                </x-ui.glass-card>

                <!-- Capability 3 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 rounded-xl bg-success/10 flex items-center justify-center mb-6 border border-success/20">
                        <svg class="w-7 h-7 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-white mb-3">Data Analytics & Dashboards</h3>
                    <p class="text-text-dark/70 text-base leading-relaxed">
                        Custom BI dashboards, clinical predictive models, and real-time hospital operational metrics to drive data-informed decisions.
                    </p>
                </x-ui.glass-card>

                <!-- Capability 4 -->
                <x-ui.glass-card :hoverEffect="true" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-14 h-14 rounded-xl bg-gold/10 flex items-center justify-center mb-6 border border-gold/20">
                        <svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-white mb-3">API & Middleware</h3>
                    <p class="text-text-dark/70 text-base leading-relaxed">
                        Development of robust HL7/FHIR compliant APIs and middleware to connect disparate medical devices and third-party software.
                    </p>
                </x-ui.glass-card>
            </div>
        </div>
    </section>

    <!-- Methodology & Stack -->
    <section class="py-24 bg-surface-light dark:bg-[#111827] relative z-10 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <div data-aos="fade-right">
                    <h2 class="font-display font-bold text-4xl text-navy dark:text-white mb-6">Agile Methodology & DevOps</h2>
                    <p class="text-text-light dark:text-text-dark/80 text-lg leading-relaxed mb-6">
                        We don't just write code; we engineer solutions. Our development lifecycle is strictly agile, ensuring transparent communication, rapid prototyping, and continuous delivery.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center text-text-light dark:text-text-dark/70 font-medium">
                            <span class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center mr-3 font-bold">1</span>
                            Requirements & Architecture Design
                        </li>
                        <li class="flex items-center text-text-light dark:text-text-dark/70 font-medium">
                            <span class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center mr-3 font-bold">2</span>
                            Two-Week Sprints & Iterative Builds
                        </li>
                        <li class="flex items-center text-text-light dark:text-text-dark/70 font-medium">
                            <span class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center mr-3 font-bold">3</span>
                            Automated CI/CD Pipelines & Security Scanning
                        </li>
                        <li class="flex items-center text-text-light dark:text-text-dark/70 font-medium">
                            <span class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center mr-3 font-bold">4</span>
                            UAT & Zero-downtime Deployment
                        </li>
                    </ul>
                </div>

                <!-- Tech Stack Visual -->
                <div data-aos="fade-left">
                    <div class="bg-white dark:bg-midnight p-8 rounded-3xl shadow-2xl border border-gray-100 dark:border-white/10">
                        <h4 class="font-display font-bold text-xl text-navy dark:text-white mb-6 text-center">Technologies We Excel In</h4>
                        <div class="grid grid-cols-3 gap-4">
                            <!-- Backend -->
                            <div class="col-span-3 text-center mb-2">
                                <span class="text-xs uppercase tracking-widest text-text-light dark:text-text-dark/50 font-bold">Backend</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-white/5 rounded-xl p-4 flex flex-col items-center justify-center text-center">
                                <span class="font-bold text-navy dark:text-white">Laravel</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-white/5 rounded-xl p-4 flex flex-col items-center justify-center text-center">
                                <span class="font-bold text-navy dark:text-white">Node.js</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-white/5 rounded-xl p-4 flex flex-col items-center justify-center text-center">
                                <span class="font-bold text-navy dark:text-white">Python</span>
                            </div>

                            <!-- Frontend -->
                            <div class="col-span-3 text-center mb-2 mt-4">
                                <span class="text-xs uppercase tracking-widest text-text-light dark:text-text-dark/50 font-bold">Frontend</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-white/5 rounded-xl p-4 flex flex-col items-center justify-center text-center">
                                <span class="font-bold text-navy dark:text-white">Vue.js</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-white/5 rounded-xl p-4 flex flex-col items-center justify-center text-center">
                                <span class="font-bold text-navy dark:text-white">React</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-white/5 rounded-xl p-4 flex flex-col items-center justify-center text-center">
                                <span class="font-bold text-navy dark:text-white">Tailwind</span>
                            </div>

                            <!-- Infra -->
                            <div class="col-span-3 text-center mb-2 mt-4">
                                <span class="text-xs uppercase tracking-widest text-text-light dark:text-text-dark/50 font-bold">Infrastructure</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-white/5 rounded-xl p-4 flex flex-col items-center justify-center text-center">
                                <span class="font-bold text-navy dark:text-white">AWS</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-white/5 rounded-xl p-4 flex flex-col items-center justify-center text-center">
                                <span class="font-bold text-navy dark:text-white">Docker</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-white/5 rounded-xl p-4 flex flex-col items-center justify-center text-center">
                                <span class="font-bold text-navy dark:text-white">PostgreSQL</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-24 bg-navy relative border-y border-white/5 text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="font-display font-bold text-4xl text-white mb-6">Have a project in mind?</h2>
            <p class="text-xl text-text-dark/70 mb-10">Our solutions architects are ready to discuss your requirements and provide a technical roadmap.</p>
            <x-ui.button href="{{ url('/contact') }}" variant="primary" class="!px-10 !py-4 text-lg">
                Book a Technical Discovery Call
            </x-ui.button>
        </div>
    </section>
</x-app-layout>
