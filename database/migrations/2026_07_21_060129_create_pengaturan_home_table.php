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
        Schema::create('pengaturan_home', function (Blueprint $table) {
            $table->id();
            $table->string('kepala_sekolah_nama')->nullable();
            $table->string('kepala_sekolah_jabatan')->nullable();
            $table->text('kepala_sekolah_sambutan')->nullable();
            $table->string('kepala_sekolah_foto')->nullable();
            $table->string('kepala_sekolah_pengalaman_angka')->nullable();
            $table->string('kepala_sekolah_pengalaman_label')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_home');
    }
};
