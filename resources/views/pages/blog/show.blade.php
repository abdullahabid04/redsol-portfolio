<x-app-layout>
    <article class="bg-surface-light dark:bg-[#111827] min-h-screen pb-24">
        <!-- Post Header -->
        <header class="pt-32 pb-16 bg-navy relative overflow-hidden border-b border-white/5">
            <div class="absolute inset-0 z-0 opacity-20">
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/20 rounded-full blur-[150px]"></div>
            </div>
            
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <nav class="flex mb-8 text-sm font-medium">
                    <ol class="flex items-center space-x-2">
                        <li><a href="{{ url('/blog') }}" class="text-text-dark/60 hover:text-white transition-colors flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Back to Insights</a></li>
                    </ol>
                </nav>
                
                <div class="mb-6 flex items-center gap-4">
                    <x-ui.badge color="primary">Technology</x-ui.badge>
                    <span class="text-text-dark/50 text-sm font-sans flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        May 15, 2026
                    </span>
                    <span class="text-text-dark/50 text-sm font-sans flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        5 min read
                    </span>
                </div>
                
                <!-- Format slug to a readable title for demo -->
                <h1 class="font-display font-bold text-4xl sm:text-5xl md:text-6xl text-white leading-tight mb-8">
                    {{ ucwords(str_replace('-', ' ', $slug)) }}
                </h1>
                
                <div class="flex items-center border-t border-white/10 pt-8 mt-8">
                    <div class="w-12 h-12 rounded-full bg-steel flex items-center justify-center mr-4 border border-white/10 overflow-hidden">
                        <!-- Author Avatar Placeholder -->
                        <svg class="w-6 h-6 text-text-dark/50" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
                    </div>
                    <div>
                        <p class="text-white font-bold text-sm">Dr. Sarah Jenkins</p>
                        <p class="text-text-dark/50 text-xs">Chief Medical Informatics Officer</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Post Content Placeholder -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20">
            <!-- Featured Image Placeholder -->
            <div class="w-full aspect-[21/9] bg-steel rounded-2xl border border-white/10 mb-16 shadow-2xl flex items-center justify-center overflow-hidden relative group">
                <div class="absolute inset-0 bg-gradient-to-tr from-primary/20 to-transparent"></div>
                <svg class="w-20 h-20 text-white/10 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>

            <!-- Typography Content -->
            <div class="prose prose-lg prose-invert max-w-none text-text-dark/80 font-sans">
                <p class="lead text-xl text-text-dark/90 font-medium mb-8">
                    The integration of Artificial Intelligence into health information systems is no longer a futuristic concept—it is a present-day necessity. As hospitals generate terabytes of data daily, legacy systems struggle to keep pace with the demand for rapid, accurate reporting.
                </p>

                <h2 class="text-white font-display text-3xl font-bold mt-12 mb-6">The Bottleneck in Radiology</h2>
                <p class="mb-6">
                    Traditionally, a radiologist spends a significant portion of their day dictating notes, which are then transcribed by humans, reviewed, and finalized. This asynchronous process often leads to reporting delays that directly impact patient care in critical scenarios.
                </p>
                <p class="mb-8">
                    Furthermore, manual transcription is prone to human error, particularly when dealing with complex anatomical terminology and ICD-10 codification.
                </p>

                <!-- Blockquote -->
                <blockquote class="border-l-4 border-primary pl-6 py-2 my-10 bg-white/5 rounded-r-xl italic text-white/90">
                    "Implementing AI-driven voice reporting reduced our average turnaround time from 24 hours to under 30 minutes, fundamentally changing how our emergency department operates."
                </blockquote>

                <h2 class="text-white font-display text-3xl font-bold mt-12 mb-6">Enter AI Voice Dictation</h2>
                <p class="mb-6">
                    Modern HIS platforms, like REDSOL, natively integrate NLP (Natural Language Processing) and medical voice dictation engines directly into the RIS (Radiology Information System).
                </p>
                
                <ul class="space-y-4 mb-8 list-none pl-0">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <strong class="text-white">Real-time Transcription:</strong> Speech is converted to text instantly, with over 99% accuracy for medical terminology.
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <strong class="text-white">Auto-formatting:</strong> The AI automatically structures the text into standard clinical templates (Findings, Impression, Recommendations).
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <strong class="text-white">Smart Codification:</strong> Algorithms detect diagnoses within the text and suggest the appropriate ICD-10 or SNOMED CT codes automatically.
                        </div>
                    </li>
                </ul>

                <h2 class="text-white font-display text-3xl font-bold mt-12 mb-6">Conclusion</h2>
                <p class="mb-8">
                    The synergy between a robust HIS and AI tools represents a paradigm shift. Hospitals that adopt these technologies today are not merely optimizing workflows—they are actively improving patient outcomes by delivering critical information precisely when it is needed.
                </p>
            </div>

            <!-- Share and Tags -->
            <div class="mt-16 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-3">
                    <span class="text-text-dark/50 text-sm font-bold uppercase tracking-wider">Tags:</span>
                    <a href="#" class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-text-dark/80 hover:text-white hover:bg-white/10 transition-colors">AI</a>
                    <a href="#" class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-text-dark/80 hover:text-white hover:bg-white/10 transition-colors">Radiology</a>
                    <a href="#" class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-text-dark/80 hover:text-white hover:bg-white/10 transition-colors">HIS</a>
                </div>
                
                <div class="flex items-center gap-3">
                    <span class="text-text-dark/50 text-sm font-bold uppercase tracking-wider">Share:</span>
                    <a href="#" class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-text-dark/70 hover:text-white hover:bg-[#1DA1F2] transition-colors"><span class="sr-only">Twitter</span><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-text-dark/70 hover:text-white hover:bg-[#0A66C2] transition-colors"><span class="sr-only">LinkedIn</span><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a>
                </div>
            </div>
        </div>
    </article>

    <!-- Next/Prev Articles Placeholder -->
    <section class="py-16 bg-navy border-t border-white/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="font-display font-bold text-2xl text-white mb-8">More from REDSOL</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <!-- Related 1 -->
                <a href="#" class="group block p-6 bg-steel rounded-2xl border border-white/10 hover:border-primary/50 hover:bg-white/5 transition-all">
                    <span class="text-primary text-xs font-bold uppercase tracking-wider mb-2 block">Previous</span>
                    <h4 class="font-display font-bold text-white group-hover:text-primary transition-colors text-lg">Launching REDSOL Campus Management System</h4>
                </a>
                <!-- Related 2 -->
                <a href="#" class="group block p-6 bg-steel rounded-2xl border border-white/10 hover:border-cyan/50 hover:bg-white/5 transition-all text-right">
                    <span class="text-cyan text-xs font-bold uppercase tracking-wider mb-2 block">Next</span>
                    <h4 class="font-display font-bold text-white group-hover:text-cyan transition-colors text-lg">The Importance of HL7 Compliance in Modern Hospitals</h4>
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
