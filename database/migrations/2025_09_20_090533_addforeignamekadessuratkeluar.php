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
        Schema::table('surat_keluar', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('nama_kades')->nullable();
            $table->foreign('nama_kades')->references('id')->on('kepaladesa')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            //
            $table->dropForeign(['nama_kades']);
            $table->dropColumn('nama_kades');
        });
    }
};
