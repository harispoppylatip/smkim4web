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
        Schema::create('program_keahlian', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('singkatan', 20);
            $table->string('nama');
            $table->text('deskripsi_singkat');
            $table->longText('deskripsi');
            $table->string('icon', 50)->default('school');
            $table->string('icon_besar', 50)->default('school');
            $table->string('warna', 50)->default('primary');
            $table->string('warna_bg', 50)->default('primary/20');
            $table->string('warna_icon', 50)->default('primary/30');
            $table->string('warna_container', 50)->default('primary');
            $table->string('warna_container_bg', 50)->default('primary/10');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_keahlian');
    }
};
