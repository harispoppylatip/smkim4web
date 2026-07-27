<nav
    class="md:hidden fixed bottom-0 w-full z-50 flex justify-around items-center h-16 px-sm bg-surface-container-lowest shadow-lg border-t border-outline-variant">

    {{-- Home --}}
    <a href="{{ route('home') }}"
        class="flex flex-col items-center justify-center {{ $active === 'home' ? 'bg-secondary-container text-on-secondary-container rounded-xl px-4 py-1 transition-transform scale-95' : 'text-on-surface-variant hover:bg-surface-container-high transition-colors' }}">
        <span
            class="material-symbols-outlined {{ $active === 'home' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">home</span>
        <span class="text-xs {{ $active === 'home' ? 'font-semibold' : 'font-semibold' }}">Beranda</span>
    </a>

    {{-- Contact --}}
    <a href="{{ route('contact') }}"
        class="flex flex-col items-center justify-center {{ $active === 'contact' ? 'bg-secondary-container text-on-secondary-container rounded-xl px-4 py-1 transition-transform scale-95' : 'text-on-surface-variant hover:bg-surface-container-high transition-colors' }}">
        <span
            class="material-symbols-outlined {{ $active === 'contact' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">contact_support</span>
        <span class="text-xs {{ $active === 'contact' ? 'font-semibold' : 'font-semibold' }}">Contact</span>
    </a>

    {{-- Berita --}}
    <a href="{{ route('berita') }}"
        class="flex flex-col items-center justify-center {{ $active === 'berita' ? 'bg-secondary-container text-on-secondary-container rounded-xl px-4 py-1 transition-transform scale-95' : 'text-on-surface-variant hover:bg-surface-container-high transition-colors' }}">
        <span
            class="material-symbols-outlined {{ $active === 'berita' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">feed</span>
        <span class="text-xs {{ $active === 'berita' ? 'font-semibold' : 'font-semibold' }}">Berita</span>
    </a>

    {{-- Jurusan --}}
    <a href="{{ route('program-keahlian') }}"
        class="flex flex-col items-center justify-center {{ $active === 'jurusan' ? 'bg-secondary-container text-on-secondary-container rounded-xl px-4 py-1 transition-transform scale-95' : 'text-on-surface-variant hover:bg-surface-container-high transition-colors' }}">
        <span
            class="material-symbols-outlined {{ $active === 'jurusan' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">account_balance</span>
        <span class="text-xs {{ $active === 'jurusan' ? 'font-semibold' : 'font-semibold' }}">Jurusan</span>
    </a>

    {{-- SPMB --}}
    <a href="{{ route('spmb') }}"
        class="flex flex-col items-center justify-center {{ $active === 'spmb' ? 'bg-secondary-container text-on-secondary-container rounded-xl px-4 py-1 transition-transform scale-95' : 'text-on-surface-variant hover:bg-surface-container-high transition-colors' }}">
        <span
            class="material-symbols-outlined {{ $active === 'spmb' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">school</span>
        <span class="text-xs {{ $active === 'spmb' ? 'font-semibold' : 'font-semibold' }}">SPMB</span>
    </a>

    {{-- Profil --}}
    <a href="{{ route('profile') }}"
        class="flex flex-col items-center justify-center {{ $active === 'profil' ? 'bg-secondary-container text-on-secondary-container rounded-xl px-4 py-1 transition-transform scale-95' : 'text-on-surface-variant hover:bg-surface-container-high transition-colors' }}">
        <span
            class="material-symbols-outlined {{ $active === 'profil' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">person</span>
        <span class="text-xs {{ $active === 'profil' ? 'font-semibold' : 'font-semibold' }}">Profil</span>
    </a>

</nav>
