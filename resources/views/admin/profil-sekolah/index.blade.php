@extends('layouts.app')

@section('title', 'Profil Sekolah')
@section('page_title', 'Profil Sekolah')

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

        .section-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .preview-img {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            object-fit: cover;
            border: 3px solid #e2e2e5;
            background: #f3f3f6;
        }

        .preview-img-lg {
            width: 100%;
            max-width: 400px;
            max-height: 250px;
            border-radius: 12px;
            object-fit: contain;
            border: 3px solid #e2e2e5;
            background: #f3f3f6;
        }

        .timeline-item {
            background: #f9f9fc;
            border: 1px solid #e2e2e5;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 12px;
            position: relative;
        }

        .nilai-item,
        .struktur-item {
            background: #f9f9fc;
            border: 1px solid #e2e2e5;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 12px;
            position: relative;
        }

        .remove-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 28px;
            height: 28px;
            border-radius: 6px;
            border: none;
            background: #fef2f2;
            color: #dc2626;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: background 0.2s;
        }

        .remove-btn:hover {
            background: #fee2e2;
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

        <form action="{{ route('admin.profil-sekolah.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- ==================== SEJARAH ==================== --}}
            <div class="setting-card">
                <div class="flex items-center gap-4 mb-6">
                    <div class="section-icon bg-[#d5e3ff] text-[#003366]">
                        <span class="material-symbols-outlined">history_edu</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-[#001e40]">Sejarah Sekolah</h3>
                        <p class="text-sm text-[#737780]">Cerita perjalanan dan sejarah berdirinya SMKIM4</p>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="form-label">Konten Sejarah</label>
                    <textarea name="sejarah" id="sejarah-editor" rows="8" class="form-input" placeholder="Tulis sejarah sekolah...">{{ old('sejarah', $profil->sejarah ?? '') }}</textarea>
                    <p class="form-hint">Gunakan editor di atas untuk merapikan teks sejarah sekolah.</p>
                </div>

                <div>
                    <label class="form-label">Gambar Sejarah</label>
                    <div class="flex flex-col md:flex-row gap-4 items-start">
                        <div class="text-center">
                            @if ($profil && $profil->sejarah_gambar)
                                <img src="{{ asset('storage/' . $profil->sejarah_gambar) }}" alt="Gambar Sejarah"
                                    class="preview-img-lg">
                                <div class="mt-2">
                                    <a href="{{ route('admin.profil-sekolah.destroy-gambar', 'sejarah') }}"
                                        class="text-xs text-red-600 hover:text-red-800 font-medium"
                                        onclick="event.preventDefault(); if(confirm('Hapus gambar ini?')) document.getElementById('delete-sejarah-form').submit();">Hapus
                                        Gambar</a>
                                </div>
                            @else
                                <div class="preview-img-lg flex items-center justify-center bg-[#f3f3f6] text-[#737780]"
                                    style="height:150px;width:300px;">
                                    <span class="material-symbols-outlined text-4xl">image</span>
                                </div>
                                <p class="text-xs text-[#737780] mt-2">Belum ada gambar</p>
                            @endif
                        </div>
                        <div class="flex-1">
                            <input type="file" name="sejarah_gambar" accept="image/jpeg,image/png,image/webp"
                                class="form-input file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#d5e3ff] file:text-[#003366] hover:file:bg-[#a7c8ff]">
                            <p class="form-hint">Format: JPG, PNG, WEBP. Maksimal 5MB.</p>
                            @error('sejarah_gambar')
                                <p class="text-xs text-[#ba1a1a] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==================== VISI & MISI ==================== --}}
            <div class="setting-card">
                <div class="flex items-center gap-4 mb-6">
                    <div class="section-icon bg-[#d1fae5] text-[#065f46]">
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-[#001e40]">Visi & Misi</h3>
                        <p class="text-sm text-[#737780]">Visi dan misi sekolah</p>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="form-label">Visi</label>
                    <textarea name="visi" rows="3" class="form-input" placeholder="Tulis visi sekolah...">{{ old('visi', $profil->visi ?? '') }}</textarea>
                </div>

                <div>
                    <label class="form-label">Misi</label>
                    <p class="form-hint mb-2">Tulis setiap misi dalam satu baris (setiap baris akan menjadi poin misi).</p>
                    <textarea name="misi" rows="6" class="form-input"
                        placeholder="Tulis misi sekolah, setiap baris adalah satu poin misi...">{{ old('misi', $profil->misi ?? '') }}</textarea>
                </div>
            </div>

            {{-- ==================== TIMELINE ==================== --}}
            <div class="setting-card">
                <div class="flex items-center gap-4 mb-6">
                    <div class="section-icon bg-[#fce7f3] text-[#be185d]">
                        <span class="material-symbols-outlined">timeline</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-[#001e40]">Timeline Perjalanan</h3>
                        <p class="text-sm text-[#737780]">Tonggak sejarah sekolah dalam bentuk timeline</p>
                    </div>
                </div>

                <div id="timeline-container">
                    @php
                        $timeline = old(
                            'timeline',
                            $profil->timeline ?? [
                                [
                                    'tahun' => '2010',
                                    'judul' => 'Pendirian Sekolah',
                                    'deskripsi' => 'SMK Istiqomah Muhammadiyah 4 Samarinda resmi berdiri.',
                                    'icon' => 'flag',
                                ],
                                [
                                    'tahun' => '2014',
                                    'judul' => 'Akreditasi A',
                                    'deskripsi' => 'Meraih akreditasi A dari BAN-SM.',
                                    'icon' => 'award_star',
                                ],
                                [
                                    'tahun' => '2017',
                                    'judul' => 'Laboratorium Modern',
                                    'deskripsi' => 'Peresmian laboratorium komputer dan jaringan baru.',
                                    'icon' => 'dns',
                                ],
                                [
                                    'tahun' => '2020',
                                    'judul' => '1.000 Lulusan',
                                    'deskripsi' => 'Mencapai milestone 1.000 lulusan.',
                                    'icon' => 'groups',
                                ],
                                [
                                    'tahun' => '2025',
                                    'judul' => 'Transformasi Digital',
                                    'deskripsi' => 'Meluncurkan program transformasi digital.',
                                    'icon' => 'rocket_launch',
                                ],
                            ],
                        );
                    @endphp

                    @foreach ($timeline as $index => $item)
                        <div class="timeline-item" data-index="{{ $index }}">
                            <button type="button" class="remove-btn"
                                onclick="this.closest('.timeline-item').remove()">✕</button>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="form-label">Tahun</label>
                                    <input type="text" name="timeline[{{ $index }}][tahun]" class="form-input"
                                        value="{{ $item['tahun'] ?? '' }}" placeholder="2010">
                                </div>
                                <div>
                                    <label class="form-label">Icon <span class="text-[#737780] font-normal">(Material
                                            Symbol)</span></label>
                                    <input type="text" name="timeline[{{ $index }}][icon]" class="form-input"
                                        value="{{ $item['icon'] ?? 'flag' }}" placeholder="flag">
                                    <p class="form-hint">Cari icon di <a href="https://fonts.google.com/icons"
                                            target="_blank"
                                            class="text-[#003366] underline hover:text-[#001e40]">fonts.google.com/icons</a>
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="timeline[{{ $index }}][judul]" class="form-input"
                                    value="{{ $item['judul'] ?? '' }}" placeholder="Pendirian Sekolah">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="timeline[{{ $index }}][deskripsi]" rows="2" class="form-input"
                                    placeholder="Deskripsi...">{{ $item['deskripsi'] ?? '' }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" onclick="addTimeline()"
                    class="mt-3 px-4 py-2 border border-dashed border-[#c3c6d1] rounded-lg text-sm font-medium text-[#737780] hover:border-[#001e40] hover:text-[#001e40] transition-colors w-full">
                    + Tambah Timeline
                </button>
            </div>

            {{-- ==================== NILAI-NILAI ==================== --}}
            <div class="setting-card">
                <div class="flex items-center gap-4 mb-6">
                    <div class="section-icon bg-[#fff3e0] text-[#e65100]">
                        <span class="material-symbols-outlined">diamond</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-[#001e40]">Nilai-Nilai Karakter</h3>
                        <p class="text-sm text-[#737780]">Nilai-nilai yang menjadi karakter SMKIM4</p>
                    </div>
                </div>

                <div id="nilai-container">
                    @php
                        $nilai = old(
                            'nilai',
                            $profil->nilai ?? [
                                [
                                    'icon' => 'mosque',
                                    'judul' => 'Islami',
                                    'deskripsi' => 'Berlandaskan nilai-nilai Islam',
                                ],
                                [
                                    'icon' => 'computer',
                                    'judul' => 'Teknologi',
                                    'deskripsi' => 'Melek teknologi terkini',
                                ],
                                [
                                    'icon' => 'handshake',
                                    'judul' => 'Integritas',
                                    'deskripsi' => 'Jujur dan bertanggung jawab',
                                ],
                                ['icon' => 'public', 'judul' => 'Global', 'deskripsi' => 'Berdaya saing global'],
                            ],
                        );
                    @endphp

                    @foreach ($nilai as $index => $item)
                        <div class="nilai-item" data-index="{{ $index }}">
                            <button type="button" class="remove-btn"
                                onclick="this.closest('.nilai-item').remove()">✕</button>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="form-label">Icon</label>
                                    <input type="text" name="nilai[{{ $index }}][icon]" class="form-input"
                                        value="{{ $item['icon'] ?? 'diamond' }}" placeholder="mosque">
                                    <p class="form-hint">Cari icon di <a href="https://fonts.google.com/icons"
                                            target="_blank"
                                            class="text-[#003366] underline hover:text-[#001e40]">fonts.google.com/icons</a>
                                    </p>
                                </div>
                                <div>
                                    <label class="form-label">Judul</label>
                                    <input type="text" name="nilai[{{ $index }}][judul]" class="form-input"
                                        value="{{ $item['judul'] ?? '' }}" placeholder="Islami">
                                </div>
                                <div>
                                    <label class="form-label">Deskripsi</label>
                                    <input type="text" name="nilai[{{ $index }}][deskripsi]"
                                        class="form-input" value="{{ $item['deskripsi'] ?? '' }}"
                                        placeholder="Berlandaskan nilai-nilai Islam">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" onclick="addNilai()"
                    class="mt-3 px-4 py-2 border border-dashed border-[#c3c6d1] rounded-lg text-sm font-medium text-[#737780] hover:border-[#001e40] hover:text-[#001e40] transition-colors w-full">
                    + Tambah Nilai
                </button>
            </div>

            {{-- ==================== STRUKTUR ORGANISASI ==================== --}}
            <div class="setting-card">
                <div class="flex items-center gap-4 mb-6">
                    <div class="section-icon bg-[#e8f5e9] text-[#2e7d32]">
                        <span class="material-symbols-outlined">account_tree</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-[#001e40]">Struktur Organisasi</h3>
                        <p class="text-sm text-[#737780]">Data jabatan dan gambar struktur organisasi</p>
                    </div>
                </div>

                {{-- Data Jabatan --}}
                <label class="form-label mb-3">Data Jabatan</label>
                <div id="struktur-container">
                    @php
                        $struktur = old(
                            'struktur_organisasi',
                            $profil->struktur_organisasi ?? [
                                [
                                    'jabatan' => 'Kepala Sekolah',
                                    'nama' => 'Dr. H. Ahmad Fauzi, M.Pd.',
                                    'icon' => 'badge',
                                    'foto' => null,
                                    'is_kepsek' => true,
                                    'level' => 1,
                                ],
                                [
                                    'jabatan' => 'Wakasek Kurikulum',
                                    'nama' => 'Siti Rahmawati, S.Pd., M.Pd.',
                                    'icon' => 'school',
                                    'foto' => null,
                                    'is_kepsek' => false,
                                    'level' => 2,
                                ],
                                [
                                    'jabatan' => 'Wakasek Kesiswaan',
                                    'nama' => 'M. Rizky Pratama, S.Pd.',
                                    'icon' => 'diversity_3',
                                    'foto' => null,
                                    'is_kepsek' => false,
                                    'level' => 2,
                                ],
                                [
                                    'jabatan' => 'Wakasek Humas',
                                    'nama' => 'Doni Setiawan, S.Kom.',
                                    'icon' => 'business_center',
                                    'foto' => null,
                                    'is_kepsek' => false,
                                    'level' => 2,
                                ],
                                [
                                    'jabatan' => 'Wakasek Sarpras',
                                    'nama' => 'Hendra Gunawan, S.T.',
                                    'icon' => 'inventory_2',
                                    'foto' => null,
                                    'is_kepsek' => false,
                                    'level' => 2,
                                ],
                            ],
                        );
                    @endphp

                    @foreach ($struktur as $index => $item)
                        <div class="struktur-item" data-index="{{ $index }}">
                            <button type="button" class="remove-btn"
                                onclick="this.closest('.struktur-item').remove()">✕</button>
                            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                                <div>
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" name="struktur_organisasi[{{ $index }}][jabatan]"
                                        class="form-input" value="{{ $item['jabatan'] ?? '' }}"
                                        placeholder="Kepala Sekolah">
                                </div>
                                <div>
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="struktur_organisasi[{{ $index }}][nama]"
                                        class="form-input" value="{{ $item['nama'] ?? '' }}"
                                        placeholder="Dr. H. Ahmad Fauzi, M.Pd.">
                                </div>
                                <div>
                                    <label class="form-label">Foto</label>
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="struktur-foto-preview w-10 h-10 rounded-full flex items-center justify-center border border-[#e2e2e5] flex-shrink-0 overflow-hidden bg-[#f3f3f6]">
                                            @if (!empty($item['foto']))
                                                <img src="{{ asset('storage/' . $item['foto']) }}" alt="Foto"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <span
                                                    class="material-symbols-outlined text-[#737780] text-lg">person</span>
                                            @endif
                                        </div>
                                        <input type="file" name="struktur_organisasi[{{ $index }}][foto]"
                                            accept="image/jpeg,image/png,image/webp"
                                            onchange="previewStrukturFoto(this, 'struktur_organisasi[{{ $index }}][foto]')"
                                            class="form-input text-xs file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#d5e3ff] file:text-[#003366] hover:file:bg-[#a7c8ff]">
                                    </div>
                                    <p class="text-xs text-[#737780] mt-1">Format: JPEG, PNG, WebP. Maks: 5MB.</p>
                                    @error('struktur_organisasi.' . $index . '.foto')
                                        <p class="text-xs text-[#ba1a1a] mt-1">{{ $message }}</p>
                                    @enderror
                                    @if (!empty($item['foto']))
                                        <label class="text-xs text-[#737780] mt-1 flex items-center gap-1">
                                            <input type="checkbox"
                                                name="struktur_organisasi[{{ $index }}][hapus_foto]"
                                                value="1" class="w-3 h-3">
                                            Hapus foto
                                        </label>
                                    @endif
                                    <input type="hidden" name="struktur_organisasi[{{ $index }}][foto_lama]"
                                        value="{{ $item['foto'] ?? '' }}">
                                </div>
                                <div>
                                    <label class="form-label">Icon <span
                                            class="text-[#737780] font-normal">(opsional)</span></label>
                                    <input type="text" name="struktur_organisasi[{{ $index }}][icon]"
                                        class="form-input" value="{{ $item['icon'] ?? 'badge' }}" placeholder="badge">
                                    <p class="form-hint">Cari icon di <a href="https://fonts.google.com/icons"
                                            target="_blank"
                                            class="text-[#003366] underline hover:text-[#001e40]">fonts.google.com/icons</a>
                                    </p>
                                </div>
                                <div>
                                    <label class="form-label">Level <span
                                            class="text-[#737780] font-normal">(lapis)</span></label>
                                    <select name="struktur_organisasi[{{ $index }}][level]" class="form-input">
                                        <option value="1" {{ ($item['level'] ?? 2) == 1 ? 'selected' : '' }}>Layer 1
                                            (Puncak)
                                        </option>
                                        <option value="2" {{ ($item['level'] ?? 2) == 2 ? 'selected' : '' }}>Layer 2
                                        </option>
                                        <option value="3" {{ ($item['level'] ?? 2) == 3 ? 'selected' : '' }}>Layer 3
                                        </option>
                                        <option value="4" {{ ($item['level'] ?? 2) == 4 ? 'selected' : '' }}>Layer 4
                                        </option>
                                        <option value="5" {{ ($item['level'] ?? 2) == 5 ? 'selected' : '' }}>Layer 5
                                        </option>
                                    </select>
                                    <p class="form-hint">Layer 1 = paling atas (puncak piramida)</p>
                                </div>
                            </div>
                            <div class="mt-3 flex items-center gap-2">
                                <input type="checkbox" name="struktur_organisasi[{{ $index }}][is_kepsek]"
                                    value="1" {{ $item['is_kepsek'] ?? false ? 'checked' : '' }}
                                    class="w-4 h-4 rounded border-[#c3c6d1] text-[#001e40] focus:ring-[#001e40]">
                                <label class="text-sm text-[#43474f]">Kepala Sekolah</label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" onclick="addStruktur()"
                    class="mt-3 px-4 py-2 border border-dashed border-[#c3c6d1] rounded-lg text-sm font-medium text-[#737780] hover:border-[#001e40] hover:text-[#001e40] transition-colors w-full">
                    + Tambah Jabatan
                </button>
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('dashboard') }}"
                    class="px-5 py-2.5 text-sm font-semibold text-[#737780] hover:text-[#1a1c1e] transition-colors">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    Simpan Profil Sekolah
                </button>
            </div>
        </form>
    </div>

    {{-- Form Hapus Gambar --}}
    <form id="delete-sejarah-form" action="{{ route('admin.profil-sekolah.destroy-gambar', 'sejarah') }}" method="POST"
        class="hidden">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        <script>
            let timelineIndex =
                {{ count(old('timeline', $profil->timeline ?? [['tahun' => '', 'judul' => '', 'deskripsi' => '', 'icon' => 'flag']])) }};
            let nilaiIndex = {{ count(old('nilai', $profil->nilai ?? [['icon' => '', 'judul' => '', 'deskripsi' => '']])) }};
            let strukturIndex =
                {{ count(old('struktur_organisasi', $profil->struktur_organisasi ?? [['jabatan' => '', 'nama' => '', 'icon' => '', 'is_kepsek' => false]])) }};

            function addTimeline() {
                const i = timelineIndex++;
                const html = `
                    <div class="timeline-item" data-index="${i}">
                        <button type="button" class="remove-btn" onclick="this.closest('.timeline-item').remove()">✕</button>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">Tahun</label>
                                <input type="text" name="timeline[${i}][tahun]" class="form-input" placeholder="2010">
                            </div>
                            <div>
                                <label class="form-label">Icon</label>
                                <input type="text" name="timeline[${i}][icon]" class="form-input" placeholder="flag">
                                <p class="form-hint">Cari icon di <a href="https://fonts.google.com/icons" target="_blank" class="text-[#003366] underline hover:text-[#001e40]">fonts.google.com/icons</a></p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="timeline[${i}][judul]" class="form-input" placeholder="Pendirian Sekolah">
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="timeline[${i}][deskripsi]" rows="2" class="form-input" placeholder="Deskripsi..."></textarea>
                        </div>
                    </div>
                `;
                document.getElementById('timeline-container').insertAdjacentHTML('beforeend', html);
            }

            function addNilai() {
                const i = nilaiIndex++;
                const html = `
                    <div class="nilai-item" data-index="${i}">
                        <button type="button" class="remove-btn" onclick="this.closest('.nilai-item').remove()">✕</button>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="form-label">Icon</label>
                                <input type="text" name="nilai[${i}][icon]" class="form-input" placeholder="mosque">
                                <p class="form-hint">Cari icon di <a href="https://fonts.google.com/icons" target="_blank" class="text-[#003366] underline hover:text-[#001e40]">fonts.google.com/icons</a></p>
                            </div>
                            <div>
                                <label class="form-label">Judul</label>
                                <input type="text" name="nilai[${i}][judul]" class="form-input" placeholder="Islami">
                            </div>
                            <div>
                                <label class="form-label">Deskripsi</label>
                                <input type="text" name="nilai[${i}][deskripsi]" class="form-input" placeholder="Berlandaskan nilai-nilai Islam">
                            </div>
                        </div>
                    </div>
                `;
                document.getElementById('nilai-container').insertAdjacentHTML('beforeend', html);
            }

            function addStruktur() {
                const i = strukturIndex++;
                const html = `
                    <div class="struktur-item" data-index="${i}">
                        <button type="button" class="remove-btn" onclick="this.closest('.struktur-item').remove()">✕</button>
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            <div>
                                <label class="form-label">Jabatan</label>
                                <input type="text" name="struktur_organisasi[${i}][jabatan]" class="form-input" placeholder="Kepala Sekolah">
                            </div>
                            <div>
                                <label class="form-label">Nama</label>
                                <input type="text" name="struktur_organisasi[${i}][nama]" class="form-input" placeholder="Dr. H. Ahmad Fauzi, M.Pd.">
                            </div>
                            <div>
                                <label class="form-label">Foto</label>
                                <div class="flex items-center gap-2">
                                    <div class="struktur-foto-preview w-10 h-10 rounded-full flex items-center justify-center border border-[#e2e2e5] flex-shrink-0 overflow-hidden bg-[#f3f3f6]">
                                        <span class="material-symbols-outlined text-[#737780] text-lg">person</span>
                                    </div>
                                    <input type="file" name="struktur_organisasi[${i}][foto]" accept="image/jpeg,image/png,image/webp" onchange="previewStrukturFoto(this, 'struktur_organisasi[${i}][foto]')" class="form-input text-xs file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#d5e3ff] file:text-[#003366] hover:file:bg-[#a7c8ff]">
                                </div>
                                <p class="text-xs text-[#737780] mt-1">Format: JPEG, PNG, WebP. Maks: 5MB.</p>
                                <input type="hidden" name="struktur_organisasi[${i}][foto_lama]" value="">
                            </div>
                            <div>
                                <label class="form-label">Icon <span class="text-[#737780] font-normal">(opsional)</span></label>
                                <input type="text" name="struktur_organisasi[${i}][icon]" class="form-input" placeholder="badge">
                                <p class="form-hint">Cari icon di <a href="https://fonts.google.com/icons" target="_blank" class="text-[#003366] underline hover:text-[#001e40]">fonts.google.com/icons</a></p>
                            </div>
                            <div>
                                <label class="form-label">Level <span class="text-[#737780] font-normal">(lapis)</span></label>
                                <select name="struktur_organisasi[${i}][level]" class="form-input">
                                    <option value="1">Layer 1 (Puncak)</option>
                                    <option value="2" selected>Layer 2</option>
                                    <option value="3">Layer 3</option>
                                    <option value="4">Layer 4</option>
                                    <option value="5">Layer 5</option>
                                </select>
                                <p class="form-hint">Layer 1 = paling atas (puncak piramida)</p>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center gap-2">
                            <input type="checkbox" name="struktur_organisasi[${i}][is_kepsek]" value="1" class="w-4 h-4 rounded border-[#c3c6d1] text-[#001e40] focus:ring-[#001e40]">
                            <label class="text-sm text-[#43474f]">Kepala Sekolah</label>
                        </div>
                    </div>
                `;
                document.getElementById('struktur-container').insertAdjacentHTML('beforeend', html);
            }

            function previewStrukturFoto(input, name) {
                const container = input.closest('.struktur-item') || input.closest('div');
                const preview = container.querySelector('.struktur-foto-preview');
                if (!preview) return;

                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const maxSize = 5 * 1024 * 1024; // 5MB
                    if (file.size > maxSize) {
                        alert('Ukuran foto terlalu besar! Maksimal 5MB.');
                        input.value = '';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML =
                            `<img src="${e.target.result}" class="w-full h-full object-cover rounded-full">`;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Validasi client-side + preview untuk upload gambar sejarah
            document.addEventListener('DOMContentLoaded', function() {
                const sejarahInput = document.querySelector('input[name="sejarah_gambar"]');
                if (sejarahInput) {
                    sejarahInput.addEventListener('change', function() {
                        if (this.files && this.files[0]) {
                            const maxSize = 5 * 1024 * 1024; // 5MB
                            if (this.files[0].size > maxSize) {
                                alert('Ukuran gambar terlalu besar! Maksimal 5MB.');
                                this.value = '';
                                return;
                            }
                            // Preview gambar sejarah
                            const preview = document.querySelector('.preview-img-lg');
                            if (preview) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    preview.innerHTML = '<img src="' + e.target.result +
                                        '" class="w-full h-full object-cover rounded-lg" style="height:150px;width:300px;">';
                                    preview.className = 'preview-img-lg overflow-hidden';
                                };
                                reader.readAsDataURL(this.files[0]);
                            }
                        }
                    });
                }
            });
        </script>

        {{-- TinyMCE untuk Konten Sejarah --}}
        <script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: '#sejarah-editor',
                license_key: 'gpl',
                height: 400,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | bold italic underline strikethrough | bullist numlist outdent indent | alignleft aligncenter alignright alignjustify | removeformat | help',
                content_style: 'body { font-family:Inter,sans-serif; font-size:14px; line-height:1.7; color:#1a1c1e; }',
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save();
                    });
                }
            });
        </script>
    @endpush
@endsection
