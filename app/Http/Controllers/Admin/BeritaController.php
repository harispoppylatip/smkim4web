<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Konversi tanggal dari date picker (Y-m-d) ke format tampilan Indonesia (d M Y),
     * mis. "2023-10-24" -> "24 Okt 2023". Konsisten dengan data lama.
     */
    private function formatTanggalIndo(?string $tanggal): string
    {
        $tanggal = trim((string) $tanggal);
        if ($tanggal === '') {
            return '';
        }

        try {
            return \Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('d M Y');
        } catch (\Throwable $e) {
            return $tanggal;
        }
    }

    /**
     * Mapping warna tema untuk tiap kategori berita.
     * Mengikuti warna jurusan di tabel program_keahlian (lihat [[tema-website]]).
     */
    private function warnaKategori(string $kategori): array
    {
        return match ($kategori) {
            'TKJT', 'TKR' => ['warna' => 'primary', 'warna_bg' => 'primary/20', 'warna_icon' => 'primary/30'],
            'DKV', 'LKS' => ['warna' => 'secondary', 'warna_bg' => 'secondary-container/20', 'warna_icon' => 'secondary-container/40'],
            'TAB' => ['warna' => 'tertiary', 'warna_bg' => 'tertiary/20', 'warna_icon' => 'tertiary/30'],
            'TSM' => ['warna' => 'error', 'warna_bg' => 'error/20', 'warna_icon' => 'error/30'],
            default => ['warna' => 'outline', 'warna_bg' => 'tertiary-container/20', 'warna_icon' => 'tertiary-container/40'],
        };
    }

    public function index()
    {
        $berita = Berita::latest()->get();
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $programKeahlian = ProgramKeahlian::orderBy('singkatan')->get();

        return view('admin.berita.form', [
            'berita' => null,
            'editMode' => false,
            'programKeahlian' => $programKeahlian,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required|max:50',
            'tanggal' => 'required|max:50',
            'deskripsi' => 'required',
            'konten' => 'required',
            'icon' => 'required|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $warna = $this->warnaKategori($validated['kategori']);

        $data = [
            'slug' => Str::slug($validated['judul']) . '-' . time(),
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'tanggal' => $this->formatTanggalIndo($validated['tanggal']),
            'deskripsi' => $validated['deskripsi'],
            'konten' => $validated['konten'],
            'icon' => $validated['icon'],
            'warna' => $warna['warna'],
            'warna_bg' => $warna['warna_bg'],
            'warna_icon' => $warna['warna_icon'],
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $programKeahlian = ProgramKeahlian::orderBy('singkatan')->get();

        return view('admin.berita.form', [
            'berita' => $berita,
            'editMode' => true,
            'programKeahlian' => $programKeahlian,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required|max:50',
            'tanggal' => 'required|max:50',
            'deskripsi' => 'required',
            'konten' => 'required',
            'icon' => 'required|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $berita = Berita::findOrFail($id);

        // Regenerasi slug jika judul berubah
        $slugChanged = $berita->judul !== $validated['judul'];

        $warna = $this->warnaKategori($validated['kategori']);

        $data = [
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'tanggal' => $this->formatTanggalIndo($validated['tanggal']),
            'deskripsi' => $validated['deskripsi'],
            'konten' => $validated['konten'],
            'icon' => $validated['icon'],
            'warna' => $warna['warna'],
            'warna_bg' => $warna['warna_bg'],
            'warna_icon' => $warna['warna_icon'],
        ];

        if ($slugChanged) {
            $data['slug'] = Str::slug($validated['judul']) . '-' . time();
        }

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Upload gambar dari TinyMCE
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
        ]);

        $path = $request->file('file')->store('berita/konten', 'public');

        return response()->json([
            'location' => asset('storage/' . $path),
        ]);
    }

    /**
     * Hapus gambar berita (dari form)
     */
    public function deleteGambar($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
            $berita->update(['gambar' => null]);
        }
        return back()->with('success', 'Gambar berita berhasil dihapus.');
    }
}
