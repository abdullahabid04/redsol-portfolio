<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription ?? 'REDSOL — Healthcare Software Solutions. We Think In New Dimensions.' }}">
    <title>{{ $title ?? 'REDSOL' }} | Healthcare Software Solutions</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">

    {{-- Tailwind CDN (replace with compiled asset in production) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Syne', 'sans-serif'],
                        body: ['DM Sans', 'sans-serif'],
                    },
                    colors: {
                        crimson: {
                            50:  '#fff1f2',
                            100: '#ffe4e6',
                            400: '#fb7185',
                            500: '#e11d48',
                            600: '#be123c',
                            700: '#9f1239',
                        },
                    },
                    animation: {
                        'fade-up': 'fadeUp 0.7s ease forwards',
                        'fade-in': 'fadeIn 0.6s ease forwards',
                        'slide-left': 'slideLeft 0.7s ease forwards',
                        'ticker': 'ticker 30s linear infinite',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideLeft: {
                            '0%': { opacity: '0', transform: 'translateX(40px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' },
                        },
                        ticker: {
                            '0%': { transform: 'translateX(0)' },
                            '100%': { transform: 'translateX(-50%)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-12px)' },
                        }
                    }
                }
            }
        }
    </script>

    {{-- Alpine JS--}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite('resources/css/app.css')

    @stack('head')
</head>
<body class="mesh-bg grid-lines">

{{-- Navbar --}}
<x-ui.header />
{{-- Main Content --}}
<main>
    @yield('content')
</main>

{{-- Footer --}}
<x-ui.footer />

{{-- Alpine.js --}}
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    // Navbar scroll effect

    const navbar  = document.getElementById('navbar');
    const hasHero = document.querySelector('.hero-slide') !== null;

    function updateNav() {
        if (hasHero && window.scrollY < 80) {
            // Hero page, at top → transparent with white text
            navbar.classList.remove('nav-glass');
            navbar.classList.add('nav-transparent');
        } else {
            // Scrolled down, OR non-hero page → frosted glass with dark text
            navbar.classList.remove('nav-transparent');
            navbar.classList.add('nav-glass');
        }
    }

    updateNav(); // run immediately on page load
    window.addEventListener('scroll', updateNav, { passive: true });


    // Mobile menu
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Scroll reveal
    const revealEls = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });
    revealEls.forEach(el => revealObserver.observe(el));

    // Counter animation
    function animateCounter(el) {
        const target = parseInt(el.dataset.target);
        const duration = 2000;
        const start = performance.now();
        const update = (now) => {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.round(eased * target).toLocaleString();
            if (progress < 1) requestAnimationFrame(update);
        };
        requestAnimationFrame(update);
    }

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.animated) {
                entry.target.dataset.animated = true;
                animateCounter(entry.target);
            }
        });
    }, { threshold: 0.5 });
    document.querySelectorAll('[data-target]').forEach(el => counterObserver.observe(el));
</script>

@stack('scripts')
</body>
</html>
