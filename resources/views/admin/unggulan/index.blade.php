@extends('layouts.app')

@section('title', 'Kelola Program Unggulan')
@section('page_title', 'Kelola Program Unggulan')

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
        <p class="text-sm text-[#737780]">Kelola program kegiatan keunggulan sekolah</p>
        <a href="{{ route('admin.unggulan.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Program Unggulan
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-[#e2e2e5] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#f3f3f6] text-left">
                        <th class="px-4 py-3 font-semibold text-[#43474f]">No</th>
                        <th class="px-4 py-3 font-semibold text-[#43474f]">Gambar</th>
                        <th class="px-4 py-3 font-semibold text-[#43474f]">Nama</th>
                        <th class="px-4 py-3 font-semibold text-[#43474f]">Icon</th>
                        <th class="px-4 py-3 font-semibold text-[#43474f]">Urutan</th>
                        <th class="px-4 py-3 font-semibold text-[#43474f] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e2e2e5]">
                    @forelse ($unggulan as $item)
                        <tr class="hover:bg-[#f9f9fc] transition-colors">
                            <td class="px-4 py-3 text-[#737780]">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                        class="w-12 h-8 rounded object-contain border border-[#e2e2e5] bg-[#f3f3f6]">
                                @else
                                    <span class="material-symbols-outlined text-[#737780] text-lg">image</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-[#1a1c1e]">{{ $item->nama }}</td>
                            <td class="px-4 py-3">
                                @if ($item->icon)
                                    <span class="material-symbols-outlined text-[#001e40]">{{ $item->icon }}</span>
                                @else
                                    <span class="text-[#737780]">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-[#737780]">{{ $item->urutan }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.unggulan.edit', $item) }}"
                                        class="p-1.5 rounded-lg text-[#737780] hover:bg-[#f3f3f6] hover:text-[#001e40] transition-colors"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.unggulan.destroy', $item) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus program unggulan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 rounded-lg text-[#737780] hover:bg-[#fef2f2] hover:text-red-600 transition-colors"
                                            title="Hapus">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-[#737780]">
                                Belum ada program unggulan. <a href="{{ route('admin.unggulan.create') }}"
                                    class="text-[#001e40] font-semibold underline">Tambah sekarang</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
