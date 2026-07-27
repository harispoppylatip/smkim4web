@extends('layouts.public')

@section('title', $item->judul . ' - SMKIM4')

@section('bottomNavActive', 'berita')

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

        .prose-berita h3 {
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }

        .prose-berita p {
            margin-bottom: 1rem;
            line-height: 1.75;
        }

        .prose-berita ul {
            margin-bottom: 1rem;
        }

        .prose-berita li {
            margin-bottom: 0.25rem;
        }
    </style>
@endpush

@section('content')

    <main class="px-container-margin-mobile md:px-container-margin-desktop mt-lg max-w-4xl mx-auto">

        {{-- ==================== BREADCRUMB ==================== --}}
        <nav class="flex items-center gap-xs text-sm text-on-surface-variant mb-lg fade-in" style="animation-delay: 0s;">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
            <span class="material-symbols-outlined text-base">chevron_right</span>
            <a href="{{ route('berita') }}" class="hover:text-primary transition-colors">Berita</a>
            <span class="material-symbols-outlined text-base">chevron_right</span>
            <span class="text-primary font-semibold truncate max-w-[200px] md:max-w-xs">{{ $item->judul }}</span>
        </nav>

        {{-- ==================== HEADER ARTIKEL ==================== --}}
        <article class="fade-in" style="animation-delay: 0.1s;">
            {{-- Kategori & Tanggal --}}
            <div class="flex items-center gap-sm mb-md">
                <span
                    class="px-3 py-1 rounded-full font-body text-xs font-semibold
                    @switch($item->warna)
                        @case('primary') bg-primary text-on-primary @break
                        @case('secondary') bg-secondary text-on-secondary @break
                        @default bg-surface-container-high text-on-surface-variant @endswitch">
                    {{ $item->kategori }}
                </span>
                <span class="text-outline font-body text-xs">•</span>
                <span class="text-outline font-body text-xs">{{ $item->tanggal }}</span>
            </div>

            {{-- Judul --}}
            <h1 class="font-heading text-2xl md:text-4xl font-bold text-primary leading-tight mb-lg">
                {{ $item->judul }}
            </h1>

            {{-- Hero Image --}}
            @if ($item->gambar)
                <div class="w-full h-56 md:h-96 rounded-xl mb-xl overflow-hidden bg-surface-container-low">
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover"
                        alt="{{ $item->judul }}">
                </div>
            @else
                <div
                    class="w-full h-56 md:h-80 rounded-xl mb-xl relative overflow-hidden bg-gradient-to-br from-{{ $item->warna_bg }} to-transparent">
                    <div class="w-full h-full flex items-center justify-center">
                        <span
                            class="material-symbols-outlined text-8xl md:text-9xl text-{{ $item->warna_icon }} opacity-60">
                            {{ $item->icon }}
                        </span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-surface/40 to-transparent"></div>
                </div>
            @endif

            {{-- Konten --}}
            <div class="prose-berita text-on-surface-variant font-body text-base md:text-lg leading-relaxed max-w-none">
                {!! $item->konten !!}
            </div>

            {{-- Bagikan --}}
            <div class="mt-xl pt-lg border-t border-outline-variant">
                <p class="font-body text-sm font-semibold text-on-surface mb-md">Bagikan artikel ini:</p>
                <div class="flex gap-sm">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary hover:bg-primary hover:text-on-primary transition-colors">
                        <span class="material-symbols-outlined text-sm">share</span>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary hover:bg-primary hover:text-on-primary transition-colors">
                        <span class="material-symbols-outlined text-sm">content_copy</span>
                    </a>
                </div>
            </div>
        </article>

        {{-- ==================== BERITA TERKAIT ==================== --}}
        @if (count($related) > 0)
            <section class="mt-xl mb-xl">
                <div class="flex items-center justify-between mb-lg">
                    <h2 class="font-heading text-xl md:text-2xl font-bold text-primary">Berita Terkait</h2>
                    <a href="{{ route('berita') }}"
                        class="text-sm font-semibold text-primary hover:underline flex items-center gap-xs">
                        Lihat Semua
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($related as $item)
                        <a href="{{ route('berita.detail', $item->slug) }}"
                            class="group bg-surface-container-lowest rounded-xl overflow-hidden card-shadow border-t-4
                                @switch($item->warna)
                                    @case('primary') border-primary @break
                                    @case('secondary') border-secondary @break
                                    @default border-outline @endswitch
                                hover:shadow-lg transition-shadow fade-in"
                            style="animation-delay: {{ $loop->iteration * 0.1 }}s;">
                            <div
                                class="h-40 flex items-center justify-center relative overflow-hidden
                                @if ($item->gambar) bg-surface-container-low
                                @else bg-gradient-to-br from-{{ $item->warna_bg }} to-transparent @endif">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                        class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                        alt="{{ $item->judul }}">
                                @else
                                    <span
                                        class="material-symbols-outlined text-5xl text-{{ $item->warna_icon }}">{{ $item->icon }}</span>
                                @endif
                                <span
                                    class="absolute top-3 left-3 px-2 py-0.5 rounded-full font-body text-xs font-semibold
                                    @switch($item->warna)
                                        @case('primary') bg-primary text-on-primary @break
                                        @case('secondary') bg-secondary text-on-secondary @break
                                        @default bg-surface-container-high text-on-surface-variant @endswitch">
                                    {{ $item->kategori }}
                                </span>
                            </div>
                            <div class="p-md">
                                <p class="font-body text-xs text-outline mb-xs">{{ $item->tanggal }}</p>
                                <h3 class="font-heading text-sm font-bold text-primary group-hover:underline leading-snug">
                                    {{ $item->judul }}
                                </h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Tombol Kembali --}}
        <div class="flex justify-center pb-xl">
            <a href="{{ route('berita') }}"
                class="inline-flex items-center gap-sm px-lg py-md bg-primary text-on-primary rounded-full font-body text-xs font-semibold hover:scale-105 active:scale-95 transition-transform shadow-lg">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali ke Berita
            </a>
        </div>

    </main>

    @push('scripts')
        <style>
            .card-shadow {
                box-shadow: 0px 4px 12px rgba(0, 51, 102, 0.08);
            }
        </style>
    @endpush

@endsection
