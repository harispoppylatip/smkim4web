<nav
    class="md:hidden fixed bottom-0 w-full z-50 flex justify-around items-center h-16 px-sm bg-surface-container-lowest shadow-[0px_-4px_12px_rgba(0,51,102,0.08)] border-t border-outline-variant">

    {{-- Home --}}
    <a href="{{ route('home') }}"
        class="flex flex-col items-center justify-center focus:outline-none focus:ring-0 focus-visible:outline-none focus-visible:ring-0 active:outline-none active:ring-0 {{ $active === 'home' ? 'bg-secondary-container text-on-secondary-container rounded-xl px-4 py-1' : 'text-on-surface-variant hover:bg-surface-container-high active:bg-surface-container-high transition-colors' }}">
        <span
            class="material-symbols-outlined {{ $active === 'home' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">home</span>
        <span class="text-xs {{ $active === 'home' ? 'font-semibold' : 'font-semibold' }}">Beranda</span>
    </a>

    {{-- Contact --}}
    <a href="{{ route('contact') }}"
        class="flex flex-col items-center justify-center focus:outline-none focus:ring-0 focus-visible:outline-none focus-visible:ring-0 active:outline-none active:ring-0 {{ $active === 'contact' ? 'bg-secondary-container text-on-secondary-container rounded-xl px-4 py-1' : 'text-on-surface-variant hover:bg-surface-container-high active:bg-surface-container-high transition-colors' }}">
        <span
            class="material-symbols-outlined {{ $active === 'contact' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">contact_support</span>
        <span class="text-xs {{ $active === 'contact' ? 'font-semibold' : 'font-semibold' }}">Contact</span>
    </a>

    {{-- Berita --}}
    <a href="{{ route('berita') }}"
        class="flex flex-col items-center justify-center focus:outline-none focus:ring-0 focus-visible:outline-none focus-visible:ring-0 active:outline-none active:ring-0 {{ $active === 'berita' ? 'bg-secondary-container text-on-secondary-container rounded-xl px-4 py-1' : 'text-on-surface-variant hover:bg-surface-container-high active:bg-surface-container-high transition-colors' }}">
        <span
            class="material-symbols-outlined {{ $active === 'berita' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">feed</span>
        <span class="text-xs {{ $active === 'berita' ? 'font-semibold' : 'font-semibold' }}">Berita</span>
    </a>

    {{-- Jurusan --}}
    <a href="{{ route('program-keahlian') }}"
        class="flex flex-col items-center justify-center focus:outline-none focus:ring-0 focus-visible:outline-none focus-visible:ring-0 active:outline-none active:ring-0 {{ $active === 'jurusan' ? 'bg-secondary-container text-on-secondary-container rounded-xl px-4 py-1' : 'text-on-surface-variant hover:bg-surface-container-high active:bg-surface-container-high transition-colors' }}">
        <span
            class="material-symbols-outlined {{ $active === 'jurusan' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">account_balance</span>
        <span class="text-xs {{ $active === 'jurusan' ? 'font-semibold' : 'font-semibold' }}">Jurusan</span>
    </a>

    {{-- SPMB --}}
    <a href="{{ route('spmb') }}"
        class="flex flex-col items-center justify-center focus:outline-none focus:ring-0 focus-visible:outline-none focus-visible:ring-0 active:outline-none active:ring-0 {{ $active === 'spmb' ? 'bg-secondary-container text-on-secondary-container rounded-xl px-4 py-1' : 'text-on-surface-variant hover:bg-surface-container-high active:bg-surface-container-high transition-colors' }}">
        <span
            class="material-symbols-outlined {{ $active === 'spmb' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">school</span>
        <span class="text-xs {{ $active === 'spmb' ? 'font-semibold' : 'font-semibold' }}">SPMB</span>
    </a>

    {{-- Profil --}}
    <a href="{{ route('profile') }}"
        class="flex flex-col items-center justify-center focus:outline-none focus:ring-0 focus-visible:outline-none focus-visible:ring-0 active:outline-none active:ring-0 {{ $active === 'profil' ? 'bg-secondary-container text-on-secondary-container rounded-xl px-4 py-1' : 'text-on-surface-variant hover:bg-surface-container-high active:bg-surface-container-high transition-colors' }}">
        <span
            class="material-symbols-outlined {{ $active === 'profil' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">person</span>
        <span class="text-xs {{ $active === 'profil' ? 'font-semibold' : 'font-semibold' }}">Profil</span>
    </a>

</nav>
