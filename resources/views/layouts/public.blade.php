<!DOCTYPE html>
<html class="scroll-smooth" lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('gambar/logoim4.png') }}">
    <title>@yield('title', 'SMKIM4 - SMK Istiqomah Muhammadiyah 4 Samarinda')</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    {{-- Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    {{-- Tailwind Config --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "surface": "#f9f9fc",
                        "surface-dim": "#dadadc",
                        "surface-bright": "#f9f9fc",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f3f3f6",
                        "surface-container": "#eeeef0",
                        "surface-container-high": "#e8e8ea",
                        "surface-container-highest": "#e2e2e5",
                        "on-surface": "#1a1c1e",
                        "on-surface-variant": "#43474f",
                        "outline": "#737780",
                        "outline-variant": "#c3c6d1",
                        "primary": "#001e40",
                        "on-primary": "#ffffff",
                        "primary-container": "#003366",
                        "on-primary-container": "#799dd6",
                        "primary-fixed": "#d5e3ff",
                        "primary-fixed-dim": "#a7c8ff",
                        "secondary": "#705d00",
                        "on-secondary": "#ffffff",
                        "secondary-container": "#fcd400",
                        "on-secondary-container": "#6e5c00",
                        "secondary-fixed": "#ffe16d",
                        "secondary-fixed-dim": "#e9c400",
                        "tertiary": "#001d44",
                        "tertiary-container": "#00316c",
                        "on-tertiary-container": "#629afb",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "inverse-surface": "#2f3133",
                        "inverse-on-surface": "#f0f0f3",
                        "inverse-primary": "#a7c8ff",
                        "surface-tint": "#3a5f94",
                        "surface-variant": "#e2e2e5",
                        "background": "#f9f9fc",
                        "on-background": "#1a1c1e",
                    },
                    fontFamily: {
                        'heading': ['Montserrat', 'sans-serif'],
                        'body': ['Inter', 'sans-serif'],
                    },
                    borderRadius: {
                        'DEFAULT': '0.25rem',
                        'lg': '0.5rem',
                        'xl': '0.75rem',
                        'full': '9999px',
                    },
                    spacing: {
                        'xs': '4px',
                        'sm': '8px',
                        'md': '16px',
                        'lg': '24px',
                        'xl': '40px',
                        'container-margin-mobile': '16px',
                        'container-margin-desktop': '64px',
                        'gutter': '16px',
                        'base': '4px',
                    },
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            min-height: 100dvh;
            -webkit-tap-highlight-color: transparent;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-surface font-body text-on-surface antialiased overflow-x-hidden">

    {{-- ==================== TOP NAVBAR ==================== --}}
    <header
        class="fixed top-0 w-full z-50 flex justify-between items-center px-container-margin-mobile md:px-container-margin-desktop h-16 bg-surface shadow-sm">
        <div class="flex items-center gap-sm">
            <a href="{{ route('home') }}" class="flex items-center justify-center hover:opacity-90 transition-opacity">
                @php($logoPath = public_path('gambar/logoim4.jpeg'))
                @if (file_exists($logoPath))
                    <img src="{{ asset('gambar/logoim4.jpeg') }}" alt="Logo" class="w-9 h-9 object-contain">
                @else
                    <span class="material-symbols-outlined text-3xl text-primary"
                        style="font-variation-settings: 'FILL' 1;">school</span>
                @endif
            </a>
            <h1 class="text-xl md:text-2xl font-heading font-bold text-primary">SMKIM4</h1>
        </div>
        <nav class="hidden md:flex gap-lg items-center">
            <a class="{{ request()->routeIs('home') ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} transition-colors"
                href="{{ route('home') }}">Home</a>
            <a class="{{ request()->routeIs('program-keahlian*') ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} transition-colors"
                href="{{ route('program-keahlian') }}">Jurusan</a>
            <a class="{{ request()->routeIs('berita') ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} transition-colors"
                href="{{ route('berita') }}">Berita</a>
            <a class="{{ request()->routeIs('profile') ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} transition-colors"
                href="{{ route('profile') }}">Profil</a>
            <a class="{{ request()->routeIs('contact') ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} transition-colors"
                href="{{ route('contact') }}">Contact</a>
            <a class="{{ request()->routeIs('spmb') ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} transition-colors"
                href="{{ route('spmb') }}">SPMB</a>
        </nav>
    </header>

    {{-- ==================== MAIN CONTENT ==================== --}}
    <main class="pt-16 pb-20 md:pb-0">
        @yield('content')
    </main>

    {{-- ==================== FOOTER ==================== --}}
    <footer class="w-full bg-[#001a33] pt-xl pb-24 md:pb-lg px-container-margin-mobile md:px-container-margin-desktop">
        <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-xl">
            {{-- Brand & Social --}}
            <div class="md:col-span-1">
                <div class="flex items-center gap-3 mb-md">
                    <div class="w-10 h-10 flex items-center justify-center shrink-0">
                        <img src="{{ asset('gambar/logoim4.jpeg') }}" alt="SMKIM4"
                            class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h5 class="font-heading text-lg font-bold text-white">SMKIM4</h5>
                        <p class="text-xs text-white/50">Muhammadiyah 4 Samarinda</p>
                    </div>
                </div>
                <p class="font-body text-sm text-white/60 max-w-sm mb-lg leading-relaxed">
                    Lembaga pendidikan kejuruan yang berfokus pada keunggulan teknologi dan penguatan spiritual.
                    Kompleks Perguruan Muhammadiyah, Jl. A. Wahab Syahranie, Samarinda.
                </p>
                <div class="flex gap-3">
                    {{-- YouTube --}}
                    <a href="{{ $social->youtube ?? config('social.youtube') }}" target="_blank"
                        rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white/70 hover:bg-red-600 hover:text-white hover:scale-110 transition-all duration-200"
                        aria-label="YouTube">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </a>
                    {{-- Instagram --}}
                    <a href="{{ $social->instagram ?? config('social.instagram') }}" target="_blank"
                        rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white/70 hover:bg-gradient-to-tr hover:from-purple-600 hover:via-pink-500 hover:to-yellow-500 hover:text-white hover:scale-110 transition-all duration-200"
                        aria-label="Instagram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z" />
                        </svg>
                    </a>
                    {{-- Facebook --}}
                    <a href="{{ $social->facebook ?? config('social.facebook') }}" target="_blank"
                        rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white/70 hover:bg-blue-600 hover:text-white hover:scale-110 transition-all duration-200"
                        aria-label="Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    {{-- TikTok --}}
                    <a href="{{ $social->tiktok ?? config('social.tiktok') }}" target="_blank"
                        rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white/70 hover:bg-black hover:text-white hover:scale-110 transition-all duration-200"
                        aria-label="TikTok">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h6 class="text-xs font-semibold text-secondary mb-sm uppercase tracking-wider">Quick Links</h6>
                <ul class="space-y-2.5">
                    <li><a href="{{ route('home') }}"
                            class="text-white/60 hover:text-white transition-colors text-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">chevron_right</span>Home</a></li>
                    <li><a href="{{ route('program-keahlian') }}"
                            class="text-white/60 hover:text-white transition-colors text-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">chevron_right</span>Jurusan</a></li>
                    <li><a href="{{ route('berita') }}"
                            class="text-white/60 hover:text-white transition-colors text-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">chevron_right</span>Berita</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="text-white/60 hover:text-white transition-colors text-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">chevron_right</span>Contact</a></li>
                    <li><a href="{{ route('spmb') }}"
                            class="text-white/60 hover:text-white transition-colors text-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">chevron_right</span>SPMB</a></li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div>
                <h6 class="text-xs font-semibold text-secondary mb-sm uppercase tracking-wider">Kontak</h6>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3 text-white/60 text-sm">
                        <span class="material-symbols-outlined text-sm mt-0.5 text-secondary">location_on</span>
                        <span>Kompleks Perguruan Muhammadiyah<br>
                            Jl. A. Wahab Syahranie, RT.25, Air Hitam<br>
                            Kec. Samarinda Ulu, Kota Samarinda<br>
                            Kalimantan Timur 75124</span>
                    </li>
                    <li>
                        <a href="tel:0541747366"
                            class="flex items-center gap-3 text-white/60 hover:text-white transition-colors text-sm">
                            <span class="material-symbols-outlined text-sm text-secondary">call</span>
                            0541 747366
                        </a>
                    </li>
                    <li>
                        <a href="mailto:info@smkim4samarinda.sch.id"
                            class="flex items-center gap-3 text-white/60 hover:text-white transition-colors text-sm">
                            <span class="material-symbols-outlined text-sm text-secondary">mail</span>
                            info@smkim4samarinda.sch.id
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Copyright --}}
        <div
            class="max-w-7xl mx-auto mt-xl pt-lg border-t border-white/10 flex flex-col items-center justify-center gap-3 text-center text-white/40 text-xs md:flex-row md:items-center md:justify-between md:text-left">
            <p class="leading-relaxed"><a href="{{ route('tentang-pengembang') }}"
                    class="hover:text-white/60 transition-colors">&copy;
                    {{ date('Y') }} SMKIM4 Muhammadiyah 4 Samarinda. All rights reserved.</a></p>
            <p class="flex items-center justify-center gap-1 leading-relaxed">
                <span class="material-symbols-outlined text-xs">favorite</span>
                Berlandaskan Nilai Islam, Kedisiplinan, Berkarakter
            </p>
        </div>
    </footer>

    {{-- ==================== BOTTOM NAV (Mobile) ==================== --}}
    @php($bottomNavActive = trim((string) $__env->yieldContent('bottomNavActive', 'home')))
    <x-navigation.bottom-nav :active="$bottomNavActive" />

    {{-- ==================== SCRIPTS ==================== --}}
    @stack('scripts')

    <script>
        // Scroll header effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('shadow-md', 'bg-white/95', 'backdrop-blur-sm');
                header.classList.remove('bg-surface');
            } else {
                header.classList.remove('shadow-md', 'bg-white/95', 'backdrop-blur-sm');
                header.classList.add('bg-surface');
            }
        });
    </script>

</body>

</html>
