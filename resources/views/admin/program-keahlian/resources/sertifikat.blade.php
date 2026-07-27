<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#sertifikat input[type="file"]').forEach(function(input) {
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
</script>

<div id="sertifikat" class="resource-section max-w-4xl mb-8">
    <div class="bg-white rounded-xl border border-[#e2e2e5] overflow-hidden">
        <div class="px-6 py-4 bg-[#f9f9fc] border-b border-[#e2e2e5]">
            <h3 class="text-sm font-semibold text-[#1a1c1e]">Sertifikat Kompetensi</h3>
            <p class="text-xs text-[#737780]">Kelola sertifikat yang relevan dengan program.</p>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.program-keahlian.sertifikat.store', $program->id) }}"
                enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">
                @csrf
                <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Nama Sertifikat</label>
                    <input type="text" name="nama" required placeholder="cth: CCNA Routing & Switching"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                </div>
                <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Penyelenggara</label>
                    <input type="text" name="penyelenggara" required placeholder="cth: Cisco Academy"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                </div>
                <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Gambar (opsional)</label>
                    <div class="custom-file-input">
                        <input type="file" name="gambar" accept="image/*"
                            onchange="this.parentElement.classList.add('has-file'); this.nextElementSibling.querySelector('span').textContent = this.files[0].name">
                        <div class="custom-file-label">
                            <span class="material-symbols-outlined text-base">badge</span>
                            <span>Pilih gambar sertifikat...</span>
                        </div>
                    </div>
                    <p class="text-xs text-[#737780] mt-1">Format: JPEG, PNG, WebP. Maks: 5MB.</p>
                </div>
                <div class="md:col-span-2 flex items-end">
                    <button
                        class="w-full px-4 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">Tambah
                        Sertifikat</button>
                </div>
                <div class="md:col-span-4">
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Deskripsi</label>
                    <textarea name="deskripsi" placeholder="Deskripsi sertifikat"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent"
                        rows="2"></textarea>
                </div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @forelse ($program->sertifikat as $item)
                    <div class="bg-[#f9f9fc] rounded-lg overflow-hidden border border-[#e2e2e5]">
                        @if ($item->gambar)
                            <div class="h-40 bg-white flex items-center justify-center p-4">
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="h-full object-contain"
                                    alt="{{ $item->nama }}">
                            </div>
                        @else
                            <div class="h-32 bg-[#e8f0fe] flex items-center justify-center">
                                <span class="material-symbols-outlined text-4xl text-[#001e40]/30">badge</span>
                            </div>
                        @endif
                        <div class="p-3 text-center">
                            <h4 class="font-semibold text-sm">{{ $item->nama }}</h4>
                            <p class="text-xs text-[#737780]">{{ $item->penyelenggara }}</p>
                            @if ($item->deskripsi)
                                <p class="text-xs text-[#737780] mt-1">{{ $item->deskripsi }}</p>
                            @endif
                            <form method="POST"
                                action="{{ route('admin.program-keahlian.sertifikat.destroy', [$program->id, $item->id]) }}"
                                class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus sertifikat?')"
                                    class="px-2 py-1 text-xs text-[#ba1a1a] hover:bg-[#fff1f1] rounded transition-colors">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-3 text-center text-[#737780] py-6 bg-[#f9f9fc] rounded-lg">Belum ada
                        sertifikat.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
