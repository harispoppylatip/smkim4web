@extends('layouts.public')

@section('title', 'Tim Pengembang - SMKIM4')

@section('bottomNavActive', 'tentang-pengembang')

@push('styles')
    <style>
        .team-card {
            box-shadow: 0 12px 30px rgba(0, 51, 102, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 40px rgba(0, 51, 102, 0.12);
        }

        .portrait-frame {
            background:
                radial-gradient(circle at 50% 35%, rgba(252, 212, 0, 0.16), transparent 42%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.9), rgba(243, 247, 255, 0.92));
        }
    </style>
@endpush

@section('content')
    <section class="relative overflow-hidden pt-20 pb-24 md:pt-24 md:pb-28">
        <div class="absolute inset-0 bg-gradient-to-b from-white via-[#f8f9ff] to-white"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute top-28 right-0 w-96 h-96 rounded-full bg-secondary-container/20 blur-3xl pointer-events-none">
        </div>

        <div class="container mx-auto px-container-margin-mobile md:px-container-margin-desktop relative z-10">
            <div class="max-w-3xl mx-auto text-center space-y-5">
                <h1 class="font-heading text-4xl md:text-5xl font-extrabold text-primary leading-tight">
                    Membangun Wajah Digital
                    <span class="text-primary">SMKIM4</span>
                </h1>
                <p class="text-on-surface-variant text-base md:text-lg leading-relaxed max-w-2xl mx-auto">
                    Melalui kolaborasi, inovasi, dan dedikasi, kami menghadirkan website resmi yang menjadi pusat informasi
                    sekolah sekaligus mendukung transformasi digital SMK Istiqomah Muhammadiyah 4 Samarinda.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 mt-12 items-start">
                <div class="lg:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <article
                        class="team-card overflow-hidden rounded-3xl border border-outline-variant/20 bg-white/85 backdrop-blur-sm">
                        <div
                            class="portrait-frame relative min-h-[390px] flex items-end justify-center overflow-hidden px-6 pt-10">
                            <div class="absolute inset-x-8 bottom-8 h-40 rounded-full bg-primary/10 blur-2xl"></div>
                            <img alt="Hari Poppy Latip"
                                class="relative z-10 w-full max-w-[300px] object-contain drop-shadow-[0_18px_28px_rgba(0,51,102,0.14)]"
                                src="{{ asset('tim/haris.png') }}" />
                        </div>
                        <div class="p-6 text-center border-t border-outline-variant/20">
                            <h3 class="font-heading text-xl font-bold text-primary">Hari Poppy Latip</h3>
                            <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-on-surface-variant">Full
                                Stack Developer</p>
                            <p class="mt-4 text-sm leading-relaxed text-on-surface-variant">
                                Mengelola struktur, fitur, dan pengembangan teknis utama agar website tetap stabil,
                                cepat, dan mudah dirawat.
                            </p>
                        </div>
                    </article>

                    <article
                        class="team-card overflow-hidden rounded-3xl border border-outline-variant/20 bg-white/85 backdrop-blur-sm">
                        <div
                            class="portrait-frame relative min-h-[390px] flex items-end justify-center overflow-hidden px-6 pt-10">
                            <div class="absolute inset-x-8 bottom-8 h-40 rounded-full bg-secondary-container/20 blur-2xl">
                            </div>
                            <img alt="Yusuf Sardani"
                                class="relative z-10 w-full max-w-[300px] object-contain drop-shadow-[0_18px_28px_rgba(0,51,102,0.14)]"
                                src="{{ asset('tim/yusuf.png') }}" />
                        </div>
                        <div class="p-6 text-center border-t border-outline-variant/20">
                            <h3 class="font-heading text-xl font-bold text-primary">Yusuf Sardani</h3>
                            <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-on-surface-variant">Desain
                                UI/UX</p>
                            <p class="mt-4 text-sm leading-relaxed text-on-surface-variant">
                                Menjaga tampilan tetap nyaman, berkarakter, dan konsisten dengan identitas visual
                                sekolah.
                            </p>
                        </div>
                    </article>
                </div>

                <div class="lg:col-span-5 space-y-6 lg:sticky lg:top-24">
                    <div
                        class="rounded-3xl border border-outline-variant/20 bg-surface-container-lowest/90 backdrop-blur-sm p-7 shadow-[0_12px_28px_rgba(0,51,102,0.08)]">
                        <h2 class="mt-4 font-heading text-2xl md:text-3xl font-bold text-primary leading-tight">
                            Menghadirkan Wajah Digital Baru SMKIM4
                        </h2>
                        <div
                            class="mt-4 space-y-4 text-sm md:text-base leading-relaxed text-justify text-on-surface-variant">
                            <p>
                                Saya, <strong class="text-on-surface">Hari Poppy Latip</strong>, alumni SMK Istiqomah
                                Muhammadiyah 4 Samarinda angkatan 2024, bersama
                                rekan saya <strong class="text-on-surface">Yusuf Sardani</strong>, mengembangkan website ini
                                sebagai bagian dari program kerja
                                Praktik Kerja Lapangan (PKL).
                            </p>

                            <p>
                                Website ini dirancang untuk menghadirkan wajah digital yang lebih modern, sederhana, dan
                                informatif bagi SMK Istiqomah Muhammadiyah 4 Samarinda. Dengan tampilan yang lebih responsif
                                serta penyajian informasi yang cepat dan mudah diakses, kami berharap website ini dapat
                                menjadi
                                media informasi resmi yang bermanfaat bagi siswa, guru, orang tua, alumni, maupun masyarakat
                                luas.
                            </p>

                            <p>
                                Semoga website ini dapat terus berkembang dan memberikan kontribusi positif dalam mendukung
                                kemajuan serta citra SMK Istiqomah Muhammadiyah 4 Samarinda di era digital.
                            </p>
                        </div>
                    </div>

                    {{-- <div class="grid gap-4">
                        <div
                            class="flex items-start gap-4 rounded-3xl border border-outline-variant/20 bg-white p-5 shadow-[0_8px_22px_rgba(0,51,102,0.07)]">
                            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary text-2xl">code</span>
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-primary text-lg">Pengembangan Sistem</h4>
                                <p class="mt-1 text-sm leading-relaxed text-on-surface-variant">
                                    Struktur fitur disusun agar ringan, konsisten, dan mudah dipelihara.
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-4 rounded-3xl border border-outline-variant/20 bg-white p-5 shadow-[0_8px_22px_rgba(0,51,102,0.07)]">
                            <div
                                class="w-12 h-12 rounded-2xl bg-secondary-container/20 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-secondary text-2xl">palette</span>
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-primary text-lg">Desain &amp; Pengalaman</h4>
                                <p class="mt-1 text-sm leading-relaxed text-on-surface-variant">
                                    Visual lebih tenang, lebih bersih, dan tetap menonjolkan identitas sekolah.
                                </p>
                            </div>
                        </div>
                    </div> --}}
                </div>

            </div>

            <div class="mt-12 mx-auto max-w-3xl rounded-3xl border border-outline-variant/20 bg-primary/5 p-6 md:p-8">
                <div class="flex gap-4 items-start text-on-surface-variant md:items-center md:justify-center">
                    <span class="material-symbols-outlined text-primary text-4xl opacity-25 select-none">format_quote</span>
                    <p class="text-sm md:text-[15px] leading-relaxed font-medium italic md:text-center">
                        "Kami percaya bahwa sebuah website bukan hanya media informasi, tetapi juga representasi
                        identitas dan kemajuan sebuah sekolah di era digital."
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Tidak ada interaksi 3D berat agar nyaman di mobile.
    </script>
@endpush
