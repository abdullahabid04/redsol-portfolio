<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'REDSOL HIS')) | Premium Digital Health Solutions</title>
    
    <meta name="description" content="@yield('meta_description', 'REDSOL provides enterprise-grade Health Information Systems (HIS) and Campus Management Systems (CMS) for modern hospitals and medical colleges.')">
    <meta name="keywords" content="HIS, Hospital Management System, CMS, Campus Management, Digital Health, EMR, REDSOL">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', config('app.name', 'REDSOL HIS'))">
    <meta property="og:description" content="@yield('meta_description', 'Premium Digital Health & Education Solutions')">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', config('app.name', 'REDSOL HIS'))">
    <meta property="twitter:description" content="@yield('meta_description', 'Premium Digital Health & Education Solutions')">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Syne:wght@400..800&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased text-text-light dark:text-text-dark bg-surface-light dark:bg-navy min-h-screen flex flex-col selection:bg-primary selection:text-white" x-data="{ mobileMenuOpen: false }">
    
    <!-- Navbar -->
    <x-ui.navbar />

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-ui.footer />

    @livewireScripts
    @stack('scripts')
</body>
</html>
