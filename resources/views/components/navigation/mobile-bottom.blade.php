<nav
    class="lg:hidden fixed bottom-0 inset-x-0 z-30 bg-white border-t border-[#e2e2e5] shadow-[0px_-4px_12px_rgba(0,51,102,0.08)]">
    <div class="flex items-center justify-around h-16 px-2">
        {{-- Beranda --}}
        <a href="{{ route('dashboard') }}"
            class="flex flex-col items-center gap-0.5 px-3 py-1 {{ request()->routeIs('dashboard') ? 'text-[#003366]' : 'text-[#737780]' }} transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-[10px] font-medium">Beranda</span>
        </a>

        {{-- Berita --}}
        <a href="{{ route('admin.berita.index') }}"
            class="flex flex-col items-center gap-0.5 px-3 py-1 {{ request()->routeIs('admin.berita*') ? 'text-[#003366]' : 'text-[#737780]' }} transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            <span class="text-[10px] font-medium">Berita</span>
        </a>

        {{-- Program Keahlian --}}
        <a href="{{ route('admin.program-keahlian.index') }}"
            class="flex flex-col items-center gap-0.5 px-3 py-1 {{ request()->routeIs('admin.program-keahlian*') ? 'text-[#003366]' : 'text-[#737780]' }} transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <span class="text-[10px] font-medium">Program</span>
        </a>

        {{-- Fasilitas --}}
        <a href="{{ route('admin.fasilitas-umum.index') }}"
            class="flex flex-col items-center gap-0.5 px-3 py-1 {{ request()->routeIs('admin.fasilitas-umum*') ? 'text-[#003366]' : 'text-[#737780]' }} transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-[10px] font-medium">Fasilitas</span>
        </a>

        {{-- Profil --}}
        <a href="{{ route('admin.profile.index') }}"
            class="flex flex-col items-center gap-0.5 px-3 py-1 {{ request()->routeIs('admin.profile*') ? 'text-[#003366]' : 'text-[#737780]' }} transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-[10px] font-medium">Profil</span>
        </a>
    </div>
</nav>
