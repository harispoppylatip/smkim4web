<div id="guru" class="resource-section max-w-4xl mb-8">
    <div class="bg-white rounded-xl border border-[#e2e2e5] overflow-hidden">
        <div class="px-6 py-4 bg-[#f9f9fc] border-b border-[#e2e2e5]">
            <h3 class="text-sm font-semibold text-[#1a1c1e]">Tim Pengajar (Guru)</h3>
            <p class="text-xs text-[#737780]">Tambah, edit, atau hapus guru untuk program ini.</p>
        </div>
        <div class="p-6">
            {{-- Form Tambah Guru --}}
            <form method="POST" action="{{ route('admin.program-keahlian.guru.store', $program->id) }}"
                enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-6 pb-6 border-b border-[#e2e2e5]">
                @csrf
                <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Nama Guru</label>
                    <input type="text" name="nama" required placeholder="Nama lengkap guru"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                </div>
                <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Bidang / Mata Ajar</label>
                    <input type="text" name="bidang" required placeholder="cth: Administrasi Sistem Jaringan"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                </div>
                <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Foto (opsional)</label>
                    <div class="custom-file-input">
                        <input type="file" name="foto" accept="image/*"
                            onchange="this.parentElement.classList.add('has-file'); this.nextElementSibling.querySelector('span').textContent = this.files[0].name">
                        <div class="custom-file-label">
                            <span class="material-symbols-outlined text-base">photo_camera</span>
                            <span>Pilih foto guru...</span>
                        </div>
                    </div>
                    <p class="text-xs text-[#737780] mt-1">Format: JPEG, PNG, WebP. Maks: 5MB.</p>
                </div>
                <div class="md:col-span-2 flex items-end">
                    <button type="submit"
                        class="w-full px-4 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">Tambah
                        Guru</button>
                </div>
            </form>

            {{-- Daftar Guru --}}
            <table class="w-full resource-table border border-[#e2e2e5] rounded-lg overflow-hidden">
                <thead>
                    <tr class="text-left bg-[#f3f3f6] text-[#43474f]">
                        <th class="font-semibold">No</th>
                        <th class="font-semibold">Nama</th>
                        <th class="font-semibold">Bidang</th>
                        <th class="text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e2e2e5]">
                    @forelse ($program->guru as $item)
                        <tr class="hover:bg-[#f9f9fc] transition-colors" id="guru-row-{{ $item->id }}">
                            <td class="text-[#737780]">{{ $loop->iteration }}</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    @if ($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" class="preview-thumb"
                                            alt="{{ $item->nama }}">
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-[#e8f0fe] flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[#001e40]/40">person</span>
                                        </div>
                                    @endif
                                    <span class="font-medium">{{ $item->nama }}</span>
                                </div>
                            </td>
                            <td class="text-[#43474f]">{{ $item->bidang }}</td>
                            <td class="text-right">
                                {{-- Tombol Edit --}}
                                <button type="button" onclick="openEditGuru({{ $item->id }})"
                                    class="px-2 py-1 text-xs text-[#003366] hover:bg-[#d5e3ff] rounded transition-colors">Edit</button>
                                {{-- Tombol Hapus --}}
                                <form method="POST"
                                    action="{{ route('admin.program-keahlian.guru.destroy', [$program->id, $item->id]) }}"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus guru {{ $item->nama }}?')"
                                        class="px-2 py-1 text-xs text-[#ba1a1a] hover:bg-[#fff1f1] rounded transition-colors">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        {{-- Row Edit Form (hidden by default) --}}
                        <tr id="guru-edit-{{ $item->id }}" class="hidden">
                            <td colspan="4" class="bg-[#f9f9fc] p-4">
                                <form method="POST"
                                    action="{{ route('admin.program-keahlian.guru.update', [$program->id, $item->id]) }}"
                                    enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                                    @csrf
                                    @method('PUT')
                                    <div class="md:col-span-2">
                                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">Nama Guru</label>
                                        <input type="text" name="nama" value="{{ $item->nama }}" required
                                            class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">Bidang / Mata
                                            Ajar</label>
                                        <input type="text" name="bidang" value="{{ $item->bidang }}" required
                                            class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">Foto (biarkan
                                            kosong jika tidak diganti)</label>
                                        <div class="flex items-center gap-3">
                                            @if ($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}"
                                                    class="w-10 h-10 rounded-lg object-cover">
                                            @endif
                                            <div class="custom-file-input flex-1">
                                                <input type="file" name="foto" accept="image/*"
                                                    onchange="this.parentElement.classList.add('has-file'); this.nextElementSibling.querySelector('span').textContent = this.files[0].name">
                                                <div class="custom-file-label">
                                                    <span
                                                        class="material-symbols-outlined text-base">photo_camera</span>
                                                    <span>Ganti foto...</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-xs text-[#737780] mt-1">Format: JPEG, PNG, WebP. Maks: 5MB.</p>
                                    </div>
                                    <div class="md:col-span-2 flex items-end gap-2">
                                        <button type="submit"
                                            class="px-4 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">Simpan</button>
                                        <button type="button" onclick="closeEditGuru({{ $item->id }})"
                                            class="px-4 py-2 bg-white border border-[#c3c6d1] text-[#43474f] rounded-lg text-sm font-semibold hover:bg-[#f3f3f6] transition-colors">Batal</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-[#737780] py-6">Belum ada guru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('#guru input[type="file"]').forEach(function(input) {
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

        function openEditGuru(id) {
            document.getElementById('guru-row-' + id).classList.add('hidden');
            document.getElementById('guru-edit-' + id).classList.remove('hidden');
        }

        function closeEditGuru(id) {
            document.getElementById('guru-row-' + id).classList.remove('hidden');
            document.getElementById('guru-edit-' + id).classList.add('hidden');
        }
    </script>
@endpush
