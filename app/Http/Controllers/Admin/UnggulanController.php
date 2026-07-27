<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unggulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UnggulanController extends Controller
{
    public function index()
    {
        $unggulan = Unggulan::orderBy('urutan')->get();
        return view('admin.unggulan.index', compact('unggulan'));
    }

    public function create()
    {
        return view('admin.unggulan.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['nama', 'icon', 'urutan']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('unggulan', 'public');
        }

        Unggulan::create($data);

        return redirect()->route('admin.unggulan.index')
            ->with('success', 'Program unggulan berhasil ditambahkan.');
    }

    public function edit(Unggulan $unggulan)
    {
        return view('admin.unggulan.form', [
            'editMode' => true,
            'unggulan' => $unggulan,
        ]);
    }

    public function update(Request $request, Unggulan $unggulan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['nama', 'icon', 'urutan']);

        if ($request->hasFile('gambar')) {
            if ($unggulan->gambar) {
                Storage::disk('public')->delete($unggulan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('unggulan', 'public');
        }

        $unggulan->update($data);

        return redirect()->route('admin.unggulan.index')
            ->with('success', 'Program unggulan berhasil diperbarui.');
    }

    public function destroy(Unggulan $unggulan)
    {
        if ($unggulan->gambar) {
            Storage::disk('public')->delete($unggulan->gambar);
        }
        $unggulan->delete();

        return redirect()->route('admin.unggulan.index')
            ->with('success', 'Program unggulan berhasil dihapus.');
    }

    public function destroyGambar(Unggulan $unggulan)
    {
        if ($unggulan->gambar) {
            Storage::disk('public')->delete($unggulan->gambar);
            $unggulan->update(['gambar' => null]);
        }

        return redirect()->route('admin.unggulan.edit', $unggulan)
            ->with('success', 'Gambar unggulan berhasil dihapus.');
    }
}
