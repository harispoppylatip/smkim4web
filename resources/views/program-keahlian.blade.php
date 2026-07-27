@extends('layouts.public')

@section('title', 'Program Keahlian - SMKIM4')

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
    </style>
@endpush

@section('content')

    @php
        $heroBackgroundUrl = !empty($pengaturanHome?->hero_background_foto)
            ? asset('storage/' . $pengaturanHome->hero_background_foto)
            : null;

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
            // Handle opacity suffixes like "primary/20", "error/10", "secondary-container/40"
            $parts = explode('/', $colorName);
            $base = $parts[0] ?? 'primary';
            $opacity = $parts[1] ?? null;
            $hex = $colorMap[$base] ?? '#001e40';
            if ($opacity !== null) {
                $opacityVal = (int) $opacity / 100;
                // Return rgba
                $r = hexdec(substr($hex, 1, 2));
                $g = hexdec(substr($hex, 3, 2));
                $b = hexdec(substr($hex, 5, 2));
                return "rgba({$r}, {$g}, {$b}, {$opacityVal})";
            }
            return $hex;
        }
    @endphp

    {{-- ==================== HERO SECTION ==================== --}}
    <section
        class="relative overflow-hidden {{ $heroBackgroundUrl ? '' : 'bg-gradient-to-br from-primary via-primary-container to-primary' }}"
        @if ($heroBackgroundUrl) style="background-image: linear-gradient(rgba(0, 30, 64, 0.58), rgba(0, 30, 64, 0.50)), url('{{ $heroBackgroundUrl }}'); background-size: cover; background-position: center;" @endif>
        <div class="absolute inset-0 opacity-[0.08]">
            <div class="absolute top-10 left-10 w-72 h-72 bg-secondary rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        </div>
        <div class="relative px-container-margin-mobile md:px-container-margin-desktop py-xl md:py-20 text-center">
            <span
                class="inline-block px-4 py-1 bg-secondary/20 text-secondary rounded-full text-xs font-semibold mb-md backdrop-blur-sm">Program
                Keahlian</span>
            <h2 class="font-heading text-3xl md:text-5xl font-bold text-on-primary mb-md leading-tight">Pilih Jurusan
                Impianmu</h2>
            <p class="font-body text-base md:text-lg text-on-primary-container max-w-2xl mx-auto">
                SMK Istiqomah Muhammadiyah 4 Samarinda memiliki enam program keahlian unggulan yang siap mencetak generasi
                berdaya saing global.
            </p>
        </div>
    </section>

    {{-- ==================== PROGRAM KEAHLIAN LIST ==================== --}}
    <section class="px-container-margin-mobile md:px-container-margin-desktop py-xl max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
            @foreach ($programs as $program)
                @php
                    $warnaHex = getColorHex($program->warna, $colorMap);
                    $warnaContainerBgHex = getColorHex($program->warna_container_bg, $colorMap);
                    $warnaHoverBg = getColorHex($program->warna . '/5', $colorMap);
                @endphp
                <a href="{{ route('program-keahlian.detail', $program->slug) }}"
                    class="group relative overflow-hidden rounded-xl bg-white shadow-lg p-lg transition-all hover:-translate-y-2 block fade-in"
                    style="animation-delay: {{ $loop->iteration * 0.1 }}s; border-top: 4px solid {{ $warnaHex }};">

                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-lg">
                        <span class="text-xs font-semibold px-md py-xs rounded-full"
                            style="color: {{ $warnaHex }}; background-color: {{ $warnaContainerBgHex }};">
                            {{ $program->singkatan }}
                        </span>
                    </div>

                    {{-- Title --}}
                    <h4 class="font-heading text-xl md:text-2xl font-bold mb-md" style="color: {{ $warnaHex }};">
                        {{ $program->nama }}
                    </h4>

                    {{-- Description --}}
                    <p class="font-body text-sm text-on-surface-variant mb-lg">
                        {{ $program->deskripsi_singkat }}
                    </p>

                    {{-- Kompetensi --}}
                    <div class="grid grid-cols-2 gap-sm mb-lg">
                        @foreach ($program->kompetensi->take(4) as $kompetensi)
                            <div class="flex items-center gap-xs text-on-surface-variant">
                                <span class="material-symbols-outlined text-sm"
                                    style="color: {{ $warnaHex }};">check_circle</span>
                                <span class="text-xs">{{ $kompetensi->nama }}</span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Preview Image --}}
                    <div class="relative h-48 rounded-lg overflow-hidden mb-lg flex items-center justify-center bg-white">
                        @if ($program->gambar)
                            <img src="{{ asset('storage/' . $program->gambar) }}" alt="{{ $program->nama }}"
                                class="h-full w-full object-cover">
                        @endif
                    </div>

                    {{-- CTA --}}
                    <div class="w-full py-md text-on-primary rounded-lg text-xs font-semibold hover:opacity-90 transition-opacity text-center"
                        style="background-color: {{ $warnaHex }};">
                        Pelajari Selengkapnya
                    </div>

                    {{-- Hover effect overlay --}}
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl pointer-events-none"
                        style="background-color: {{ $warnaHoverBg }};">
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- ==================== CTA SECTION ==================== --}}
    <section class="px-container-margin-mobile md:px-container-margin-desktop pb-xl max-w-7xl mx-auto">
        <x-cta-bergabung judul="Belum Yakin dengan Pilihanmu?"
            deskripsi="Hubungi kami untuk konsultasi gratis tentang program keahlian yang sesuai dengan minat dan bakatmu."
            warna="primary"
            tombolPertama='<a href="{{ route('contact') }}" class="inline-flex items-center gap-sm bg-secondary-container text-on-secondary-container px-xl py-md rounded-lg font-heading text-sm font-semibold hover:scale-105 transition-transform shadow-lg">
                <span class="material-symbols-outlined">call</span>
                Hubungi Kami
            </a>'
            tombolKedua='<a href="{{ route('home') }}" class="inline-flex items-center gap-sm border-2 border-on-primary text-on-primary px-xl py-md rounded-lg font-heading text-sm font-semibold hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali ke Beranda
            </a>' />
    </section>

    @push('scripts')
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
        </script>
    @endpush

@endsection
