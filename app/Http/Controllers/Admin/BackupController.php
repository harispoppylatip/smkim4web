<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SystemBackupService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use RuntimeException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BackupController extends Controller
{
    /**
     * Tampilkan halaman cadangan dan pemulihan sistem (Backup & Restore).
     */
    public function index(SystemBackupService $backup): View
    {
        $summary = $backup->storageSummary();

        return view('admin.backup.index', [
            'summary' => $summary,
        ]);
    }

    /**
     * Unduh cadangan lengkap (.zip) berisi seluruh database dan seluruh berkas media storage.
     */
    public function download(SystemBackupService $backup): BinaryFileResponse
    {
        $zipFilePath = $backup->createBackupZipFile();
        $filename = 'backup-smkim4-'.now()->format('Y-m-d-His').'.zip';

        return response()
            ->download($zipFilePath, $filename, [
                'Content-Type' => 'application/zip',
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
            ])
            ->deleteFileAfterSend(true);
    }

    /**
     * Pulihkan seluruh basis data dan berkas media dari arsip .zip yang diunggah.
     */
    public function restore(Request $request, SystemBackupService $backup): RedirectResponse
    {
        $request->validate([
            'backup_file' => ['required', 'file', 'mimes:zip', 'max:512000'],
            'confirm_restore' => ['accepted'],
        ], [
            'backup_file.required' => 'Pilih berkas cadangan (.zip) dari perangkat Anda terlebih dahulu.',
            'backup_file.file' => 'Berkas cadangan tidak valid.',
            'backup_file.mimes' => 'Berkas cadangan harus berupa arsip .zip hasil unduhan dari menu Backup & Restore SMKIM4.',
            'backup_file.max' => 'Ukuran berkas cadangan melebihi batas maksimum (500 MB).',
            'confirm_restore.accepted' => 'Centang kotak persetujuan konfirmasi sebelum memulihkan data.',
        ]);

        $uploadedFile = $request->file('backup_file');
        $realPath = $uploadedFile->getRealPath();

        try {
            $result = $backup->restoreFromZipFile($realPath, $request->user());
        } catch (RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }

        Auth::login($result['admin_user']);
        $request->session()->regenerate();

        $totalTables = count($result['tables']);
        $totalFiles = $result['files'];

        return redirect()
            ->route('admin.backup.index')
            ->with('success', "Pemulihan data berhasil! {$totalTables} tabel basis data dan {$totalFiles} berkas media berhasil dikembalikan.");
    }
}

