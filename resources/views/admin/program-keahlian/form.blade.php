@extends('layouts.app')

@section('title', 'Edit Program Keahlian')
@section('page_title', 'Edit Program Keahlian')

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

        .form-group {
            margin-bottom: 0.25rem;
        }

        .form-group .form-input {
            padding: 0.75rem 1rem;
        }

        textarea.form-input {
            padding: 0.75rem 1rem;
        }

        .resource-section {
            scroll-margin-top: 1rem;
        }

        .resource-section .section-header {
            cursor: pointer;
            user-select: none;
        }

        .resource-section .section-header:hover {
            opacity: 0.8;
        }

        .resource-table td,
        .resource-table th {
            padding: 0.5rem 0.75rem;
            font-size: 0.8125rem;
        }

        .preview-thumb {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 0.375rem;
            border: 1px solid #e2e2e5;
        }

        /* Custom file input */
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

    {{-- ==================== FORM EDIT PROGRAM ==================== --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
        <div class="lg:col-span-2">
            <form method="POST" action="{{ route('admin.program-keahlian.update', $program->id) }}"
                class="bg-white rounded-xl border border-[#e2e2e5] p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="block text-sm font-semibold text-[#43474f] mb-2">Nama Program Keahlian</label>
                    <input type="text" name="nama" value="{{ old('nama', $program->nama) }}" required
                        class="form-input w-full rounded-lg border border-[#c3c6d1] bg-white text-sm text-[#1a1c1e] focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent transition-all"
                        placeholder="Nama lengkap program keahlian">
                    @error('nama')
                        <p class="mt-1.5 text-xs text-[#ba1a1a]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="block text-sm font-semibold text-[#43474f] mb-2">Singkatan</label>
                    <input type="text" value="{{ $program->singkatan }}" disabled
                        class="form-input w-full rounded-lg border border-[#c3c6d1] bg-[#f3f3f6] text-sm text-[#737780] cursor-not-allowed">
                    <p class="mt-1.5 text-xs text-[#737780]">Singkatan tidak dapat diubah.</p>
                </div>

                <div class="form-group">
                    <label class="block text-sm font-semibold text-[#43474f] mb-2">Deskripsi Singkat</label>
                    <textarea name="deskripsi_singkat" rows="3" required
                        class="form-input w-full rounded-lg border border-[#c3c6d1] bg-white text-sm text-[#1a1c1e] focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent transition-all resize-y"
                        placeholder="Deskripsi singkat program">{{ old('deskripsi_singkat', $program->deskripsi_singkat) }}</textarea>
                    @error('deskripsi_singkat')
                        <p class="mt-1.5 text-xs text-[#ba1a1a]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="block text-sm font-semibold text-[#43474f] mb-2">Deskripsi Lengkap</label>
                    <p class="text-xs text-[#737780] mb-3">Gunakan toolbar di bawah untuk memformat teks (tebal, miring,
                        daftar, dll.)</p>
                    <textarea name="deskripsi" id="deskripsi-editor" rows="10" required
                        class="form-input w-full rounded-lg border border-[#c3c6d1] bg-white text-sm text-[#1a1c1e] focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent transition-all"
                        placeholder="Deskripsi lengkap program">{{ old('deskripsi', $program->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1.5 text-xs text-[#ba1a1a]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Quick Stats --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="bg-[#f3f3f6] rounded-lg p-3 text-center">
                        <p class="text-lg font-bold text-[#001e40]">{{ $program->kompetensi->count() }}</p>
                        <p class="text-[10px] text-[#737780] mt-0.5">Kompetensi</p>
                    </div>
                    <div class="bg-[#f3f3f6] rounded-lg p-3 text-center">
                        <p class="text-lg font-bold text-[#001e40]">{{ $program->mataPelajaran->count() }}</p>
                        <p class="text-[10px] text-[#737780] mt-0.5">Mata Pelajaran</p>
                    </div>
                    <div class="bg-[#f3f3f6] rounded-lg p-3 text-center">
                        <p class="text-lg font-bold text-[#001e40]">{{ $program->prestasi->count() }}</p>
                        <p class="text-[10px] text-[#737780] mt-0.5">Prestasi</p>
                    </div>
                    <div class="bg-[#f3f3f6] rounded-lg p-3 text-center">
                        <p class="text-lg font-bold text-[#001e40]">{{ $program->sertifikat->count() }}</p>
                        <p class="text-[10px] text-[#737780] mt-0.5">Sertifikat</p>
                    </div>
                    <div class="bg-[#f3f3f6] rounded-lg p-3 text-center">
                        <p class="text-lg font-bold text-[#001e40]">{{ $program->guru->count() }}</p>
                        <p class="text-[10px] text-[#737780] mt-0.5">Tim Pengajar</p>
                    </div>
                    <div class="bg-[#f3f3f6] rounded-lg p-3 text-center">
                        <p class="text-lg font-bold text-[#001e40]">{{ $program->fasilitas->count() }}</p>
                        <p class="text-[10px] text-[#737780] mt-0.5">Fasilitas</p>
                    </div>
                    <div class="bg-[#f3f3f6] rounded-lg p-3 text-center">
                        <p class="text-lg font-bold text-[#001e40]">{{ $program->peluangKerja->count() }}</p>
                        <p class="text-[10px] text-[#737780] mt-0.5">Peluang Kerja</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#e2e2e5]">
                    <a href="{{ route('admin.program-keahlian.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium text-[#43474f] hover:bg-[#f3f3f6] transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <div class="lg:col-span-1">
            {{-- Panel Pengaturan Gambar --}}
            <div class="bg-white rounded-xl border border-[#e2e2e5] overflow-hidden mb-4">
                <div class="px-5 py-4 bg-[#f9f9fc] border-b border-[#e2e2e5] flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#001e40]">image</span>
                    <h3 class="text-sm font-semibold text-[#1a1c1e]">Pengaturan Gambar</h3>
                </div>
                <div class="divide-y divide-[#e2e2e5]">
                    {{-- Hero Background --}}
                    <div class="p-4" id="upload-hero-background">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-base text-[#001e40]">photo</span>
                                <span class="text-xs font-semibold text-[#43474f]">Background Hero</span>
                                <span class="text-[10px] text-[#737780]">Header Detail Jurusan</span>
                            </div>
                            @if ($program->hero_background_foto)
                                <form method="POST"
                                    action="{{ route('admin.program-keahlian.delete-hero-background', $program->id) }}">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus background hero?')"
                                        class="text-[10px] text-[#ba1a1a] hover:underline">Hapus</button>
                                </form>
                            @endif
                        </div>
                        @if ($program->hero_background_foto)
                            <img src="{{ asset('storage/' . $program->hero_background_foto) }}"
                                alt="Background Hero {{ $program->nama }}"
                                class="w-full aspect-video object-cover rounded-lg border border-[#e2e2e5] mb-2">
                        @endif
                        <form method="POST"
                            action="{{ route('admin.program-keahlian.upload-hero-background', $program->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="flex gap-2">
                                <div class="custom-file-input flex-1">
                                    <input type="file" name="hero_background_foto"
                                        accept="image/jpeg,image/png,image/jpg,image/webp"
                                        onchange="if(this.files[0].size > 5 * 1024 * 1024) { alert('Ukuran file terlalu besar! Maksimal 5MB.'); this.value = ''; return; } this.parentElement.classList.add('has-file'); this.nextElementSibling.querySelector('span:last-child').textContent = this.files[0].name">
                                    <div class="custom-file-label text-xs py-1.5 px-2">
                                        <span class="material-symbols-outlined text-sm">upload</span>
                                        <span class="truncate">Pilih file...</span>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="px-3 py-1.5 bg-[#001e40] text-white rounded-lg text-xs font-semibold hover:bg-[#003366] transition-colors shrink-0">Upload</button>
                            </div>
                            <p class="text-xs text-[#737780] mt-1">Format: JPEG, PNG, WebP. Maks: 5MB.</p>
                        </form>
                    </div>

                    {{-- Gambar Kurikulum --}}
                    <div class="p-4" id="upload-gambar-kurikulum">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-base text-[#001e40]">menu_book</span>
                                <span class="text-xs font-semibold text-[#43474f]">Kurikulum</span>
                                <span class="text-[10px] text-[#737780]">Section Kurikulum</span>
                            </div>
                            @if ($program->gambar_kurikulum)
                                <form method="POST"
                                    action="{{ route('admin.program-keahlian.delete-gambar-kurikulum', $program->id) }}">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus gambar kurikulum?')"
                                        class="text-[10px] text-[#ba1a1a] hover:underline">Hapus</button>
                                </form>
                            @endif
                        </div>
                        @if ($program->gambar_kurikulum)
                            <img src="{{ asset('storage/' . $program->gambar_kurikulum) }}"
                                alt="Kurikulum {{ $program->nama }}"
                                class="w-full aspect-video object-cover rounded-lg border border-[#e2e2e5] mb-2">
                        @endif
                        <form method="POST"
                            action="{{ route('admin.program-keahlian.upload-gambar-kurikulum', $program->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="flex gap-2">
                                <div class="custom-file-input flex-1">
                                    <input type="file" name="gambar_kurikulum"
                                        accept="image/jpeg,image/png,image/jpg,image/webp"
                                        onchange="this.parentElement.classList.add('has-file'); this.nextElementSibling.querySelector('span:last-child').textContent = this.files[0].name">
                                    <div class="custom-file-label text-xs py-1.5 px-2">
                                        <span class="material-symbols-outlined text-sm">upload</span>
                                        <span class="truncate">Pilih file...</span>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="px-3 py-1.5 bg-[#001e40] text-white rounded-lg text-xs font-semibold hover:bg-[#003366] transition-colors shrink-0">Upload</button>
                            </div>
                            <p class="text-xs text-[#737780] mt-1">Format: JPEG, PNG, WebP. Maks: 5MB.</p>
                        </form>
                    </div>

                    {{-- Gambar Program --}}
                    <div class="p-4" id="upload-gambar">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-base text-[#001e40]">image</span>
                                <span class="text-xs font-semibold text-[#43474f]">Gambar</span>
                                <span class="text-[10px] text-[#737780]">Section Tentang</span>
                            </div>
                            @if ($program->gambar)
                                <form method="POST"
                                    action="{{ route('admin.program-keahlian.delete-gambar', $program->id) }}">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus gambar?')"
                                        class="text-[10px] text-[#ba1a1a] hover:underline">Hapus</button>
                                </form>
                            @endif
                        </div>
                        @if ($program->gambar)
                            <img src="{{ asset('storage/' . $program->gambar) }}" alt="{{ $program->nama }}"
                                class="w-full aspect-video object-cover rounded-lg border border-[#e2e2e5] mb-2">
                        @endif
                        <form method="POST" action="{{ route('admin.program-keahlian.upload-gambar', $program->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="flex gap-2">
                                <div class="custom-file-input flex-1">
                                    <input type="file" name="gambar"
                                        accept="image/jpeg,image/png,image/jpg,image/webp"
                                        onchange="this.parentElement.classList.add('has-file'); this.nextElementSibling.querySelector('span:last-child').textContent = this.files[0].name">
                                    <div class="custom-file-label text-xs py-1.5 px-2">
                                        <span class="material-symbols-outlined text-sm">upload</span>
                                        <span class="truncate">Pilih file...</span>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="px-3 py-1.5 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors shrink-0">Upload</button>
                            </div>
                            <p class="text-xs text-[#737780] mt-1">Format: JPEG, PNG, WebP. Maks: 5MB.</p>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Navigasi Cepat --}}
            <div class="bg-[#f9f9fc] rounded-xl border border-[#e2e2e5] p-4">
                <p class="text-sm font-semibold text-[#43474f] mb-3">Navigasi Cepat</p>
                <div class="space-y-1">
                    <a href="#kompetensi"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs text-[#43474f] hover:bg-white hover:text-[#001e40] transition-colors">
                        <span class="material-symbols-outlined text-base">checklist</span> Kompetensi
                        <span
                            class="ml-auto bg-[#001e40] text-white text-[10px] px-2 py-0.5 rounded-full">{{ $program->kompetensi->count() }}</span>
                    </a>
                    <a href="#mata-pelajaran"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs text-[#43474f] hover:bg-white hover:text-[#001e40] transition-colors">
                        <span class="material-symbols-outlined text-base">book</span> Mata Pelajaran
                        <span
                            class="ml-auto bg-[#001e40] text-white text-[10px] px-2 py-0.5 rounded-full">{{ $program->mataPelajaran->count() }}</span>
                    </a>
                    <a href="#guru"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs text-[#43474f] hover:bg-white hover:text-[#001e40] transition-colors">
                        <span class="material-symbols-outlined text-base">school</span> Tim Pengajar
                        <span
                            class="ml-auto bg-[#001e40] text-white text-[10px] px-2 py-0.5 rounded-full">{{ $program->guru->count() }}</span>
                    </a>
                    <a href="#prestasi"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs text-[#43474f] hover:bg-white hover:text-[#001e40] transition-colors">
                        <span class="material-symbols-outlined text-base">emoji_events</span> Prestasi
                        <span
                            class="ml-auto bg-[#001e40] text-white text-[10px] px-2 py-0.5 rounded-full">{{ $program->prestasi->count() }}</span>
                    </a>
                    <a href="#sertifikat"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs text-[#43474f] hover:bg-white hover:text-[#001e40] transition-colors">
                        <span class="material-symbols-outlined text-base">verified</span> Sertifikat
                        <span
                            class="ml-auto bg-[#001e40] text-white text-[10px] px-2 py-0.5 rounded-full">{{ $program->sertifikat->count() }}</span>
                    </a>
                    <a href="#fasilitas"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs text-[#43474f] hover:bg-white hover:text-[#001e40] transition-colors">
                        <span class="material-symbols-outlined text-base">business_center</span> Fasilitas
                        <span
                            class="ml-auto bg-[#001e40] text-white text-[10px] px-2 py-0.5 rounded-full">{{ $program->fasilitas->count() }}</span>
                    </a>
                    <a href="#peluang-kerja"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs text-[#43474f] hover:bg-white hover:text-[#001e40] transition-colors">
                        <span class="material-symbols-outlined text-base">work</span> Peluang Kerja
                        <span
                            class="ml-auto bg-[#001e40] text-white text-[10px] px-2 py-0.5 rounded-full">{{ $program->peluangKerja->count() }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== KOMPETENSI ==================== --}}
    @include('admin.program-keahlian.resources.kompetensi')

    {{-- ==================== MATA PELAJARAN ==================== --}}
    @include('admin.program-keahlian.resources.mata-pelajaran')

    {{-- ==================== TIM PENGAJAR (GURU) ==================== --}}
    @include('admin.program-keahlian.resources.guru')

    {{-- ==================== PRESTASI SISWA ==================== --}}
    @include('admin.program-keahlian.resources.prestasi')

    {{-- ==================== SERTIFIKAT ==================== --}}
    @include('admin.program-keahlian.resources.sertifikat')

    {{-- ==================== FASILITAS ==================== --}}
    @include('admin.program-keahlian.resources.fasilitas')

    {{-- ==================== PELUANG KERJA ==================== --}}
    @include('admin.program-keahlian.resources.peluang-kerja')

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.7.2/tinymce.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '#deskripsi-editor',
                license_key: 'gpl',
                height: 400,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
                    'anchor', 'searchreplace', 'visualblocks', 'code',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent | removeformat | code | help',
                toolbar_mode: 'wrap',
                content_style: `
                    body {
                        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                        font-size: 14px;
                        line-height: 1.7;
                        color: #1a1c1e;
                        padding: 12px 16px;
                    }
                    p { margin-bottom: 1rem; }
                    h1, h2, h3, h4 { margin-top: 1.5rem; margin-bottom: 0.75rem; font-weight: 700; }
                    ul, ol { margin-bottom: 1rem; padding-left: 1.5rem; }
                    li { margin-bottom: 0.25rem; }
                    strong { font-weight: 700; }
                    em { font-style: italic; }
                `,
                setup: function(editor) {
                    editor.on('init', function() {
                        editor.save();
                    });
                },
                change: function(editor) {
                    editor.save();
                }
            });

            document.querySelector('form').addEventListener('submit', function() {
                tinymce.triggerSave();
            });

            // Client-side file size validation for sidebar uploads
            document.querySelectorAll(
                '#upload-hero-background input[type="file"], #upload-gambar-kurikulum input[type="file"], #upload-gambar input[type="file"]'
            ).forEach(function(input) {
                input.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        var name = this.getAttribute('name');
                        var maxSize = 5 * 1024 * 1024;
                        var label = '5MB';
                        if (this.files[0].size > maxSize) {
                            alert('Ukuran file terlalu besar! Maksimal ' + label + '.');
                            this.value = '';
                        }
                    }
                });
            });
        });
    </script>
@endpush
