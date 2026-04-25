<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('reports', function (Blueprint $table) {
        // Tambahkan kolom urgensi setelah kolom deskripsi
        $table->enum('urgensi', ['normal', 'darurat'])->default('normal')->after('deskripsi');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            //
        });
    }
};
