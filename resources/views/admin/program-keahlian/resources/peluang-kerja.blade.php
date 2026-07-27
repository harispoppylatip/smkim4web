<div id="peluang-kerja" class="resource-section max-w-4xl mb-8">
    <div class="bg-white rounded-xl border border-[#e2e2e5] overflow-hidden">
        <div class="px-6 py-4 bg-[#f9f9fc] border-b border-[#e2e2e5]">
            <h3 class="text-sm font-semibold text-[#1a1c1e]">Peluang Kerja</h3>
            <p class="text-xs text-[#737780]">Kelola peluang karir untuk lulusan program ini.</p>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.program-keahlian.peluang-kerja.store', $program->id) }}"
                class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">
                @csrf
                <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Nama Peluang Kerja</label>
                    <input type="text" name="nama" required placeholder="cth: Network Engineer"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                </div>
                <div>
                    <label class="text-xs font-semibold text-[#43474f] mb-1 block">Urutan</label>
                    <input type="number" name="urutan" placeholder="Otomatis"
                        class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                </div>
                <div class="flex items-end">
                    <button
                        class="w-full px-4 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">Tambah</button>
                </div>
            </form>

            <table class="w-full resource-table border border-[#e2e2e5] rounded-lg overflow-hidden">
                <thead>
                    <tr class="text-left bg-[#f3f3f6] text-[#43474f]">
                        <th class="font-semibold">No</th>
                        <th class="font-semibold">Nama</th>
                        <th class="text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e2e2e5]">
                    @forelse ($program->peluangKerja as $item)
                        <tr class="hover:bg-[#f9f9fc] transition-colors">
                            <td class="text-[#737780]">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td class="text-right">
                                <form method="POST"
                                    action="{{ route('admin.program-keahlian.peluang-kerja.destroy', [$program->id, $item->id]) }}"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus peluang kerja?')"
                                        class="px-2 py-1 text-xs text-[#ba1a1a] hover:bg-[#fff1f1] rounded transition-colors">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-[#737780] py-6">Belum ada peluang kerja.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
