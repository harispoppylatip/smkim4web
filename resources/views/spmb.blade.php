@extends('layouts.public')

@section('title', 'SPMB - SMKIM4')

@section('bottomNavActive', 'spmb')

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
                @if ($spmb && $spmb->whatsapp)
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

@endsection
