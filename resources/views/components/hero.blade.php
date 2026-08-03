{{--
    KOMPONEN HERO REUSABLE — dipakai di semua halaman publik (home, profile, program-keahlian,
    program-keahlian-detail, spmb, dst).

    Background: video (muted, tanpa suara) sebagai lapisan utama, dengan overlay navy gradient
    agar teks tetap terbaca. Jika video gagal dimuat, foto (`image`) atau gradient fallback tampil.

    Props:
        video            (string|null)  URL video background. Default: /videos/hero-image.mp4
        image            (string|null)  URL foto fallback (tampil jika video gagal load)
        preTitle         (string|null)  Teks kecil di atas judul (plain text, bukan pill)
        subtitle         (string|null)  Paragraf di bawah judul
        align            'center' | 'left'   Perataan konten (default center)
        size             'lg' | 'md' | 'sm'  lg = tinggi penuh home, md = py-xl md:py-20,
                                             sm = min-h 400/500 (SPMB)
        headingTag       'h1' | 'h2' | dst.  Tag judul (semantik per halaman)
        overlay          bool   Tampilkan overlay navy di atas video (default true)
        fallbackClass    string Class gradient fallback saat tidak ada foto
        fallbackStyle    string Style inline fallback (mis. warna jurusan)
        bottomFade       null | 'white' | 'surface'   Fade transisi ke konten bawah

    Slot:
        title            Judul utama — dirender apa adanya (HTML diizinkan). AMAN karena
                         konten berasal dari view; untuk data DB gunakan {{ }} di pemanggil.
        breadcrumb       Navigasi breadcrumb (untuk halaman detail)
        actions          Tombol CTA (flex container sudah disiapkan)
--}}
@props([
    'video' => null,
    'image' => null,
    'preTitle' => null,
    'subtitle' => null,
    'align' => 'center',
    'size' => 'md',
    'headingTag' => 'h1',
    'overlay' => true,
    'fallbackClass' => 'bg-gradient-to-br from-primary via-primary-container to-primary',
    'fallbackStyle' => null,
    'bottomFade' => null,
])

@php
    $videoUrl = $video ?? asset('videos/hero-image.mp4');

    $sizeClasses = match ($size) {
        'lg' => 'min-h-[600px] md:min-h-[751px] flex items-center justify-center',
        'sm' => 'min-h-[400px] md:min-h-[500px] flex items-center justify-center',
        default => 'py-xl md:py-20',
    };

    $alignClasses = $align === 'left' ? 'text-center md:text-left' : 'text-center';

    $contentMax = $align === 'left' ? 'max-w-7xl mx-auto' : 'max-w-4xl mx-auto';

    $subtitleClass = $align === 'left' ? 'text-on-primary/80 max-w-2xl' : 'text-on-primary/80 max-w-2xl mx-auto';

    $sectionStyle = $fallbackStyle;
    if ($image) {
        $sectionStyle = "background-image: url('{$image}'); background-size: cover; background-position: center;";
    }
@endphp

<section {{ $attributes->merge(['class' => 'relative overflow-hidden ' . $sizeClasses]) }}
    @if ($sectionStyle) style="{{ $sectionStyle }}" @endif>

    {{-- Video background (muted, tanpa suara) --}}
    <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline preload="auto"
        aria-hidden="true" tabindex="-1">
        <source src="{{ $videoUrl }}" type="video/mp4">
    </video>

    {{-- Fallback gradient jika tidak ada foto & tidak ada style khusus --}}
    @if (!$image && !$fallbackStyle)
        <div class="absolute inset-0 {{ $fallbackClass }}"></div>
    @endif

    {{-- Overlay navy agar teks tetap terbaca di atas video/foto --}}
    @if ($overlay)
        <div class="absolute inset-0 pointer-events-none"
            style="background: linear-gradient(rgba(0, 30, 64, 0.58), rgba(0, 30, 64, 0.50));"></div>
    @endif

    {{-- Breadcrumb (opsional, di atas konten) --}}
    @isset($breadcrumb)
        <div class="relative z-10 px-container-margin-mobile md:px-container-margin-desktop pt-lg">
            <div class="max-w-7xl mx-auto">{{ $breadcrumb }}</div>
        </div>
    @endisset

    {{-- Konten hero --}}
    <div
        class="relative z-10 px-container-margin-mobile md:px-container-margin-desktop {{ $alignClasses }} {{ $size === 'lg' || $size === 'sm' ? 'py-xl' : '' }}">
        <div class="{{ $contentMax }}">
            @if ($preTitle)
                <span
                    class="inline-block text-xs font-semibold text-secondary-fixed uppercase tracking-widest mb-md">{{ $preTitle }}</span>
            @endif

            <{{ $headingTag }}
                class="font-heading text-3xl md:text-5xl font-bold text-on-primary mb-md leading-tight">
                {!! $title !!}
                </{{ $headingTag }}>

                @if ($subtitle)
                    <p class="font-body text-base md:text-lg {{ $subtitleClass }}">{{ $subtitle }}</p>
                @endif

                @isset($actions)
                    <div class="flex flex-col sm:flex-row gap-md {{ $align === 'left' ? '' : 'justify-center' }} mt-xl">
                        {{ $actions }}
                    </div>
                @endisset
        </div>
    </div>

    {{-- Fade transisi ke konten bawah --}}
    @if ($bottomFade === 'white')
        <div
            class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-white via-white/30 to-transparent pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-full h-16 backdrop-blur-sm bg-gradient-to-t from-white/50 to-transparent pointer-events-none">
        </div>
    @elseif ($bottomFade === 'surface')
        <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-surface to-transparent"></div>
    @endif
</section>
