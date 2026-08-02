@extends('layouts.app')

@section('title', 'Manajemen User')
@section('page_title', 'Manajemen User')

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
    @if (session('error'))
        <div class="flex items-center gap-3 bg-[#fff1f1] text-[#ba1a1a] rounded-lg p-4 mb-6 text-sm">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <p class="text-sm text-[#737780]">Kelola pengguna yang dapat mengakses dashboard</p>
            <p class="text-xs text-[#737780] mt-1">
                <span class="inline-flex items-center gap-1">
                    <strong class="font-semibold">Admin</strong> = akses semua menu
                </span>
                <span class="inline-flex items-center gap-1 ml-3">
                    <strong class="font-semibold">Editor</strong> = hanya kelola berita
                </span>
            </p>
        </div>
        <a href="{{ route('admin.users.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah User
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-[#e2e2e5] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#f3f3f6] text-left">
                        <th class="px-4 py-3 font-semibold text-[#43474f]">No</th>
                        <th class="px-4 py-3 font-semibold text-[#43474f]">Nama</th>
                        <th class="px-4 py-3 font-semibold text-[#43474f]">Email</th>
                        <th class="px-4 py-3 font-semibold text-[#43474f]">Role</th>
                        <th class="px-4 py-3 font-semibold text-[#43474f]">Bergabung</th>
                        <th class="px-4 py-3 font-semibold text-[#43474f] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e2e2e5]">
                    @forelse ($users as $item)
                        <tr class="hover:bg-[#f9f9fc] transition-colors">
                            <td class="px-4 py-3 text-[#737780]">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-[#003366] flex items-center justify-center text-white text-xs font-semibold shrink-0">
                                        {{ strtoupper(substr($item->name, 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-[#1a1c1e]">
                                        {{ $item->name }}
                                        @if ($item->id === auth()->id())
                                            <span class="text-xs text-[#737780] font-normal">(Anda)</span>
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-[#43474f]">{{ $item->email }}</td>
                            <td class="px-4 py-3">
                                @if ($item->isAdmin())
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#d5e3ff] text-[#003366]">
                                        Admin
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#fff3cd] text-[#705d00]">
                                        Editor
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-[#737780]">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $item->id) }}"
                                        class="p-1.5 rounded-lg text-[#737780] hover:bg-[#f3f3f6] hover:text-[#001e40] transition-colors"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    @if ($item->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.users.destroy', $item->id) }}"
                                            onsubmit="return confirm('Hapus user {{ $item->name }}?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-1.5 rounded-lg text-[#737780] hover:bg-[#ffebee] hover:text-[#ba1a1a] transition-colors"
                                                title="Hapus">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-[#737780]">
                                Belum ada user.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
