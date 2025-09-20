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

            $table->dropForeign('surat_keluar_created_by_foreign');

            // Add the foreign key constraint back with ON DELETE SET NULL
            $table->foreign('created_by')
                  ->references('id')
                  ->on('pengguna')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            //

             $table->dropForeign('surat_keluar_created_by_foreign');

            // Add the foreign key constraint back with ON DELETE SET NULL
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }
};
