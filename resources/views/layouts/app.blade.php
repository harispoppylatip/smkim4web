<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('gambar/logoim4.png') }}">

    <title>@yield('title', config('app.name', 'SMKIM4')) - {{ config('app.name', 'SMKIM4') }}</title>

    {{-- Fonts: Montserrat for headings, Inter for body --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/css/dashboard.css'])
    @stack('styles')
    @yield('styles')

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="font-sans bg-[#f9f9fc] text-[#1a1c1e] antialiased">
    {{-- Mobile Overlay --}}
    <div id="mobile-overlay" class="fixed inset-0 z-40 bg-black/50 hidden lg:hidden transition-opacity duration-300">
    </div>
    </div>

    {{-- Mobile Off-canvas Sidebar --}}
    <aside id="mobile-sidebar"
        class="fixed inset-y-0 left-0 z-50 w-72 bg-[#001e40] text-white transform -translate-x-full transition-transform duration-300 ease-in-out lg:hidden overflow-y-auto">
        {{-- Brand --}}
        <div class="flex items-center justify-between px-5 h-16 border-b border-[#1f477b] shrink-0">
            <div class="flex items-center gap-3">
                <img src="{{ asset('gambar/logoim4.jpeg') }}" alt="Logo SMKIM4" class="w-8 h-8 rounded-lg object-cover">
                <div class="leading-tight">
                    <p class="text-sm font-semibold text-white">SMKIM4</p>
                    <p class="text-[10px] text-[#a7c8ff]">Muhammadiyah 4 Samarinda</p>
                </div>
            </div>
            <button type="button" id="mobile-menu-close"
                class="p-1.5 rounded-lg text-[#a7c8ff] hover:bg-[#1f477b] transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="py-4 px-3 space-y-1">
            <p class="px-3 text-[10px] font-semibold uppercase tracking-wider text-[#799dd6] mb-2">Menu</p>

            <x-navigation.nav-item href="{{ route('dashboard') }}" icon="home" :active="request()->routeIs('dashboard')">
                Beranda
            </x-navigation.nav-item>

            <x-navigation.nav-item href="{{ route('admin.berita.index') }}" icon="file-text" :active="request()->routeIs('admin.berita*')">
                Berita
            </x-navigation.nav-item>

            <x-navigation.nav-item href="{{ route('admin.program-keahlian.index') }}" icon="book-open"
                :active="request()->routeIs('admin.program-keahlian*')">
                Program Keahlian
            </x-navigation.nav-item>

            <p class="px-3 text-[10px] font-semibold uppercase tracking-wider text-[#799dd6] mb-2 mt-4">Pengaturan</p>

            <x-navigation.nav-item href="{{ route('admin.fasilitas-umum.index') }}" icon="home_repair_service"
                :active="request()->routeIs('admin.fasilitas-umum*')">
                Fasilitas
            </x-navigation.nav-item>

            <x-navigation.nav-item href="{{ route('admin.unggulan.index') }}" icon="stars" :active="request()->routeIs('admin.unggulan*')">
                Program Unggulan
            </x-navigation.nav-item>

            <x-navigation.nav-item href="{{ route('admin.profil-sekolah.index') }}" icon="account_balance"
                :active="request()->routeIs('admin.profil-sekolah*')">
                Profil Sekolah
            </x-navigation.nav-item>

            <x-navigation.nav-item href="{{ route('admin.pengaturan-home.index') }}" icon="settings" :active="request()->routeIs('admin.pengaturan-home*')">
                Halaman Utama
            </x-navigation.nav-item>

            <x-navigation.nav-item href="{{ route('admin.spmb.index') }}" icon="school" :active="request()->routeIs('admin.spmb*')">
                SPMB
            </x-navigation.nav-item>

            <x-navigation.nav-item href="{{ route('admin.sosial-media.index') }}" icon="share" :active="request()->routeIs('admin.sosial-media*')">
                Sosial Media
            </x-navigation.nav-item>
        </nav>

        {{-- User Footer --}}
        <div class="border-t border-[#1f477b] p-4">
            <div class="flex items-center gap-3">
                <div
                    class="w-8 h-8 rounded-full bg-[#799dd6] flex items-center justify-center text-white text-xs font-semibold">
                    {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'User' }}</p>
                    <p class="text-[11px] text-[#a7c8ff] truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-[#ff8a8a] hover:bg-[#1f477b] hover:text-red-300 transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="flex min-h-screen overflow-x-hidden max-w-full">
        {{-- Desktop Sidebar --}}
        <x-navigation.sidebar />

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col lg:ml-64 min-w-0 max-w-full w-full">
            {{-- Top Header --}}
            <x-navigation.top-header />

            {{-- Page Content --}}
            <main class="flex-1 p-4 md:p-6 lg:p-8 min-w-0 max-w-full">
                <div class="max-w-7xl mx-auto w-full">
                    @yield('content')
                </div>
            </main>

            {{-- Footer --}}
            <footer class="border-t border-[#e2e2e5] bg-white py-4 px-4 md:px-6">
                <div
                    class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-2 text-sm text-[#737780]">
                    <p>&copy; {{ date('Y') }} P.A.Z.
                        All rights reserved.</p>
                    <p class="text-xs">SMK Istiqomah Muhammadiyah 4 Samarinda</p>
                </div>
            </footer>
        </div>
    </div>

    {{-- Scripts --}}
    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>

</html>
