@extends('layouts.app')

@section('title', 'Profil Admin')
@section('page_title', 'Profil Admin')

@section('content')
    {{-- Success Alert --}}
    @if (session('success'))
        <div class="flex items-center gap-3 bg-[#e8f5e9] text-[#2e7d32] rounded-lg p-4 mb-6 text-sm">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Error Alert --}}
    @if ($errors->any())
        <div class="flex items-center gap-3 bg-[#fff1f1] text-[#ba1a1a] rounded-lg p-4 mb-6 text-sm">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Edit Profil --}}
        <div class="bg-white rounded-xl border border-[#e2e2e5] overflow-hidden">
            <div class="px-6 py-4 bg-[#f9f9fc] border-b border-[#e2e2e5] flex items-center gap-3">
                <span class="material-symbols-outlined text-[#001e40]">person</span>
                <h3 class="text-sm font-semibold text-[#1a1c1e]">Informasi Akun</h3>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('admin.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                            class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                            class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">Bergabung Sejak</label>
                        <input type="text" value="{{ auth()->user()->created_at->format('d F Y') }}" disabled
                            class="form-input w-full rounded-lg border border-[#e2e2e5] bg-[#f9f9fc] p-2 text-sm text-[#737780] cursor-not-allowed">
                    </div>

                    <button type="submit"
                        class="px-4 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">Simpan
                        Profil</button>
                </form>
            </div>
        </div>

        {{-- Ganti Password --}}
        <div class="bg-white rounded-xl border border-[#e2e2e5] overflow-hidden">
            <div class="px-6 py-4 bg-[#f9f9fc] border-b border-[#e2e2e5] flex items-center gap-3">
                <span class="material-symbols-outlined text-[#001e40]">lock</span>
                <h3 class="text-sm font-semibold text-[#1a1c1e]">Ganti Password</h3>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('admin.profile.password') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">Password Saat Ini</label>
                        <input type="password" name="current_password" required
                            class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">Password Baru</label>
                        <input type="password" name="password" required minlength="8"
                            class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                        <p class="text-xs text-[#737780] mt-1">Minimal 8 karakter.</p>
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" required minlength="8"
                            class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                    </div>

                    <button type="submit"
                        class="px-4 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">Ubah
                        Password</button>
                </form>
            </div>
        </div>
    </div>
@endsection


