
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-9 h-9">
                    <div class="w-full h-full flex items-center justify-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Site Logo">
                    </div>
                </div>

                <span class="nav-logo-text font-display font-800 text-xl tracking-tight">
                    RED<span class="red-gradient-text">SOL</span>
                </span>
                <div class="nav-tagline text-[9px] tracking-widest uppercase -mt-0.5">
                    We Think In New Dimensions
                </div>
            </a>

            <div class="hidden lg:flex items-center gap-1">
                @php
                    $navItems = [
                        ['label' => 'Home',     'href' => '/'],
                        ['label' => 'About',    'href' => '/about'],
                        ['label' => 'Services', 'href' => '/services'],
                        ['label' => 'Products', 'href' => '/products'],
                        // ['label' => 'Projects', 'href' => '/projects'],
                        ['label' => 'Clients',  'href' => '/clients'],
                        ['label' => 'Blog',     'href' => '/blog'],
                    ];
                @endphp
                @foreach($navItems as $item)
                    <a href="{{ $item['href'] }}"
                       class="nav-link px-4 py-2 text-sm font-body font-medium
                  transition-colors duration-200 rounded-lg
                  {{ request()->is(ltrim($item['href'], '/') ?: '/') ? 'active' : '' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="flex items-center gap-3">
                <a href="/contact"
                   class="hidden lg:flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-display font-600 text-white bg-crimson-500 hover:bg-crimson-600 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-crimson-500/30">
                    Get In Touch
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>

                
                <button id="mobileMenuBtn" class="nav-mobile-btn lg:hidden p-2 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="hamburgerIcon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

            </div>

        </div>
    </div>

    
    <div id="mobileMenu" class="hidden lg:hidden nav-glass border-t border-crimson-500/10 px-6 py-4">
        @foreach($navItems as $item)
            <a href="{{ $item['href'] }}" class="block py-3 text-gray-600 hover:text-crimson-500 font-body transition-colors border-b border-gray-100">
                {{ $item['label'] }}
            </a>
        @endforeach
        <a href="/contact" class="mt-4 w-full flex justify-center px-5 py-3 rounded-xl text-sm font-display font-600 text-white bg-crimson-500">
            Get In Touch
        </a>
    </div>
</nav>
