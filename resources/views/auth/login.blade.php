@extends('layouts.public')

@section('title', 'Login - SMKIM4')
@section('bottomNavActive', 'home')

@section('content')
    <div
        class="min-h-[calc(100vh-8rem)] flex items-center justify-center px-container-margin-mobile md:px-container-margin-desktop py-xl">
        <div class="w-full max-w-md">
            <div class="bg-surface-container-lowest rounded-xl card-shadow p-lg md:p-xl">
                {{-- Header --}}
                <div class="text-center mb-lg">
                    <div class="w-20 h-20 flex items-center justify-center mx-auto mb-md">
                        <img src="{{ asset('gambar/logoim4.jpeg') }}" alt="SMKIM4" class="w-full h-full object-contain">
                    </div>
                    <h2 class="font-heading text-2xl font-bold text-primary">Masuk</h2>
                    <p class="font-body text-sm text-on-surface-variant mt-sm">Masuk ke dashboard admin SMKIM4</p>
                </div>

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div
                        class="bg-error-container text-on-error-container rounded-lg p-md mb-lg flex items-center gap-sm text-sm">
                        <span class="material-symbols-outlined text-sm">error</span>
                        <span>{{ $errors->first('email') }}</span>
                    </div>
                @endif

                {{-- Success Message --}}
                @if (session('status'))
                    <div class="bg-primary/10 text-primary rounded-lg p-md mb-lg flex items-center gap-sm text-sm">
                        <span class="material-symbols-outlined text-sm">check_circle</span>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-md">
                    @csrf

                    <div>
                        <label class="font-body text-xs font-semibold text-on-surface-variant mb-xs block">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-md py-sm rounded-lg border border-outline-variant bg-surface text-on-surface font-body text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-outline"
                            placeholder="admin@smkistiqomah.sch.id">
                    </div>

                    <div>
                        <label class="font-body text-xs font-semibold text-on-surface-variant mb-xs block">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-md py-sm rounded-lg border border-outline-variant bg-surface text-on-surface font-body text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-outline"
                            placeholder="Masukkan password">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-sm cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary">
                            <span class="font-body text-xs text-on-surface-variant">Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full py-md bg-primary text-on-primary rounded-lg font-heading text-sm font-bold hover:bg-primary-container transition-colors shadow-lg flex items-center justify-center gap-sm">
                        <span class="material-symbols-outlined">login</span>
                        Masuk
                    </button>
                </form>

                {{-- Back link --}}
                <div class="text-center mt-lg">
                    <a href="{{ route('home') }}"
                        class="font-body text-xs text-primary hover:underline inline-flex items-center gap-xs">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .card-shadow {
                box-shadow: 0px 4px 12px rgba(0, 51, 102, 0.08);
            }
        </style>
    @endpush
@endsection
