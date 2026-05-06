<header 
    x-data="{ scrolled: false }" 
    @scroll.window="scrolled = (window.pageYOffset > 20)"
    :class="{ 'bg-navy/85 backdrop-blur-xl border-b border-white/10': scrolled, 'bg-transparent': !scrolled }"
    class="fixed w-full top-0 z-50 transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <!-- Placeholder Logo -->
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary to-neon-red flex items-center justify-center shadow-[0_0_15px_rgba(192,57,43,0.5)]">
                        <span class="text-white font-display font-bold text-xl leading-none">R</span>
                    </div>
                    <span class="font-display font-extrabold text-2xl tracking-wide text-white">REDSOL</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ url('/') }}" class="text-text-dark hover:text-white transition-colors relative group font-sans font-medium">
                    Home
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-neon-red transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ url('/about') }}" class="text-text-dark hover:text-white transition-colors relative group font-sans font-medium">
                    About
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-neon-red transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ url('/products') }}" class="text-text-dark hover:text-white transition-colors relative group font-sans font-medium">
                    Products
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-neon-red transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ url('/services') }}" class="text-text-dark hover:text-white transition-colors relative group font-sans font-medium">
                    Services
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-neon-red transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ url('/blog') }}" class="text-text-dark hover:text-white transition-colors relative group font-sans font-medium">
                    Blog
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-neon-red transition-all duration-300 group-hover:w-full"></span>
                </a>
            </nav>

            <!-- CTA Button -->
            <div class="hidden md:flex items-center">
                <x-ui.button href="{{ url('/contact') }}" variant="primary">
                    Request Demo
                </x-ui.button>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-text-dark hover:text-white focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg :class="{'hidden': mobileMenuOpen, 'block': !mobileMenuOpen }" class="h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg :class="{'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-steel border-t border-white/10" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ url('/') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-white/5">Home</a>
            <a href="{{ url('/about') }}" class="text-text-dark hover:text-white hover:bg-white/5 block px-3 py-2 rounded-md text-base font-medium">About</a>
            <a href="{{ url('/products') }}" class="text-text-dark hover:text-white hover:bg-white/5 block px-3 py-2 rounded-md text-base font-medium">Products</a>
            <a href="{{ url('/services') }}" class="text-text-dark hover:text-white hover:bg-white/5 block px-3 py-2 rounded-md text-base font-medium">Services</a>
            <a href="{{ url('/blog') }}" class="text-text-dark hover:text-white hover:bg-white/5 block px-3 py-2 rounded-md text-base font-medium">Blog</a>
            <div class="mt-4 px-3">
                <x-ui.button href="{{ url('/contact') }}" variant="primary" class="w-full justify-center">
                    Request Demo
                </x-ui.button>
            </div>
        </div>
    </div>
</header>
