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
        Schema::table('pengaturan_home', function (Blueprint $table) {
            $table->string('hero_background_foto')->nullable()->after('kepala_sekolah_sambutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturan_home', function (Blueprint $table) {
            $table->dropColumn('hero_background_foto');
        });
    }
};
