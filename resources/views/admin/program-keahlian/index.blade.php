@extends('layouts.app')

@section('title', 'Kelola Program Keahlian')
@section('page_title', 'Kelola Program Keahlian')

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

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <p class="text-sm text-[#737780]">Kelola program keahlian SMK Istiqomah Muhammadiyah 4 Samarinda</p>
    </div>

    {{-- Program Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse ($programs as $program)
            <div class="bg-white rounded-xl border border-[#e2e2e5] p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-[#1a1c1e]">{{ $program->nama }}</h3>
                        <p class="text-xs text-[#737780] mt-0.5">{{ $program->singkatan }}</p>
                        <p class="text-sm text-[#43474f] mt-2 line-clamp-2">{{ $program->deskripsi_singkat }}</p>

                        {{-- Stats --}}
                        <div class="flex items-center gap-4 mt-3 text-xs text-[#737780]">
                            <span>{{ $program->kompetensi->count() }} Kompetensi</span>
                            <span>{{ $program->prestasi->count() }} Prestasi</span>
                            <span>{{ $program->sertifikat->count() }} Sertifikat</span>
                        </div>
                    </div>

                    {{-- Action --}}
                    <a href="{{ route('admin.program-keahlian.edit', $program->id) }}"
                        class="p-2 rounded-lg text-[#737780] hover:bg-[#f3f3f6] hover:text-[#001e40] transition-colors shrink-0"
                        title="Edit">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8 text-[#737780]">
                Belum ada program keahlian.
            </div>
        @endforelse
    </div>
@endsection
