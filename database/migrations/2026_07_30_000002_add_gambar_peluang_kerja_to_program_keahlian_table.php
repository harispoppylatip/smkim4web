<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop per-item gambar from program_peluang_kerja
        Schema::table('program_peluang_kerja', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });

        // Add single illustration image to program_keahlian
        Schema::table('program_keahlian', function (Blueprint $table) {
            $table->string('gambar_peluang_kerja')->nullable()->after('gambar');
        });
    }

    public function down(): void
    {
        Schema::table('program_keahlian', function (Blueprint $table) {
            $table->dropColumn('gambar_peluang_kerja');
        });

        Schema::table('program_peluang_kerja', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('nama');
        });
    }
};
