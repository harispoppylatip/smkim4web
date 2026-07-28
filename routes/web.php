<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramKeahlianController;
use App\Http\Controllers\SpmbController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\ProgramKeahlianController as AdminProgramKeahlianController;
use App\Http\Controllers\Admin\ProgramResourceController;
use App\Http\Controllers\Admin\PengaturanHomeController;
use App\Http\Controllers\Admin\PengaturanSpmbController;
use App\Http\Controllers\Admin\FasilitasUmumController;
use App\Http\Controllers\Admin\UnggulanController;
use App\Http\Controllers\Admin\ProfilSekolahController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\PengaturanSosialMediaController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/program-keahlian', [ProgramKeahlianController::class, 'index'])
    ->name('program-keahlian');

Route::get('/program-keahlian/{slug}', [ProgramKeahlianController::class, 'show'])
    ->name('program-keahlian.detail');

Route::get('/berita', [BeritaController::class, 'index'])
    ->name('berita');

Route::get('/berita/{slug}', [BeritaController::class, 'show'])
    ->name('berita.detail');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');

Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile');

Route::get('/spmb', [SpmbController::class, 'index'])
    ->name('spmb');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes (protected)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('berita', AdminBeritaController::class);
    Route::post('berita/upload-image', [AdminBeritaController::class, 'uploadImage'])
        ->name('berita.upload-image');
    Route::delete('berita/{id}/delete-gambar', [AdminBeritaController::class, 'deleteGambar'])
        ->name('berita.delete-gambar');
    Route::resource('program-keahlian', AdminProgramKeahlianController::class);

    // Program Keahlian sub-resources (gambar, kompetensi, guru, prestasi, sertifikat, fasilitas, peluang)
    Route::post('program-keahlian/{id}/upload-gambar', [ProgramResourceController::class, 'uploadGambar'])
        ->name('program-keahlian.upload-gambar');
    Route::delete('program-keahlian/{id}/delete-gambar', [ProgramResourceController::class, 'deleteGambar'])
        ->name('program-keahlian.delete-gambar');

    Route::post('program-keahlian/{id}/upload-logo', [ProgramResourceController::class, 'uploadLogo'])
        ->name('program-keahlian.upload-logo');
    Route::delete('program-keahlian/{id}/delete-logo', [ProgramResourceController::class, 'deleteLogo'])
        ->name('program-keahlian.delete-logo');

    // Hero Background
    Route::post('program-keahlian/{id}/upload-hero-background', [ProgramResourceController::class, 'uploadHeroBackground'])
        ->name('program-keahlian.upload-hero-background');
    Route::delete('program-keahlian/{id}/delete-hero-background', [ProgramResourceController::class, 'deleteHeroBackground'])
        ->name('program-keahlian.delete-hero-background');

    // Kompetensi
    Route::post('program-keahlian/{id}/kompetensi', [ProgramResourceController::class, 'storeKompetensi'])
        ->name('program-keahlian.kompetensi.store');
    Route::put('program-keahlian/{id}/kompetensi/{kompetensi}', [ProgramResourceController::class, 'updateKompetensi'])
        ->name('program-keahlian.kompetensi.update');
    Route::delete('program-keahlian/{id}/kompetensi/{kompetensi}', [ProgramResourceController::class, 'destroyKompetensi'])
        ->name('program-keahlian.kompetensi.destroy');

    // Mata Pelajaran
    Route::post('program-keahlian/{id}/mata-pelajaran', [ProgramResourceController::class, 'storeMataPelajaran'])
        ->name('program-keahlian.mata-pelajaran.store');
    Route::put('program-keahlian/{id}/mata-pelajaran/{mapel}', [ProgramResourceController::class, 'updateMataPelajaran'])
        ->name('program-keahlian.mata-pelajaran.update');
    Route::delete('program-keahlian/{id}/mata-pelajaran/{mapel}', [ProgramResourceController::class, 'destroyMataPelajaran'])
        ->name('program-keahlian.mata-pelajaran.destroy');

    // Prestasi
    Route::post('program-keahlian/{id}/prestasi', [ProgramResourceController::class, 'storePrestasi'])
        ->name('program-keahlian.prestasi.store');
    Route::put('program-keahlian/{id}/prestasi/{prestasi}', [ProgramResourceController::class, 'updatePrestasi'])
        ->name('program-keahlian.prestasi.update');
    Route::delete('program-keahlian/{id}/prestasi/{prestasi}', [ProgramResourceController::class, 'destroyPrestasi'])
        ->name('program-keahlian.prestasi.destroy');

    // Sertifikat
    Route::post('program-keahlian/{id}/sertifikat', [ProgramResourceController::class, 'storeSertifikat'])
        ->name('program-keahlian.sertifikat.store');
    Route::put('program-keahlian/{id}/sertifikat/{sertifikat}', [ProgramResourceController::class, 'updateSertifikat'])
        ->name('program-keahlian.sertifikat.update');
    Route::delete('program-keahlian/{id}/sertifikat/{sertifikat}', [ProgramResourceController::class, 'destroySertifikat'])
        ->name('program-keahlian.sertifikat.destroy');

    // Guru
    Route::post('program-keahlian/{id}/guru', [ProgramResourceController::class, 'storeGuru'])
        ->name('program-keahlian.guru.store');
    Route::put('program-keahlian/{id}/guru/{guru}', [ProgramResourceController::class, 'updateGuru'])
        ->name('program-keahlian.guru.update');
    Route::delete('program-keahlian/{id}/guru/{guru}', [ProgramResourceController::class, 'destroyGuru'])
        ->name('program-keahlian.guru.destroy');

    // Fasilitas
    Route::post('program-keahlian/{id}/fasilitas', [ProgramResourceController::class, 'storeFasilitas'])
        ->name('program-keahlian.fasilitas.store');
    Route::put('program-keahlian/{id}/fasilitas/{fasilitas}', [ProgramResourceController::class, 'updateFasilitas'])
        ->name('program-keahlian.fasilitas.update');
    Route::delete('program-keahlian/{id}/fasilitas/{fasilitas}', [ProgramResourceController::class, 'destroyFasilitas'])
        ->name('program-keahlian.fasilitas.destroy');

    // Peluang Kerja
    Route::post('program-keahlian/{id}/peluang-kerja', [ProgramResourceController::class, 'storePeluangKerja'])
        ->name('program-keahlian.peluang-kerja.store');
    Route::put('program-keahlian/{id}/peluang-kerja/{peluang}', [ProgramResourceController::class, 'updatePeluangKerja'])
        ->name('program-keahlian.peluang-kerja.update');
    Route::delete('program-keahlian/{id}/peluang-kerja/{peluang}', [ProgramResourceController::class, 'destroyPeluangKerja'])
        ->name('program-keahlian.peluang-kerja.destroy');

    // Pengaturan Halaman Utama
    Route::get('pengaturan-home', [PengaturanHomeController::class, 'index'])
        ->name('pengaturan-home.index');
    Route::post('pengaturan-home', [PengaturanHomeController::class, 'update'])
        ->name('pengaturan-home.update');
    Route::delete('pengaturan-home/foto', [PengaturanHomeController::class, 'destroyFoto'])
        ->name('pengaturan-home.destroy-foto');

    // Pengaturan SPMB
    Route::get('spmb', [PengaturanSpmbController::class, 'index'])
        ->name('spmb.index');
    Route::post('spmb', [PengaturanSpmbController::class, 'update'])
        ->name('spmb.update');
    Route::delete('spmb/brosur', [PengaturanSpmbController::class, 'destroyBrosur'])
        ->name('spmb.destroy-brosur');

    // Fasilitas Umum
    Route::get('fasilitas-umum', [FasilitasUmumController::class, 'index'])
        ->name('fasilitas-umum.index');
    Route::get('fasilitas-umum/create', [FasilitasUmumController::class, 'create'])
        ->name('fasilitas-umum.create');
    Route::post('fasilitas-umum', [FasilitasUmumController::class, 'store'])
        ->name('fasilitas-umum.store');
    Route::get('fasilitas-umum/{fasilitas_umum}/edit', [FasilitasUmumController::class, 'edit'])
        ->name('fasilitas-umum.edit');
    Route::put('fasilitas-umum/{fasilitas_umum}', [FasilitasUmumController::class, 'update'])
        ->name('fasilitas-umum.update');
    Route::delete('fasilitas-umum/{fasilitas_umum}', [FasilitasUmumController::class, 'destroy'])
        ->name('fasilitas-umum.destroy');
    Route::delete('fasilitas-umum/{fasilitas_umum}/gambar', [FasilitasUmumController::class, 'destroyGambar'])
        ->name('fasilitas-umum.destroy-gambar');

    // Unggulan
    Route::get('unggulan', [UnggulanController::class, 'index'])
        ->name('unggulan.index');
    Route::get('unggulan/create', [UnggulanController::class, 'create'])
        ->name('unggulan.create');
    Route::post('unggulan', [UnggulanController::class, 'store'])
        ->name('unggulan.store');
    Route::get('unggulan/{unggulan}/edit', [UnggulanController::class, 'edit'])
        ->name('unggulan.edit');
    Route::put('unggulan/{unggulan}', [UnggulanController::class, 'update'])
        ->name('unggulan.update');
    Route::delete('unggulan/{unggulan}', [UnggulanController::class, 'destroy'])
        ->name('unggulan.destroy');
    Route::delete('unggulan/{unggulan}/gambar', [UnggulanController::class, 'destroyGambar'])
        ->name('unggulan.destroy-gambar');

    // Profil Sekolah
    Route::get('profil-sekolah', [ProfilSekolahController::class, 'index'])
        ->name('profil-sekolah.index');
    Route::post('profil-sekolah', [ProfilSekolahController::class, 'update'])
        ->name('profil-sekolah.update');
    Route::delete('profil-sekolah/gambar/{jenis}', [ProfilSekolahController::class, 'destroyGambar'])
        ->name('profil-sekolah.destroy-gambar');

    // Profile Admin (Akun)
    Route::get('profile', [AdminProfileController::class, 'index'])
        ->name('profile.index');
    Route::put('profile', [AdminProfileController::class, 'update'])
        ->name('profile.update');
    Route::put('profile/password', [AdminProfileController::class, 'updatePassword'])
        ->name('profile.password');

    // Sosial Media
    Route::get('sosial-media', [PengaturanSosialMediaController::class, 'index'])
        ->name('sosial-media.index');
    Route::post('sosial-media', [PengaturanSosialMediaController::class, 'update'])
        ->name('sosial-media.update');
});
