@extends('layouts.app')

@section('title', 'Pengaturan SPMB')
@section('page_title', 'Pengaturan SPMB')

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

        .btn-outline {
            background: transparent;
            color: #003366;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            border: 1.5px solid #003366;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-outline:hover {
            background: #d5e3ff;
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

        .persyaratan-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .persyaratan-item .form-input {
            flex: 1;
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

        <form action="{{ route('admin.spmb.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Section: Tahun Ajaran --}}
            <div class="setting-card">
                <div class="flex items-center gap-4 mb-6">
                    <div class="section-icon bg-[#d5e3ff] text-[#003366]">
                        <span class="material-symbols-outlined">calendar_today</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-[#001e40]">Tahun Ajaran</h3>
                        <p class="text-sm text-[#737780]">Tahun ajaran yang tampil di halaman SPMB</p>
                    </div>
                </div>

                <div>
                    <label class="form-label">Tahun</label>
                    <input type="text" name="tahun" class="form-input max-w-xs"
                        value="{{ old('tahun', $pengaturan->tahun ?? '2025/2026') }}" placeholder="2025/2026">
                    <p class="form-hint">Contoh: 2025/2026, 2026/2027</p>
                </div>
            </div>

            {{-- Section: Persyaratan --}}
            <div class="setting-card">
                <div class="flex items-center gap-4 mb-6">
                    <div class="section-icon bg-[#d1fae5] text-[#065f46]">
                        <span class="material-symbols-outlined">checklist</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-[#001e40]">Persyaratan Pendaftaran</h3>
                        <p class="text-sm text-[#737780]">Daftar persyaratan yang tampil di halaman SPMB</p>
                    </div>
                </div>

                <div id="persyaratan-container">
                    @php
                        $persyaratanList = old('persyaratan', $pengaturan->persyaratan ?? ['']);
                    @endphp
                    @foreach ($persyaratanList as $index => $item)
                        <div class="persyaratan-item">
                            <input type="text" name="persyaratan[]" class="form-input" value="{{ $item }}"
                                placeholder="Masukkan persyaratan...">
                            <button type="button" onclick="hapusPersyaratan(this)"
                                class="btn-danger !px-3 !py-2 text-lg leading-none">&times;</button>
                        </div>
                    @endforeach
                </div>

                <button type="button" onclick="tambahPersyaratan()" class="btn-outline mt-2">
                    + Tambah Persyaratan
                </button>
            </div>

            {{-- Section: Brosur --}}
            <div class="setting-card">
                <div class="flex items-center gap-4 mb-6">
                    <div class="section-icon bg-[#fce7f3] text-[#be185d]">
                        <span class="material-symbols-outlined">description</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-[#001e40]">Brosur PDF</h3>
                        <p class="text-sm text-[#737780]">File brosur yang bisa diunduh pengunjung</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-6 items-start">
                    {{-- Status brosur --}}
                    <div class="text-center min-w-[140px]">
                        @if ($pengaturan && $pengaturan->brosur)
                            <div class="flex flex-col items-center gap-2">
                                <span class="material-symbols-outlined text-5xl text-[#003366]">picture_as_pdf</span>
                                <span class="text-xs text-[#737780]">Brosur tersimpan</span>
                                <button type="button" onclick="confirmHapusBrosur()"
                                    class="text-xs text-red-600 hover:text-red-800 font-medium">Hapus Brosur</button>
                            </div>
                        @else
                            <div class="flex flex-col items-center gap-2">
                                <span class="material-symbols-outlined text-5xl text-[#737780]">description</span>
                                <span class="text-xs text-[#737780]">Belum ada brosur</span>
                            </div>
                        @endif
                    </div>

                    {{-- Upload --}}
                    <div class="flex-1">
                        <label class="form-label">Upload Brosur Baru</label>
                        <input type="file" name="brosur" accept="application/pdf"
                            class="form-input file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#fce7f3] file:text-[#be185d] hover:file:bg-[#fbcfe8]">
                        @error('brosur')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="form-hint">Format: PDF. Maksimal 5MB.</p>
                    </div>
                </div>
            </div>

            {{-- Section: WhatsApp --}}
            <div class="setting-card">
                <div class="flex items-center gap-4 mb-6">
                    <div class="section-icon bg-[#d1fae5] text-[#065f46]">
                        <span class="material-symbols-outlined">chat</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-[#001e40]">Hubungi Kami (WhatsApp)</h3>
                        <p class="text-sm text-[#737780]">Nomor WhatsApp untuk tombol "Hubungi Kami" di halaman SPMB</p>
                    </div>
                </div>

                <div>
                    <label class="form-label">Nomor WhatsApp</label>
                    <div class="flex items-center gap-2 max-w-md">
                        <span class="text-sm text-[#737780] font-mono">https://wa.me/</span>
                        <input type="text" name="whatsapp" class="form-input font-mono"
                            value="{{ old('whatsapp', $pengaturan->whatsapp ?? '') }}" placeholder="6281234567890">
                    </div>
                    <p class="form-hint">Masukkan nomor dengan kode negara, tanpa tanda + atau spasi. Contoh: 6281234567890
                    </p>
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

    {{-- Form Hapus Brosur --}}
    <form id="hapus-brosur-form" action="{{ route('admin.spmb.destroy-brosur') }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

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
                            }
                        }
                    });
                });
            });

            function tambahPersyaratan() {
                const container = document.getElementById('persyaratan-container');
                const div = document.createElement('div');
                div.className = 'persyaratan-item';
                div.innerHTML = `
                    <input type="text" name="persyaratan[]" class="form-input"
                        placeholder="Masukkan persyaratan...">
                    <button type="button" onclick="hapusPersyaratan(this)"
                        class="btn-danger !px-3 !py-2 text-lg leading-none">&times;</button>
                `;
                container.appendChild(div);
            }

            function hapusPersyaratan(btn) {
                const item = btn.closest('.persyaratan-item');
                if (document.querySelectorAll('.persyaratan-item').length > 1) {
                    item.remove();
                } else {
                    item.querySelector('input').value = '';
                }
            }

            function confirmHapusBrosur() {
                if (confirm('Apakah Anda yakin ingin menghapus brosur ini?')) {
                    document.getElementById('hapus-brosur-form').submit();
                }
            }
        </script>
    @endpush
@endsection
