<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FasilitasUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasUmumController extends Controller
{
    public function index()
    {
        $fasilitas = FasilitasUmum::orderBy('urutan')->get();
        return view('admin.fasilitas-umum.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas-umum.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['nama', 'icon', 'urutan']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('fasilitas-umum', 'public');
        }

        FasilitasUmum::create($data);

        return redirect()->route('admin.fasilitas-umum.index')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(FasilitasUmum $fasilitas_umum)
    {
        return view('admin.fasilitas-umum.form', [
            'editMode' => true,
            'fasilitas' => $fasilitas_umum,
        ]);
    }

    public function update(Request $request, FasilitasUmum $fasilitas_umum)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['nama', 'icon', 'urutan']);

        if ($request->hasFile('gambar')) {
            if ($fasilitas_umum->gambar) {
                Storage::disk('public')->delete($fasilitas_umum->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('fasilitas-umum', 'public');
        }

        $fasilitas_umum->update($data);

        return redirect()->route('admin.fasilitas-umum.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(FasilitasUmum $fasilitas_umum)
    {
        if ($fasilitas_umum->gambar) {
            Storage::disk('public')->delete($fasilitas_umum->gambar);
        }
        $fasilitas_umum->delete();

        return redirect()->route('admin.fasilitas-umum.index')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }

    public function destroyGambar(FasilitasUmum $fasilitas_umum)
    {
        if ($fasilitas_umum->gambar) {
            Storage::disk('public')->delete($fasilitas_umum->gambar);
            $fasilitas_umum->update(['gambar' => null]);
        }

        return redirect()->route('admin.fasilitas-umum.edit', $fasilitas_umum)
            ->with('success', 'Gambar fasilitas berhasil dihapus.');
    }
}
