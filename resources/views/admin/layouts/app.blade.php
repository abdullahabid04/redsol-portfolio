<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — REDSOL Admin</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600&display=swap"
        rel="stylesheet">

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
        html,
        body {
            height: 100%;
        }

        /* Admin shell — dark sidebar */
        .admin-shell {
            display: flex;
            height: 100%;
            min-height: 100vh;
            background: #f4f4f5;
        }

        /* ── SIDEBAR ──────────────────────────────── */
        .admin-sidebar {
            width: 256px;
            flex-shrink: 0;
            background: #0f0f0f;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 50;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .admin-sidebar.collapsed {
            transform: translateX(-256px);
        }

        /* Subtle red grid on sidebar */
        .sidebar-grid {
            background-image:
                linear-gradient(rgba(225, 29, 72, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(225, 29, 72, 0.05) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        /* Sidebar nav items */
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.45);
            text-decoration: none;
            transition: all 0.15s ease;
            position: relative;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.85);
        }

        .nav-item.active {
            background: rgba(225, 29, 72, 0.12);
            color: #ffffff;
            border: 1px solid rgba(225, 29, 72, 0.2);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: -14px;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 18px;
            background: #e11d48;
            border-radius: 0 2px 2px 0;
        }

        .nav-item svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        /* Nav section label */
        .nav-section-label {
            font-family: 'DM Sans', sans-serif;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.2);
            padding: 6px 14px 4px;
            margin-top: 8px;
        }

        /* ── TOPBAR ───────────────────────────────── */
        .admin-topbar {
            height: 60px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        /* ── MAIN CONTENT ─────────────────────────── */
        .admin-main {
            margin-left: 256px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .admin-main.expanded {
            margin-left: 0;
        }

        /* ── Mobile overlay ───────────────────────── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 49;
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.visible {
            display: block;
        }

        /* Admin input focus */
        .admin-input:focus {
            outline: none;
            border-color: #e11d48;
            box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.10);
        }

        @media (max-width: 1024px) {
            .admin-sidebar {
                transform: translateX(-256px);
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0 !important;
            }
        }
    </style>

    @stack('head')
</head>

<body class="h-full font-body bg-gray-50">

    @php $admin = Auth::guard('admin')->user(); @endphp

    <div class="admin-shell">

        
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div><aside class="admin-sidebar sidebar-grid" id="adminSidebar">

            
            <div class="px-5 py-5 border-b border-white/5 shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.svg') }}" alt="REDSOL" class="h-7 w-auto">
                    <div>
                        <div class="text-[8px] text-gray-600 tracking-widest uppercase -mt-0.5">Admin Panel</div>
                    </div>
                </a>
            </div>

            
            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
            
                
                <div class="nav-section-label">Main</div>
            
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            
                    <div class="nav-section-label">Content</div>

                    <a href="{{ route('admin.blog.index') }}" class="nav-item {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Blog Posts
                        @php $unpublished = \App\Models\BlogPost::where('status', 'draft')->count() ?? 0; @endphp
                        @if($unpublished > 0)
                            <span
                                class="ml-auto text-[10px] font-display font-700 bg-crimson-500/20 text-crimson-400 px-1.5 py-0.5 rounded-md">
                                {{ $unpublished }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('admin.services.index') }}"
                        class="nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                        Services
                    </a>

                    <a href="{{ route('admin.products.index') }}"
                        class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Products
                    </a>

                    <a href="{{ route('admin.projects.index') }}"
                        class="nav-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Projects
                    </a>

                    <a href="{{ route('admin.team.index') }}" class="nav-item {{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Team Members
                    </a>

                    <a href="{{ route('admin.clients.index') }}"
                        class="nav-item {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Clients
                    </a>

                    <a href="{{ route('admin.testimonials.index') }}"
                        class="nav-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        Testimonials
                    </a>
            
                    <div class="nav-section-label">Leads</div>

                    <a href="{{ route('admin.contacts.index') }}"
                        class="nav-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Contact Enquiries
                        @php $unread = \App\Models\ContactSubmission::where('status', \App\Models\ContactSubmission::STATUS_NEW)->count() ?? 0; @endphp
                        @if($unread > 0)
                            <span
                                class="ml-auto text-[10px] font-display font-700 bg-crimson-500 text-white px-1.5 py-0.5 rounded-md animate-pulse">
                                {{ $unread }}
                            </span>
                        @endif
                    </a>

                    {{-- <a href="{{ route('admin.demos.index') }}"
                        class="nav-item {{ request()->routeIs('admin.demos.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Demo Requests
                    </a> --}}                
                
                
                
                {{-- <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">

                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Admin Users
                </a> --}}
                
                
                {{-- <a href="" class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Settings
                </a> --}}
                
                <div class="nav-section-label">Navigation</div>
                <a href="{{ url('/') }}" target="_blank" class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    View Public Site
                </a>
            </nav>

            
            <div class="shrink-0 border-t border-white/5 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-crimson-500 flex items-center justify-center shrink-0">
                        <span class="font-display font-700 text-white text-xs">
                            {{ strtoupper(substr($admin->name, 0, 2)) }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-display font-600 text-white text-sm truncate">{{ $admin->name }}</div>
                        <span
                            class="inline-block text-[10px] font-600 px-1.5 py-0.5 rounded border {{ $admin->roleBadgeClass() }}">
                            {{ $admin->roleLabel() }}
                        </span>
                    </div>
                    
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" title="Logout"
                            class="w-7 h-7 rounded-lg bg-white/5 hover:bg-crimson-500/20 flex items-center justify-center text-gray-500 hover:text-crimson-400 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </aside><div class="admin-main" id="adminMain">

            
            <header class="admin-topbar sticky top-0 z-40 h-[60px] bg-white border-b border-gray-200 px-6 flex items-center justify-between">

                
                <div class="flex items-center gap-4 min-w-0">

                    
                    <div class="flex items-center gap-2">
                        
                        <button onclick="toggleSidebar()"
                            class="lg:hidden w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-100 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        
                        <button onclick="toggleSidebarDesktop()"
                            class="hidden lg:flex w-10 h-10 items-center justify-center rounded-lg border border-gray-200 text-gray-400 hover:text-gray-700 hover:bg-gray-50 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                            </svg>
                        </button>
                    </div>

                    
                    <div class="flex flex-col justify-center min-w-0">
                        
                        <h1 class="font-display font-800 text-lg text-gray-900 leading-tight tracking-tight truncate">
                            @yield('page-title', 'Dashboard')
                        </h1>

                        
                        @hasSection('breadcrumb')
                            <div class="flex items-center gap-1 mt-0.5 text-[11px] font-body text-gray-400">
                                @yield('breadcrumb')
                            </div>
                        @endif
                    </div>

                    
                    <div class="hidden md:block h-8 w-px bg-gray-200 mx-4"></div>

                    
                    <div class="hidden md:flex flex-col min-w-0">
                        <span class="text-sm text-gray-600 truncate">
                            @yield('page-description', 'Overview of your platform')
                        </span>
                        <span class="text-xs text-gray-400">
                            Monitor activity, manage content and grow your business.
                        </span>
                    </div>
                </div>

                
                <div class="flex items-center gap-4">
                    
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-3 px-1 py-1 rounded-lg hover:bg-gray-100 transition-colors">

                            
                            <div class="relative">
                                <div class="w-10 h-10 rounded-lg bg-gray-900 text-white flex items-center justify-center text-sm font-semibold font-display">
                                    {{ strtoupper(substr($admin->name, 0, 2)) }}
                                </div>
                                <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-crimson-500 border-2 border-white rounded-full"></span>
                            </div>

                            
                            <div class="hidden sm:flex flex-col leading-tight text-left">
                                <span class="text-sm font-medium text-gray-800 truncate max-w-[120px]">{{ $admin->name }}</span>
                                <span class="text-[10px] font-600 px-1.5 py-0.5 rounded border {{ $admin->roleBadgeClass() }} inline-block mt-0.5">
                                    {{ $admin->roleLabel() }}
                                </span>
                            </div>

                            
                            <svg class="w-4 h-4 text-gray-400 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        
                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            @click.away="open = false"
                            class="absolute right-0 top-full mt-2 w-56 bg-white border border-gray-100 rounded-xl shadow-lg shadow-gray-900/10 overflow-hidden z-50">

                            <div class="px-4 py-3 border-b border-gray-100">
                                <div class="font-display font-700 text-gray-900 text-sm">{{ $admin->name }}</div>
                                <div class="font-body text-xs text-gray-400 truncate">{{ $admin->email }}</div>
                                <span class="inline-block mt-1 text-[10px] font-600 px-1.5 py-0.5 rounded border {{ $admin->roleBadgeClass() }}">
                                    {{ $admin->roleLabel() }}
                                </span>
                            </div>

                            <div class="py-1 border-t border-gray-100">
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-body text-crimson-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </header>

            
            @if(session('success'))
                <div class="mx-6 mt-4 flex items-center gap-3 px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-sm font-body text-green-700"
                    x-data x-init="setTimeout(()=>$el.remove(),5000)">
                    <svg class="w-4 h-4 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mx-6 mt-4 flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50 border border-crimson-500/20 text-sm font-body text-crimson-700"
                    x-data x-init="setTimeout(()=>$el.remove(),5000)">
                    <svg class="w-4 h-4 text-crimson-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            
            <main class="flex-1 p-6">
                @yield('content')
            </main>

            
            <footer class="border-t border-gray-200 px-6 py-3 bg-white">
                <div class="flex items-center justify-between">
                    <p class="font-body text-xs text-gray-400">
                        © {{ date('Y') }} REDSOL Admin Panel. Logged in as <strong
                            class="text-gray-600">{{ $admin->name }}</strong>
                    </p>
                    <p class="font-body text-xs text-gray-400">
                        Last login: {{ $admin->last_login_at?->diffForHumans() ?? 'First login' }}
                    </p>
                </div>
            </footer>

        </div>

    </div>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        let sidebarCollapsed = false;

        // Mobile toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('visible');
        }

        function closeSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.remove('open');
            overlay.classList.remove('visible');
        }

        // Desktop collapse toggle
        function toggleSidebarDesktop() {
            const sidebar = document.getElementById('adminSidebar');
            const main = document.getElementById('adminMain');
            sidebarCollapsed = !sidebarCollapsed;
            sidebar.classList.toggle('collapsed', sidebarCollapsed);
            main.classList.toggle('expanded', sidebarCollapsed);
        }
    </script>

    @stack('scripts')
</body>

</html>