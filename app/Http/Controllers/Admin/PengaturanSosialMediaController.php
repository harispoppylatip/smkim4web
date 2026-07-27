<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSosialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PengaturanSosialMediaController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanSosialMedia::first();
        return view('admin.sosial-media.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'youtube' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
        ]);

        $pengaturan = PengaturanSosialMedia::first();
        if (!$pengaturan) {
            $pengaturan = new PengaturanSosialMedia();
        }

        $pengaturan->youtube = $request->youtube;
        $pengaturan->instagram = $request->instagram;
        $pengaturan->facebook = $request->facebook;
        $pengaturan->tiktok = $request->tiktok;
        $pengaturan->save();

        Cache::forget('pengaturan_sosial_media');

        return redirect()->route('admin.sosial-media.index')
            ->with('success', 'Pengaturan sosial media berhasil diperbarui.');
    }
}
