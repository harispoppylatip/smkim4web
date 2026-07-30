<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->get();
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.form', [
            'berita' => null,
            'editMode' => false,
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

        $data = [
            'slug' => Str::slug($validated['judul']) . '-' . time(),
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'tanggal' => $validated['tanggal'],
            'deskripsi' => $validated['deskripsi'],
            'konten' => $validated['konten'],
            'icon' => $validated['icon'],
            'warna' => match ($validated['kategori']) {
                'TKJT' => 'primary',
                'DKV' => 'secondary',
                default => 'outline',
            },
            'warna_bg' => match ($validated['kategori']) {
                'TKJT' => 'primary/20',
                'DKV' => 'secondary-container/20',
                default => 'tertiary-container/20',
            },
            'warna_icon' => match ($validated['kategori']) {
                'TKJT' => 'primary/30',
                'DKV' => 'secondary-container/40',
                default => 'tertiary-container/40',
            },
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

        return view('admin.berita.form', [
            'berita' => $berita,
            'editMode' => true,
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

        $data = [
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'tanggal' => $validated['tanggal'],
            'deskripsi' => $validated['deskripsi'],
            'konten' => $validated['konten'],
            'icon' => $validated['icon'],
            'warna' => match ($validated['kategori']) {
                'TKJT' => 'primary',
                'DKV' => 'secondary',
                default => 'outline',
            },
            'warna_bg' => match ($validated['kategori']) {
                'TKJT' => 'primary/20',
                'DKV' => 'secondary-container/20',
                default => 'tertiary-container/20',
            },
            'warna_icon' => match ($validated['kategori']) {
                'TKJT' => 'primary/30',
                'DKV' => 'secondary-container/40',
                default => 'tertiary-container/40',
            },
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
