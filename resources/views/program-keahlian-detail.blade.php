@extends('layouts.public')

@section('title', $program->nama . ' - SMKIM4')

@section('bottomNavActive', 'jurusan')

@push('styles')
    <style>
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

        .card-shadow {
            box-shadow: 0px 4px 12px rgba(0, 51, 102, 0.08);
        }

        .prose-program h3 {
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }

        .prose-program p {
            margin-bottom: 1rem;
            line-height: 1.75;
        }

        .prose-program ul {
            margin-bottom: 1rem;
        }

        .prose-program li {
            margin-bottom: 0.25rem;
        }

        .sticky-nav {
            position: sticky;
            top: 80px;
            z-index: 20;
        }
    </style>
@endpush

@section('content')

    @php
        // Color mapping for jurusan themes (matches Tailwind config in public.blade.php)
        $colorMap = [
            'primary' => '#001e40',
            'primary-container' => '#003366',
            'secondary' => '#705d00',
            'secondary-container' => '#fcd400',
            'tertiary' => '#001d44',
            'tertiary-container' => '#00316c',
            'error' => '#ba1a1a',
            'error-container' => '#ffdad6',
        ];

        function getColorHex($colorName, $colorMap)
        {
            $parts = explode('/', $colorName);
            $base = $parts[0] ?? 'primary';
            $opacity = $parts[1] ?? null;
            $hex = $colorMap[$base] ?? '#001e40';
            if ($opacity !== null) {
                $opacityVal = (int) $opacity / 100;
                $r = hexdec(substr($hex, 1, 2));
                $g = hexdec(substr($hex, 3, 2));
                $b = hexdec(substr($hex, 5, 2));
                return "rgba({$r}, {$g}, {$b}, {$opacityVal})";
            }
            return $hex;
        }

        $warnaHex = getColorHex($program->warna, $colorMap);
        $warnaContainerBgHex = getColorHex($program->warna_container_bg, $colorMap);
    @endphp

    @php
        $heroBgUrl = $program->hero_background_foto ? asset('storage/' . $program->hero_background_foto) : null;
    @endphp

    {{-- ==================== HERO SECTION ==================== --}}
    <section class="relative overflow-hidden"
        @if ($heroBgUrl) style="background-image: linear-gradient(rgba(0, 30, 64, 0.58), rgba(0, 30, 64, 0.50)), url('{{ $heroBgUrl }}'); background-size: cover; background-position: center;"
        @else
            style="background: linear-gradient(to bottom right, {{ $warnaHex }}, {{ $warnaHex }});" @endif>
        @if (!$heroBgUrl)
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-72 h-72 bg-secondary rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
            </div>
        @endif
        <div class="relative px-container-margin-mobile md:px-container-margin-desktop py-xl md:py-20">
            <div class="max-w-7xl mx-auto">
                {{-- Breadcrumb --}}
                <nav class="flex items-center gap-xs text-sm text-on-primary/70 mb-lg fade-in" style="animation-delay: 0s;">
                    <a href="{{ route('home') }}" class="hover:text-on-primary transition-colors">Home</a>
                    <span class="material-symbols-outlined text-base">chevron_right</span>
                    <a href="{{ route('home') }}#departments" class="hover:text-on-primary transition-colors">Program
                        Keahlian</a>
                    <span class="material-symbols-outlined text-base">chevron_right</span>
                    <span class="text-on-primary font-semibold">{{ $program->singkatan }}</span>
                </nav>

                <div class="flex flex-col md:flex-row items-center gap-lg mt-lg">
                    <div class="text-center md:text-left fade-in" style="animation-delay: 0.2s;">
                        <span
                            class="inline-block px-4 py-1 bg-white/10 text-on-primary rounded-full text-xs font-semibold mb-md backdrop-blur-sm">
                            {{ $program->singkatan }}
                        </span>
                        <h1 class="font-heading text-3xl md:text-5xl font-bold text-on-primary mb-md leading-tight">
                            {{ $program->nama }}
                        </h1>
                        <p class="font-body text-base md:text-lg text-on-primary/80 max-w-2xl">
                            {{ $program->deskripsi_singkat }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== STICKY NAV (Anchor Links) ==================== --}}
    <div class="sticky-nav bg-surface/95 backdrop-blur-sm border-b border-outline-variant">
        <div class="px-container-margin-mobile md:px-container-margin-desktop max-w-7xl mx-auto">
            <div class="flex gap-md md:gap-lg overflow-x-auto py-md scrollbar-hide">
                <a href="#tentang"
                    class="whitespace-nowrap text-xs font-semibold text-on-surface-variant hover:text-primary transition-colors flex items-center gap-xs">
                    <span class="material-symbols-outlined text-sm">info</span>
                    Tentang
                </a>
                <a href="#kompetensi"
                    class="whitespace-nowrap text-xs font-semibold text-on-surface-variant hover:text-primary transition-colors flex items-center gap-xs">
                    <span class="material-symbols-outlined text-sm">checklist</span>
                    Kompetensi
                </a>
                <a href="#kurikulum"
                    class="whitespace-nowrap text-xs font-semibold text-on-surface-variant hover:text-primary transition-colors flex items-center gap-xs">
                    <span class="material-symbols-outlined text-sm">menu_book</span>
                    Kurikulum
                </a>
                <a href="#prestasi"
                    class="whitespace-nowrap text-xs font-semibold text-on-surface-variant hover:text-primary transition-colors flex items-center gap-xs">
                    <span class="material-symbols-outlined text-sm">emoji_events</span>
                    Prestasi
                </a>
                <a href="#sertifikat"
                    class="whitespace-nowrap text-xs font-semibold text-on-surface-variant hover:text-primary transition-colors flex items-center gap-xs">
                    <span class="material-symbols-outlined text-sm">verified</span>
                    Sertifikat
                </a>
                <a href="#guru"
                    class="whitespace-nowrap text-xs font-semibold text-on-surface-variant hover:text-primary transition-colors flex items-center gap-xs">
                    <span class="material-symbols-outlined text-sm">school</span>
                    Pengajar
                </a>
                <a href="#fasilitas"
                    class="whitespace-nowrap text-xs font-semibold text-on-surface-variant hover:text-primary transition-colors flex items-center gap-xs">
                    <span class="material-symbols-outlined text-sm">business</span>
                    Fasilitas
                </a>
                <a href="#karir"
                    class="whitespace-nowrap text-xs font-semibold text-on-surface-variant hover:text-primary transition-colors flex items-center gap-xs">
                    <span class="material-symbols-outlined text-sm">work</span>
                    Peluang Karir
                </a>
            </div>
        </div>
    </div>

    <div class="px-container-margin-mobile md:px-container-margin-desktop py-xl max-w-7xl mx-auto">

        {{-- ==================== TENTANG ==================== --}}
        <section id="tentang" class="scroll-mt-24 mb-xl fade-in">
            <div class="flex flex-col md:flex-row gap-lg items-start">
                <div class="md:w-1/2">
                    <span class="text-xs font-semibold uppercase tracking-widest"
                        style="color: {{ $warnaHex }};">Tentang</span>
                    <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mt-sm mb-md">
                        {{ $program->singkatan }}
                    </h2>
                    <div class="h-1 w-12 rounded-full mb-md" style="background-color: {{ $warnaHex }};"></div>
                    <div class="prose-program text-on-surface-variant font-body text-sm md:text-base leading-relaxed">
                        {!! $program->deskripsi !!}
                    </div>
                </div>
                <div class="md:w-1/2">
                    @if ($program->gambar)
                        <div class="w-full aspect-video rounded-xl overflow-hidden card-shadow">
                            <img src="{{ asset('storage/' . $program->gambar) }}" alt="{{ $program->nama }}"
                                class="w-full h-full object-cover">
                        </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- ==================== KOMPETENSI ==================== --}}
        <section id="kompetensi" class="scroll-mt-24 mb-xl bg-surface-container-low rounded-xl p-lg md:p-xl fade-in">
            <div class="text-center mb-lg">
                <span class="text-xs font-semibold uppercase tracking-widest"
                    style="color: {{ $warnaHex }};">Keahlian</span>
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mt-sm">Kompetensi Keahlian</h2>
                <div class="h-1 w-12 rounded-full mx-auto mt-md" style="background-color: {{ $warnaHex }};"></div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($program->kompetensi as $kompetensi)
                    <div class="bg-surface-container-lowest rounded-xl p-md card-shadow flex items-center gap-sm hover:-translate-y-1 transition-transform fade-in"
                        style="animation-delay: {{ $loop->iteration * 0.05 }}s;">
                        <span class="material-symbols-outlined text-xl"
                            style="color: {{ $warnaHex }};">check_circle</span>
                        <span
                            class="font-body text-xs md:text-sm font-semibold text-on-surface">{{ $kompetensi->nama }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ==================== KURIKULUM ==================== --}}
        <section id="kurikulum" class="scroll-mt-24 mb-xl fade-in">
            <div class="text-center mb-lg">
                <span class="text-xs font-semibold uppercase tracking-widest"
                    style="color: {{ $warnaHex }};">Kurikulum</span>
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mt-sm">Mata Pelajaran Unggulan</h2>
                <div class="h-1 w-12 rounded-full mx-auto mt-md" style="background-color: {{ $warnaHex }};"></div>
                <p class="font-body text-sm text-on-surface-variant mt-md max-w-2xl mx-auto">
                    Kurikulum kami dirancang sesuai standar industri dan perkembangan teknologi terkini. Berikut adalah
                    mata pelajaran unggulan yang diajarkan:
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 max-w-5xl mx-auto">
                @foreach ($program->mataPelajaran as $mapel)
                    <div class="flex items-center gap-sm bg-surface-container-lowest rounded-lg p-md card-shadow hover:-translate-y-1 transition-transform fade-in"
                        style="animation-delay: {{ $loop->iteration * 0.05 }}s;">
                        <span class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                            style="background-color: {{ $warnaContainerBgHex }};">
                            <span class="material-symbols-outlined text-sm"
                                style="color: {{ $warnaHex }};">book</span>
                        </span>
                        <span class="font-body text-sm text-on-surface">{{ $mapel->nama }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ==================== PRESTASI ==================== --}}
        <section id="prestasi" class="scroll-mt-24 mb-xl fade-in">
            <div class="text-center mb-lg">
                <span class="text-xs font-semibold uppercase tracking-widest"
                    style="color: {{ $warnaHex }};">Prestasi</span>
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mt-sm">Prestasi Siswa</h2>
                <div class="h-1 w-12 rounded-full mx-auto mt-md" style="background-color: {{ $warnaHex }};"></div>
                <p class="font-body text-sm text-on-surface-variant mt-md max-w-2xl mx-auto">
                    Berbagai prestasi telah diraih oleh siswa {{ $program->singkatan }} di tingkat provinsi, nasional,
                    dan internasional.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($program->prestasi as $prestasi)
                    <div class="bg-surface-container-lowest rounded-2xl overflow-hidden card-shadow hover:-translate-y-1 transition-transform fade-in group"
                        style="border-top: 4px solid {{ $warnaHex }};"
                        style="animation-delay: {{ $loop->iteration * 0.1 }}s;">
                        @if ($prestasi->gambar)
                            <x-media-card-image src="{{ asset('storage/' . $prestasi->gambar) }}"
                                alt="{{ $prestasi->judul }}"
                                containerClass="w-full h-48" />
                        @endif
                        <div class="p-lg">
                            <div class="flex items-center justify-between mb-md">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                                    style="background-color: {{ $warnaContainerBgHex }};">
                                    <span class="material-symbols-outlined text-2xl"
                                        style="color: {{ $warnaHex }};">{{ $prestasi->icon ?: 'emoji_events' }}</span>
                                </div>
                                <span class="text-xs font-bold px-md py-xs rounded-full"
                                    style="color: {{ $warnaHex }}; background-color: {{ $warnaContainerBgHex }};">
                                    {{ $prestasi->tahun }}
                                </span>
                            </div>
                            <h4 class="font-heading text-sm font-bold text-primary mb-sm">{{ $prestasi->judul }}</h4>
                            <p class="font-body text-xs text-on-surface-variant">{{ $prestasi->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ==================== SERTIFIKAT ==================== --}}
        <section id="sertifikat" class="scroll-mt-24 mb-xl bg-surface-container-low rounded-xl p-lg md:p-xl fade-in">
            <div class="text-center mb-lg">
                <span class="text-xs font-semibold uppercase tracking-widest"
                    style="color: {{ $warnaHex }};">Sertifikasi</span>
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mt-sm">Sertifikat Kompetensi</h2>
                <div class="h-1 w-12 rounded-full mx-auto mt-md" style="background-color: {{ $warnaHex }};"></div>
                <p class="font-body text-sm text-on-surface-variant mt-md max-w-2xl mx-auto">
                    Siswa {{ $program->singkatan }} berkesempatan meraih sertifikasi yang diakui secara nasional dan
                    internasional.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($program->sertifikat as $sertifikat)
                    <div class="bg-surface-container-lowest rounded-xl p-lg card-shadow text-center hover:-translate-y-1 transition-transform fade-in"
                        style="animation-delay: {{ $loop->iteration * 0.1 }}s;">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-md"
                            style="background-color: {{ $warnaContainerBgHex }};">
                            <span class="material-symbols-outlined text-3xl"
                                style="color: {{ $warnaHex }};">{{ $sertifikat->icon }}</span>
                        </div>
                        <h4 class="font-heading text-sm font-bold text-primary mb-xs">{{ $sertifikat->nama }}</h4>
                        <span class="text-xs font-semibold mb-sm block"
                            style="color: {{ $warnaHex }};">{{ $sertifikat->penyelenggara }}</span>
                        <p class="font-body text-xs text-on-surface-variant">{{ $sertifikat->deskripsi }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ==================== GURU / PENGAJAR ==================== --}}
        <section id="guru" class="scroll-mt-24 mb-xl fade-in">
            <div class="text-center mb-lg">
                <span class="text-xs font-semibold uppercase tracking-widest"
                    style="color: {{ $warnaHex }};">Pengajar</span>
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mt-sm">Tim Pengajar</h2>
                <div class="h-1 w-12 rounded-full mx-auto mt-md" style="background-color: {{ $warnaHex }};"></div>
                <p class="font-body text-sm text-on-surface-variant mt-md max-w-2xl mx-auto">
                    Tenaga pengajar yang kompeten dan berpengalaman di bidangnya masing-masing.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($program->guru as $guru)
                    <div class="bg-surface-container-lowest rounded-xl p-lg card-shadow text-center hover:-translate-y-1 transition-transform fade-in"
                        style="animation-delay: {{ $loop->iteration * 0.1 }}s;">
                        <div class="w-16 h-16 rounded-full mx-auto mb-md overflow-hidden flex items-center justify-center"
                            style="background-color: {{ $warnaContainerBgHex }};">
                            @if ($guru->foto)
                                <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama }}"
                                    class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-3xl"
                                    style="color: {{ $warnaHex }};">person</span>
                            @endif
                        </div>
                        <h4 class="font-heading text-sm font-bold text-primary">{{ $guru->nama }}</h4>
                        <p class="font-body text-xs text-on-surface-variant mt-xs">{{ $guru->bidang }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ==================== FASILITAS ==================== --}}
        <section id="fasilitas" class="scroll-mt-24 mb-xl bg-surface-container-low rounded-xl p-lg md:p-xl fade-in">
            <div class="text-center mb-lg">
                <span class="text-xs font-semibold uppercase tracking-widest"
                    style="color: {{ $warnaHex }};">Fasilitas</span>
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mt-sm">Fasilitas
                    {{ $program->singkatan }}</h2>
                <div class="h-1 w-12 rounded-full mx-auto mt-md" style="background-color: {{ $warnaHex }};"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($program->fasilitas as $fasilitas)
                    <div class="bg-surface-container-lowest rounded-2xl overflow-hidden card-shadow hover:-translate-y-1 transition-transform fade-in group"
                        style="animation-delay: {{ $loop->iteration * 0.1 }}s;">
                        @if ($fasilitas->gambar)
                            <img src="{{ asset('storage/' . $fasilitas->gambar) }}" class="w-full h-44 object-cover"
                                alt="{{ $fasilitas->nama }}">
                        @endif
                        <div class="p-lg flex items-start gap-md">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                                style="background-color: {{ $warnaContainerBgHex }};">
                                <span class="material-symbols-outlined text-2xl"
                                    style="color: {{ $warnaHex }};">{{ $fasilitas->icon }}</span>
                            </div>
                            <div>
                                <h4 class="font-heading text-sm font-bold text-primary mb-xs">{{ $fasilitas->nama }}</h4>
                                <p class="font-body text-xs text-on-surface-variant">{{ $fasilitas->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ==================== PELUANG KARIR ==================== --}}
        <section id="karir" class="scroll-mt-24 mb-xl fade-in">
            <div class="flex flex-col md:flex-row gap-lg items-center">
                <div class="md:w-1/2">
                    <span class="text-xs font-semibold uppercase tracking-widest"
                        style="color: {{ $warnaHex }};">Karir</span>
                    <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mt-sm mb-md">Peluang Karir</h2>
                    <div class="h-1 w-12 rounded-full mb-md" style="background-color: {{ $warnaHex }};"></div>
                    <p class="font-body text-sm text-on-surface-variant mb-lg">
                        Lulusan {{ $program->singkatan }} memiliki prospek karir yang luas di berbagai bidang industri,
                        baik di dalam maupun luar negeri.
                    </p>
                    <div class="grid grid-cols-2 gap-sm">
                        @foreach ($program->peluangKerja as $karir)
                            <div
                                class="flex items-center gap-sm bg-surface-container-lowest rounded-lg p-md card-shadow hover:-translate-y-0.5 transition-transform">
                                <span class="material-symbols-outlined text-sm"
                                    style="color: {{ $warnaHex }};">work</span>
                                <span class="font-body text-xs font-semibold text-on-surface">{{ $karir->nama }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="md:w-1/2">
                    @if ($program->gambar_peluang_kerja)
                        <img src="{{ asset('storage/' . $program->gambar_peluang_kerja) }}"
                            class="w-full aspect-video rounded-xl card-shadow object-cover"
                            alt="Peluang Karir {{ $program->singkatan }}">
                    @else
                        <div class="w-full aspect-video rounded-xl card-shadow flex items-center justify-center"
                            style="background-color: {{ $warnaContainerBgHex }};">
                            <span class="material-symbols-outlined text-6xl"
                                style="color: {{ $warnaHex }};">work</span>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- ==================== CTA ==================== --}}
        <x-cta-bergabung judul="Tertarik Bergabung?"
            deskripsi="Dapatkan informasi lengkap tentang program keahlian {{ $program->singkatan }} dengan mengunduh brosur resmi SMK Istiqomah Muhammadiyah 4 Samarinda."
            :warna="$program->warna"
            tombolKedua='<a href="{{ route('home') }}#departments" class="inline-flex items-center gap-sm border-2 border-on-primary text-on-primary px-xl py-md rounded-lg font-heading text-sm font-semibold hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali
            </a>' />

        {{-- Tombol Kembali --}}
        <div class="flex justify-center mt-xl">
            <a href="{{ route('home') }}#departments"
                class="inline-flex items-center gap-sm px-lg py-md bg-primary text-on-primary rounded-full font-body text-xs font-semibold hover:scale-105 active:scale-95 transition-transform shadow-lg">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali ke Program Keahlian
            </a>
        </div>

    </div>

    @push('scripts')
        <style>
            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }

            .scrollbar-hide {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
        <script>
            // Intersection Observer for fade-in animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.fade-in').forEach(el => {
                el.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-700');
                observer.observe(el);
            });

            // Sticky nav active state on scroll
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.sticky-nav a');

            window.addEventListener('scroll', () => {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop - 150;
                    if (window.scrollY >= sectionTop) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('text-primary', 'font-bold');
                    link.classList.add('text-on-surface-variant');
                    if (link.getAttribute('href') === '#' + current) {
                        link.classList.add('text-primary', 'font-bold');
                        link.classList.remove('text-on-surface-variant');
                    }
                });
            });
        </script>
    @endpush

@endsection
