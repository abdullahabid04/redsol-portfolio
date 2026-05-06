<footer class="bg-navy border-t border-white/10 pt-16 pb-8 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute -top-[50%] -left-[10%] w-[50%] h-[50%] rounded-full bg-primary/5 blur-[120px]"></div>
        <div class="absolute top-[20%] -right-[10%] w-[40%] h-[60%] rounded-full bg-cyan/5 blur-[120px]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">
            
            <!-- Brand Column -->
            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                <a href="{{ url('/') }}" class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 rounded-md bg-gradient-to-br from-primary to-neon-red flex items-center justify-center">
                        <span class="text-white font-display font-bold text-lg leading-none">R</span>
                    </div>
                    <span class="font-display font-extrabold text-xl tracking-wide text-white">REDSOL</span>
                </a>
                <p class="text-text-dark/80 text-sm leading-relaxed mb-6">
                    Transforming healthcare with intelligent information systems. Built for modern hospitals and academic campuses.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-text-dark hover:text-white hover:bg-white/10 transition-colors">
                        <span class="sr-only">LinkedIn</span>
                        <!-- Placeholder icon -->
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-text-dark hover:text-white hover:bg-white/10 transition-colors">
                        <span class="sr-only">Twitter</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Links Column 1 -->
            <div>
                <h3 class="text-white font-sans font-bold uppercase tracking-wider text-sm mb-6">Products</h3>
                <ul class="space-y-4">
                    <li><a href="{{ url('/products/his') }}" class="text-text-dark/80 hover:text-neon-red transition-colors text-sm">HIS Modules</a></li>
                    <li><a href="{{ url('/products/campus-management-system') }}" class="text-text-dark/80 hover:text-neon-red transition-colors text-sm">Campus Management (CMS)</a></li>
                    <li><a href="{{ url('/products') }}" class="text-text-dark/80 hover:text-neon-red transition-colors text-sm">Full Product Index</a></li>
                </ul>
            </div>

            <!-- Links Column 2 -->
            <div>
                <h3 class="text-white font-sans font-bold uppercase tracking-wider text-sm mb-6">Company</h3>
                <ul class="space-y-4">
                    <li><a href="{{ url('/about') }}" class="text-text-dark/80 hover:text-neon-red transition-colors text-sm">About Us</a></li>
                    <li><a href="{{ url('/services/custom-software-development') }}" class="text-text-dark/80 hover:text-neon-red transition-colors text-sm">Custom Dev</a></li>
                    <li><a href="{{ url('/blog') }}" class="text-text-dark/80 hover:text-neon-red transition-colors text-sm">Blog & News</a></li>
                    <li><a href="{{ url('/contact') }}" class="text-text-dark/80 hover:text-neon-red transition-colors text-sm">Contact Us</a></li>
                </ul>
            </div>

            <!-- Newsletter Column -->
            <div>
                <h3 class="text-white font-sans font-bold uppercase tracking-wider text-sm mb-6">Newsletter</h3>
                <p class="text-text-dark/80 text-sm mb-4">Subscribe to our newsletter for the latest updates on health-tech.</p>
                <form class="flex flex-col gap-3">
                    <input type="email" placeholder="Email address" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    <button type="submit" class="bg-white/10 hover:bg-white/20 text-white font-medium text-sm py-2.5 rounded-lg transition-all border border-white/5">Subscribe</button>
                </form>
            </div>
            
        </div>

        <div class="mt-16 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-text-dark/60 text-xs text-center md:text-left">
                &copy; {{ date('Y') }} REDSOL HIS. All rights reserved.
            </p>
            <div class="flex gap-6">
                <a href="#" class="text-text-dark/60 hover:text-white text-xs transition-colors">Privacy Policy</a>
                <a href="#" class="text-text-dark/60 hover:text-white text-xs transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
