<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom status ke tabel surat_keluar.
     */
    public function up(): void
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            $table->enum('status', ['belum_dikonfirmasi', 'disetujui', 'ditolak'])
                ->default('belum_dikonfirmasi')
                ->after('id'); // letakkan setelah kolom id (boleh diganti sesuai kebutuhan)
        });
    }

    /**
     * Rollback perubahan (hapus kolom status).
     */
    public function down(): void
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
