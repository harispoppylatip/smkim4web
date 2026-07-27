@extends('layouts.public')

@section('title', 'Profil - SMKIM4')

@section('bottomNavActive', 'profil')

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

        .timeline-line {
            position: absolute;
            left: 19px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, #003366, #fcd400);
        }

        .overflow-anywhere {
            overflow-wrap: anywhere;
            word-break: normal;
            hyphens: auto;
        }
    </style>
@endpush

@section('content')

    @php
        $heroBackgroundUrl = !empty($pengaturanHome?->hero_background_foto)
            ? asset('storage/' . $pengaturanHome->hero_background_foto)
            : null;
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
                class="inline-block px-4 py-1 bg-secondary/20 text-secondary rounded-full text-xs font-semibold mb-md backdrop-blur-sm">Tentang
                SMKIM4</span>
            <h2 class="font-heading text-3xl md:text-5xl font-bold text-on-primary mb-md leading-tight">Profil Sekolah</h2>
            <p class="font-body text-base md:text-lg text-on-primary-container max-w-2xl mx-auto">
                SMK Istiqomah Muhammadiyah 4 Samarinda — Mencetak generasi unggul, beriman, dan berdaya saing global.
            </p>
        </div>
    </section>

    {{-- ==================== SEJARAH ==================== --}}
    <section class="px-container-margin-mobile md:px-container-margin-desktop py-xl max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row gap-lg items-center">
            <div class="md:w-1/2">
                @if ($profil && $profil->sejarah_gambar)
                    <img src="{{ asset('storage/' . $profil->sejarah_gambar) }}" alt="Gambar Sejarah"
                        class="w-full aspect-video object-cover rounded-xl card-shadow">
                @else
                    <div
                        class="w-full aspect-video bg-gradient-to-br from-primary-container/10 to-primary-container/5 rounded-xl flex items-center justify-center card-shadow">
                        <span class="material-symbols-outlined text-8xl text-primary-container/30">history_edu</span>
                    </div>
                @endif
            </div>
            <div class="md:w-1/2">
                <span class="text-xs font-semibold text-secondary uppercase tracking-widest">Sejarah</span>
                <h3 class="font-heading text-2xl md:text-3xl font-bold text-primary mt-sm mb-md">Perjalanan SMKIM4</h3>
                <div class="h-1 w-12 bg-secondary rounded-full mb-md"></div>
                <div class="space-y-md font-body text-sm text-on-surface-variant leading-relaxed">
                    @if ($profil && $profil->sejarah)
                        @php
                            $sejarah = $profil->sejarah;
                            // Jika masih plain text (dari input lama), konversi ke paragraf HTML
                            if ($sejarah === strip_tags($sejarah)) {
                                $pars = array_filter(explode("\n\n", $sejarah));
                                $sejarah = '<p>' . implode('</p><p>', $pars) . '</p>';
                            }
                        @endphp
                        <div class="sejarah-content">{!! $sejarah !!}</div>
                    @else
                        <p>Belum ada data sejarah.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== VISI & MISI ==================== --}}
    <section class="bg-surface-container-low py-xl px-container-margin-mobile md:px-container-margin-desktop">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-lg">
                <span class="text-xs font-semibold text-secondary uppercase tracking-widest">Visi & Misi</span>
                <h3 class="font-heading text-2xl md:text-3xl font-bold text-primary mt-sm">Arah & Tujuan Kami</h3>
                <div class="h-1 w-12 bg-secondary rounded-full mx-auto mt-md"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-lg">
                {{-- Visi --}}
                <div class="bg-surface-container-lowest rounded-xl p-lg card-shadow border-t-4 border-primary fade-in">
                    <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center mb-md">
                        <span class="material-symbols-outlined text-primary text-3xl">visibility</span>
                    </div>
                    <h4 class="font-heading text-xl font-bold text-primary mb-sm">Visi</h4>
                    <p class="font-body text-sm text-on-surface-variant leading-relaxed italic">
                        "{{ $profil->visi ?? 'Belum ada visi.' }}"
                    </p>
                </div>

                {{-- Misi --}}
                <div class="bg-surface-container-lowest rounded-xl p-lg card-shadow border-t-4 border-secondary fade-in"
                    style="animation-delay: 0.2s;">
                    <div class="w-14 h-14 rounded-xl bg-secondary/10 flex items-center justify-center mb-md">
                        <span class="material-symbols-outlined text-secondary text-3xl">flag</span>
                    </div>
                    <h4 class="font-heading text-xl font-bold text-primary mb-sm">Misi</h4>
                    <ul class="space-y-sm font-body text-sm text-on-surface-variant">
                        @if ($profil && $profil->misi)
                            @foreach (explode("\n", $profil->misi) as $misi)
                                @if (trim($misi))
                                    <li class="flex items-start gap-sm">
                                        <span
                                            class="material-symbols-outlined text-secondary text-base mt-0.5">check_circle</span>
                                        <span>{{ trim($misi) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        @else
                            <li class="flex items-start gap-sm">
                                <span class="material-symbols-outlined text-secondary text-base mt-0.5">check_circle</span>
                                <span>Belum ada data misi.</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== TIMELINE ==================== --}}
    <section class="px-container-margin-mobile md:px-container-margin-desktop py-xl max-w-7xl mx-auto">
        <div class="text-center mb-lg">
            <span class="text-xs font-semibold text-secondary uppercase tracking-widest">Perjalanan</span>
            <h3 class="font-heading text-2xl md:text-3xl font-bold text-primary mt-sm">Tonggak Sejarah</h3>
            <div class="h-1 w-12 bg-secondary rounded-full mx-auto mt-md"></div>
        </div>

        <div class="relative max-w-3xl mx-auto">
            <div class="timeline-line"></div>

            @php $timeline = $profil->timeline ?? []; @endphp
            @forelse($timeline as $index => $item)
                <div class="relative pl-12 {{ !$loop->last ? 'pb-lg' : '' }} fade-in"
                    style="animation-delay: {{ $index * 0.15 }}s;">
                    <div
                        class="absolute left-3 top-1 w-8 h-8 {{ $loop->last ? 'bg-secondary' : 'bg-primary' }} rounded-full flex items-center justify-center ring-4 ring-surface">
                        <span class="material-symbols-outlined text-on-primary text-sm">{{ $item['icon'] ?? 'flag' }}</span>
                    </div>
                    <div class="bg-surface-container-lowest rounded-xl p-lg card-shadow">
                        <span class="text-xs font-bold text-secondary">{{ $item['tahun'] ?? '' }}</span>
                        <h4 class="font-heading text-base font-bold text-primary mt-xs">{{ $item['judul'] ?? '' }}</h4>
                        <p class="font-body text-sm text-on-surface-variant mt-xs">{{ $item['deskripsi'] ?? '' }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-lg text-on-surface-variant">
                    <p>Belum ada data timeline.</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- ==================== NILAI-NILAI ==================== --}}
    <section class="bg-primary py-xl px-container-margin-mobile md:px-container-margin-desktop">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-xl">
                <span class="text-xs font-semibold text-secondary uppercase tracking-widest">Nilai-Nilai</span>
                <h3 class="font-heading text-2xl md:text-3xl font-bold text-on-primary mt-sm">Karakter SMKIM4</h3>
                <p class="font-body text-sm text-on-primary-container mt-md max-w-2xl mx-auto">
                    Tiga pilar utama yang menjadi fondasi pembentukan karakter siswa SMK Istiqomah Muhammadiyah 4 Samarinda
                </p>
                <div class="h-1 w-12 bg-secondary rounded-full mx-auto mt-md"></div>
            </div>

            @php
                $nilaiList = $profil->nilai ?? [];
                // Urutkan agar Kedisiplinan berada di tengah (index 1)
                $orderedNilai = [];
                $disiplinIndex = null;
                foreach ($nilaiList as $idx => $item) {
                    if (strtolower($item['judul'] ?? '') === 'kedisiplinan') {
                        $disiplinIndex = $idx;
                    }
                }
                // Susun ulang: item lain, lalu kedisiplinan, lalu sisanya
                foreach ($nilaiList as $idx => $item) {
                    if ($idx !== $disiplinIndex) {
                        $orderedNilai[] = $item;
                    }
                }
                if ($disiplinIndex !== null) {
                    array_splice($orderedNilai, 1, 0, [$nilaiList[$disiplinIndex]]);
                } else {
                    $orderedNilai = $nilaiList;
                }
            @endphp

            @if (count($orderedNilai) > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">
                    @foreach ($orderedNilai as $index => $item)
                        @php
                            $isDisiplin = strtolower($item['judul'] ?? '') === 'kedisiplinan';
                            $isCenter = $index === 1 && $isDisiplin;
                        @endphp
                        <div class="relative bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 text-center hover:bg-white/20 transition-all duration-300 fade-in group {{ $isDisiplin ? 'md:scale-105 md:-mt-2 md:mb-2 ring-2 ring-secondary/50' : '' }}"
                            style="animation-delay: {{ $index * 0.15 }}s;">

                            {{-- Badge untuk Kedisiplinan --}}
                            {{-- @if ($isDisiplin)
                                <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                                    <span
                                        class="inline-block px-3 py-1 bg-secondary text-on-secondary text-xs font-bold rounded-full shadow-lg">
                                        LANDASAN UTAMA
                                    </span>
                                </div>
                            @endif --}}

                            {{-- Icon Container --}}
                            <div
                                class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 rounded-2xl bg-secondary/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 {{ $isDisiplin ? 'bg-secondary/30' : '' }}">
                                <span class="material-symbols-outlined text-secondary text-3xl md:text-4xl">
                                    {{ $item['icon'] ?? 'diamond' }}
                                </span>
                            </div>

                            {{-- Judul --}}
                            <h4 class="font-heading text-lg md:text-xl font-bold text-on-primary mb-3">
                                {{ $item['judul'] ?? '' }}
                            </h4>

                            {{-- Deskripsi --}}
                            <p class="font-body text-sm text-on-primary-container leading-relaxed">
                                {{ $item['deskripsi'] ?? '' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-on-primary-container">
                    <p>Belum ada data nilai-nilai.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ==================== STRUKTUR ORGANISASI ==================== --}}
    <section class="px-container-margin-mobile md:px-container-margin-desktop py-xl max-w-7xl mx-auto">
        <div class="text-center mb-lg">
            <span class="text-xs font-semibold text-secondary uppercase tracking-widest">Organisasi</span>
            <h3 class="font-heading text-2xl md:text-3xl font-bold text-primary mt-sm">Struktur Organisasi</h3>
            <div class="h-1 w-12 bg-secondary rounded-full mx-auto mt-md"></div>
        </div>

        @if ($profil && $profil->struktur_organisasi_gambar)
            <div class="flex justify-center mb-lg">
                <img src="{{ asset('storage/' . $profil->struktur_organisasi_gambar) }}" alt="Struktur Organisasi"
                    class="w-full max-w-3xl rounded-xl card-shadow">
            </div>
        @endif

        @php
            $struktur = $profil->struktur_organisasi ?? [];
            $grouped = collect($struktur)
                ->groupBy(function ($item) {
                    return $item['level'] ?? ($item['is_kepsek'] ?? false ? 1 : 2);
                })
                ->sortKeys();
        @endphp

        @if ($grouped->count() > 0)
            <div class="org-pyramid mx-auto max-w-full">
                @foreach ($grouped as $level => $items)
                    @if (!$loop->first)
                        <div class="org-connector">
                            <div class="org-line"></div>
                        </div>
                    @endif

                    <div class="org-layer">
                        <div class="org-layer-items">
                            @foreach ($items as $index => $item)
                                <div class="org-card fade-in"
                                    style="animation-delay: {{ $loop->parent->index * 0.2 + $index * 0.1 }}s;">
                                    <div
                                        class="org-card__avatar rounded-full {{ $level <= 1 ? 'bg-primary/10' : 'bg-secondary/10' }} flex items-center justify-center mx-auto mb-2 flex-shrink-0 overflow-hidden">
                                        @if (!empty($item['foto']))
                                            <img src="{{ asset('storage/' . $item['foto']) }}" alt="{{ $item['nama'] }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <span
                                                class="material-symbols-outlined {{ $level <= 1 ? 'text-primary' : 'text-secondary' }}">{{ $item['icon'] ?? ($level <= 1 ? 'badge' : 'person') }}</span>
                                        @endif
                                    </div>
                                    <h4 class="font-heading font-bold text-primary leading-tight">
                                        {{ $item['jabatan'] ?? '' }}
                                    </h4>
                                    <p class="font-body text-on-surface-variant mt-1 leading-tight">
                                        {{ $item['nama'] ?? '' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            @push('styles')
                <style>
                    .org-pyramid {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        gap: 0;
                        width: 100%;
                    }

                    .org-layer {
                        width: 100%;
                        margin: 0 auto;
                    }

                    .org-layer-items {
                        display: flex;
                        flex-wrap: wrap;
                        gap: 12px;
                        justify-content: center;
                        padding: 0 4px;
                    }

                    .org-card {
                        background: var(--md-sys-color-surface-container-lowest, #ffffff);
                        border-radius: 12px;
                        padding: 16px 12px;
                        box-shadow: 0px 4px 12px rgba(0, 51, 102, 0.08);
                        text-align: center;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        overflow-wrap: break-word;
                        word-break: break-word;
                        overflow: hidden;
                        flex: 1 1 140px;
                        min-width: 130px;
                        max-width: 100%;
                    }

                    .org-card__avatar {
                        width: 60px;
                        height: 60px;
                    }

                    .org-card h4 {
                        width: 100%;
                        max-width: 100%;
                        font-size: 12px;
                        overflow-wrap: break-word;
                        word-break: break-word;
                    }

                    .org-card p {
                        width: 100%;
                        max-width: 100%;
                        font-size: 11px;
                        overflow-wrap: break-word;
                        word-break: break-word;
                    }

                    .org-card .material-symbols-outlined {
                        font-size: 28px;
                    }

                    .org-card:first-child:nth-child(1):last-child {
                        max-width: 320px;
                        flex: 0 1 auto;
                    }

                    .org-connector {
                        display: flex;
                        justify-content: center;
                        padding: 0;
                        height: 24px;
                        width: 100%;
                        position: relative;
                    }

                    .org-line {
                        width: 2px;
                        height: 100%;
                        background: var(--md-sys-color-primary, #003366);
                        opacity: 0.25;
                        position: relative;
                    }

                    .org-line::before,
                    .org-line::after {
                        content: '';
                        position: absolute;
                        top: 0;
                        width: 30px;
                        height: 2px;
                        background: var(--md-sys-color-primary, #003366);
                        opacity: 0.25;
                    }

                    .org-line::before {
                        left: -30px;
                    }

                    .org-line::after {
                        right: -30px;
                    }

                    @media (min-width: 768px) {
                        .org-layer-items {
                            gap: 16px;
                            padding: 0 8px;
                        }

                        .org-card {
                            flex: 1 1 170px;
                            min-width: 150px;
                            padding: 20px 16px;
                        }

                        .org-card__avatar {
                            width: 72px;
                            height: 72px;
                        }

                        .org-card h4 {
                            font-size: 13px;
                        }

                        .org-card p {
                            font-size: 12px;
                        }

                        .org-card .material-symbols-outlined {
                            font-size: 32px;
                        }

                        .org-card:first-child:nth-child(1):last-child {
                            max-width: 360px;
                        }

                        .org-connector {
                            height: 32px;
                        }

                        .org-line::before,
                        .org-line::after {
                            width: 50px;
                        }

                        .org-line::before {
                            left: -50px;
                        }

                        .org-line::after {
                            right: -50px;
                        }
                    }

                    @media (min-width: 1024px) {
                        .org-card {
                            flex: 1 1 190px;
                            min-width: 170px;
                            max-width: 220px;
                        }

                        .org-card__avatar {
                            width: 80px;
                            height: 80px;
                        }

                        .org-card h4 {
                            font-size: 14px;
                        }

                        .org-card p {
                            font-size: 13px;
                        }

                        .org-card .material-symbols-outlined {
                            font-size: 36px;
                        }

                        .org-card:first-child:nth-child(1):last-child {
                            max-width: 400px;
                        }
                    }
                </style>
            @endpush
        @else
            <div class="text-center py-lg text-on-surface-variant">
                <p>Belum ada data struktur organisasi.</p>
            </div>
        @endif
    </section>

@endsection
