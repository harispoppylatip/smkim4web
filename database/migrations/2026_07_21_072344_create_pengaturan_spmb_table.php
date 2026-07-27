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
        Schema::create('pengaturan_spmb', function (Blueprint $table) {
            $table->id();
            $table->string('tahun', 20)->default('2025/2026');
            $table->text('persyaratan')->nullable();
            $table->string('brosur')->nullable();
            $table->string('whatsapp', 60)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_spmb');
    }
};
