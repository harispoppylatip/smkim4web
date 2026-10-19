<?php

namespace Tests\Feature\Admin;

use App\Models\Berita;
use App\Models\ProgramKeahlian;
use App\Models\User;
use App\Services\SystemBackupService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BackupRestoreTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $editor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'name' => 'Admin Utama',
            'email' => 'admin@smkistiqomah.sch.id',
            'role' => 'admin',
        ]);

        $this->editor = User::factory()->create([
            'name' => 'Editor Berita',
            'email' => 'editor@smkistiqomah.sch.id',
            'role' => 'editor',
        ]);

        Storage::fake('public');
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('admin.backup.index'));
        $response->assertRedirect(route('login'));

        $downloadResponse = $this->get(route('admin.backup.download'));
        $downloadResponse->assertRedirect(route('login'));
    }

    public function test_editor_cannot_access_backup_page(): void
    {
        $response = $this->actingAs($this->editor)->get(route('admin.backup.index'));
        $response->assertForbidden();

        $downloadResponse = $this->actingAs($this->editor)->get(route('admin.backup.download'));
        $downloadResponse->assertForbidden();
    }

    public function test_admin_can_access_backup_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.backup.index'));

        $response->assertOk();
        $response->assertSee('Cadangan &amp; Pemulihan Sistem', false);
        $response->assertSee('Unduh Cadangan Lengkap (.zip)');
        $response->assertSee('Pulihkan Data Sistem (Restore .zip)');
    }

    public function test_admin_can_download_backup_zip(): void
    {
        Storage::disk('public')->put('berita/sample.jpg', 'gambar-berita-dummy');

        Berita::create([
            'judul' => 'Ujian Akhir Semester Berlangsung Tertib',
            'slug' => 'ujian-akhir-semester-berlangsung-tertib',
            'ringkasan' => 'Pelaksanaan UAS semester ganjil.',
            'konten' => '<p>Konten berita lengkap.</p>',
            'gambar' => 'berita/sample.jpg',
            'user_id' => $this->admin->id,
            'is_published' => true,
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.backup.download'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/zip');

        $file = $response->getFile();
        $this->assertNotNull($file);
        $zipBinary = file_get_contents($file->getPathname());
        $this->assertNotEmpty($zipBinary);

        $backupService = app(SystemBackupService::class);
        $entries = $backupService->extractZip($zipBinary);

        $this->assertArrayHasKey('manifest.json', $entries);
        $this->assertArrayHasKey('database.json', $entries);
        $this->assertArrayHasKey('BACA-SAYA.txt', $entries);
        $this->assertArrayHasKey('storage/berita/sample.jpg', $entries);
        $this->assertSame('gambar-berita-dummy', $entries['storage/berita/sample.jpg']);

        $manifest = json_decode($entries['manifest.json'], true);
        $this->assertSame('smkim4', $manifest['app']);
    }

    public function test_admin_can_restore_data_from_backup_zip(): void
    {
        Storage::disk('public')->put('berita/berita-lama.jpg', 'konten-foto-lama');
        Storage::disk('public')->put('program-keahlian/logo-rpl.png', 'konten-logo-rpl');

        $jurusan = ProgramKeahlian::create([
            'nama' => 'Rekayasa Perangkat Lunak',
            'slug' => 'rekayasa-perangkat-lunak',
            'deskripsi_singkat' => 'Jurusan software engineering.',
            'deskripsi_lengkap' => 'Belajar coding Laravel dan Python.',
            'urutan' => 1,
            'logo' => 'program-keahlian/logo-rpl.png',
        ]);

        $berita = Berita::create([
            'judul' => 'Prestasi Juara 1 LKS RPL',
            'slug' => 'prestasi-juara-1-lks-rpl',
            'ringkasan' => 'Siswa SMKIM4 meraih juara 1.',
            'konten' => '<p>Selamat kepada para siswa.</p>',
            'gambar' => 'berita/berita-lama.jpg',
            'user_id' => $this->admin->id,
            'is_published' => true,
        ]);

        $backupService = app(SystemBackupService::class);
        $zipBinary = $backupService->createBackupZipBinary();

        // Bersihkan data atau ubah data untuk menguji proses restore
        Berita::query()->delete();
        ProgramKeahlian::query()->delete();
        Storage::disk('public')->delete('berita/berita-lama.jpg');
        Storage::disk('public')->delete('program-keahlian/logo-rpl.png');

        $this->assertDatabaseMissing('berita', ['id' => $berita->id]);
        $this->assertDatabaseMissing('program_keahlian', ['id' => $jurusan->id]);
        $this->assertFalse(Storage::disk('public')->exists('berita/berita-lama.jpg'));

        // Lakukan pemulihan (restore)
        $uploadedFile = UploadedFile::fake()->createWithContent('backup-smkim4.zip', $zipBinary);

        $response = $this->actingAs($this->admin)->post(route('admin.backup.restore'), [
            'backup_file' => $uploadedFile,
            'confirm_restore' => '1',
        ]);

        $response->assertRedirect(route('admin.backup.index'));
        $response->assertSessionHas('success');

        // Pastikan seluruh data dan berkas kembali pulih 100%
        $this->assertDatabaseHas('berita', [
            'id' => $berita->id,
            'judul' => 'Prestasi Juara 1 LKS RPL',
        ]);
        $this->assertDatabaseHas('program_keahlian', [
            'id' => $jurusan->id,
            'nama' => 'Rekayasa Perangkat Lunak',
        ]);
        $this->assertTrue(Storage::disk('public')->exists('berita/berita-lama.jpg'));
        $this->assertSame('konten-foto-lama', Storage::disk('public')->get('berita/berita-lama.jpg'));
        $this->assertTrue(Storage::disk('public')->exists('program-keahlian/logo-rpl.png'));
    }

    public function test_restore_rejects_corrupted_file_without_damaging_data(): void
    {
        $berita = Berita::create([
            'judul' => 'Berita Penting Jangan Hilang',
            'slug' => 'berita-penting-jangan-hilang',
            'ringkasan' => 'Harus tetap ada.',
            'konten' => '<p>Konten aman.</p>',
            'user_id' => $this->admin->id,
            'is_published' => true,
        ]);

        $corruptedFile = UploadedFile::fake()->createWithContent('rusak.zip', 'bukan-file-pkzip-asli');

        $response = $this->actingAs($this->admin)->from(route('admin.backup.index'))->post(route('admin.backup.restore'), [
            'backup_file' => $corruptedFile,
            'confirm_restore' => '1',
        ]);

        $response->assertRedirect(route('admin.backup.index'));
        $response->assertSessionHas('error');

        // Data tidak terhapus
        $this->assertDatabaseHas('berita', [
            'id' => $berita->id,
            'judul' => 'Berita Penting Jangan Hilang',
        ]);
    }
}
