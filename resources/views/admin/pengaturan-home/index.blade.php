@extends('layouts.app')

@section('title', 'Pengaturan Halaman Utama')
@section('page_title', 'Pengaturan Halaman Utama')

@push('styles')
    <style>
        .setting-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e2e2e5;
            padding: 24px;
            transition: box-shadow 0.2s;
        }

        .setting-card:hover {
            box-shadow: 0 4px 16px rgba(0, 30, 64, 0.06);
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #e2e2e5;
            border-radius: 8px;
            font-size: 14px;
            color: #1a1c1e;
            background: #f9f9fc;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #003366;
            box-shadow: 0 0 0 3px rgba(0, 51, 102, 0.1);
            background: #ffffff;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #001e40;
            margin-bottom: 6px;
        }

        .form-hint {
            font-size: 12px;
            color: #737780;
            margin-top: 4px;
        }

        .btn-primary {
            background: #003366;
            color: white;
            padding: 10px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: #001e40;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .preview-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e2e2e5;
            background: #f3f3f6;
        }

        .hero-preview {
            width: 100%;
            max-width: 420px;
            aspect-ratio: 16 / 7;
            border-radius: 12px;
            object-fit: cover;
            border: 1.5px solid #e2e2e5;
            background: linear-gradient(135deg, #003366 0%, #001e40 100%);
        }

        .section-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Success Alert --}}
        @if (session('success'))
            <div
                class="bg-[#d1fae5] border border-[#a7f3d0] text-[#065f46] px-5 py-3 rounded-xl text-sm font-medium flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="bg-[#fce4ec] border border-[#f5b7c1] text-[#981b1b] px-5 py-4 rounded-xl text-sm font-medium">
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

        <form action="{{ route('admin.pengaturan-home.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Section: Sambutan Kepala Sekolah --}}
            <div class="setting-card">
                <div class="flex items-center gap-4 mb-6">
                    <div class="section-icon bg-[#d5e3ff] text-[#003366]">
                        <span class="material-symbols-outlined">record_voice_over</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-[#001e40]">Kata Sambutan Kepala Sekolah</h3>
                        <p class="text-sm text-[#737780]">Sambutan yang tampil di halaman utama setelah hero section</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label">Nama Kepala Sekolah</label>
                        <input type="text" name="kepala_sekolah_nama" class="form-input"
                            value="{{ old('kepala_sekolah_nama', $pengaturan->kepala_sekolah_nama ?? '') }}"
                            placeholder="Dr. H. Ahmad Fauzi, M.Pd.">
                    </div>
                    <div>
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="kepala_sekolah_jabatan" class="form-input"
                            value="{{ old('kepala_sekolah_jabatan', $pengaturan->kepala_sekolah_jabatan ?? '') }}"
                            placeholder="Kepala Sekolah">
                    </div>
                </div>

                <div class="mt-5">
                    <label class="form-label">Teks Sambutan</label>
                    <textarea name="kepala_sekolah_sambutan" rows="5" class="form-input"
                        placeholder="Tulis sambutan kepala sekolah...">{{ old('kepala_sekolah_sambutan', $pengaturan->kepala_sekolah_sambutan ?? '') }}</textarea>
                </div>
            </div>

            {{-- Section: Foto Kepala Sekolah --}}
            <div class="setting-card">
                <div class="flex items-center gap-4 mb-6">
                    <div class="section-icon bg-[#fce7f3] text-[#be185d]">
                        <span class="material-symbols-outlined">photo_camera</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-[#001e40]">Foto & Profil</h3>
                        <p class="text-sm text-[#737780]">Foto kepala sekolah yang tampil di samping sambutan</p>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="form-label">Background Hero (Bagian Paling Atas)</label>
                    <div class="flex flex-col gap-3">
                        @if ($pengaturan && $pengaturan->hero_background_foto)
                            <img src="{{ asset('storage/' . $pengaturan->hero_background_foto) }}"
                                alt="Preview Background Hero" class="hero-preview">
                        @else
                            <div class="hero-preview flex items-center justify-center text-white/90">
                                <div class="text-center px-4">
                                    <span class="material-symbols-outlined text-4xl">image</span>
                                    <p class="text-xs mt-1">Belum ada background hero, masih menggunakan warna biru default
                                    </p>
                                </div>
                            </div>
                        @endif

                        <input type="file" name="hero_background_foto" accept="image/jpeg,image/png,image/webp"
                            class="form-input file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#d5e3ff] file:text-[#003366] hover:file:bg-[#a7c8ff]">
                        @error('hero_background_foto')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="form-hint">Foto ini akan menggantikan background biru section hero di halaman utama.
                            Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-6 items-start">
                    {{-- Preview --}}
                    <div class="text-center">
                        @if ($pengaturan && $pengaturan->kepala_sekolah_foto)
                            <img src="{{ asset('storage/' . $pengaturan->kepala_sekolah_foto) }}" alt="Foto Kepala Sekolah"
                                class="preview-img">
                            <div class="mt-2">
                                <button type="button" onclick="confirmDeleteFoto()"
                                    class="text-xs text-red-600 hover:text-red-800 font-medium">Hapus Foto</button>
                            </div>
                        @else
                            <div class="preview-img flex items-center justify-center bg-[#f3f3f6] text-[#737780]">
                                <span class="material-symbols-outlined text-4xl">person</span>
                            </div>
                            <p class="text-xs text-[#737780] mt-2">Belum ada foto</p>
                        @endif
                    </div>

                    {{-- Upload --}}
                    <div class="flex-1">
                        <label class="form-label">Upload Foto Baru</label>
                        <input type="file" name="kepala_sekolah_foto" accept="image/jpeg,image/png,image/webp"
                            class="form-input file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#d5e3ff] file:text-[#003366] hover:file:bg-[#a7c8ff]">
                        @error('kepala_sekolah_foto')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="form-hint">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                    </div>
                </div>
            </div>

            {{-- Section: Pengalaman --}}
            <div class="setting-card">
                <div class="flex items-center gap-4 mb-6">
                    <div class="section-icon bg-[#d1fae5] text-[#065f46]">
                        <span class="material-symbols-outlined">school</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-[#001e40]">Floating Card Pengalaman</h3>
                        <p class="text-sm text-[#737780]">Card kecil yang melayang di samping foto kepala sekolah</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label">Angka</label>
                        <input type="text" name="kepala_sekolah_pengalaman_angka" class="form-input"
                            value="{{ old('kepala_sekolah_pengalaman_angka', $pengaturan->kepala_sekolah_pengalaman_angka ?? '') }}"
                            placeholder="15+">
                        <p class="form-hint">Contoh: 15+, 20, 10+</p>
                    </div>
                    <div>
                        <label class="form-label">Label</label>
                        <input type="text" name="kepala_sekolah_pengalaman_label" class="form-input"
                            value="{{ old('kepala_sekolah_pengalaman_label', $pengaturan->kepala_sekolah_pengalaman_label ?? '') }}"
                            placeholder="Tahun Pengalaman">
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('dashboard') }}"
                    class="px-5 py-2.5 text-sm font-semibold text-[#737780] hover:text-[#1a1c1e] transition-colors">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

    {{-- Form Hapus Foto --}}
    <form id="delete-foto-form" action="{{ route('admin.pengaturan-home.destroy-foto') }}" method="POST"
        class="hidden">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        <script>
            function confirmDeleteFoto() {
                if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
                    document.getElementById('delete-foto-form').submit();
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('input[type="file"]').forEach(function(input) {
                    input.addEventListener('change', function() {
                        if (this.files && this.files[0]) {
                            var maxSize = 2 * 1024 * 1024;
                            if (this.files[0].size > maxSize) {
                                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                                this.value = '';
                                return;
                            }
                            // Preview gambar
                            var reader = new FileReader();
                            var name = this.getAttribute('name');
                            reader.onload = function(e) {
                                if (name === 'hero_background_foto') {
                                    var preview = document.querySelector('.hero-preview');
                                    if (preview) {
                                        preview.innerHTML = '<img src="' + e.target.result +
                                            '" class="w-full h-full object-cover rounded-xl">';
                                        preview.className = 'hero-preview overflow-hidden';
                                    }
                                } else if (name === 'kepala_sekolah_foto') {
                                    var preview = document.querySelector('.preview-img');
                                    if (preview) {
                                        preview.innerHTML = '<img src="' + e.target.result +
                                            '" class="w-full h-full object-cover rounded-xl">';
                                        preview.className = 'preview-img overflow-hidden';
                                    }
                                }
                            };
                            reader.readAsDataURL(this.files[0]);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection



