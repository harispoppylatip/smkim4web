@extends('layouts.public')

@section('title', 'SMKIM4 - SMK Istiqomah Muhammadiyah 4 Samarinda')

@section('bottomNavActive', 'home')

@section('content')

    @php
        $heroBackgroundUrl = !empty($pengaturanHome?->hero_background_foto)
            ? asset('storage/' . $pengaturanHome->hero_background_foto)
            : null;
    @endphp

    {{-- # HERO SECTION --}}
    <x-hero size="lg" headingTag="h2" :image="$heroBackgroundUrl" fallbackClass="bg-primary-container" bottomFade="white"
        subtitle="Selamat datang di SMK Istiqomah Muhammadiyah 4 Samarinda. Kami menyiapkan talenta digital yang kompeten, kreatif, dan berakhlak mulia.">
        <x-slot:title>
            Membangun Masa Depan Berbasis <span class="text-secondary-fixed">Teknologi &amp; Iman</span>
        </x-slot:title>
        <x-slot:actions>
            <a href="{{ route('spmb') }}"
                class="bg-secondary-container text-on-secondary-container px-xl py-md rounded-lg font-heading text-lg shadow-lg hover:scale-105 transition-transform">
                Daftar Sekarang
            </a>
            <a href="{{ route('contact') }}"
                class="border-2 border-on-primary text-on-primary px-xl py-md rounded-lg font-heading text-lg hover:bg-white/10 transition-colors">
                Contact Us
            </a>
        </x-slot:actions>
    </x-hero>

    {{-- # KEPALA SEKOLAH SECTION --}}
    @php
        $kepsek =
            $pengaturanHome ??
            (object) [
                'kepala_sekolah_nama' => 'Dr. H. Ahmad Fauzi, M.Pd.',
                'kepala_sekolah_jabatan' => 'Kepala Sekolah',
                'kepala_sekolah_sambutan' =>
                    'Assalamu\'alaikum warahmatullahi wabarakatuh. Puji syukur kehadirat Allah SWT yang telah melimpahkan rahmat dan hidayah-Nya kepada kita semua. SMK Istiqomah Muhammadiyah 4 Samarinda hadir sebagai lembaga pendidikan yang berkomitmen mencetak generasi muda yang unggul dalam teknologi, berwawasan global, dan berkarakter Islami. Kami percaya bahwa setiap siswa memiliki potensi luar biasa yang perlu dikembangkan melalui pendidikan berkualitas dan lingkungan yang mendukung.',
                'kepala_sekolah_foto' => null,
                'kepala_sekolah_pengalaman_angka' => '15+',
                'kepala_sekolah_pengalaman_label' => 'Tahun Pengalaman',
            ];
        $fotoUrl = $kepsek->kepala_sekolah_foto
            ? asset('storage/' . $kepsek->kepala_sekolah_foto)
            : asset('gambar/logoim4.jpeg');
    @endphp

    <section
        class="relative py-20 md:py-28 px-container-margin-mobile md:px-container-margin-desktop bg-gradient-to-b from-white via-[#f8f9ff] to-white overflow-hidden">
        {{-- Decorative background elements --}}
        <div
            class="absolute top-0 right-0 w-[600px] h-[600px] bg-gradient-to-bl from-[#d5e3ff]/20 to-transparent rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-gradient-to-tr from-[#fcd400]/10 to-transparent rounded-full blur-3xl translate-y-1/2 -translate-x-1/4 pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            {{-- Main Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 xl:gap-20 items-center">

                {{-- LEFT: Photo Column --}}
                <div class="relative order-2 lg:order-1">
                    {{-- Mobile label (visible only on small screens) --}}
                    <div class="relative flex items-center justify-center lg:hidden">

                        {{-- Photo card --}}
                        <div class="relative w-full max-w-[320px] mx-auto">
                            {{-- Glowing frame --}}
                            <div
                                class="absolute -inset-4 bg-gradient-to-br from-secondary-container/15 via-primary/5 to-secondary-container/15 rounded-[28px] blur-md">
                            </div>
                            <div
                                class="absolute -inset-2 bg-gradient-to-br from-primary/10 via-secondary-container/25 to-primary/10 rounded-[24px]">
                            </div>
                            <div class="absolute -inset-1 bg-white rounded-[22px] shadow-[0_0_0_1px_rgba(252,212,0,0.25)]">
                            </div>

                            <div
                                class="relative bg-white rounded-2xl shadow-[0_20px_80px_-12px_rgba(0,30,64,0.25)] overflow-hidden">

                                {{-- Photo with gradient overlay --}}
                                <div class="relative aspect-[3/4]">
                                    <img src="{{ $fotoUrl }}" alt="{{ $kepsek->kepala_sekolah_nama }}"
                                        class="w-full h-full object-cover">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/70 via-primary/10 to-transparent">
                                    </div>
                                    {{-- Subtle light overlay --}}
                                    <div
                                        class="absolute top-0 left-0 right-0 h-1/2 bg-gradient-to-b from-white/10 to-transparent">
                                    </div>
                                </div>

                                {{-- Info overlay at bottom --}}
                                <div class="absolute bottom-0 left-0 right-0 p-5 text-white">
                                    <p class="font-heading text-lg font-bold drop-shadow-lg">
                                        {{ $kepsek->kepala_sekolah_nama }}</p>
                                    <p class="font-body text-xs text-white/80 drop-shadow">
                                        {{ $kepsek->kepala_sekolah_jabatan }}</p>
                                </div>

                            </div>


                        </div>
                    </div>

                    {{-- Desktop photo column --}}
                    <div class="relative hidden lg:flex items-center justify-center">
                        {{-- Premium decorative frame --}}
                        <div
                            class="absolute w-[340px] h-[340px] xl:w-[400px] xl:h-[400px] rounded-full bg-gradient-to-br from-[#d5e3ff]/50 via-[#d5e3ff]/20 to-transparent">
                        </div>
                        <div
                            class="absolute w-[380px] h-[380px] xl:w-[440px] xl:h-[440px] rounded-full border-2 border-dashed border-[#d5e3ff]/40">
                        </div>
                        <div
                            class="absolute w-[420px] h-[420px] xl:w-[480px] xl:h-[480px] rounded-full border border-[#d5e3ff]/15">
                        </div>

                        {{-- Decorative orbit dots --}}
                        <svg class="absolute w-[420px] h-[420px] xl:w-[480px] xl:h-[480px] animate-spin-slow"
                            viewBox="0 0 100 100">
                            <circle cx="50" cy="0" r="3" fill="#fcd400" opacity="0.6" />
                            <circle cx="50" cy="100" r="3" fill="#fcd400" opacity="0.6" />
                            <circle cx="0" cy="50" r="3" fill="#003366" opacity="0.4" />
                            <circle cx="100" cy="50" r="3" fill="#003366" opacity="0.4" />
                        </svg>

                        {{-- Photo with elegant frame --}}
                        <div class="relative z-10 w-[280px] xl:w-[340px]">
                            {{-- Outer glowing frame --}}
                            <div
                                class="absolute -inset-5 bg-gradient-to-br from-secondary-container/20 via-primary/5 to-secondary-container/20 rounded-[32px] blur-xl">
                            </div>
                            <div
                                class="absolute -inset-3 bg-gradient-to-br from-primary/10 via-secondary-container/25 to-primary/10 rounded-[28px]">
                            </div>
                            <div class="absolute -inset-1.5 bg-white rounded-[26px] shadow-[0_0_0_1px_rgba(252,212,0,0.3)]">
                            </div>

                            <div
                                class="relative bg-white rounded-2xl shadow-[0_30px_100px_-20px_rgba(0,30,64,0.4)] overflow-hidden">

                                <div class="relative aspect-[3/4]">
                                    <img src="{{ $fotoUrl }}" alt="{{ $kepsek->kepala_sekolah_nama }}"
                                        class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent">
                                    </div>

                                    {{-- Subtle light overlay --}}
                                    <div
                                        class="absolute top-0 left-0 right-0 h-1/2 bg-gradient-to-b from-white/10 to-transparent">
                                    </div>
                                </div>

                                {{-- Name overlay --}}
                                <div class="absolute bottom-0 left-0 right-0 p-7 text-white">
                                    <p class="font-heading text-xl xl:text-2xl font-bold drop-shadow-lg">
                                        {{ $kepsek->kepala_sekolah_nama }}</p>
                                    <p class="font-body text-sm text-white/80 drop-shadow">
                                        {{ $kepsek->kepala_sekolah_jabatan }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Message Column --}}
                <div class="relative order-1 lg:order-2">
                    {{-- Decorative opening quote mark --}}
                    <div class="hidden lg:block absolute -top-8 -left-2 text-7xl text-secondary-container/30 font-heading font-bold leading-none select-none"
                        aria-hidden="true">"</div>

                    {{-- Greeting --}}
                    <p class="font-heading text-lg md:text-xl text-primary/70 font-semibold mb-3">
                        Assalamu'alaikum Warahmatullahi Wabarakatuh
                    </p>

                    {{-- Main heading --}}
                    <h3 class="font-heading text-2xl md:text-3xl xl:text-4xl font-bold text-primary leading-tight mb-6">
                        Selamat Datang di
                        <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary to-secondary/70">SMK
                            Istiqomah Muhammadiyah 4</span>
                    </h3>

                    {{-- Welcome message --}}
                    <div class="relative">
                        {{-- Quote icon --}}
                        <div class="absolute -top-1 -left-1 text-secondary-container/40">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.57-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z" />
                            </svg>
                        </div>
                        <div class="pl-8 md:pl-10">
                            <p class="font-body text-base md:text-lg text-on-surface-variant leading-relaxed italic">
                                {{ $kepsek->kepala_sekolah_sambutan }}
                            </p>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </section>

    {{-- CSS for subtle spin animation --}}
    <style>
        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin-slow {
            animation: spin-slow 20s linear infinite;
        }
    </style>

    {{-- # DEPARTMENTS SECTION --}}
    <section class="py-2xl md:py-3xl px-container-margin-mobile md:px-container-margin-desktop" id="departments">
        <div class="text-center mb-2xl">
            <span class="inline-block text-xs font-semibold text-secondary uppercase tracking-widest mb-sm">Program
                Unggulan</span>
            <h3 class="font-heading text-3xl md:text-4xl font-bold text-primary mb-sm">Program Keahlian</h3>
            <p class="font-body text-sm md:text-base text-on-surface-variant mt-md max-w-2xl mx-auto">
                Enam program keahlian unggulan yang siap membentuk masa depanmu
            </p>
        </div>

        {{-- Horizontal scroll container with nav buttons --}}
        <div class="relative group/scroll program-scroll-wrapper max-w-7xl mx-auto px-2 md:px-6">
            {{-- Tombol kiri --}}
            <button type="button"
                class="scroll-btn-left absolute -left-3 md:-left-5 top-1/2 -translate-y-1/2 z-20 w-11 h-11 md:w-13 md:h-13 rounded-full bg-white shadow-lg flex items-center justify-center text-on-surface hover:bg-primary hover:text-on-primary hover:scale-110 transition-all md:opacity-0 md:group-hover/scroll:opacity-100 focus:opacity-100"
                aria-label="Scroll ke kiri">
                <span class="material-symbols-outlined text-2xl">chevron_left</span>
            </button>

            {{-- Tombol kanan --}}
            <button type="button"
                class="scroll-btn-right absolute -right-3 md:-right-5 top-1/2 -translate-y-1/2 z-20 w-11 h-11 md:w-13 md:h-13 rounded-full bg-white shadow-lg flex items-center justify-center text-on-surface hover:bg-primary hover:text-on-primary hover:scale-110 transition-all md:opacity-0 md:group-hover/scroll:opacity-100 focus:opacity-100"
                aria-label="Scroll ke kanan">
                <span class="material-symbols-outlined text-2xl">chevron_right</span>
            </button>

            {{-- Gradient fade kanan --}}
            <div
                class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none md:hidden">
            </div>

            <div class="overflow-hidden">
                <div class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-lg scrollbar-hide horizontal-scroll"
                    style="-ms-overflow-style: none; scrollbar-width: none;">

                    @foreach ($programKeahlian as $prog)
                        @php
                            // Color mapping for jurusan themes
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
                            $warnaKey = $prog->warna ?? 'primary';
                            $warnaHex = $colorMap[$warnaKey] ?? '#001e40';
                            $warnaContainerBgKey = $prog->warna_container_bg ?? 'primary/10';
                            // Parse opacity for container bg
                            $warnaParts = explode('/', $warnaContainerBgKey);
                            $warnaBase = $colorMap[$warnaParts[0]] ?? '#001e40';
                            $warnaOpacity = isset($warnaParts[1]) ? (int) $warnaParts[1] / 100 : 0.1;
                            $r = hexdec(substr($warnaBase, 1, 2));
                            $g = hexdec(substr($warnaBase, 3, 2));
                            $b = hexdec(substr($warnaBase, 5, 2));
                            $warnaContainerBgRgba = "rgba({$r}, {$g}, {$b}, {$warnaOpacity})";
                            // Badge: text color = warnaHex, bg = containerBg
                            // Button: bg = warnaHex, text = white
                            // Gradient: from warnaHex with opacity
                            $gradientFromRgba = "rgba({$r}, {$g}, {$b}, 0.2)";
                            $gradientToRgba = "rgba({$r}, {$g}, {$b}, 0.05)";
                        @endphp
                        <a href="{{ route('program-keahlian.detail', $prog->slug) }}"
                            class="group relative overflow-hidden rounded-2xl bg-white shadow-md hover:shadow-xl border border-outline/10 p-xl md:p-2xl transition-all hover:-translate-y-1 block w-full md:w-[calc((100%-1.5rem)/2)] shrink-0 snap-start snap-always"
                            style="border-top: 4px solid {{ $warnaHex }};">
                            <div class="flex items-start justify-between mb-lg">
                                <span class="text-xs font-semibold px-lg py-xs rounded-full"
                                    style="color: {{ $warnaHex }}; background-color: {{ $warnaContainerBgRgba }};">{{ $prog->singkatan }}</span>
                            </div>
                            <h4 class="font-heading text-xl md:text-2xl font-bold mb-sm"
                                style="color: {{ $warnaHex }};">
                                {{ $prog->nama }}</h4>
                            <p class="font-body text-sm text-on-surface-variant mb-lg leading-relaxed">
                                {{ $prog->deskripsi_singkat }}</p>
                            <div class="grid grid-cols-2 gap-sm mb-lg">
                                @foreach ($prog->kompetensi as $kompetensi)
                                    <div class="flex items-center gap-xs text-on-surface-variant">
                                        <span class="material-symbols-outlined text-sm"
                                            style="color: {{ $warnaHex }};">check_circle</span>
                                        <span class="text-xs">{{ $kompetensi->nama }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="relative h-52 rounded-xl overflow-hidden mb-lg flex items-center justify-center"
                                style="background: linear-gradient(to bottom right, {{ $gradientFromRgba }}, {{ $gradientToRgba }});">
                                @if ($prog->gambar)
                                    <img src="{{ asset('storage/' . $prog->gambar) }}" alt="{{ $prog->nama }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <div class="w-full py-lg rounded-xl text-sm font-semibold transition-all duration-300 text-center group-hover:tracking-wide text-white"
                                style="background-color: {{ $warnaHex }};">
                                Pelajari Selengkapnya</div>
                        </a>
                    @endforeach

                </div>
            </div>

            {{-- Scroll indicator dots --}}
            <div class="flex justify-center gap-3 mt-2xl">
                @foreach ($programKeahlian as $prog)
                    <button
                        onclick="document.querySelector('.horizontal-scroll').scrollTo({left: document.querySelectorAll('.snap-start')[' . $loop->index . '].offsetLeft, behavior: 'smooth'})"
                        class="w-2.5 h-2.5 rounded-full bg-outline/30 hover:bg-primary transition-all duration-300 scroll-dot hover:scale-125"
                        data-index="{{ $loop->index }}" aria-label="Scroll ke {{ $prog->nama }}"></button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- # PROGRAM KEGIATAN KEUNGGULAN (Accordion) --}}
    <section class="py-xl px-container-margin-mobile md:px-container-margin-desktop bg-surface" id="unggulan">
        <div class="text-center mb-xl">
            <h3 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-xs">Program Kegiatan Keunggulan</h3>
            <p class="font-body text-sm text-on-surface-variant mt-md max-w-xl mx-auto">
                Program unggulan dan kegiatan khas SMK Istiqomah Muhammadiyah 4 Samarinda
            </p>
        </div>

        {{-- Tombol trigger accordion --}}
        <div class="text-center mb-lg">
            <button id="unggulanToggle"
                class="inline-flex items-center gap-sm bg-secondary text-on-secondary px-xl py-md rounded-lg font-heading text-base font-bold shadow-md hover:bg-secondary-container hover:text-on-secondary transition-all"
                onclick="toggleUnggulan()">
                <span class="material-symbols-outlined">expand_more</span>
                Lihat Program Keunggulan
            </button>
        </div>

        {{-- Konten program keunggulan --}}
        <div id="unggulanContent" class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 hidden">
            @foreach ($unggulan as $u)
                @php
                    $warna = ['primary', 'secondary', 'tertiary'][$loop->index % 3];
                    $accentColor = match ($warna) {
                        'primary' => 'from-primary to-primary/60',
                        'secondary' => 'from-secondary to-secondary/60',
                        'tertiary' => 'from-tertiary to-tertiary/60',
                        default => 'from-primary to-primary/60',
                    };
                    $iconBg = match ($warna) {
                        'primary' => 'bg-primary/10 text-primary',
                        'secondary' => 'bg-secondary/10 text-secondary',
                        'tertiary' => 'bg-tertiary/10 text-tertiary',
                        default => 'bg-surface-container-high text-on-surface-variant',
                    };
                @endphp
                <div
                    class="relative bg-white rounded-2xl overflow-hidden cursor-default shadow-sm border border-outline/5">
                    @if ($u->gambar)
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $u->gambar) }}" alt="{{ $u->nama }}"
                                class="w-full aspect-video object-cover">
                            {{-- Gradient overlay bottom --}}
                            <div
                                class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-black/40 to-transparent">
                            </div>
                        </div>
                    @else
                        <div
                            class="aspect-video w-full bg-gradient-to-br {{ $accentColor }}/10 flex items-center justify-center">
                            <div
                                class="w-14 h-14 md:w-16 md:h-16 rounded-2xl {{ $iconBg }} flex items-center justify-center">
                                <span
                                    class="material-symbols-outlined text-3xl md:text-4xl">{{ $u->icon ?? 'stars' }}</span>
                            </div>
                        </div>
                    @endif
                    <div class="p-3 md:p-4">
                        <h4 class="font-heading text-xs md:text-sm font-bold text-primary leading-snug">
                            {{ $u->nama }}
                        </h4>
                        @if (!empty($u->deskripsi))
                            <p class="font-body text-[11px] text-on-surface-variant/70 mt-1 leading-relaxed line-clamp-2">
                                {{ $u->deskripsi }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- # FASILITAS SECTION (Accordion) --}}
    <section class="py-xl px-container-margin-mobile md:px-container-margin-desktop bg-surface-container-lowest"
        id="fasilitas">
        <div class="text-center mb-xl">
            <h3 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-xs">Fasilitas</h3>
            <p class="font-body text-sm text-on-surface-variant mt-md max-w-xl mx-auto">
                Berbagai fasilitas modern untuk mendukung proses belajar mengajar yang optimal
            </p>
        </div>

        {{-- Tombol trigger accordion --}}
        <div class="text-center mb-lg">
            <button id="fasilitasToggle"
                class="inline-flex items-center gap-sm bg-primary text-on-primary px-xl py-md rounded-lg font-heading text-base font-bold shadow-md hover:bg-primary-container hover:text-on-primary transition-all"
                onclick="toggleFasilitas()">
                <span class="material-symbols-outlined">expand_more</span>
                Lihat Fasilitas
            </button>
        </div>

        {{-- Konten fasilitas --}}
        <div id="fasilitasContent" class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 hidden">
            @foreach ($fasilitas as $f)
                @php
                    $warna = ['primary', 'secondary', 'tertiary'][$loop->index % 3];
                    $accentColor = match ($warna) {
                        'primary' => 'from-primary to-primary/60',
                        'secondary' => 'from-secondary to-secondary/60',
                        'tertiary' => 'from-tertiary to-tertiary/60',
                        default => 'from-primary to-primary/60',
                    };
                    $iconBg = match ($warna) {
                        'primary' => 'bg-primary/10 text-primary',
                        'secondary' => 'bg-secondary/10 text-secondary',
                        'tertiary' => 'bg-tertiary/10 text-tertiary',
                        default => 'bg-surface-container-high text-on-surface-variant',
                    };
                @endphp
                <div
                    class="relative bg-white rounded-2xl overflow-hidden cursor-default shadow-sm border border-outline/5">
                    @if ($f->gambar)
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $f->gambar) }}" alt="{{ $f->nama }}"
                                class="w-full aspect-video object-cover">
                            {{-- Gradient overlay bottom --}}
                            <div
                                class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-black/40 to-transparent">
                            </div>
                        </div>
                    @else
                        <div
                            class="aspect-video w-full bg-gradient-to-br {{ $accentColor }}/10 flex items-center justify-center">
                            <div
                                class="w-14 h-14 md:w-16 md:h-16 rounded-2xl {{ $iconBg }} flex items-center justify-center">
                                <span
                                    class="material-symbols-outlined text-3xl md:text-4xl">{{ $f->icon ?? 'home_repair_service' }}</span>
                            </div>
                        </div>
                    @endif
                    <div class="p-3 md:p-4">
                        <h4 class="font-heading text-xs md:text-sm font-bold text-primary leading-snug">
                            {{ $f->nama }}
                        </h4>
                        @if (!empty($f->deskripsi))
                            <p class="font-body text-[11px] text-on-surface-variant/70 mt-1 leading-relaxed line-clamp-2">
                                {{ $f->deskripsi }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @push('scripts')
        <script>
            function toggleFasilitas() {
                const content = document.getElementById('fasilitasContent');
                const btn = document.getElementById('fasilitasToggle');
                const icon = btn.querySelector('.material-symbols-outlined');
                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    content.classList.add('grid');
                    icon.textContent = 'expand_less';
                    btn.innerHTML = '<span class="material-symbols-outlined">expand_less</span> Sembunyikan Fasilitas';
                    // Refresh AOS agar item yang baru muncul bisa teranimasi
                    setTimeout(function() {
                        if (typeof AOS !== 'undefined') AOS.refresh();
                    }, 100);
                } else {
                    content.classList.add('hidden');
                    content.classList.remove('grid');
                    icon.textContent = 'expand_more';
                    btn.innerHTML = '<span class="material-symbols-outlined">expand_more</span> Lihat Fasilitas';
                }
            }

            function toggleUnggulan() {
                const content = document.getElementById('unggulanContent');
                const btn = document.getElementById('unggulanToggle');
                const icon = btn.querySelector('.material-symbols-outlined');
                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    content.classList.add('grid');
                    icon.textContent = 'expand_less';
                    btn.innerHTML = '<span class="material-symbols-outlined">expand_less</span> Sembunyikan Program Keunggulan';
                    // Refresh AOS agar item yang baru muncul bisa teranimasi
                    setTimeout(function() {
                        if (typeof AOS !== 'undefined') AOS.refresh();
                    }, 100);
                } else {
                    content.classList.add('hidden');
                    content.classList.remove('grid');
                    icon.textContent = 'expand_more';
                    btn.innerHTML = '<span class="material-symbols-outlined">expand_more</span> Lihat Program Keunggulan';
                }
            }
        </script>
    @endpush

    {{-- # NEWS SECTION (Compact Bento Grid) --}}
    <section class="py-xl px-container-margin-mobile md:px-container-margin-desktop bg-surface" id="news">
        {{-- Section Header --}}
        <div class="mb-lg flex items-center justify-between">
            <div>
                <h3 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-xs">Berita Terbaru</h3>
                <div class="h-1 w-12 bg-secondary rounded-full"></div>
            </div>
            <a href="{{ route('berita') }}"
                class="hidden md:inline-flex items-center gap-xs text-primary font-semibold text-xs hover:underline">
                Lihat Semua
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        {{-- Bento Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-3">

            @foreach ($berita as $index => $item)
                @php
                    $isFirst = $index === 0;
                    $isLast = $index === count($berita) - 1;
                    $borderColors = ['border-primary', 'border-secondary', 'border-outline'];
                    $gradients = [
                        ['from-primary/20', 'to-primary/5', 'text-primary/30'],
                        ['from-secondary-container/20', 'to-secondary-container/5', 'text-secondary-container/40'],
                        ['from-tertiary-container/20', 'to-tertiary-container/5', 'text-tertiary-container/40'],
                    ];
                    $g = $gradients[$index] ?? $gradients[0];
                    $delay = 0.1 + $index * 0.1;
                @endphp

                @if ($isFirst)
                    {{-- Card 1: Large Asymmetric --}}
                    <article
                        class="md:col-span-8 bg-surface-container-lowest rounded-xl overflow-hidden shadow-md border-t-4 {{ $borderColors[$index] ?? 'border-primary' }} flex flex-col md:flex-row fade-in"
                        style="animation-delay: {{ $delay }}s;">
                        <div
                            class="md:w-2/5 relative h-36 md:h-auto bg-gradient-to-br {{ $g[0] }} {{ $g[1] }} flex items-center justify-center overflow-hidden">
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <span
                                    class="material-symbols-outlined text-5xl {{ $g[2] }}">{{ $item->icon }}</span>
                            @endif
                            <span
                                class="absolute top-3 left-3 px-2 py-0.5 bg-primary text-on-primary rounded-full font-body text-xs font-semibold">{{ $item->kategori }}</span>
                        </div>
                        <div class="p-md flex flex-col flex-1">
                            <div>
                                <p class="font-body text-xs text-outline mb-xs">{{ $item->tanggal }}</p>
                                <h4
                                    class="font-heading text-lg md:text-xl font-bold text-primary mb-sm leading-snug line-clamp-2">
                                    {{ $item->judul }}</h4>
                                <p class="font-body text-sm text-on-surface-variant line-clamp-2 mb-sm">
                                    {{ $item->deskripsi }}</p>
                            </div>
                            <div class="mt-auto">
                                <a href="{{ route('berita.detail', $item->slug) }}"
                                    class="block w-full py-xs bg-primary text-on-primary rounded-lg font-body text-xs font-bold text-center hover:bg-primary-container hover:text-on-primary transition-colors">Baca
                                    Selengkapnya</a>
                            </div>
                        </div>
                    </article>
                @elseif (!$isLast)
                    {{-- Card 2: Small Card --}}
                    <article
                        class="md:col-span-4 bg-surface-container-lowest rounded-xl overflow-hidden shadow-md border-t-4 {{ $borderColors[$index] ?? 'border-secondary' }} flex flex-col fade-in"
                        style="animation-delay: {{ $delay }}s;">
                        <div
                            class="relative h-32 bg-gradient-to-br {{ $g[0] }} {{ $g[1] }} flex items-center justify-center overflow-hidden">
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <span
                                    class="material-symbols-outlined text-5xl {{ $g[2] }}">{{ $item->icon }}</span>
                            @endif
                            <span
                                class="absolute top-3 left-3 px-2 py-0.5 bg-secondary text-on-secondary rounded-full font-body text-xs font-semibold">{{ $item->kategori }}</span>
                        </div>
                        <div class="p-sm flex flex-col flex-1">
                            <p class="font-body text-xs text-outline mb-xs">{{ $item->tanggal }}</p>
                            <h4 class="font-heading text-base font-bold text-primary mb-xs leading-snug line-clamp-2">
                                {{ $item->judul }}</h4>
                            <p class="font-body text-sm text-on-surface-variant line-clamp-2 mb-sm">{{ $item->deskripsi }}
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('berita.detail', $item->slug) }}"
                                    class="block w-full py-xs bg-secondary-container text-on-secondary-container rounded-lg font-body text-xs font-bold text-center hover:bg-secondary hover:text-on-secondary transition-colors">Baca
                                    Selengkapnya</a>
                            </div>
                        </div>
                    </article>
                @else
                    {{-- Card 3 (Last): Horizontal Card --}}
                    <article
                        class="md:col-span-12 bg-surface-container-lowest rounded-xl overflow-hidden shadow-md border-t-4 {{ $borderColors[$index] ?? 'border-outline' }} flex flex-col md:flex-row fade-in"
                        style="animation-delay: {{ $delay }}s;">
                        <div
                            class="md:w-1/4 h-32 md:h-auto bg-gradient-to-br {{ $g[0] }} {{ $g[1] }} flex items-center justify-center overflow-hidden">
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <span
                                    class="material-symbols-outlined text-5xl {{ $g[2] }}">{{ $item->icon }}</span>
                            @endif
                        </div>
                        <div class="p-sm md:p-md flex-1 flex flex-col md:flex-row md:items-center justify-between gap-sm">
                            <div class="md:max-w-2xl">
                                <div class="flex items-center gap-sm mb-xs">
                                    <span
                                        class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant rounded-full font-body text-xs">{{ $item->kategori }}</span>
                                    <span class="text-outline font-body text-xs">•</span>
                                    <span class="text-outline font-body text-xs">{{ $item->tanggal }}</span>
                                </div>
                                <h4 class="font-heading text-base font-bold text-primary mb-xs line-clamp-1">
                                    {{ $item->judul }}</h4>
                                <p class="font-body text-sm text-on-surface-variant line-clamp-1">{{ $item->deskripsi }}
                                </p>
                            </div>
                            <a href="{{ route('berita.detail', $item->slug) }}"
                                class="px-4 py-1.5 border-2 border-primary text-primary rounded-lg font-body text-xs font-bold hover:bg-primary hover:text-on-primary transition-colors whitespace-nowrap text-center shrink-0">Baca
                                Selengkapnya</a>
                        </div>
                    </article>
                @endif
            @endforeach

        </div>

        {{-- Tombol Lihat Berita Lainnya --}}
        <div class="mt-lg flex justify-center">
            <a href="{{ route('berita') }}"
                class="flex items-center gap-sm px-md py-sm bg-primary text-on-primary rounded-full font-body text-xs font-semibold hover:scale-105 active:scale-95 transition-transform shadow-md">
                <span class="material-symbols-outlined text-base">refresh</span>
                Lihat Berita Lainnya
            </a>
        </div>
    </section>



    </main>

    @push('scripts')
        <script>
            // Tombol navigasi kiri/kanan untuk horizontal scroll
            (function() {
                const container = document.querySelector('.horizontal-scroll');
                if (!container) return;

                const wrapper = container.closest('.program-scroll-wrapper');
                if (!wrapper) return;

                const btnLeft = wrapper.querySelector('.scroll-btn-left');
                const btnRight = wrapper.querySelector('.scroll-btn-right');
                const dots = wrapper.querySelectorAll('.scroll-dot');

                function getGap() {
                    const styles = window.getComputedStyle(container);
                    return parseFloat(styles.columnGap || styles.gap || '0') || 0;
                }

                function getScrollAmount() {
                    const card = container.querySelector('.snap-start');
                    return card ? card.offsetWidth + getGap() : 300;
                }

                function updateButtons() {
                    const maxScroll = container.scrollWidth - container.clientWidth;
                    const atLeft = container.scrollLeft <= 5;
                    const atRight = container.scrollLeft >= maxScroll - 5;

                    if (btnLeft) {
                        btnLeft.classList.toggle('opacity-0', atLeft);
                        btnLeft.classList.toggle('pointer-events-none', atLeft);
                    }
                    if (btnRight) {
                        btnRight.classList.toggle('opacity-0', atRight);
                        btnRight.classList.toggle('pointer-events-none', atRight);
                    }

                    // Update active dot
                    if (dots.length) {
                        const step = getScrollAmount();
                        const activeIndex = Math.round(container.scrollLeft / step);
                        dots.forEach((dot, i) => {
                            dot.classList.toggle('bg-primary', i === activeIndex);
                            dot.classList.toggle('bg-outline/40', i !== activeIndex);
                            dot.classList.toggle('w-3', i === activeIndex);
                            dot.classList.toggle('w-2', i !== activeIndex);
                        });
                    }
                }

                if (btnLeft) {
                    btnLeft.addEventListener('click', function() {
                        container.scrollBy({
                            left: -getScrollAmount(),
                            behavior: 'smooth'
                        });
                    });
                }

                if (btnRight) {
                    btnRight.addEventListener('click', function() {
                        container.scrollBy({
                            left: getScrollAmount(),
                            behavior: 'smooth'
                        });
                    });
                }

                container.addEventListener('scroll', updateButtons);
                updateButtons();
            })();

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

            document.querySelectorAll('.group').forEach(el => {
                el.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-700');
                observer.observe(el);
            });
        </script>
    @endpush

@endsection
