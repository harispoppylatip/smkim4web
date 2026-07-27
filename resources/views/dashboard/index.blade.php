@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    {{-- Stats Cards --}}
    <div class="stats-grid mb-6">
        {{-- Total Program Keahlian --}}
        <div class="stat-card animate-fade-in">
            <div class="flex items-center justify-between mb-3">
                <div class="stat-icon bg-[#d5e3ff] text-[#003366]">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                </div>
                <span class="badge badge-info">Total</span>
            </div>
            <p class="stat-value">{{ $programKeahlian->count() }}</p>
            <p class="stat-label">Program Keahlian</p>
            <div class="mt-3 flex items-center gap-2 text-xs text-[#737780]">
                @foreach ($programKeahlian as $prog)
                    <span class="px-2 py-0.5 rounded-full bg-[#f3f3f6] font-medium">{{ $prog->singkatan }}</span>
                @endforeach
            </div>
        </div>

        {{-- Total Berita --}}
        <div class="stat-card animate-fade-in-delay-3">
            <div class="flex items-center justify-between mb-3">
                <div class="stat-icon bg-[#d5f5e3] text-[#1a7a3a]">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                <span class="badge badge-success">Terbaru</span>
            </div>
            <p class="stat-value">{{ $totalBerita }}</p>
            <p class="stat-label">Total Berita</p>
            <div class="mt-3 flex items-center gap-1 text-xs text-[#2e7d32]">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                <span>{{ $berita->first()?->tanggal ?? 'Belum ada berita' }}</span>
            </div>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="dashboard-grid-2">
        {{-- Left Column - Berita Terbaru --}}
        <div class="space-y-6">
            {{-- Berita Terbaru --}}
            <div class="card p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="section-title mb-0">Berita Terbaru</h2>
                    <a href="{{ route('admin.berita.index') }}"
                        class="text-sm font-medium text-[#003366] hover:underline">Lihat Semua</a>
                </div>
                <div class="space-y-3">
                    @forelse ($berita as $item)
                        <a href="#"
                            class="block p-4 rounded-lg bg-[#f8f9fc] hover:bg-[#eef1f7] transition-colors border border-[#e8eaef]">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0
                                {{ $item->kategori === 'TKJT' ? 'bg-[#d5e3ff] text-[#003366]' : ($item->kategori === 'DKV' ? 'bg-[#fff3cd] text-[#705d00]' : 'bg-[#e8f5e9] text-[#1a7a3a]') }}">
                                    <span class="text-lg font-bold">{{ substr($item->kategori, 0, 1) }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span
                                            class="text-[10px] font-semibold uppercase tracking-wider
                                        {{ $item->kategori === 'TKJT' ? 'text-[#003366]' : ($item->kategori === 'DKV' ? 'text-[#705d00]' : 'text-[#1a7a3a]') }}">
                                            {{ $item->kategori }}
                                        </span>
                                        <span class="text-[10px] text-[#9a9ea8]">&bull;</span>
                                        <span class="text-[10px] text-[#9a9ea8]">{{ $item->tanggal }}</span>
                                    </div>
                                    <p class="text-sm font-semibold text-[#1a1c1e] leading-snug">{{ $item->judul }}</p>
                                    <p class="text-xs text-[#737780] mt-1 line-clamp-2">{{ $item->deskripsi }}</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-8 text-[#737780]">
                            <svg class="w-12 h-12 mx-auto mb-3 text-[#c4c7cc]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                            <p class="text-sm font-medium">Belum ada berita</p>
                            <a href="{{ route('admin.berita.create') }}"
                                class="text-xs text-[#003366] hover:underline mt-1 inline-block">Tulis berita pertama</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="space-y-6">
            {{-- Aksi Cepat --}}
            <div class="card p-5">
                <h2 class="section-title">Aksi Cepat</h2>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.berita.create') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-xl bg-[#f3f3f6] hover:bg-[#e8e8ea] hover:shadow-sm transition-all text-center group">
                        <div
                            class="w-11 h-11 rounded-xl bg-[#d5e3ff] flex items-center justify-center text-[#003366] group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-[#1a1c1e]">Tambah Berita</span>
                    </a>
                    <a href="{{ route('admin.program-keahlian.index') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-xl bg-[#f3f3f6] hover:bg-[#e8e8ea] hover:shadow-sm transition-all text-center group">
                        <div
                            class="w-11 h-11 rounded-xl bg-[#fff3cd] flex items-center justify-center text-[#705d00] group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-[#1a1c1e]">Program Keahlian</span>
                    </a>
                    <a href="{{ route('admin.berita.index') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-xl bg-[#f3f3f6] hover:bg-[#e8e8ea] hover:shadow-sm transition-all text-center group">
                        <div
                            class="w-11 h-11 rounded-xl bg-[#d5f5e3] flex items-center justify-center text-[#1a7a3a] group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-[#1a1c1e]">Kelola Berita</span>
                    </a>
                    <a href="{{ route('dashboard') }}"
                        class="flex flex-col items-center gap-2 p-4 rounded-xl bg-[#f3f3f6] hover:bg-[#e8e8ea] hover:shadow-sm transition-all text-center group">
                        <div
                            class="w-11 h-11 rounded-xl bg-[#fde8e8] flex items-center justify-center text-[#ba1a1a] group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-[#1a1c1e]">Beranda</span>
                    </a>
                </div>
            </div>

            {{-- Program Keahlian Overview --}}
            <div class="card p-5">
                <h2 class="section-title">Program Keahlian</h2>
                <div class="space-y-3">
                    @foreach ($programKeahlian as $prog)
                        <div
                            class="p-4 rounded-xl border-l-4 {{ $loop->first ? 'border-[#003366]' : 'border-[#fcd400]' }} bg-[#f8f9fc] hover:bg-[#eef1f7] transition-colors">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold
                                    {{ $loop->first ? 'bg-[#d5e3ff] text-[#003366]' : 'bg-[#fff3cd] text-[#705d00]' }}">
                                        {{ substr($prog->singkatan, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-semibold text-[#1a1c1e]">{{ $prog->singkatan }}</h3>
                                        <p class="text-[10px] text-[#737780]">{{ $prog->nama }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('admin.program-keahlian.index') }}"
                                    class="text-[#003366] hover:underline text-xs">Kelola</a>
                            </div>
                            <div class="flex flex-wrap items-center gap-1.5 mt-3">
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-medium bg-[#e8f0fe] text-[#003366]">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    {{ $prog->kompetensi_count }} Kompetensi
                                </span>
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-medium bg-[#e8f0fe] text-[#003366]">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    {{ $prog->mata_pelajaran_count }} Mapel
                                </span>
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-medium bg-[#fce8e8] text-[#ba1a1a]">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                    {{ $prog->prestasi_count }} Prestasi
                                </span>
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-medium bg-[#e8f5e9] text-[#1a7a3a]">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $prog->guru_count }} Guru
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
