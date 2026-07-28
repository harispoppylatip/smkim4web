<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus file gambar kurikulum dari storage
        $programs = \DB::table('program_keahlian')
            ->whereNotNull('gambar_kurikulum')
            ->get(['gambar_kurikulum']);

        foreach ($programs as $program) {
            Storage::disk('public')->delete($program->gambar_kurikulum);
        }

        Schema::table('program_keahlian', function (Blueprint $table) {
            $table->dropColumn('gambar_kurikulum');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('program_keahlian', function (Blueprint $table) {
            $table->string('gambar_kurikulum')->nullable()->after('gambar');
        });
    }
};
