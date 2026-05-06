<x-app-layout>
    @section('title', 'Insights & Blog')
    @section('meta_description', 'Latest updates, industry news, and technical insights from the REDSOL healthcare technology team.')
    <!-- Page Hero -->
    <section class="pt-32 pb-20 bg-navy relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gold/5 rounded-full blur-[150px]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <nav class="flex justify-center mb-6 text-sm font-medium">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ url('/') }}" class="text-text-dark/60 hover:text-white transition-colors">Home</a></li>
                    <li><span class="text-text-dark/40">/</span></li>
                    <li><span class="text-white">Insights</span></li>
                </ol>
            </nav>
            <h1 class="font-display font-extrabold text-5xl sm:text-6xl text-white mb-6" data-aos="fade-up">
                REDSOL <span class="text-gradient">Insights</span>
            </h1>
            <p class="text-xl text-text-dark/80 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                Latest news, product updates, and thought leadership in healthcare technology and digital transformation.
            </p>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="py-24 bg-midnight relative z-10 border-t border-white/5 min-h-[60vh]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Placeholder Post 1 -->
                <article class="glass-card group flex flex-col h-full hover:shadow-[0_15px_40px_rgba(192,57,43,0.15)] transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ url('/blog/the-future-of-ai-in-radiology-reporting') }}" class="block w-full aspect-[16/10] bg-steel rounded-t-2xl overflow-hidden relative border-b border-white/10">
                        <div class="absolute inset-0 flex items-center justify-center text-white/10 group-hover:scale-105 transition-transform duration-500">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="absolute top-4 left-4">
                            <x-ui.badge color="primary">Technology</x-ui.badge>
                        </div>
                    </a>
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center text-text-dark/50 text-sm mb-4 font-sans">
                            <span>May 15, 2026</span>
                            <span class="mx-2">•</span>
                            <span>5 min read</span>
                        </div>
                        <h2 class="font-display font-bold text-xl text-white mb-3 group-hover:text-primary transition-colors">
                            <a href="{{ url('/blog/the-future-of-ai-in-radiology-reporting') }}">The Future of AI in Radiology Reporting</a>
                        </h2>
                        <p class="text-text-dark/70 text-sm leading-relaxed mb-6 line-clamp-3">
                            How artificial intelligence and voice dictation are drastically reducing turnaround times and human error in modern hospital radiology departments.
                        </p>
                        <div class="mt-auto">
                            <a href="{{ url('/blog/the-future-of-ai-in-radiology-reporting') }}" class="inline-flex items-center text-white font-medium hover:text-primary transition-colors text-sm uppercase tracking-wider group/link">
                                Read Article 
                                <svg class="ml-2 w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Placeholder Post 2 -->
                <article class="glass-card group flex flex-col h-full hover:shadow-[0_15px_40px_rgba(0,212,255,0.15)] transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ url('/blog/launching-redsol-cms-v2') }}" class="block w-full aspect-[16/10] bg-steel rounded-t-2xl overflow-hidden relative border-b border-white/10">
                        <div class="absolute inset-0 flex items-center justify-center text-white/10 group-hover:scale-105 transition-transform duration-500">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="absolute top-4 left-4">
                            <x-ui.badge color="success">Product Update</x-ui.badge>
                        </div>
                    </a>
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center text-text-dark/50 text-sm mb-4 font-sans">
                            <span>April 28, 2026</span>
                            <span class="mx-2">•</span>
                            <span>3 min read</span>
                        </div>
                        <h2 class="font-display font-bold text-xl text-white mb-3 group-hover:text-cyan transition-colors">
                            <a href="{{ url('/blog/launching-redsol-cms-v2') }}">Launching REDSOL Campus Management System</a>
                        </h2>
                        <p class="text-text-dark/70 text-sm leading-relaxed mb-6 line-clamp-3">
                            We are thrilled to announce the launch of our new CMS, specifically engineered to bridge the gap between medical academics and clinical practice.
                        </p>
                        <div class="mt-auto">
                            <a href="{{ url('/blog/launching-redsol-cms-v2') }}" class="inline-flex items-center text-white font-medium hover:text-cyan transition-colors text-sm uppercase tracking-wider group/link">
                                Read Article 
                                <svg class="ml-2 w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Placeholder Post 3 -->
                <article class="glass-card group flex flex-col h-full hover:shadow-[0_15px_40px_rgba(243,156,18,0.15)] transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ url('/blog/the-importance-of-hl7-in-modern-hospitals') }}" class="block w-full aspect-[16/10] bg-steel rounded-t-2xl overflow-hidden relative border-b border-white/10">
                        <div class="absolute inset-0 flex items-center justify-center text-white/10 group-hover:scale-105 transition-transform duration-500">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="absolute top-4 left-4">
                            <x-ui.badge color="warning">Industry Standard</x-ui.badge>
                        </div>
                    </a>
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center text-text-dark/50 text-sm mb-4 font-sans">
                            <span>April 10, 2026</span>
                            <span class="mx-2">•</span>
                            <span>6 min read</span>
                        </div>
                        <h2 class="font-display font-bold text-xl text-white mb-3 group-hover:text-gold transition-colors">
                            <a href="{{ url('/blog/the-importance-of-hl7-in-modern-hospitals') }}">The Importance of HL7 Compliance in Modern Hospitals</a>
                        </h2>
                        <p class="text-text-dark/70 text-sm leading-relaxed mb-6 line-clamp-3">
                            Why interoperability matters. A deep dive into health level 7 protocols and how they allow disparate systems to communicate flawlessly.
                        </p>
                        <div class="mt-auto">
                            <a href="{{ url('/blog/the-importance-of-hl7-in-modern-hospitals') }}" class="inline-flex items-center text-white font-medium hover:text-gold transition-colors text-sm uppercase tracking-wider group/link">
                                Read Article 
                                <svg class="ml-2 w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Pagination Placeholder -->
            <div class="mt-16 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <a href="#" class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-text-dark/50 hover:text-white hover:bg-white/10 transition-colors pointer-events-none opacity-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-lg bg-primary text-white font-bold flex items-center justify-center border border-primary">1</a>
                    <a href="#" class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-text-dark/80 hover:text-white hover:bg-white/10 transition-colors">2</a>
                    <a href="#" class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-text-dark/80 hover:text-white hover:bg-white/10 transition-colors">3</a>
                    <a href="#" class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-text-dark/80 hover:text-white hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </nav>
            </div>
            
        </div>
    </section>
</x-app-layout>
