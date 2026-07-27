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
        Schema::create('program_prestasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_keahlian_id')->constrained('program_keahlian')->cascadeOnDelete();
            $table->string('tahun', 10);
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('icon', 50)->default('emoji_events');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_prestasi');
    }
};
