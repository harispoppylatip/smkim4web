@extends('layouts.app')

@section('title', 'Backup & Restore')
@section('page_title', 'Backup & Restore')

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

        .btn-primary {
            background: #003366;
            color: #ffffff;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: #001e40;
            color: #ffffff;
        }

        .btn-danger {
            background: #b91c1c;
            color: #ffffff;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn-danger:hover {
            background: #991b1b;
        }

        .btn-danger:disabled {
            background: #e2e2e5;
            color: #8c8c93;
            cursor: not-allowed;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #e2e2e5;
            border-radius: 12px;
            padding: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="space-y-6">

        {{-- Header Teks Tenang --}}
        <div>
            <p class="text-xs uppercase tracking-wider text-[#737780] font-medium mb-1">Pengaturan Sistem</p>
            <h1 class="text-2xl font-bold text-[#001e40]">Cadangan & Pemulihan Sistem (Backup & Restore)</h1>
            <p class="text-sm text-[#5f6368] mt-1">
                Cadangkan seluruh basis data dan berkas foto media situs ke dalam satu berkas .zip utuh, atau pulihkan data dari cadangan yang tersimpan.
            </p>
        </div>

        {{-- Alert Notifikasi --}}
        @if (session('success'))
            <div class="bg-[#d1fae5] text-[#065f46] px-5 py-3.5 rounded-xl text-sm font-medium flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-[#fee2e2] text-[#991b1b] px-5 py-3.5 rounded-xl text-sm font-medium flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-[#fee2e2] text-[#991b1b] px-5 py-4 rounded-xl text-sm font-medium">
                <p class="font-semibold mb-1">Gagal memproses berkas cadangan:</p>
                <ul class="list-disc list-inside space-y-1 text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Ringkasan Statistik Data Saat Ini --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="stat-card">
                <p class="text-xs font-medium text-[#737780] uppercase tracking-wider">Total Rekaman Database</p>
                <div class="mt-2 flex items-baseline justify-between">
                    <p class="text-2xl font-bold text-[#001e40]">{{ number_format($summary['total_records']) }}</p>
                    <span class="text-xs text-[#5f6368]">{{ count($summary['tables_count']) }} tabel aktif</span>
                </div>
            </div>

            <div class="stat-card">
                <p class="text-xs font-medium text-[#737780] uppercase tracking-wider">Berkas Media & Foto</p>
                <div class="mt-2 flex items-baseline justify-between">
                    <p class="text-2xl font-bold text-[#001e40]">{{ number_format($summary['file_count']) }}</p>
                    <span class="text-xs text-[#5f6368]">berkas fisik</span>
                </div>
            </div>

            <div class="stat-card">
                <p class="text-xs font-medium text-[#737780] uppercase tracking-wider">Ukuran Penyimpanan Media</p>
                <div class="mt-2 flex items-baseline justify-between">
                    <p class="text-2xl font-bold text-[#001e40]">{{ $summary['formatted_bytes'] }}</p>
                    <span class="text-xs text-[#5f6368]">di disk publik</span>
                </div>
            </div>
        </div>

        {{-- Dua Kartu Aksi: Unduh Backup & Pulihkan (Restore) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Kartu 1: Unduh Cadangan --}}
            <div class="setting-card flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg bg-[#e8f0fe] text-[#003366] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-[#001e40]">Unduh Cadangan Lengkap (.zip)</h2>
                            <p class="text-xs text-[#5f6368]">Kemas seluruh sistem dalam 1 berkas arsip standar</p>
                        </div>
                    </div>

                    <p class="text-sm text-[#444746] leading-relaxed mb-4">
                        Fitur ini mengemas seluruh data sekolah beserta dokumen dan media gambar yang telah diunggah ke dalam berkas <span class="font-mono text-xs bg-[#f1f3f4] px-1.5 py-0.5 rounded">.zip</span> standar:
                    </p>

                    <div class="bg-[#f9f9fc] rounded-lg p-4 space-y-2 mb-6 text-xs text-[#444746]" style="border: none;">
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-[#003366] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span><strong>Basis Data:</strong> Seluruh tabel (berita, program keahlian, guru, fasilitas, prestasi, SPMB, profil sekolah, dan akun pengguna).</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-[#003366] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span><strong>Berkas Media:</strong> Seluruh foto artikel, logo jurusan, banner hero, brosur SPMB, dan galeri fasilitas.</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-[#003366] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span><strong>Petunjuk Pemulihan:</strong> Disertai berkas <span class="font-mono">BACA-SAYA.txt</span> dan identitas sistem yang sah.</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-[#e2e2e5]">
                    <a href="{{ route('admin.backup.download') }}" class="btn-primary w-full">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span>Unduh Cadangan Sistem Sekarang (.zip)</span>
                    </a>
                </div>
            </div>

            {{-- Kartu 2: Pulihkan Data (Restore) --}}
            <div class="setting-card flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg bg-[#fef2f2] text-[#b91c1c] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-[#001e40]">Pulihkan Data Sistem (Restore .zip)</h2>
                            <p class="text-xs text-[#5f6368]">Unggah berkas .zip cadangan untuk memulihkan seluruh data</p>
                        </div>
                    </div>

                    <div class="bg-[#fff7ed] text-[#9a3412] rounded-lg p-3.5 text-xs leading-relaxed mb-4" style="border: none;">
                        <p class="font-semibold mb-1">Perhatian Penting:</p>
                        <p>Pemulihan data akan menimpa data dan berkas yang saat ini ada di sistem dengan isi dari berkas cadangan. Pastikan berkas yang Anda unggah adalah berkas <span class="font-mono">.zip</span> resmi yang diunduh dari menu Backup SMKIM4.</p>
                    </div>

                    <form id="restore-form" method="POST" action="{{ route('admin.backup.restore') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div>
                            <label for="backup_file" class="block text-xs font-semibold text-[#001e40] mb-1.5">
                                Pilih Berkas Cadangan (.zip)
                            </label>
                            <input
                                type="file"
                                id="backup_file"
                                name="backup_file"
                                accept=".zip,application/zip"
                                required
                                class="block w-full text-xs text-[#444746] file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#e8f0fe] file:text-[#003366] hover:file:bg-[#d2e3fc] file:cursor-pointer border border-[#e2e2e5] rounded-lg p-2 bg-[#f9f9fc]"
                            >
                            <p class="text-[11px] text-[#737780] mt-1">Format berkas harus .zip (maksimum 500 MB).</p>
                        </div>

                        <div class="pt-2">
                            <label class="flex items-start gap-2.5 cursor-pointer">
                                <input
                                    type="checkbox"
                                    id="confirm_restore"
                                    name="confirm_restore"
                                    value="1"
                                    required
                                    class="mt-0.5 rounded border-[#c4c7c5] text-[#003366] focus:ring-[#003366]"
                                    onchange="document.getElementById('btn-restore-submit').disabled = !this.checked;"
                                >
                                <span class="text-xs text-[#444746] leading-relaxed">
                                    Saya memahami dan setuju bahwa seluruh basis data dan berkas saat ini akan digantikan sepenuhnya oleh isi berkas cadangan ini.
                                </span>
                            </label>
                        </div>

                        <div class="pt-4 border-t border-[#e2e2e5]">
                            <button
                                type="submit"
                                id="btn-restore-submit"
                                disabled
                                class="btn-danger w-full"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span id="btn-restore-text">Pulihkan Data Sekarang</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        {{-- Rincian Tabel Basis Data (Collapsible Panel) --}}
        <div class="setting-card">
            <details class="group">
                <summary class="flex items-center justify-between cursor-pointer font-semibold text-sm text-[#001e40] list-none">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#737780]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                        </svg>
                        <span>Lihat Rincian Baris Data Per Tabel ({{ count($summary['tables_count']) }} Tabel)</span>
                    </div>
                    <svg class="w-4 h-4 text-[#737780] transition-transform group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </summary>

                <div class="mt-4 pt-4 border-t border-[#e2e2e5]">
                    <div class="overflow-x-auto">
                        <table class="w-full text-xs text-left">
                            <thead>
                                <tr class="text-[#737780] border-b border-[#e2e2e5]">
                                    <th class="py-2 font-medium">Nama Tabel</th>
                                    <th class="py-2 text-right font-medium">Jumlah Baris Data</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#f1f3f4]">
                                @foreach ($summary['tables_count'] as $tableName => $rowCount)
                                    <tr>
                                        <td class="py-2 font-mono text-[#001e40]">{{ $tableName }}</td>
                                        <td class="py-2 text-right font-semibold text-[#1a1c1e]">{{ number_format($rowCount) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </details>
        </div>

    </div>

    {{-- Script Konfirmasi Dialog --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('restore-form');
            const submitBtn = document.getElementById('btn-restore-submit');
            const btnText = document.getElementById('btn-restore-text');

            if (form) {
                form.addEventListener('submit', function (e) {
                    const confirmMsg = "APAKAH ANDA YAKIN?\n\nProses pemulihan data akan mengganti seluruh database dan berkas media situs dengan isi file cadangan yang Anda pilih.\n\nTindakan ini tidak dapat dibatalkan.";
                    if (!confirm(confirmMsg)) {
                        e.preventDefault();
                        return false;
                    }

                    submitBtn.disabled = true;
                    btnText.textContent = "Sedang Memulihkan Data...";
                });
            }
        });
    </script>
@endsection

