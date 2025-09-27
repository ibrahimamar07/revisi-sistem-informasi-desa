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
        Schema::table('perihal_surat', function (Blueprint $table) {
            //
            $table->string('kepentingan')->after('deskripsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perihal_surat', function (Blueprint $table) {
            //
            $table->dropColumn('kepentingan');
        });
    }
};
