@extends('layouts.app')

@section('title', 'Pengaturan Sosial Media')
@section('page_title', 'Pengaturan Sosial Media')

@section('styles')
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

        .section-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .social-preview {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .social-preview:hover {
            transform: translateY(-1px);
        }
    </style>
@endsection

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

        <form action="{{ route('admin.sosial-media.update') }}" method="POST">
            @csrf

            {{-- Section: Sosial Media --}}
            <div class="setting-card">
                <div class="flex items-center gap-4 mb-6">
                    <div class="section-icon bg-[#d5e3ff] text-[#003366]">
                        <span class="material-symbols-outlined">share</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-[#001e40]">Link Sosial Media</h3>
                        <p class="text-sm text-[#737780]">Masukkan URL profil sosial media sekolah. Link ini akan tampil di
                            footer website.</p>
                    </div>
                </div>

                <div class="space-y-5">
                    {{-- YouTube --}}
                    <div>
                        <label class="form-label">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                                YouTube
                            </span>
                        </label>
                        <input type="url" name="youtube" class="form-input"
                            value="{{ old('youtube', $pengaturan->youtube ?? '') }}"
                            placeholder="https://youtube.com/@smkim4samarinda">
                        <p class="form-hint">URL channel YouTube sekolah</p>
                    </div>

                    {{-- Instagram --}}
                    <div>
                        <label class="form-label">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z" />
                                </svg>
                                Instagram
                            </span>
                        </label>
                        <input type="url" name="instagram" class="form-input"
                            value="{{ old('instagram', $pengaturan->instagram ?? '') }}"
                            placeholder="https://instagram.com/smkim4samarinda">
                        <p class="form-hint">URL profil Instagram sekolah</p>
                    </div>

                    {{-- Facebook --}}
                    <div>
                        <label class="form-label">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                                Facebook
                            </span>
                        </label>
                        <input type="url" name="facebook" class="form-input"
                            value="{{ old('facebook', $pengaturan->facebook ?? '') }}"
                            placeholder="https://facebook.com/smkim4samarinda">
                        <p class="form-hint">URL halaman Facebook sekolah</p>
                    </div>

                    {{-- TikTok --}}
                    <div>
                        <label class="form-label">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                </svg>
                                TikTok
                            </span>
                        </label>
                        <input type="url" name="tiktok" class="form-input"
                            value="{{ old('tiktok', $pengaturan->tiktok ?? '') }}"
                            placeholder="https://tiktok.com/@smkim4samarinda">
                        <p class="form-hint">URL profil TikTok sekolah</p>
                    </div>
                </div>
            </div>

            {{-- Preview --}}
            @if ($pengaturan && ($pengaturan->youtube || $pengaturan->instagram || $pengaturan->facebook || $pengaturan->tiktok))
                <div class="setting-card">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="section-icon bg-[#e0f2fe] text-[#0369a1]">
                            <span class="material-symbols-outlined">visibility</span>
                        </div>
                        <div>
                            <h3 class="font-heading text-lg font-bold text-[#001e40]">Pratinjau Tampilan Footer</h3>
                            <p class="text-sm text-[#737780]">Ikon sosial media akan tampil seperti ini di footer website
                            </p>
                        </div>
                    </div>
                    <div class="bg-[#001a33] rounded-xl p-6 flex items-center gap-3 flex-wrap">
                        @if ($pengaturan->youtube)
                            <a href="{{ $pengaturan->youtube }}" target="_blank" rel="noopener noreferrer"
                                class="social-preview bg-white/10 text-white/70 hover:bg-red-600 hover:text-white">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                                YouTube
                            </a>
                        @endif
                        @if ($pengaturan->instagram)
                            <a href="{{ $pengaturan->instagram }}" target="_blank" rel="noopener noreferrer"
                                class="social-preview bg-white/10 text-white/70 hover:bg-gradient-to-tr hover:from-purple-600 hover:via-pink-500 hover:to-yellow-500 hover:text-white">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z" />
                                </svg>
                                Instagram
                            </a>
                        @endif
                        @if ($pengaturan->facebook)
                            <a href="{{ $pengaturan->facebook }}" target="_blank" rel="noopener noreferrer"
                                class="social-preview bg-white/10 text-white/70 hover:bg-blue-600 hover:text-white">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                                Facebook
                            </a>
                        @endif
                        @if ($pengaturan->tiktok)
                            <a href="{{ $pengaturan->tiktok }}" target="_blank" rel="noopener noreferrer"
                                class="social-preview bg-white/10 text-white/70 hover:bg-black hover:text-white">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                </svg>
                                TikTok
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Submit --}}
            <div class="flex justify-end">
                <button type="submit" class="btn-primary flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">save</span>
                    Simpan Pengaturan
                </button>
            </div>
        </form>

    </div>
@endsection


