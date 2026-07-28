@extends('layouts.public')

@section('title', 'Tim Pengembang - SMKIM4')

@section('bottomNavActive', 'tentang-pengembang')

@push('styles')
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 48;
        }

        .profile-card-container {
            perspective: 1500px;
        }

        .profile-card {
            transition: transform 0.4s cubic-bezier(0.2, 0, 0.2, 1);
            transform-style: preserve-3d;
        }

        .character-mask {
            position: relative;
            height: 420px;
            width: 100%;
            overflow: visible;
        }

        .background-blob {
            position: absolute;
            bottom: 10%;
            left: 50%;
            transform: translateX(-50%);
            width: 85%;
            height: 70%;
            background: linear-gradient(135deg, rgba(232, 232, 234, 0.4) 0%, rgba(213, 227, 255, 0.3) 100%);
            border-radius: 40% 60% 60% 40% / 60% 30% 70% 40%;
            z-index: 1;
            backdrop-filter: blur(8px);
            transition: all 0.5s ease;
        }

        .character-image {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%) translateZ(60px) scale(1.1);
            height: 105%;
            width: auto;
            z-index: 10;
            pointer-events: none;
            filter: drop-shadow(0 20px 30px rgba(0, 0, 0, 0.12));
            transition: transform 0.4s cubic-bezier(0.2, 0, 0.2, 1);
        }

        .profile-card:hover .background-blob {
            border-radius: 50%;
            transform: translateX(-50%) scale(1.05);
            background: linear-gradient(135deg, rgba(213, 227, 255, 0.5) 0%, rgba(252, 212, 0, 0.1) 100%);
        }

        .profile-card:hover .character-image {
            transform: translateX(-50%) translateZ(100px) scale(1.15);
        }

        .bg-dots {
            background-image: radial-gradient(#003366 0.8px, transparent 0.8px);
            background-size: 32px 32px;
            opacity: 0.04;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <section class="relative min-h-[70vh] pt-16 pb-20 overflow-hidden">
        {{-- Dot Background --}}
        <div class="absolute inset-0 bg-dots pointer-events-none"></div>

        <div class="container mx-auto px-container-margin-mobile md:px-container-margin-desktop relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">

                {{-- Left Side: Profile Cards --}}
                <div class="lg:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
                    {{-- Card 1: Hari Poppy Latip --}}
                    <div class="profile-card-container">
                        <div class="profile-card flex flex-col items-center relative overflow-visible h-[540px]">
                            <div class="character-mask">
                                <div class="background-blob shadow-sm"></div>
                                <img alt="Hari Poppy Latip" class="character-image object-contain"
                                    src="{{ asset('tim/haris.png') }}" />
                            </div>
                            <div
                                class="mt-4 w-[90%] bg-white/80 backdrop-blur-md border border-outline-variant/30 shadow-xl rounded-2xl py-5 px-6 text-center transform translate-z-[40px]">
                                <h3 class="font-bold text-primary text-lg font-heading">Hari Poppy Latip</h3>
                                <p class="text-on-surface-variant text-xs font-semibold uppercase tracking-wider mt-1">Full
                                    Stack Developer</p>
                            </div>
                        </div>
                    </div>

                    {{-- Card 2: Yusuf Sardani --}}
                    <div class="profile-card-container">
                        <div class="profile-card flex flex-col items-center relative overflow-visible h-[540px]">
                            <div class="character-mask">
                                <div class="background-blob shadow-sm"
                                    style="background: linear-gradient(135deg, rgba(232, 232, 234, 0.4) 0%, rgba(252, 212, 0, 0.15) 100%);">
                                </div>
                                <img alt="Yusuf Sardani" class="character-image object-contain"
                                    src="{{ asset('tim/yusuf.png') }}" />
                            </div>
                            <div
                                class="mt-4 w-[90%] bg-white/80 backdrop-blur-md border border-outline-variant/30 shadow-xl rounded-2xl py-5 px-6 text-center transform translate-z-[40px]">
                                <h3 class="font-bold text-primary text-lg font-heading">Yusuf Sardani</h3>
                                <p class="text-on-surface-variant text-xs font-semibold uppercase tracking-wider mt-1">
                                    Desain UI/UX</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Side: Content --}}
                <div class="lg:col-span-5 space-y-12 self-center">
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <span class="text-primary font-extrabold text-xs uppercase tracking-[0.2em]">The Minds
                                Behind</span>
                            <div class="h-px flex-1 bg-outline-variant/50"></div>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-extrabold text-primary leading-[1.1] font-heading">
                            Karya Digital Untuk
                            <span class="relative inline-block">
                                <span class="relative z-10 text-primary">Sekolah Kami</span>
                                <span
                                    class="absolute bottom-1 left-0 w-full h-3 bg-secondary-container -z-0 opacity-80"></span>
                            </span>
                        </h1>
                        <p class="text-on-surface-variant text-lg leading-relaxed font-medium opacity-90">
                            Website ini hadir sebagai wujud nyata kolaborasi kreatif — memadukan
                            keahlian teknis dan sentuhan desain untuk membangun identitas digital
                            SMK Istiqomah Muhammadiyah 4 Samarinda.
                        </p>
                    </div>

                    {{-- Feature Cards --}}
                    <div class="grid grid-cols-1 gap-4">
                        <div
                            class="flex items-start gap-6 bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/20 shadow-sm hover:shadow-md hover:border-primary/20 transition-all group">
                            <div
                                class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center shrink-0 group-hover:bg-primary transition-colors">
                                <span
                                    class="material-symbols-outlined text-primary text-3xl group-hover:text-white">code</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-primary text-lg font-heading">Pengembangan Sistem</h4>
                                <p class="text-on-surface-variant text-sm mt-1 leading-relaxed">
                                    Merancang dan mengembangkan website dengan teknologi modern, performa tinggi,
                                    dan responsivitas penuh.
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-6 bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/20 shadow-sm hover:shadow-md hover:border-secondary/20 transition-all group">
                            <div
                                class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center shrink-0 group-hover:bg-secondary-container transition-colors">
                                <span
                                    class="material-symbols-outlined text-secondary text-3xl group-hover:text-on-secondary-container">palette</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-primary text-lg font-heading">Desain &amp; Pengalaman</h4>
                                <p class="text-on-surface-variant text-sm mt-1 leading-relaxed">
                                    Mendesain antarmuka yang intuitif dan estetik, memastikan setiap interaksi
                                    pengguna terasa mulus.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Quote --}}
                    <div class="pt-8 border-t border-outline-variant/30">
                        <div class="flex gap-4 items-start italic text-on-surface-variant">
                            <span
                                class="material-symbols-outlined text-primary text-4xl opacity-20 select-none">format_quote</span>
                            <p class="text-[15px] leading-relaxed font-medium">
                                "Bersama, kami wujudkan website yang bukan hanya fungsional, tapi juga
                                membanggakan — untuk sekolah, dan untuk generasi penerus."
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.profile-card-container').forEach(container => {
            const card = container.querySelector('.profile-card');

            container.addEventListener('mousemove', (e) => {
                const rect = container.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = ((y - centerY) / centerY) * -8;
                const rotateY = ((x - centerX) / centerX) * 8;

                card.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });

            container.addEventListener('mouseleave', () => {
                card.style.transform = 'rotateX(0deg) rotateY(0deg)';
            });
        });
    </script>
@endpush
