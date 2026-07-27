<aside class="fixed inset-y-0 left-0 z-30 hidden lg:flex lg:flex-col w-64 bg-[#001e40] text-white">
    {{-- Brand --}}
    <div class="flex items-center gap-3 px-6 h-16 border-b border-[#1f477b] shrink-0">
        <img src="{{ asset('gambar/logoim4.jpeg') }}" alt="Logo SMKIM4" class="w-9 h-9 rounded-lg object-cover">
        <div class="leading-tight">
            <p class="text-sm font-semibold text-white">SMKIM4</p>
            <p class="text-[10px] text-[#a7c8ff]">Muhammadiyah 4 Samarinda</p>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        {{-- Menu --}}
        <p class="px-3 text-[10px] font-semibold uppercase tracking-wider text-[#799dd6] mb-2">Menu</p>

        <x-navigation.nav-item href="{{ route('dashboard') }}" icon="home" :active="request()->routeIs('dashboard')">
            Beranda
        </x-navigation.nav-item>

        <x-navigation.nav-item href="{{ route('admin.berita.index') }}" icon="file-text" :active="request()->routeIs('admin.berita*')">
            Berita
        </x-navigation.nav-item>

        <x-navigation.nav-item href="{{ route('admin.program-keahlian.index') }}" icon="book-open" :active="request()->routeIs('admin.program-keahlian*')">
            Program Keahlian
        </x-navigation.nav-item>

        {{-- Divider --}}
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
                <p class="text-[11px] text-[#a7c8ff] truncate">
                    {{ auth()->user()->email ?? 'user@smkistiqomah.sch.id' }}
                </p>
            </div>
        </div>
        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-[#ff8a8a] hover:bg-[#1f477b] hover:text-red-300 transition-colors">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>
