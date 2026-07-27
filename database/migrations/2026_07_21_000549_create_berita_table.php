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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('judul');
            $table->string('kategori', 50);
            $table->string('tanggal', 50);
            $table->text('deskripsi');
            $table->longText('konten');
            $table->string('icon', 50)->default('article');
            $table->string('warna', 50)->default('primary');
            $table->string('warna_bg', 50)->default('primary/20');
            $table->string('warna_icon', 50)->default('primary/30');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
