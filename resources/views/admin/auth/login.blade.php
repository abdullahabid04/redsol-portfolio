<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — REDSOL</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600&display=swap" rel="stylesheet">

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
                            50: '#fff1f2',
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
    @vite('resources/css/app.css')

    <style>
        html, body { height: 100%; }

        /* Left panel diagonal clip */
        .login-panel-left {
            background: #0f0f0f;
            position: relative;
            overflow: hidden;
        }
        .login-panel-left::after {
            content: '';
            position: absolute;
            top: 0; right: -60px; bottom: 0;
            width: 120px;
            background: #ffffff;
            clip-path: polygon(60px 0, 100% 0, 100% 100%, 0 100%);
            z-index: 10;
        }

        /* Subtle red grid on dark panel */
        .login-grid {
            background-image:
                linear-gradient(rgba(225,29,72,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(225,29,72,0.06) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Input focus ring using crimson */
        .admin-input {
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .admin-input:focus {
            outline: none;
            border-color: #e11d48;
            box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.10);
        }

        /* Password toggle button */
        .pw-toggle { transition: color 0.15s; }
        .pw-toggle:hover { color: #e11d48; }

        /* Form entrance animation */
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(24px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .form-card { animation: slideInRight 0.5s cubic-bezier(0.16,1,0.3,1) both; }

        /* Left panel content entrance */
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-24px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .panel-content { animation: slideInLeft 0.5s cubic-bezier(0.16,1,0.3,1) both; }
        .panel-content-1 { animation-delay: 0.1s; }
        .panel-content-2 { animation-delay: 0.22s; }
        .panel-content-3 { animation-delay: 0.34s; }
        .panel-content-4 { animation-delay: 0.46s; }

        /* Pulse dot */
        @keyframes pulse {
            0%,100% { box-shadow: 0 0 0 0 rgba(225,29,72,.5); }
            50%      { box-shadow: 0 0 0 6px rgba(225,29,72,0); }
        }
        .pulse-dot { animation: pulse 2s ease-in-out infinite; }
    </style>
</head>
<body class="h-full bg-white font-body">

<div class="flex h-full min-h-screen"><div class="hidden lg:flex lg:w-[45%] xl:w-[42%] login-panel-left login-grid flex-col justify-between p-12 xl:p-16 relative z-0">

        
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full border border-crimson-500/10 pointer-events-none"></div>
        <div class="absolute -bottom-16 left-1/3 w-56 h-56 rounded-full border border-crimson-500/8 pointer-events-none"></div>

        
        <div class="relative z-10 panel-content panel-content-1">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="REDSOL Logo" class="h-9 w-auto">
                <div>
                    <div class="font-display font-800 text-xl text-white tracking-tight">
                        RED<span class="text-crimson-500">SOL</span>
                    </div>
                    <div class="text-[9px] text-gray-500 tracking-widest uppercase -mt-0.5">
                        We Think In New Dimensions
                    </div>
                </div>
            </a>
        </div>

        
        <div class="relative z-10 my-auto py-16">
            <div class="flex items-center gap-3 mb-6 panel-content panel-content-2">
                <div class="h-px w-10 bg-crimson-500"></div>
                <span class="text-crimson-500 text-xs font-display font-600 tracking-widest uppercase">Admin Panel</span>
            </div>

            <h1 class="font-display font-800 text-4xl xl:text-5xl text-white leading-[0.95] mb-6 panel-content panel-content-2">
                Manage Your<br>
                <span class="text-crimson-500">REDSOL</span><br>
                Platform
            </h1>

            <p class="font-body text-gray-400 text-base leading-relaxed max-w-xs panel-content panel-content-3">
                Control content, manage leads, publish blog posts, add testimonials, and monitor your portfolio — all in one place.
            </p>

            
            <div class="mt-10 space-y-3 panel-content panel-content-4">
                @foreach([
    'Manage blog posts & services',
    'Handle contact & demo requests',
    'Update clients & testimonials',
    'Control team members & projects',
] as $feature)
                <div class="flex items-center gap-3">
                    <div class="w-5 h-5 rounded-full bg-crimson-500/15 border border-crimson-500/30 flex items-center justify-center shrink-0">
                        <svg class="w-2.5 h-2.5 text-crimson-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="font-body text-sm text-gray-400">{{ $feature }}</span>
                </div>
                @endforeach
            </div>
        </div>

        
        <div class="relative z-10 flex items-center gap-3 panel-content panel-content-4">
            <div class="w-2 h-2 rounded-full bg-green-400 pulse-dot"></div>
            <span class="font-body text-xs text-gray-500">System operational — all services running</span>
        </div>

    </div><div class="flex-1 flex flex-col justify-center items-center px-6 py-12 lg:px-16 xl:px-24 bg-white relative">

        
        <div class="lg:hidden absolute top-6 left-6 flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="REDSOL" class="h-8 w-auto">
            <span class="font-display font-800 text-lg text-gray-900">RED<span class="text-crimson-500">SOL</span></span>
        </div>

        
        <div class="absolute top-6 right-6">
            <a href="/" class="flex items-center gap-2 font-body text-xs text-gray-400 hover:text-crimson-500 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to site
            </a>
        </div>

        <div class="w-full max-w-[400px] form-card">

            
            <div class="mb-8">
                <h2 class="font-display font-800 text-3xl text-gray-900 mb-2">Welcome back</h2>
                <p class="font-body text-gray-500 text-sm">Sign in to your admin account to continue.</p>
            </div>

            
            @if(session('success'))
            <div class="mb-5 flex items-start gap-3 px-4 py-3.5 rounded-xl bg-green-50 border border-green-200">
                <svg class="w-4 h-4 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="font-body text-sm text-green-700">{{ session('success') }}</p>
            </div>
            @endif

            
            @if(session('error'))
            <div class="mb-5 flex items-start gap-3 px-4 py-3.5 rounded-xl bg-red-50 border border-crimson-500/20">
                <svg class="w-4 h-4 text-crimson-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="font-body text-sm text-crimson-600">{{ session('error') }}</p>
            </div>
            @endif

            
            <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
                @csrf

                
                <div>
                    <label for="email" class="block font-body text-sm font-500 text-gray-700 mb-1.5">
                        Email address
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                        placeholder="admin@redsol.com"
                        class="admin-input w-full px-4 py-3 rounded-xl border font-body text-sm text-gray-900 placeholder-gray-400 bg-white
                               {{ $errors->has('email') ? 'border-crimson-500 bg-red-50' : 'border-gray-200 hover:border-gray-300' }}"
                    >
                    @error('email')
                    <p class="mt-1.5 flex items-center gap-1.5 font-body text-xs text-crimson-600">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                
                <div>
                    <label for="password" class="block font-body text-sm font-500 text-gray-700 mb-1.5">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••••"
                            class="admin-input w-full px-4 py-3 pr-12 rounded-xl border font-body text-sm text-gray-900 placeholder-gray-400 bg-white
                                   {{ $errors->has('password') ? 'border-crimson-500 bg-red-50' : 'border-gray-200 hover:border-gray-300' }}"
                        >
                        
                        <button type="button"
                                onclick="togglePassword()"
                                class="pw-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-1.5 flex items-center gap-1.5 font-body text-xs text-crimson-600">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2.5 cursor-pointer group">
                        <input type="checkbox" name="remember"
                               class="w-4 h-4 rounded border-gray-300 text-crimson-500 focus:ring-crimson-500/30 cursor-pointer">
                        <span class="font-body text-sm text-gray-600 group-hover:text-gray-900 transition-colors">Remember me</span>
                    </label>
                </div>

                
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-crimson-500 text-white font-display font-700 text-sm tracking-wide hover:bg-crimson-600 transition-all duration-300
                               hover:shadow-lg hover:shadow-crimson-500/30 hover:scale-[1.01]
                               active:scale-[0.99] focus:outline-none focus:ring-2 focus:ring-crimson-500/30">
                    Sign In to Admin Panel
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>

            </form>

            
            <div class="flex items-center gap-4 my-6">
                <div class="flex-1 h-px bg-gray-100"></div>
                <span class="font-body text-xs text-gray-400">REDSOL Admin Panel</span>
                <div class="flex-1 h-px bg-gray-100"></div>
            </div>

            
            <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 border border-gray-100">
                <svg class="w-4 h-4 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <p class="font-body text-xs text-gray-500 leading-relaxed">
                    This area is restricted to authorized REDSOL staff only. Accounts are locked after {{ \App\Http\Controllers\Admin\AdminAuthController::MAX_ATTEMPTS }} failed attempts.
                </p>
            </div>

        </div>

        
        <div class="absolute bottom-6 left-0 right-0 text-center">
            <p class="font-body text-xs text-gray-400">
                © {{ date('Y') }} REDSOL Technologies. All rights reserved.
            </p>
        </div>

    </div>

</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('eyeIcon');
        const isHidden = input.type === 'password';

        input.type = isHidden ? 'text' : 'password';
        icon.innerHTML = isHidden
            ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
            : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
    }
</script>

</body>
</html>