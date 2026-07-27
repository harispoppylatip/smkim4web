<div id="fasilitas" class="resource-section max-w-4xl mb-8">
    <div class="bg-white rounded-xl border border-[#e2e2e5] overflow-hidden">
        <div class="px-6 py-4 bg-[#f9f9fc] border-b border-[#e2e2e5]">
            <h3 class="text-sm font-semibold text-[#1a1c1e]">Fasilitas</h3>
            <p class="text-xs text-[#737780]">Tambah fasilitas dan gambar pendukung.</p>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.program-keahlian.fasilitas.store', $program->id) }}"
                enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">
                @csrf
                <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Nama Fasilitas</label>
                    <input type="text" name="nama" required placeholder="cth: Laboratorium Komputer"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                </div>
                <div>
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Icon (opsional)</label>
                    <input type="text" name="icon" placeholder="Nama icon Material"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                </div>
                <div>
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Gambar (opsional)</label>
                    <div class="custom-file-input">
                        <input type="file" name="gambar" accept="image/*"
                            onchange="this.parentElement.classList.add('has-file'); this.nextElementSibling.querySelector('span').textContent = this.files[0].name">
                        <div class="custom-file-label">
                            <span class="material-symbols-outlined text-base">add_photo_alternate</span>
                            <span>Pilih gambar fasilitas...</span>
                        </div>
                    </div>
                    <p class="text-xs text-[#737780] mt-1">Format: JPEG, PNG, WebP. Maks: 5MB.</p>
                </div>
                <div class="md:col-span-4">
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Deskripsi</label>
                    <textarea name="deskripsi" placeholder="Deskripsi fasilitas"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent"
                        rows="2"></textarea>
                </div>
                <div class="md:col-span-4">
                    <button
                        class="px-4 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">Tambah
                        Fasilitas</button>
                </div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @forelse ($program->fasilitas as $item)
                    <div class="bg-[#f9f9fc] rounded-lg overflow-hidden border border-[#e2e2e5]">
                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-40 object-cover"
                                alt="{{ $item->nama }}">
                        @else
                            <div class="h-32 bg-[#e8f0fe] flex items-center justify-center">
                                <span
                                    class="material-symbols-outlined text-4xl text-[#001e40]/30">business_center</span>
                            </div>
                        @endif
                        <div class="p-3">
                            <h4 class="font-semibold text-sm">{{ $item->nama }}</h4>
                            @if ($item->deskripsi)
                                <p class="text-xs text-[#737780] mt-1">{{ $item->deskripsi }}</p>
                            @endif
                            <div class="flex gap-2 mt-2">
                                <button type="button" onclick="openEditFasilitas({{ $item->id }})"
                                    class="px-2 py-1 text-xs text-[#001e40] hover:bg-[#e8f0fe] rounded transition-colors">Edit</button>
                                <form method="POST"
                                    action="{{ route('admin.program-keahlian.fasilitas.destroy', [$program->id, $item->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus fasilitas?')"
                                        class="px-2 py-1 text-xs text-[#ba1a1a] hover:bg-[#fff1f1] rounded transition-colors">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-3 text-center text-[#737780] py-6 bg-[#f9f9fc] rounded-lg">Belum ada
                        fasilitas.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit Fasilitas --}}
<div id="editFasilitasModal" class="fixed inset-0 z-50 hidden bg-black/40 flex items-center justify-center p-4"
    onclick="if(event.target===this)closeEditFasilitas()">
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-[#e2e2e5] flex items-center justify-between">
            <h3 class="text-sm font-semibold text-[#1a1c1e]">Edit Fasilitas</h3>
            <button type="button" onclick="closeEditFasilitas()"
                class="p-1 hover:bg-[#f5f5f5] rounded-full transition-colors">
                <span class="material-symbols-outlined text-[#737780]">close</span>
            </button>
        </div>
        <form id="editFasilitasForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="text-xs font-semibold text-[#43474f] mb-1 block">Nama Fasilitas</label>
                <input type="text" name="nama" id="edit_fasilitas_nama" required
                    class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
            </div>
            <div>
                <label class="text-xs font-semibold text-[#43474f] mb-1 block">Deskripsi</label>
                <textarea name="deskripsi" id="edit_fasilitas_deskripsi" rows="2"
                    class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Icon (opsional)</label>
                    <input type="text" name="icon" id="edit_fasilitas_icon" placeholder="Nama icon Material"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                </div>
                <div>
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Urutan</label>
                    <input type="number" name="urutan" id="edit_fasilitas_urutan" min="0"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                </div>
            </div>
            <div>
                <label class="text-xs font-semibold text-[#43474f] mb-1 block">Gambar</label>
                <div id="edit_fasilitas_gambar_preview" class="mb-2"></div>
                <div class="custom-file-input">
                    <input type="file" name="gambar" accept="image/*"
                        onchange="this.parentElement.classList.add('has-file'); this.nextElementSibling.querySelector('span:last-child').textContent = this.files[0].name">
                    <div class="custom-file-label">
                        <span class="material-symbols-outlined text-base">add_photo_alternate</span>
                        <span>Pilih gambar baru...</span>
                    </div>
                </div>
                <p class="text-xs text-[#737780] mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeEditFasilitas()"
                    class="px-4 py-2 text-sm font-semibold text-[#43474f] hover:bg-[#f5f5f5] rounded-lg transition-colors">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('#fasilitas input[type="file"]').forEach(function(input) {
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

    const fasilitasData = @json($program->fasilitas);
    const fasilitasUpdateBase =
        '{{ route('admin.program-keahlian.fasilitas.update', [$program->id, 'FASILITAS_ID']) }}';

    function openEditFasilitas(id) {
        const item = fasilitasData.find(f => f.id === id);
        if (!item) return;

        document.getElementById('edit_fasilitas_nama').value = item.nama;
        document.getElementById('edit_fasilitas_deskripsi').value = item.deskripsi || '';
        document.getElementById('edit_fasilitas_icon').value = item.icon || 'business';
        document.getElementById('edit_fasilitas_urutan').value = item.urutan || 0;

        const preview = document.getElementById('edit_fasilitas_gambar_preview');
        if (item.gambar) {
            preview.innerHTML =
                `<img src="{{ asset('storage/') }}/${item.gambar}" class="h-24 w-full object-cover rounded-lg border border-[#e2e2e5]">`;
        } else {
            preview.innerHTML = '';
        }

        document.getElementById('editFasilitasForm').action = fasilitasUpdateBase.replace('FASILITAS_ID', id);
        document.getElementById('editFasilitasModal').classList.remove('hidden');
    }

    function closeEditFasilitas() {
        document.getElementById('editFasilitasModal').classList.add('hidden');
    }
</script>
