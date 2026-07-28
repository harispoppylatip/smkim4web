@extends('layouts.app')

@section('title', $editMode ? 'Edit Program Unggulan' : 'Tambah Program Unggulan')
@section('page_title', $editMode ? 'Edit Program Unggulan' : 'Tambah Program Unggulan')

@section('content')
    <div class="max-w-2xl">
        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="bg-[#fce4ec] border border-[#f5b7c1] text-[#981b1b] px-5 py-4 rounded-xl text-sm font-medium mb-6">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Terjadi kesalahan:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-xs pl-7">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
            action="{{ $editMode ? route('admin.unggulan.update', $unggulan) : route('admin.unggulan.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if ($editMode)
                @method('PUT')
            @endif

            {{-- Nama --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-[#1a1c1e] mb-1.5">Nama Program</label>
                <input type="text" name="nama"
                    class="w-full px-3 py-2 border border-[#c3c6d1] rounded-lg text-sm focus:outline-none focus:border-[#001e40] focus:ring-2 focus:ring-[#001e40]/20 @error('nama') border-red-500 @enderror"
                    value="{{ old('nama', $editMode ? $unggulan->nama : '') }}" required>
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Icon --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-[#1a1c1e] mb-1.5">Icon <span
                        class="text-[#737780] font-normal">(nama Material Symbol, contoh: stars, school)</span></label>
                <input type="text" name="icon"
                    class="w-full px-3 py-2 border border-[#c3c6d1] rounded-lg text-sm focus:outline-none focus:border-[#001e40] focus:ring-2 focus:ring-[#001e40]/20"
                    value="{{ old('icon', $editMode ? $unggulan->icon : '') }}">
                @if ($editMode && $unggulan->icon)
                    <div class="mt-2 flex items-center gap-2 text-sm text-[#737780]">
                        <span>Preview:</span>
                        <span class="material-symbols-outlined text-[#001e40]">{{ $unggulan->icon }}</span>
                    </div>
                @endif
                @error('icon')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gambar --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-[#1a1c1e] mb-1.5">Gambar</label>
                <label
                    class="relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-[#c3c6d1] rounded-xl bg-white cursor-pointer hover:border-[#001e40] hover:bg-[#f3f3f6] transition-all group">
                    <div
                        class="flex flex-col items-center gap-1.5 text-[#737780] group-hover:text-[#001e40] transition-colors">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                        <span
                            class="text-sm font-medium">{{ $editMode && $unggulan->gambar ? 'Klik untuk ganti gambar' : 'Klik untuk pilih gambar' }}</span>
                        <span class="text-xs">PNG, JPG, WEBP (max 5MB)</span>
                    </div>
                    <input type="file" name="gambar" accept="image/*"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                </label>
                @if ($editMode && $unggulan->gambar)
                    <div class="mt-3 flex items-center gap-3 p-3 bg-white rounded-lg border border-[#e2e2e5]">
                        <img src="{{ asset('storage/' . $unggulan->gambar) }}"
                            class="h-16 w-auto rounded-lg border border-[#e2e2e5] object-contain bg-[#f3f3f6]">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-[#1a1c1e] truncate">{{ basename($unggulan->gambar) }}</p>
                            <p class="text-xs text-[#737780]">Gambar saat ini</p>
                        </div>
                        <button type="button"
                            onclick="if(confirm('Hapus gambar ini?')) document.getElementById('delete-gambar-form').submit()"
                            class="text-xs text-red-600 hover:text-red-800 font-semibold hover:underline shrink-0">Hapus</button>
                    </div>
                @endif
                @error('gambar')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Urutan --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-[#1a1c1e] mb-1.5">Urutan</label>
                <input type="number" name="urutan"
                    class="w-full px-3 py-2 border border-[#c3c6d1] rounded-lg text-sm focus:outline-none focus:border-[#001e40] focus:ring-2 focus:ring-[#001e40]/20"
                    value="{{ old('urutan', $editMode ? $unggulan->urutan : 0) }}" min="0">
                @error('urutan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3">
                <button type="submit"
                    class="px-6 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">
                    {{ $editMode ? 'Simpan Perubahan' : 'Simpan' }}
                </button>
                <a href="{{ route('admin.unggulan.index') }}"
                    class="px-6 py-2 border border-[#c3c6d1] text-[#43474f] rounded-lg text-sm font-semibold hover:bg-[#f3f3f6] transition-colors">
                    Batal
                </a>
            </div>
        </form>

        {{-- Standalone form for image deletion (tidak boleh nested di dalam form utama) --}}
        @if ($editMode && $unggulan->gambar)
            <form id="delete-gambar-form" method="POST" action="{{ route('admin.unggulan.destroy-gambar', $unggulan) }}"
                class="hidden">
                @csrf
                @method('DELETE')
            </form>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[type="file"]').forEach(function(input) {
                input.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        var maxSize = 5 * 1024 * 1024;
                        if (this.files[0].size > maxSize) {
                            alert('Ukuran file terlalu besar! Maksimal 5MB.');
                            this.value = '';
                            return;
                        }
                        // Preview gambar (fit dalam area dropzone h-32)
                        var label = this.closest('label');
                        var uploadDiv = label.querySelector('.flex.flex-col');
                        if (uploadDiv) {
                            uploadDiv.className =
                                'flex items-center justify-center w-full h-full p-2';
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                uploadDiv.innerHTML =
                                    '<img src="' + e.target.result +
                                    '" class="h-full w-full object-contain rounded-lg">';
                            };
                            reader.readAsDataURL(this.files[0]);
                        }
                    }
                });
            });
        });
    </script>
@endpush
