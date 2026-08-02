@extends('layouts.public')

@section('title', 'SPMB - SMKIM4')

@section('bottomNavActive', 'spmb')

@push('styles')
    <style>
        @keyframes modal-in {
            from {
                opacity: 0;
                transform: translateY(16px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-modal-in {
            animation: modal-in 0.22s ease-out;
        }
    </style>
@endpush

@section('content')

    @php
        $heroBackgroundUrl = !empty($pengaturanHome?->hero_background_foto)
            ? asset('storage/' . $pengaturanHome->hero_background_foto)
            : null;
    @endphp

    {{-- ==================== HERO SPMB ==================== --}}
    <section
        class="relative min-h-[400px] md:min-h-[500px] flex items-center justify-center overflow-hidden {{ $heroBackgroundUrl ? '' : 'bg-gradient-to-br from-primary via-primary-container to-primary' }}">
        @if ($heroBackgroundUrl)
            <div class="absolute inset-0">
                <img src="{{ $heroBackgroundUrl }}" class="w-full h-full object-cover" alt="Background SPMB">
                <div class="absolute inset-0 bg-gradient-to-br from-[rgba(0,30,64,0.58)] to-[rgba(0,30,64,0.50)]"></div>
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-transparent"></div>
        <div class="relative z-10 px-container-margin-mobile md:px-container-margin-desktop text-center max-w-4xl mx-auto">
            <span
                class="inline-block bg-secondary-container text-on-secondary-container px-md py-xs rounded-full text-xs font-semibold mb-md">
                Penerimaan Siswa Baru {{ $spmb->tahun ?? '2025/2026' }}
            </span>
            <h1 class="font-heading text-3xl md:text-5xl font-bold text-on-primary mb-md leading-tight">
                Selamat Datang di <span class="text-secondary-fixed">SPMB</span>
            </h1>
            <p class="font-body text-base md:text-lg text-on-primary/80 mb-xl max-w-2xl mx-auto">
                Bergabunglah bersama SMK Istiqomah Muhammadiyah 4 Samarinda. Wujudkan masa depanmu dengan pendidikan
                berkualitas berbasis teknologi dan iman.
            </p>
            <div class="flex flex-col sm:flex-row gap-md justify-center">
                {{-- <a href="#info"
                    class="bg-secondary-container text-on-secondary-container px-xl py-md rounded-lg font-heading text-lg shadow-lg hover:scale-105 transition-transform">
                    Informasi Pendaftaran
                </a> --}}
                <a href="#download"
                    class="border-2 border-on-primary text-on-primary px-xl py-md rounded-lg font-heading text-lg hover:bg-white/10 transition-colors">
                    Download Brosur
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-surface to-transparent"></div>
    </section>

    {{-- ==================== INFO PENDAFTARAN ==================== --}}
    <section id="info" class="py-xl px-container-margin-mobile md:px-container-margin-desktop">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-xl">
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-xs">Informasi Pendaftaran</h2>
                <div class="w-20 h-1 bg-secondary-container mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-lg mb-xl">
                {{-- Card 1 --}}
                <div class="bg-surface-container-lowest rounded-xl p-lg shadow-lg text-center">
                    <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-md">
                        <span class="material-symbols-outlined text-primary text-3xl">description</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-primary mb-sm">1. Isi Formulir</h3>
                    <p class="font-body text-sm text-on-surface-variant">Lengkapi data diri dan pilih program keahlian yang
                        kamu minati.</p>
                </div>

                {{-- Card 2 --}}
                <div class="bg-surface-container-lowest rounded-xl p-lg shadow-lg text-center">
                    <div
                        class="w-16 h-16 rounded-full bg-secondary-container/20 flex items-center justify-center mx-auto mb-md">
                        <span class="material-symbols-outlined text-secondary text-3xl">folder</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-secondary mb-sm">2. Kumpulkan Berkas</h3>
                    <p class="font-body text-sm text-on-surface-variant">Serahkan berkas persyaratan yang sudah ditentukan
                        panitia.</p>
                </div>

                {{-- Card 3 --}}
                <div class="bg-surface-container-lowest rounded-xl p-lg shadow-lg text-center">
                    <div
                        class="w-16 h-16 rounded-full bg-tertiary-container/20 flex items-center justify-center mx-auto mb-md">
                        <span class="material-symbols-outlined text-tertiary text-3xl">celebration</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-tertiary mb-sm">3. Daftar Ulang</h3>
                    <p class="font-body text-sm text-on-surface-variant">Lakukan daftar ulang dan siap menjadi bagian dari
                        SMKIM4.</p>
                </div>
            </div>

            {{-- Persyaratan --}}
            <div class="bg-surface-container-lowest rounded-xl p-lg md:p-xl shadow-lg">
                <h3 class="font-heading text-xl font-bold text-primary mb-lg flex items-center gap-sm">
                    <span class="material-symbols-outlined text-primary">checklist</span>
                    Persyaratan Pendaftaran
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    @php
                        $persyaratan = $spmb->persyaratan ?? [];
                    @endphp
                    @forelse ($persyaratan as $syarat)
                        <div class="flex items-start gap-sm">
                            <span class="material-symbols-outlined text-sm text-secondary mt-0.5">check_circle</span>
                            <span class="font-body text-sm text-on-surface-variant">{{ $syarat }}</span>
                        </div>
                    @empty
                        <div class="col-span-2 text-center text-on-surface-variant font-body text-sm">
                            Belum ada persyaratan yang ditetapkan.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== PROGRAM KEAHLIAN ==================== --}}
    <section class="py-xl px-container-margin-mobile md:px-container-margin-desktop bg-surface-container-lowest">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-xl">
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-xs">Program Keahlian</h2>
                <div class="w-20 h-1 bg-secondary-container mx-auto rounded-full"></div>
                <p class="font-body text-sm text-on-surface-variant mt-md max-w-xl mx-auto">
                    Pilih program keahlian yang sesuai dengan minat dan bakatmu
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($programKeahlian as $prog)
                    <div
                        class="bg-white rounded-xl border-2 border-outline-variant p-md flex flex-col items-center text-center hover:border-primary hover:-translate-y-1 hover:shadow-lg transition-all">
                        <h4 class="font-heading text-xs md:text-sm font-bold text-primary leading-snug">{{ $prog->nama }}
                        </h4>
                        <span class="text-xs text-outline mt-xs">{{ $prog->singkatan }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== FASILITAS & UNGGULAN ==================== --}}
    <section class="py-xl px-container-margin-mobile md:px-container-margin-desktop bg-surface">
        <div class="max-w-5xl mx-auto">
            {{-- Fasilitas --}}
            <div class="text-center mb-lg">
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-xs">Fasilitas</h2>
                <div class="w-20 h-1 bg-secondary-container mx-auto rounded-full"></div>
                <p class="font-body text-sm text-on-surface-variant mt-md max-w-xl mx-auto">
                    Fasilitas modern untuk mendukung proses belajar mengajar
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-xl">
                @foreach ($fasilitas as $f)
                    <div
                        class="bg-white rounded-xl border border-outline-variant p-md flex items-center gap-md hover:border-primary hover:shadow-md transition-all">
                        <span class="material-symbols-outlined text-primary text-xl">{{ $f->icon ?? 'check_circle' }}</span>
                        <span class="font-body text-xs md:text-sm font-semibold text-primary">{{ $f->nama }}</span>
                    </div>
                @endforeach
            </div>

            {{-- Unggulan --}}
            <div class="text-center mb-lg">
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-xs">Program Kegiatan Keunggulan</h2>
                <div class="w-20 h-1 bg-secondary-container mx-auto rounded-full"></div>
                <p class="font-body text-sm text-on-surface-variant mt-md max-w-xl mx-auto">
                    Program unggulan dan kegiatan khas SMK Istiqomah Muhammadiyah 4 Samarinda
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($unggulan as $u)
                    <div
                        class="bg-white rounded-xl border border-outline-variant p-md flex items-center gap-md hover:border-secondary hover:shadow-md transition-all">
                        <span class="material-symbols-outlined text-secondary text-xl">{{ $u->icon ?? 'stars' }}</span>
                        <span class="font-body text-xs md:text-sm font-semibold text-primary">{{ $u->nama }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== EKSTRAKURIKULER ==================== --}}
    <section class="py-xl px-container-margin-mobile md:px-container-margin-desktop bg-surface">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-xl">
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-xs">Ekstrakurikuler</h2>
                <div class="w-20 h-1 bg-secondary-container mx-auto rounded-full"></div>
                <p class="font-body text-sm text-on-surface-variant mt-md max-w-xl mx-auto">
                    Kegiatan ekstrakurikuler untuk mengembangkan minat dan bakat siswa
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @php
                    $ekstrakurikuler = $spmb->ekstrakurikuler ?? [];
                @endphp
                @forelse ($ekstrakurikuler as $ekskul)
                    <div
                        class="bg-white rounded-xl border-2 border-outline-variant p-md flex flex-col items-center text-center hover:border-secondary hover:-translate-y-1 hover:shadow-lg transition-all">
                        <span class="material-symbols-outlined text-secondary text-3xl mb-sm">stars</span>
                        <h4 class="font-heading text-xs md:text-sm font-bold text-primary leading-snug">{{ $ekskul }}
                        </h4>
                    </div>
                @empty
                    <div class="col-span-full text-center text-on-surface-variant font-body text-sm">
                        Belum ada data ekstrakurikuler.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ==================== DOWNLOAD BROSUR ==================== --}}
    <section id="download"
        class="py-xl px-container-margin-mobile md:px-container-margin-desktop bg-surface-container-low">
        <div class="max-w-4xl mx-auto text-center">
            <div class="mb-xl">
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-xs">Download Brosur</h2>
                <div class="w-20 h-1 bg-secondary-container mx-auto rounded-full"></div>
            </div>
            <p class="font-body text-base md:text-lg text-on-surface font-semibold mb-xl max-w-2xl mx-auto">
                Ingin tahu lebih banyak tentang SMK Istiqomah Muhammadiyah 4 Samarinda? Download brosur berikut untuk
                informasi lengkap mengenai program keahlian, fasilitas, dan prestasi kami.
            </p>
            <div class="flex flex-col sm:flex-row gap-md justify-center">
                @if ($spmb && $spmb->brosur)
                    <a href="{{ asset('storage/' . $spmb->brosur) }}" target="_blank"
                        class="inline-flex items-center gap-sm bg-primary text-on-primary px-xl py-md rounded-lg font-heading text-lg shadow-lg hover:scale-105 transition-transform font-bold">
                        <span class="material-symbols-outlined">download</span>
                        Download Brosur PDF
                    </a>
                @else
                    <span
                        class="inline-flex items-center gap-sm bg-primary/50 text-on-primary px-xl py-md rounded-lg font-heading text-lg cursor-not-allowed font-bold">
                        <span class="material-symbols-outlined">download</span>
                        Brosur Belum Tersedia
                    </span>
                @endif
                @if ($kontakSpmb->count() === 1)
                    {{-- Hanya 1 kontak aktif: langsung ke media sosial --}}
                    @php
                        $satuKontak = $kontakSpmb->first();
                    @endphp
                    <a href="{{ $satuKontak->url() }}" target="_blank" rel="noopener"
                        class="inline-flex items-center gap-sm bg-white text-primary px-xl py-md rounded-lg font-heading text-lg shadow-lg border-2 border-primary hover:bg-primary hover:text-on-primary transition-colors font-bold">
                        <span class="material-symbols-outlined">{{ $satuKontak->iconName() }}</span>
                        Hubungi Kami
                    </a>
                @elseif ($kontakSpmb->count() > 1)
                    {{-- Lebih dari 1 kontak aktif: buka popup pilihan --}}
                    <button type="button" onclick="document.getElementById('modal-kontak').classList.remove('hidden')"
                        class="inline-flex items-center gap-sm bg-white text-primary px-xl py-md rounded-lg font-heading text-lg shadow-lg border-2 border-primary hover:bg-primary hover:text-on-primary transition-colors font-bold">
                        <span class="material-symbols-outlined">chat</span>
                        Hubungi Kami
                    </button>
                @elseif ($spmb && $spmb->whatsapp)
                    <a href="https://wa.me/{{ $spmb->whatsapp }}" target="_blank"
                        class="inline-flex items-center gap-sm bg-white text-primary px-xl py-md rounded-lg font-heading text-lg shadow-lg border-2 border-primary hover:bg-primary hover:text-on-primary transition-colors font-bold">
                        <span class="material-symbols-outlined">chat</span>
                        Hubungi Kami
                    </a>
                @else
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center gap-sm bg-white text-primary px-xl py-md rounded-lg font-heading text-lg shadow-lg border-2 border-primary hover:bg-primary hover:text-on-primary transition-colors font-bold">
                        <span class="material-symbols-outlined">call</span>
                        Hubungi Kami
                    </a>
                @endif
            </div>
            <p class="font-body text-xs text-outline mt-lg">
                *Brosur dalam format PDF. Jika mengalami kendala, silakan hubungi panitia.
            </p>
        </div>
    </section>

    {{-- ==================== MODAL HUBUNGI KAMI ==================== --}}
    @if ($kontakSpmb->count() > 1)
        <div id="modal-kontak"
            class="hidden fixed inset-0 z-[60] flex items-end sm:items-center justify-center p-4 sm:p-6" role="dialog"
            aria-modal="true" aria-label="Pilih kontak yang ingin dihubungi">
            {{-- Backdrop --}}
            <div id="modal-kontak-backdrop" class="absolute inset-0 bg-primary/45 backdrop-blur-sm transition-opacity">
            </div>

            {{-- Card --}}
            <div
                class="relative w-full max-w-md bg-surface-container-lowest rounded-3xl shadow-[0_8px_24px_rgba(0,51,102,0.12)] overflow-hidden animate-modal-in">
                {{-- Header --}}
                <div class="flex items-start justify-between px-md md:px-lg pt-md md:pt-lg pb-sm">
                    <div>
                        <h3 class="font-heading text-lg md:text-xl font-bold text-primary">Hubungi Kami</h3>
                        <p class="font-body text-xs md:text-sm text-on-surface-variant mt-xs">
                            Pilih admin yang ingin kamu hubungi:
                        </p>
                    </div>
                    <button type="button" onclick="closeModalKontak()"
                        class="p-2 -m-1 rounded-full text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors"
                        aria-label="Tutup">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                {{-- Daftar kontak --}}
                <div class="px-md md:px-lg pb-md md:pb-lg space-y-sm max-h-[60vh] overflow-y-auto">
                    @foreach ($kontakSpmb as $kontak)
                        <a href="{{ $kontak->url() }}" target="_blank" rel="noopener"
                            class="flex items-center gap-md rounded-2xl border border-outline-variant/40 bg-white p-3.5 hover:border-primary hover:bg-primary/5 hover:shadow-[0_4px_12px_rgba(0,51,102,0.08)] transition-all">
                            <div class="w-11 h-11 shrink-0 rounded-xl bg-primary/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary">{{ $kontak->iconName() }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-heading text-sm font-bold text-primary truncate">{{ $kontak->nama }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $kontak->jenisLabel() }}</p>
                            </div>
                            <span class="material-symbols-outlined text-outline text-lg shrink-0">open_in_new</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                function closeModalKontak() {
                    document.getElementById('modal-kontak').classList.add('hidden');
                }
                document.getElementById('modal-kontak-backdrop').addEventListener('click', closeModalKontak);
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') closeModalKontak();
                });
            </script>
        @endpush
    @endif

@endsection
