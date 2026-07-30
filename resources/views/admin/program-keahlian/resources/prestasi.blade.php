<div id="prestasi" class="resource-section max-w-4xl mb-8">
    <div class="bg-white rounded-xl border border-[#e2e2e5] overflow-hidden">
        <div class="px-6 py-4 bg-[#f9f9fc] border-b border-[#e2e2e5]">
            <h3 class="text-sm font-semibold text-[#1a1c1e]">Prestasi Siswa</h3>
            <p class="text-xs text-[#737780]">Tambah, edit, atau hapus prestasi siswa.</p>
        </div>
        <div class="p-6">
            {{-- Form Tambah Prestasi --}}
            <form method="POST" action="{{ route('admin.program-keahlian.prestasi.store', $program->id) }}"
                enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-6 pb-6 border-b border-[#e2e2e5]">
                @csrf
                <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Judul Prestasi</label>
                    <input type="text" name="judul" required placeholder="cth: Juara 1 Lomba Kompetensi Siswa"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                </div>
                <div>
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Tahun</label>
                    <input type="text" name="tahun" required placeholder="cth: 2025"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                </div>
                <div>
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Icon (opsional)</label>
                    <input type="text" name="icon" placeholder="Nama icon Material"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                </div>
                <div class="md:col-span-4">
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Deskripsi</label>
                    <textarea name="deskripsi" placeholder="Deskripsi prestasi"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent"
                        rows="2"></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Gambar (opsional)</label>
                    <div class="custom-file-input">
                        <input type="file" name="gambar" accept="image/*"
                            onchange="this.parentElement.classList.add('has-file'); this.nextElementSibling.querySelector('span').textContent = this.files[0].name">
                        <div class="custom-file-label">
                            <span class="material-symbols-outlined text-base">image</span>
                            <span>Pilih gambar prestasi...</span>
                        </div>
                    </div>
                    <p class="text-xs text-[#737780] mt-1">Format: JPEG, PNG, WebP. Maks: 2MB.</p>
                </div>
                <div class="col-span-4 flex items-end">
                    <button
                        class="px-4 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">Tambah
                        Prestasi</button>
                </div>
            </form>

            {{-- Daftar Prestasi --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @forelse ($program->prestasi as $item)
                    {{-- Card Prestasi (tampilan normal) --}}
                    <div class="bg-[#f9f9fc] rounded-lg overflow-hidden border border-[#e2e2e5]"
                        id="prestasi-card-{{ $item->id }}">
                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-40 object-cover"
                                alt="{{ $item->judul }}">
                        @else
                            <div class="w-full h-32 bg-[#e8f0fe] flex items-center justify-center">
                                <span class="material-symbols-outlined text-4xl text-[#001e40]/30">emoji_events</span>
                            </div>
                        @endif
                        <div class="p-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-semibold text-sm">{{ $item->judul }}</h4>
                                    <p class="text-xs text-[#737780]">{{ $item->tahun }}</p>
                                </div>
                                <div class="flex items-center gap-1">
                                    <button type="button" onclick="openEditPrestasi({{ $item->id }})"
                                        class="px-2 py-1 text-xs text-[#003366] hover:bg-[#d5e3ff] rounded transition-colors">Edit</button>
                                    <button type="button"
                                        onclick="confirmHapusPrestasi({{ $item->id }}, '{{ addslashes($item->judul) }}')"
                                        class="px-2 py-1 text-xs text-[#ba1a1a] hover:bg-[#fff1f1] rounded transition-colors">Hapus</button>
                                </div>
                            </div>
                            @if ($item->deskripsi)
                                <p class="text-xs text-[#737780] mt-2">{{ $item->deskripsi }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- Card Edit Prestasi (hidden by default) --}}
                    <div class="bg-white rounded-lg overflow-hidden border-2 border-[#001e40] hidden"
                        id="prestasi-edit-{{ $item->id }}">
                        <div class="p-4">
                            <h4 class="text-sm font-semibold text-[#1a1c1e] mb-3">Edit Prestasi</h4>
                            <form method="POST"
                                action="{{ route('admin.program-keahlian.prestasi.update', [$program->id, $item->id]) }}"
                                enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @csrf
                                @method('PUT')
                                <div class="md:col-span-2">
                                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Judul
                                        Prestasi</label>
                                    <input type="text" name="judul" value="{{ $item->judul }}" required
                                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Tahun</label>
                                    <input type="text" name="tahun" value="{{ $item->tahun }}" required
                                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Icon</label>
                                    <input type="text" name="icon" value="{{ $item->icon }}"
                                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Deskripsi</label>
                                    <textarea name="deskripsi" rows="2"
                                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">{{ $item->deskripsi }}</textarea>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Gambar (biarkan
                                        kosong jika tidak diganti)</label>
                                    <div class="flex items-center gap-3">
                                        @if ($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                                class="w-16 h-12 rounded object-cover">
                                        @endif
                                        <div class="custom-file-input flex-1">
                                            <input type="file" name="gambar" accept="image/*"
                                                onchange="this.parentElement.classList.add('has-file'); this.nextElementSibling.querySelector('span').textContent = this.files[0].name">
                                            <div class="custom-file-label">
                                                <span class="material-symbols-outlined text-base">image</span>
                                                <span>Ganti gambar...</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-xs text-[#737780] mt-1">Format: JPEG, PNG, WebP. Maks: 2MB.</p>
                                </div>
                                <div class="md:col-span-2 flex items-center gap-2">
                                    <button type="submit"
                                        class="px-4 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">Simpan</button>
                                    <button type="button" onclick="closeEditPrestasi({{ $item->id }})"
                                        class="px-4 py-2 bg-white border border-[#c3c6d1] text-[#43474f] rounded-lg text-sm font-semibold hover:bg-[#f3f3f6] transition-colors">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-3 text-center text-[#737780] py-6 bg-[#f9f9fc] rounded-lg">Belum ada
                        prestasi.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus Prestasi --}}
<div id="hapusPrestasiModal" class="fixed inset-0 z-50 hidden bg-black/40 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-xl max-w-sm w-full mx-4 p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-[#fff1f1] flex items-center justify-center">
                <span class="material-symbols-outlined text-[#ba1a1a]">delete</span>
            </div>
            <div>
                <h4 class="text-sm font-semibold text-[#1a1c1e]">Hapus Prestasi</h4>
                <p class="text-xs text-[#737780]">Apakah Anda yakin ingin menghapus prestasi ini?</p>
            </div>
        </div>
        <p id="hapusPrestasiNama" class="text-sm font-medium text-[#43474f] bg-[#f9f9fc] rounded-lg px-4 py-3 mb-4">
        </p>
        <form id="hapusPrestasiForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex gap-2 justify-end">
                <button type="button" onclick="tutupModalHapusPrestasi()"
                    class="px-4 py-2 bg-white border border-[#c3c6d1] text-[#43474f] rounded-lg text-sm font-semibold hover:bg-[#f3f3f6] transition-colors">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-[#ba1a1a] text-white rounded-lg text-sm font-semibold hover:bg-[#a01818] transition-colors">Ya,
                    Hapus</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('#prestasi input[type="file"]').forEach(function(input) {
                input.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        var maxSize = 2 * 1024 * 1024;
                        if (this.files[0].size > maxSize) {
                            alert('Ukuran file terlalu besar! Maksimal 2MB.');
                            this.value = '';
                        }
                    }
                });
            });
        });

        // ========== EDIT PRESTASI ==========
        function openEditPrestasi(id) {
            document.getElementById('prestasi-card-' + id).classList.add('hidden');
            document.getElementById('prestasi-edit-' + id).classList.remove('hidden');
        }

        function closeEditPrestasi(id) {
            document.getElementById('prestasi-card-' + id).classList.remove('hidden');
            document.getElementById('prestasi-edit-' + id).classList.add('hidden');
        }

        // ========== HAPUS PRESTASI (Modal) ==========
        function confirmHapusPrestasi(id, judul) {
            document.getElementById('hapusPrestasiNama').textContent = '"' + judul + '"';
            document.getElementById('hapusPrestasiForm').action =
                '{{ route('admin.program-keahlian.prestasi.destroy', [$program->id, 'PRESTASI_ID_PLACEHOLDER']) }}'
                .replace('PRESTASI_ID_PLACEHOLDER', id);
            document.getElementById('hapusPrestasiModal').classList.remove('hidden');
        }

        function tutupModalHapusPrestasi() {
            document.getElementById('hapusPrestasiModal').classList.add('hidden');
        }

        // Tutup modal jika klik di luar
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('hapusPrestasiModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    tutupModalHapusPrestasi();
                }
            });
        });
    </script>
@endpush



