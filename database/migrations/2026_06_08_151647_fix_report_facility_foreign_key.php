<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // 1. Drop foreign key lama yang mengikat ke tabel facilities
            $table->dropForeign(['facility_id']);

            // 2. Buat foreign key baru yang mengarah dengan benar ke tabel categories
            $table->foreign('facility_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Jika di-rollback, kembalikan ke setelan awal
            $table->dropForeign(['facility_id']);
            $table->foreign('facility_id')
                  ->references('id')
                  ->on('facilities')
                  ->onDelete('cascade');
        });
    }
};