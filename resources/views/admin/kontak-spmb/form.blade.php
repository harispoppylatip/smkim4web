@extends('layouts.app')

@section('title', $editMode ? 'Edit Kontak SPMB' : 'Tambah Kontak SPMB')
@section('page_title', $editMode ? 'Edit Kontak SPMB' : 'Tambah Kontak SPMB')

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
            action="{{ $editMode ? route('admin.kontak-spmb.update', $kontak) : route('admin.kontak-spmb.store') }}">
            @csrf
            @if ($editMode)
                @method('PUT')
            @endif

            {{-- Nama --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-[#1a1c1e] mb-1.5">Nama Kontak</label>
                <input type="text" name="nama"
                    class="w-full px-3 py-2 border border-[#c3c6d1] rounded-lg text-sm focus:outline-none focus:border-[#001e40] focus:ring-2 focus:ring-[#001e40]/20 @error('nama') border-red-500 @enderror"
                    value="{{ old('nama', $editMode ? $kontak->nama : '') }}" placeholder="contoh: Admin 1, Panitia PPDB"
                    required>
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jenis --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-[#1a1c1e] mb-1.5">Jenis Kontak</label>
                <select name="jenis" id="jenis-kontak"
                    class="w-full px-3 py-2 border border-[#c3c6d1] rounded-lg text-sm bg-white focus:outline-none focus:border-[#001e40] focus:ring-2 focus:ring-[#001e40]/20">
                    @foreach ($jenisOptions as $key => $label)
                        <option value="{{ $key }}"
                            {{ old('jenis', $editMode ? $kontak->jenis : 'whatsapp') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('jenis')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nilai --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-[#1a1c1e] mb-1.5">Kontak / Nilai</label>
                <input type="text" name="nilai"
                    class="w-full px-3 py-2 border border-[#c3c6d1] rounded-lg text-sm focus:outline-none focus:border-[#001e40] focus:ring-2 focus:ring-[#001e40]/20 @error('nilai') border-red-500 @enderror"
                    value="{{ old('nilai', $editMode ? $kontak->nilai : '') }}" required>
                <p class="text-xs text-[#737780] mt-1.5" id="hint-nilai">
                    Nomor WhatsApp tanpa tanda hubung, contoh: 6281907613500
                </p>
                @error('nilai')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Urutan --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-[#1a1c1e] mb-1.5">Urutan</label>
                <input type="number" name="urutan"
                    class="w-full px-3 py-2 border border-[#c3c6d1] rounded-lg text-sm focus:outline-none focus:border-[#001e40] focus:ring-2 focus:ring-[#001e40]/20"
                    value="{{ old('urutan', $editMode ? $kontak->urutan : 0) }}" min="0">
                @error('urutan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Aktif --}}
            <div class="mb-6">
                <label class="flex items-center gap-2.5 cursor-pointer select-none">
                    <input type="checkbox" name="aktif" value="1"
                        class="w-4 h-4 rounded border-[#c3c6d1] text-[#001e40] focus:ring-[#001e40]/30"
                        {{ old('aktif', $editMode ? $kontak->aktif : true) ? 'checked' : '' }}>
                    <span class="text-sm font-semibold text-[#1a1c1e]">Aktif ditampilkan di halaman SPMB</span>
                </label>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3">
                <button type="submit"
                    class="px-6 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">
                    {{ $editMode ? 'Simpan Perubahan' : 'Simpan' }}
                </button>
                <a href="{{ route('admin.spmb.index') }}"
                    class="px-6 py-2 border border-[#c3c6d1] text-[#43474f] rounded-lg text-sm font-semibold hover:bg-[#f3f3f6] transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Ubah hint input sesuai jenis kontak yang dipilih
        const hints = {
            whatsapp: 'Nomor WhatsApp tanpa tanda hubung, contoh: 6281907613500',
            instagram: 'Username Instagram, contoh: smkim4_smd (boleh juga URL lengkap)',
            facebook: 'Username/path Facebook, contoh: smkim4 (boleh juga URL lengkap)',
            tiktok: 'Username TikTok, contoh: smkim4_ppdb (boleh juga URL lengkap)',
            telegram: 'Username Telegram, contoh: smkim4 (boleh juga URL lengkap)',
            email: 'Alamat email, contoh: info@smkim4samarinda.sch.id',
            telepon: 'Nomor telepon, contoh: 0541747366',
            website: 'Alamat website, contoh: smkim4samarinda.sch.id',
            lainnya: 'URL lengkap, contoh: https://linktr.ee/smkim4',
        };
        const select = document.getElementById('jenis-kontak');
        const hint = document.getElementById('hint-nilai');
        if (select && hint) {
            const update = () => {
                hint.textContent = hints[select.value] || hints.lainnya;
            };
            select.addEventListener('change', update);
            update();
        }
    </script>
@endpush
