@props([
    'judul' => 'Tertarik Bergabung?',
    'deskripsi' =>
        'Dapatkan informasi lengkap tentang program keahlian ini dengan mengunduh brosur resmi SMK Istiqomah Muhammadiyah 4 Samarinda.',
    'warna' => 'primary',
    'tombolPertama' => null,
    'tombolKedua' => null,
])

@php
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
    $warnaHex = $colorMap[$warna] ?? '#001e40';
@endphp

<section class="rounded-xl p-lg md:p-xl text-center fade-in"
    style="background: linear-gradient(to right, {{ $warnaHex }}, {{ $warnaHex }});">
    <h2 class="font-heading text-2xl md:text-3xl font-bold text-on-primary mb-md">
        {{ $judul }}
    </h2>
    <p class="font-body text-base text-on-primary/80 mb-lg max-w-xl mx-auto">
        {{ $deskripsi }}
    </p>
    <div class="flex flex-col sm:flex-row gap-md justify-center">
        @if ($tombolPertama)
            {!! $tombolPertama !!}
        @else
            <a href="#"
                class="inline-flex items-center gap-sm bg-secondary-container text-on-secondary-container px-xl py-md rounded-lg font-heading text-sm font-semibold hover:scale-105 transition-transform shadow-lg">
                <span class="material-symbols-outlined">download</span>
                Download Brosur
            </a>
        @endif

        @if ($tombolKedua)
            {!! $tombolKedua !!}
        @else
            <a href="{{ route('contact') }}"
                class="inline-flex items-center gap-sm border-2 border-on-primary text-on-primary px-xl py-md rounded-lg font-heading text-sm font-semibold hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined">call</span>
                Hubungi Kami
            </a>
        @endif
    </div>
</section>
