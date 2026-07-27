@extends('layouts.public')

@section('title', 'Contact Us - SMKIM4')

@section('bottomNavActive', 'contact')

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
    </style>
@endpush

@section('content')

    <main class="px-container-margin-mobile md:px-container-margin-desktop mt-lg max-w-7xl mx-auto">

        {{-- ==================== SECTION HEADER ==================== --}}
        <div class="mb-lg text-center md:text-left">
            <h2 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-xs">Contact Us</h2>
            <div class="h-1 w-12 bg-secondary rounded-full md:mx-0 mx-auto"></div>
            <p class="font-body text-sm text-on-surface-variant mt-md max-w-xl md:mx-0 mx-auto">
                Hubungi kami untuk informasi lebih lanjut tentang pendaftaran, program keahlian, atau kunjungan ke
                sekolah.
            </p>
        </div>

        {{-- ==================== CONTACT GRID ==================== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- LEFT: Contact Info Cards --}}
            <div class="space-y-4">

                {{-- Info Card: Alamat --}}
                <div class="bg-surface-container-lowest rounded-xl overflow-hidden card-shadow border-l-4 border-primary p-lg flex items-start gap-md fade-in"
                    style="animation-delay: 0.1s;">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-primary">location_on</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-base font-bold text-primary mb-xs">Alamat</h3>
                        <p class="font-body text-sm text-on-surface-variant leading-relaxed">
                            Kompleks Perguruan Muhammadiyah<br>
                            Jl. A. Wahab Syahranie, RT.25, Air Hitam<br>
                            Kec. Samarinda Ulu, Kota Samarinda<br>
                            Kalimantan Timur 75124
                        </p>
                    </div>
                </div>

                {{-- Info Card: Telepon --}}
                <div class="bg-surface-container-lowest rounded-xl overflow-hidden card-shadow border-l-4 border-primary p-lg flex items-start gap-md fade-in"
                    style="animation-delay: 0.2s;">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-primary">call</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-base font-bold text-primary mb-xs">Telepon</h3>
                        <p class="font-body text-sm text-on-surface-variant">
                            <a href="tel:0541747366" class="hover:text-primary transition-colors">0541 747366</a>
                        </p>
                    </div>
                </div>

                {{-- Info Card: Email --}}
                <div class="bg-surface-container-lowest rounded-xl overflow-hidden card-shadow border-l-4 border-primary p-lg flex items-start gap-md fade-in"
                    style="animation-delay: 0.3s;">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-primary">mail</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-base font-bold text-primary mb-xs">Email</h3>
                        <p class="font-body text-sm text-on-surface-variant">
                            info@smkim4samarinda.sch.id
                        </p>
                    </div>
                </div>

                {{-- Info Card: Jam Operasional --}}
                <div class="bg-surface-container-lowest rounded-xl overflow-hidden card-shadow border-l-4 border-primary p-lg flex items-start gap-md fade-in"
                    style="animation-delay: 0.4s;">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-primary">schedule</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-base font-bold text-primary mb-xs">Jam Operasional</h3>
                        <div class="space-y-1 font-body text-sm text-on-surface-variant">
                            <div class="flex items-center gap-sm">
                                <span class="w-28 text-xs font-semibold text-outline">Senin - Sabtu</span>
                                <span>07.00 - 17.00 WITA</span>
                            </div>
                            <div class="flex items-center gap-sm">
                                <span class="w-28 text-xs font-semibold text-outline">Minggu</span>
                                <span class="text-outline">Libur</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Social Media --}}
                <div class="bg-surface-container-lowest rounded-xl overflow-hidden card-shadow p-lg fade-in"
                    style="animation-delay: 0.5s;">
                    <h3 class="font-heading text-base font-bold text-primary mb-md">Ikuti Kami</h3>
                    <div class="flex gap-3">
                        {{-- YouTube --}}
                        <a href="{{ $social->youtube ?? config('social.youtube') }}" target="_blank"
                            rel="noopener noreferrer"
                            class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary hover:bg-red-600 hover:text-white hover:scale-110 transition-all duration-200"
                            aria-label="YouTube">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                        {{-- Instagram --}}
                        <a href="{{ $social->instagram ?? config('social.instagram') }}" target="_blank"
                            rel="noopener noreferrer"
                            class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary hover:bg-gradient-to-tr hover:from-purple-600 hover:via-pink-500 hover:to-yellow-500 hover:text-white hover:scale-110 transition-all duration-200"
                            aria-label="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z" />
                            </svg>
                        </a>
                        {{-- Facebook --}}
                        <a href="{{ $social->facebook ?? config('social.facebook') }}" target="_blank"
                            rel="noopener noreferrer"
                            class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary hover:bg-blue-600 hover:text-white hover:scale-110 transition-all duration-200"
                            aria-label="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        {{-- TikTok --}}
                        <a href="{{ $social->tiktok ?? config('social.tiktok') }}" target="_blank" rel="noopener noreferrer"
                            class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary hover:bg-black hover:text-white hover:scale-110 transition-all duration-200"
                            aria-label="TikTok">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            {{-- RIGHT: Map --}}
            <div class="md:sticky md:top-24 md:self-start">
                <div class="bg-surface-container-lowest rounded-xl overflow-hidden card-shadow fade-in h-full"
                    style="animation-delay: 0.3s;">
                    <div class="p-lg">
                        <h3 class="font-heading text-base font-bold text-primary mb-xs">Lokasi Kami</h3>
                        <p class="font-body text-xs text-on-surface-variant">Kompleks Perguruan Muhammadiyah, Jl. A. Wahab
                            Syahranie, Samarinda</p>
                    </div>
                    <div class="h-64 md:h-[520px]">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.8765!2d117.1383176!3d-0.4649263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df678cd9a48dcb3%3A0x313e5b2c487c1393!2sSMK%20Muhammadiyah%20Istiqomah%204%20Samarinda!5e0!3m2!1sid!2sid!4v1"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" class="w-full h-full">
                        </iframe>
                    </div>
                </div>
            </div>

        </div>

    </main>

@endsection
