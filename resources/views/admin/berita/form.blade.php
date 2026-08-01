@extends('layouts.app')

@section('title', $editMode ? 'Edit Berita' : 'Tambah Berita')
@section('page_title', $editMode ? 'Edit Berita' : 'Tambah Berita')

@push('styles')
    <style>
        .tox-tinymce {
            border-radius: 0.5rem !important;
            border-color: #c3c6d1 !important;
        }

        .tox-tinymce:focus-within {
            border-color: #001e40 !important;
            box-shadow: 0 0 0 2px rgba(0, 30, 64, 0.2) !important;
        }

        .tox .tox-toolbar__primary {
            background: #f9f9fc !important;
        }

        .tox .tox-edit-area {
            padding: 4px !important;
        }

        .tox .tox-editor-container {
            font-family: 'Inter', sans-serif !important;
        }

        .custom-file-input {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .custom-file-input input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .custom-file-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #f3f3f6;
            border: 1px dashed #c3c6d1;
            border-radius: 0.5rem;
            font-size: 0.8125rem;
            color: #737780;
            transition: all 0.2s;
        }

        .custom-file-input:hover .custom-file-label {
            border-color: #001e40;
            background: #eef3fa;
        }

        .custom-file-input.has-file .custom-file-label {
            border-color: #2e7d32;
            background: #e8f5e9;
            color: #2e7d32;
        }
    </style>
@endpush

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

    {{-- Form hapus gambar terpisah (harus di luar form utama) --}}
    @if ($editMode && $berita->gambar)
        <form method="POST" action="{{ route('admin.berita.delete-gambar', $berita->id) }}" id="delete-gambar-form"
            class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endif

    <div class="max-w-5xl mx-auto">
        <form method="POST"
            action="{{ $editMode ? route('admin.berita.update', $berita->id) : route('admin.berita.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if ($editMode)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- ==================== FORM UTAMA ==================== --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl border border-[#e2e2e5] p-6 space-y-6">
                        {{-- Judul --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#43474f] mb-1.5">Judul Berita</label>
                            <input type="text" name="judul" value="{{ old('judul', $berita->judul ?? '') }}" required
                                class="w-full px-3.5 py-2.5 rounded-lg border border-[#c3c6d1] bg-white text-sm text-[#1a1c1e] focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent transition-all"
                                placeholder="Masukkan judul berita">
                            @error('judul')
                                <p class="mt-1 text-xs text-[#ba1a1a]">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kategori & Tanggal --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-[#43474f] mb-1.5">Kategori</label>
                                <select name="kategori" required
                                    class="w-full px-3.5 py-2.5 rounded-lg border border-[#c3c6d1] bg-white text-sm text-[#1a1c1e] focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent transition-all">
                                    <option value="">Pilih kategori</option>
                                    @foreach ($programKeahlian as $pk)
                                        <option value="{{ $pk->singkatan }}"
                                            {{ old('kategori', $berita->kategori ?? '') == $pk->singkatan ? 'selected' : '' }}>
                                            {{ $pk->singkatan }} — {{ $pk->nama }}
                                        </option>
                                    @endforeach
                                    <option value="General"
                                        {{ old('kategori', $berita->kategori ?? '') == 'General' ? 'selected' : '' }}>
                                        General — Umum Sekolah</option>
                                    @php
                                        $kategoriTerpilih = old('kategori', $berita->kategori ?? '');
                                        $kategoriTersedia = $programKeahlian
                                            ->pluck('singkatan')
                                            ->push('General')
                                            ->all();
                                    @endphp
                                    @if ($kategoriTerpilih && !in_array($kategoriTerpilih, $kategoriTersedia))
                                        <option value="{{ $kategoriTerpilih }}" selected>{{ $kategoriTerpilih }}</option>
                                    @endif
                                </select>
                                @error('kategori')
                                    <p class="mt-1 text-xs text-[#ba1a1a]">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-[#43474f] mb-1.5">Tanggal</label>
                                <input type="date" name="tanggal"
                                    value="{{ old('tanggal', $berita ? $berita->tanggal_input : date('Y-m-d')) }}" required
                                    class="w-full px-3.5 py-2.5 rounded-lg border border-[#c3c6d1] bg-white text-sm text-[#1a1c1e] focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent transition-all">
                                @error('tanggal')
                                    <p class="mt-1 text-xs text-[#ba1a1a]">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Icon --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#43474f] mb-1.5">Icon (Material Symbol)</label>
                            <input type="text" name="icon" value="{{ old('icon', $berita->icon ?? '') }}" required
                                class="w-full px-3.5 py-2.5 rounded-lg border border-[#c3c6d1] bg-white text-sm text-[#1a1c1e] focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent transition-all"
                                placeholder="Contoh: lan, palette, groups, security">
                            @error('icon')
                                <p class="mt-1 text-xs text-[#ba1a1a]">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#43474f] mb-1.5">Deskripsi Singkat</label>
                            <textarea name="deskripsi" rows="3" required
                                class="w-full px-3.5 py-2.5 rounded-lg border border-[#c3c6d1] bg-white text-sm text-[#1a1c1e] focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent transition-all resize-y"
                                placeholder="Deskripsi singkat berita">{{ old('deskripsi', $berita->deskripsi ?? '') }}</textarea>
                            @error('deskripsi')
                                <p class="mt-1 text-xs text-[#ba1a1a]">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Konten (TinyMCE) --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#43474f] mb-1.5">Konten</label>
                            <p class="text-xs text-[#737780] mb-3">Gunakan toolbar di bawah untuk memformat teks (tebal,
                                miring, daftar, dll.)</p>
                            <textarea name="konten" id="konten-editor" rows="12"
                                class="w-full px-3.5 py-2.5 rounded-lg border border-[#c3c6d1] bg-white text-sm text-[#1a1c1e] focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent transition-all"
                                placeholder="Tulis konten berita...">{{ old('konten', $berita->konten ?? '') }}</textarea>
                            @error('konten')
                                <p class="mt-1 text-xs text-[#ba1a1a]">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#e2e2e5]">
                            <a href="{{ route('admin.berita.index') }}"
                                class="px-4 py-2 rounded-lg text-sm font-medium text-[#43474f] hover:bg-[#f3f3f6] transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-6 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">
                                {{ $editMode ? 'Simpan Perubahan' : 'Simpan' }}
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ==================== SIDEBAR ==================== --}}
                <div class="lg:col-span-1">
                    {{-- Upload Gambar --}}
                    <div class="bg-white rounded-xl border border-[#e2e2e5] overflow-hidden p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="material-symbols-outlined text-[#001e40]">image</span>
                            <h3 class="text-sm font-semibold text-[#1a1c1e]">Gambar Berita</h3>
                        </div>

                        @if ($editMode && $berita->gambar)
                            <div class="mb-4">
                                <div
                                    class="w-full h-48 rounded-lg border border-[#e2e2e5] mb-3 overflow-hidden bg-[#f3f3f6] flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                        class="w-full h-full object-contain">
                                </div>
                                <button type="button"
                                    onclick="event.preventDefault(); if(confirm('Hapus gambar ini?')) { document.getElementById('delete-gambar-form').submit(); }"
                                    class="w-full px-3 py-2 text-sm text-[#ba1a1a] bg-[#fff3f3] rounded-lg hover:bg-[#ffe0e0] transition-colors">Hapus
                                    Gambar</button>
                            </div>
                        @endif

                        <div>
                            <label class="text-xs font-semibold text-[#43474f] mb-1.5 block">Upload Gambar</label>
                            <div class="custom-file-input mb-3">
                                <input type="file" name="gambar" accept="image/jpeg,image/png,image/jpg,image/webp"
                                    onchange="this.parentElement.classList.add('has-file'); this.nextElementSibling.querySelector('span').textContent = this.files[0].name">
                                <div class="custom-file-label">
                                    <span class="material-symbols-outlined text-base">upload</span>
                                    <span>Pilih file gambar...</span>
                                </div>
                            </div>
                            @error('gambar')
                                <p class="mt-1 text-xs text-[#ba1a1a]">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-[#737780]">Format: JPEG, PNG, WebP. Maks: 2MB.</p>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="mt-6 bg-[#f9f9fc] rounded-xl border border-[#e2e2e5] p-4">
                        <p class="text-sm font-semibold text-[#43474f] mb-2">Tips</p>
                        <ul class="space-y-2 text-xs text-[#737780]">
                            <li class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-sm mt-0.5">info</span>
                                <span>Gunakan toolbar editor untuk menebalkan, memiringkan, atau membuat daftar.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-sm mt-0.5">image</span>
                                <span>Klik ikon gambar di toolbar untuk menyisipkan gambar ke dalam konten.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-sm mt-0.5">link</span>
                                <span>Anda bisa menambahkan tautan dengan tombol link di toolbar.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.7.2/tinymce.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup form submit to sync TinyMCE content
            var form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function() {
                    tinymce.triggerSave();
                });
            }

            tinymce.init({
                selector: '#konten-editor',
                height: 500,
                menubar: false,
                plugins: 'lists link image preview code',
                toolbar: 'undo redo | bold italic underline strikethrough | forecolor backcolor | bullist numlist | link image | alignleft aligncenter alignright alignjustify | code',
                toolbar_mode: 'wrap',
                license_key: 'gpl',
                content_style: `
                    body {
                        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                        font-size: 15px;
                        line-height: 1.75;
                        color: #1a1c1e;
                        padding: 12px;
                    }
                    h1, h2, h3, h4 { margin-top: 1.5rem; margin-bottom: 0.75rem; font-weight: 700; }
                    p { margin-bottom: 1rem; }
                    ul, ol { margin-bottom: 1rem; padding-left: 1.5rem; }
                    img { max-width: 100%; height: auto; border-radius: 0.5rem; margin: 1rem 0; }
                    a { color: #001e40; text-decoration: underline; }
                `,
                relative_urls: false,
                remove_script_host: false,
                images_upload_handler: function(blobInfo, progress) {
                    return new Promise(function(resolve, reject) {
                        var formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());

                        fetch('{{ route('admin.berita.upload-image') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                },
                                body: formData
                            })
                            .then(function(response) {
                                return response.json();
                            })
                            .then(function(result) {
                                if (result.location) {
                                    resolve(result.location);
                                } else {
                                    reject('Upload gagal');
                                }
                            })
                            .catch(function(error) {
                                reject('Upload gagal: ' + error.message);
                            });
                    });
                }
            });
        });
        // Client-side file size validation + preview
        document.querySelectorAll('input[type="file"]').forEach(function(input) {
            input.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    var maxSize = 2 * 1024 * 1024; // 5MB
                    if (this.files[0].size > maxSize) {
                        alert('Ukuran file terlalu besar! Maksimal 2MB.');
                        this.value = '';
                        return;
                    }
                    // Preview gambar untuk input name="gambar" di sidebar
                    if (this.getAttribute('name') === 'gambar') {
                        var sidebar = this.closest('.lg\\:col-span-1') || this.closest('div');
                        var previewDiv = sidebar.querySelector('.w-full.h-48');
                        if (previewDiv) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                previewDiv.innerHTML = '<img src="' + e.target.result +
                                    '" class="w-full h-full object-contain">';
                            };
                            reader.readAsDataURL(this.files[0]);
                        }
                    }
                }
            });
        });
    </script>
@endpush
