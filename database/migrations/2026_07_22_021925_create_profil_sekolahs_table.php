<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profil_sekolahs', function (Blueprint $table) {
            $table->id();
            // Sejarah
            $table->text('sejarah')->nullable();
            $table->string('sejarah_gambar')->nullable();
            // Visi & Misi
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            // Struktur Organisasi
            $table->string('struktur_organisasi_gambar')->nullable();
            // Timeline (disimpan sebagai JSON)
            $table->json('timeline')->nullable();
            // Nilai-nilai (disimpan sebagai JSON)
            $table->json('nilai')->nullable();
            // Struktur organisasi (data jabatan, disimpan sebagai JSON)
            $table->json('struktur_organisasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_sekolahs');
    }
};
