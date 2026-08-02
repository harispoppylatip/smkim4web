@extends('layouts.public')

@section('title', 'Berita Terbaru - SMKIM4')

@section('bottomNavActive', 'berita')

@push('styles')
    <style>
        .card-shadow {
            box-shadow: 0px 4px 12px rgba(0, 51, 102, 0.08);
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@section('content')

    <main class="px-container-margin-mobile md:px-container-margin-desktop mt-lg max-w-7xl mx-auto">

        {{-- ==================== SECTION HEADER ==================== --}}
        <div class="mb-lg flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-xs">Berita Terbaru</h2>
                <div class="h-1 w-12 bg-secondary rounded-full"></div>
            </div>
            <div class="flex gap-sm mt-md md:mt-0 overflow-x-auto pb-sm" id="filter-container">
                <button data-kategori="Semua"
                    class="filter-chip px-4 py-2 rounded-full bg-primary text-on-primary font-body text-xs font-semibold cursor-pointer whitespace-nowrap transition-colors">Semua</button>
                @foreach ($programKeahlian as $pk)
                    <button data-kategori="{{ $pk->singkatan }}"
                        class="filter-chip px-4 py-2 rounded-full bg-surface-container-high text-on-surface-variant font-body text-xs cursor-pointer hover:bg-primary-container hover:text-on-primary-container transition-colors whitespace-nowrap">{{ $pk->singkatan }}</button>
                @endforeach
                @foreach ($kategoriBerita as $kb)
                    @if (!$programKeahlian->contains('singkatan', $kb))
                        <button data-kategori="{{ $kb }}"
                            class="filter-chip px-4 py-2 rounded-full bg-surface-container-high text-on-surface-variant font-body text-xs cursor-pointer hover:bg-primary-container hover:text-on-primary-container transition-colors whitespace-nowrap">{{ $kb }}</button>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- ==================== BENTO GRID BERITA ==================== --}}
        <div id="berita-grid" class="grid grid-cols-1 md:grid-cols-12 gap-4">

            @php $delays = [0.1, 0.2, 0.3, 0.4, 0.5, 0.6]; @endphp

            @foreach ($berita as $index => $item)
                @php
                    $delay = $delays[$index % count($delays)];
                    $warna = $item->warna;
                    $warnaBg = $item->warna_bg;
                    $warnaIcon = $item->warna_icon;
                    $isFirst = $index === 0;
                    $isSecond = $index === 1;
                    $isThird = $index === 2;
                @endphp

                {{-- Card 1: Hero landscape --}}
                @if ($isFirst)
                    <a href="{{ route('berita.detail', $item->slug) }}" data-kategori="{{ $item->kategori }}"
                        class="md:col-span-8 bg-surface-container-lowest rounded-xl overflow-hidden shadow-md border-t-4 border-{{ $warna }} flex flex-col fade-in group"
                        style="animation-delay: {{ $delay }}s;">
                        <div class="relative w-full h-56 md:h-[320px] overflow-hidden bg-surface-container-low">
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300"
                                    alt="{{ $item->judul }}">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-{{ $warnaBg }} to-transparent">
                                    <span
                                        class="material-symbols-outlined text-6xl text-{{ $warnaIcon }}">{{ $item->icon }}</span>
                                </div>
                            @endif
                            <span
                                class="absolute top-4 left-4 px-3 py-1 bg-{{ $warna }} text-on-primary rounded-full font-body text-xs font-semibold">{{ $item->kategori }}</span>
                        </div>
                        <div class="p-lg md:p-xl flex flex-col justify-between flex-1">
                            <div>
                                <p class="font-body text-xs text-outline mb-sm">{{ $item->tanggal }}</p>
                                <h3
                                    class="font-heading text-lg md:text-xl font-bold text-primary mb-md leading-tight group-hover:underline line-clamp-2">
                                    {{ $item->judul }}</h3>
                                <p class="font-body text-sm text-on-surface-variant line-clamp-3 mb-lg">
                                    {{ $item->deskripsi }}</p>
                            </div>
                            <span
                                class="group inline-flex items-center gap-xs font-body text-xs font-bold text-primary group-hover:gap-sm transition-all">
                                Baca Selengkapnya
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </span>
                        </div>
                    </a>

                    {{-- Card 2: DKV Card --}}
                @elseif ($isSecond)
                    <a href="{{ route('berita.detail', $item->slug) }}" data-kategori="{{ $item->kategori }}"
                        class="md:col-span-4 bg-surface-container-lowest rounded-xl overflow-hidden card-shadow border-t-4 border-{{ $warna }} flex flex-col fade-in group"
                        style="animation-delay: {{ $delay }}s;">
                        <div
                            class="relative h-48 flex items-center justify-center overflow-hidden
                            @if ($item->gambar) bg-surface-container-low
                            @else bg-gradient-to-br from-{{ $warnaBg }} to-transparent @endif">
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    alt="{{ $item->judul }}">
                            @else
                                <span
                                    class="material-symbols-outlined text-6xl text-{{ $warnaIcon }}">{{ $item->icon }}</span>
                            @endif
                            <span
                                class="absolute top-4 left-4 px-3 py-1 bg-{{ $warna }} text-on-primary rounded-full font-body text-xs font-semibold">{{ $item->kategori }}</span>
                        </div>
                        <div class="p-md flex flex-col flex-1">
                            <p class="font-body text-xs text-outline mb-xs">{{ $item->tanggal }}</p>
                            <h3
                                class="font-heading text-base font-bold text-primary mb-sm leading-snug group-hover:underline">
                                {{ $item->judul }}</h3>
                            <p class="font-body text-sm text-on-surface-variant line-clamp-2 mb-md">
                                {{ $item->deskripsi }}</p>
                            <div class="mt-auto">
                                <span
                                    class="block w-full py-sm bg-{{ $warna }}-container text-on-{{ $warna }}-container rounded-lg font-body text-xs font-bold text-center hover:bg-{{ $warna }} hover:text-on-{{ $warna }} transition-colors">Baca
                                    Selengkapnya</span>
                            </div>
                        </div>
                    </a>

                    {{-- Card 3: Horizontal --}}
                @elseif ($isThird)
                    <a href="{{ route('berita.detail', $item->slug) }}" data-kategori="{{ $item->kategori }}"
                        class="md:col-span-12 bg-surface-container-lowest rounded-xl overflow-hidden card-shadow border-t-4 border-{{ $warna }} flex flex-col md:flex-row fade-in group"
                        style="animation-delay: {{ $delay }}s;">
                        <div
                            class="md:w-1/3 h-48 md:h-auto flex items-center justify-center overflow-hidden
                            @if ($item->gambar) bg-surface-container-low
                            @else bg-gradient-to-br from-{{ $warnaBg }} to-transparent @endif">
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    alt="{{ $item->judul }}">
                            @else
                                <span
                                    class="material-symbols-outlined text-6xl text-{{ $warnaIcon }}">{{ $item->icon }}</span>
                            @endif
                        </div>
                        <div class="p-md md:p-lg flex-1 flex flex-col md:flex-row md:items-center justify-between gap-md">
                            <div class="md:max-w-2xl">
                                <div class="flex items-center gap-sm mb-xs">
                                    <span
                                        class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant rounded-full font-body text-xs">{{ $item->kategori }}</span>
                                    <span class="text-outline font-body text-xs">•</span>
                                    <span class="text-outline font-body text-xs">{{ $item->tanggal }}</span>
                                </div>
                                <h3 class="font-heading text-base font-bold text-primary mb-xs group-hover:underline">
                                    {{ $item->judul }}</h3>
                                <p class="font-body text-sm text-on-surface-variant">{{ $item->deskripsi }}</p>
                            </div>
                            <span
                                class="px-6 py-2 border-2 border-{{ $warna == 'outline' ? 'primary' : $warna }} text-{{ $warna == 'outline' ? 'primary' : $warna }} rounded-lg font-body text-xs font-bold hover:bg-{{ $warna == 'outline' ? 'primary' : $warna }} hover:text-on-{{ $warna == 'outline' ? 'primary' : $warna }} transition-colors whitespace-nowrap text-center">Baca
                                Selengkapnya</span>
                        </div>
                    </a>

                    {{-- Cards 4-6: Small cards --}}
                @else
                    <a href="{{ route('berita.detail', $item->slug) }}" data-kategori="{{ $item->kategori }}"
                        class="md:col-span-4 bg-surface-container-lowest rounded-xl overflow-hidden card-shadow border-t-4 border-{{ $warna }} flex flex-col fade-in group"
                        style="animation-delay: {{ $delay }}s;">
                        <div
                            class="relative h-48 flex items-center justify-center overflow-hidden
                            @if ($item->gambar) bg-surface-container-low
                            @else bg-gradient-to-br from-{{ $warnaBg }} to-transparent @endif">
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    alt="{{ $item->judul }}">
                            @else
                                <span
                                    class="material-symbols-outlined text-6xl text-{{ $warnaIcon }}">{{ $item->icon }}</span>
                            @endif
                            <span
                                class="absolute top-4 left-4 px-3 py-1 bg-{{ $warna == 'outline' ? 'surface-container-high' : $warna }} text-{{ $warna == 'outline' ? 'on-surface-variant' : 'on-primary' }} rounded-full font-body text-xs font-semibold">{{ $item->kategori }}</span>
                        </div>
                        <div class="p-md flex flex-col flex-1">
                            <p class="font-body text-xs text-outline mb-xs">{{ $item->tanggal }}</p>
                            <h3
                                class="font-heading text-base font-bold text-primary mb-sm leading-snug group-hover:underline">
                                {{ $item->judul }}</h3>
                            <p class="font-body text-sm text-on-surface-variant line-clamp-2 mb-md">
                                {{ $item->deskripsi }}</p>
                            <div class="mt-auto">
                                <span
                                    class="block w-full py-sm bg-{{ $warna == 'outline' ? 'surface-container-high' : $warna }} text-{{ $warna == 'outline' ? 'on-surface-variant' : 'on-primary' }} rounded-lg font-body text-xs font-bold text-center hover:bg-{{ $warna == 'outline' ? 'primary' : $warna }} hover:text-on-{{ $warna == 'outline' ? 'primary' : $warna }} transition-colors">Baca
                                    Selengkapnya</span>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach

        </div>

        {{-- ==================== EMPTY STATE ==================== --}}
        @php
            $kategoriAktif = request('kategori');
        @endphp
        <div id="empty-state"
            class="{{ $berita->isEmpty() ? '' : 'hidden' }} mt-xl flex flex-col items-center justify-center pb-8 text-center">
            <span class="material-symbols-outlined text-6xl text-outline mb-md">newspaper</span>
            <p class="font-body text-base text-on-surface-variant">
                @if ($kategoriAktif && $kategoriAktif !== 'Semua')
                    Belum ada berita di kategori {{ $kategoriAktif }}
                @else
                    Belum ada berita
                @endif
            </p>
        </div>

        {{-- ==================== PAGINATION ==================== --}}
        @if ($berita->hasPages())
            <div class="mt-xl flex justify-center" id="pagination-wrap">
                <nav class="flex items-center gap-2" aria-label="Navigasi halaman">
                    {{-- Previous --}}
                    @if ($berita->onFirstPage())
                        <span
                            class="px-3 py-2 rounded-lg bg-surface-container-high text-outline font-body text-sm cursor-not-allowed">
                            <span class="material-symbols-outlined text-sm align-middle">chevron_left</span>
                        </span>
                    @else
                        <a href="{{ $berita->previousPageUrl() }}"
                            class="px-3 py-2 rounded-lg bg-surface-container-high text-on-surface-variant font-body text-sm hover:bg-primary hover:text-on-primary transition-colors">
                            <span class="material-symbols-outlined text-sm align-middle">chevron_left</span>
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    @php
                        $currentPage = $berita->currentPage();
                        $lastPage = $berita->lastPage();
                        $start = max(1, $currentPage - 2);
                        $end = min($lastPage, $currentPage + 2);
                        if ($end - $start < 4) {
                            if ($start == 1) {
                                $end = min($lastPage, $start + 4);
                            } else {
                                $start = max(1, $end - 4);
                            }
                        }
                    @endphp

                    @if ($start > 1)
                        <a href="{{ $berita->url(1) }}"
                            class="px-3 py-2 rounded-lg bg-surface-container-high text-on-surface-variant font-body text-sm hover:bg-primary hover:text-on-primary transition-colors">1</a>
                        @if ($start > 2)
                            <span class="px-2 text-outline font-body text-sm">...</span>
                        @endif
                    @endif

                    @for ($i = $start; $i <= $end; $i++)
                        @if ($i == $currentPage)
                            <span
                                class="px-3 py-2 rounded-lg bg-primary text-on-primary font-body text-sm font-bold">{{ $i }}</span>
                        @else
                            <a href="{{ $berita->url($i) }}"
                                class="px-3 py-2 rounded-lg bg-surface-container-high text-on-surface-variant font-body text-sm hover:bg-primary hover:text-on-primary transition-colors">{{ $i }}</a>
                        @endif
                    @endfor

                    @if ($end < $lastPage)
                        @if ($end < $lastPage - 1)
                            <span class="px-2 text-outline font-body text-sm">...</span>
                        @endif
                        <a href="{{ $berita->url($lastPage) }}"
                            class="px-3 py-2 rounded-lg bg-surface-container-high text-on-surface-variant font-body text-sm hover:bg-primary hover:text-on-primary transition-colors">{{ $lastPage }}</a>
                    @endif

                    {{-- Next --}}
                    @if ($berita->hasMorePages())
                        <a href="{{ $berita->nextPageUrl() }}"
                            class="px-3 py-2 rounded-lg bg-surface-container-high text-on-surface-variant font-body text-sm hover:bg-primary hover:text-on-primary transition-colors">
                            <span class="material-symbols-outlined text-sm align-middle">chevron_right</span>
                        </a>
                    @else
                        <span
                            class="px-3 py-2 rounded-lg bg-surface-container-high text-outline font-body text-sm cursor-not-allowed">
                            <span class="material-symbols-outlined text-sm align-middle">chevron_right</span>
                        </span>
                    @endif
                </nav>
            </div>
        @endif

    </main>

    @push('scripts')
        <script>
            // Filter berita by kategori — reload page for server-side pagination
            document.addEventListener('DOMContentLoaded', function() {
                const filterChips = document.querySelectorAll('.filter-chip');

                // Set active chip from URL parameter
                const urlParams = new URLSearchParams(window.location.search);
                const activeKategori = urlParams.get('kategori') || 'Semua';
                filterChips.forEach(chip => {
                    if (chip.dataset.kategori === activeKategori) {
                        chip.classList.remove('bg-surface-container-high', 'text-on-surface-variant');
                        chip.classList.add('bg-primary', 'text-on-primary');
                    } else {
                        chip.classList.remove('bg-primary', 'text-on-primary');
                        chip.classList.add('bg-surface-container-high', 'text-on-surface-variant');
                    }
                });

                filterChips.forEach(chip => {
                    chip.addEventListener('click', function() {
                        const kategori = this.dataset.kategori;
                        const url = new URL(window.location.href);
                        if (kategori === 'Semua') {
                            url.searchParams.delete('kategori');
                        } else {
                            url.searchParams.set('kategori', kategori);
                        }
                        url.searchParams.delete('page'); // reset ke halaman 1
                        window.location.href = url.toString();
                    });
                });
            });

            // Micro-interaction for cards
            document.querySelectorAll('article, a[class*="card-shadow"]').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.classList.add('scale-[1.01]');
                    card.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                });
                card.addEventListener('mouseleave', () => {
                    card.classList.remove('scale-[1.01]');
                });
            });
        </script>
    @endpush

@endsection
