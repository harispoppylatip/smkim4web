@extends('layouts.app')

@section('title', 'Tambah Program Keahlian')
@section('page_title', 'Tambah Program Keahlian')

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

    {{-- ==================== FORM TAMBAH PROGRAM ==================== --}}
    <div class="max-w-3xl">
        {{-- novalidate: textarea deskripsi disembunyikan TinyMCE sehingga validasi required browser
             tidak bisa fokus ke kontrol -- validasi dilakukan server-side. --}}
        <form method="POST" action="{{ route('admin.program-keahlian.store') }}" novalidate
            class="bg-white rounded-xl border border-[#e2e2e5] p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="sm:col-span-1 form-group">
                    <label class="block text-sm font-semibold text-[#43474f] mb-2">Singkatan</label>
                    <input type="text" name="singkatan" value="{{ old('singkatan') }}" required maxlength="20"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] bg-white text-sm text-[#1a1c1e] focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent transition-all uppercase"
                        placeholder="Contoh: TKJ">
                    <p class="mt-1.5 text-xs text-[#737780]">Huruf singkatan program, misal TKJ. Tidak boleh sama dengan
                        yang sudah ada.</p>
                    @error('singkatan')
                        <p class="mt-1.5 text-xs text-[#ba1a1a]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2 form-group">
                    <label class="block text-sm font-semibold text-[#43474f] mb-2">Nama Program Keahlian</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required maxlength="255"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] bg-white text-sm text-[#1a1c1e] focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent transition-all"
                        placeholder="Nama lengkap program keahlian">
                    @error('nama')
                        <p class="mt-1.5 text-xs text-[#ba1a1a]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="block text-sm font-semibold text-[#43474f] mb-2">Deskripsi Singkat</label>
                <textarea name="deskripsi_singkat" rows="3" required
                    class="form-input w-full rounded-lg border border-[#c3c6d1] bg-white text-sm text-[#1a1c1e] focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent transition-all resize-y"
                    placeholder="Deskripsi singkat program">{{ old('deskripsi_singkat') }}</textarea>
                @error('deskripsi_singkat')
                    <p class="mt-1.5 text-xs text-[#ba1a1a]">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="block text-sm font-semibold text-[#43474f] mb-2">Deskripsi Lengkap</label>
                <p class="text-xs text-[#737780] mb-3">Gunakan toolbar di bawah untuk memformat teks (tebal, miring,
                    daftar, dll.)</p>
                <textarea name="deskripsi" id="deskripsi-editor" rows="10" required
                    class="form-input w-full rounded-lg border border-[#c3c6d1] bg-white text-sm text-[#1a1c1e] focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent transition-all">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="mt-1.5 text-xs text-[#ba1a1a]">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#e2e2e5]">
                <a href="{{ route('admin.program-keahlian.index') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-[#43474f] hover:bg-[#f3f3f6] transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">
                    Simpan Program Keahlian
                </button>
            </div>
        </form>

        <p class="text-xs text-[#737780] mt-4">
            Setelah disimpan, Anda akan diarahkan ke halaman detail untuk mengunggah gambar, logo, background hero,
            serta mengelola kompetensi, prestasi, sertifikat, guru, fasilitas, dan peluang kerja.
        </p>
    </div>
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
        });
    </script>
@endpush
