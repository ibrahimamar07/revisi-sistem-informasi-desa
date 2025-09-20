<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRolePenggunaTable extends Migration
{
    public function up()
    {
        Schema::table('pengguna', function (Blueprint $table) {
            // Ubah enum role: nonadmin -> perangkatdesa, tambah warga, default warga
            $table->enum('role', ['admin', 'perangkatdesa', 'warga'])
                  ->default('warga')
                  ->change();
        });

        // Update data lama: nonadmin -> perangkatdesa
        \DB::table('pengguna')->where('role', 'nonadmin')->update(['role' => 'perangkatdesa']);
    }

    public function down()
    {
        Schema::table('pengguna', function (Blueprint $table) {
            $table->enum('role', ['admin', 'nonadmin'])->default('nonadmin')->change();
        });

        // Kembalikan perangkatdesa ke nonadmin
        \DB::table('pengguna')->where('role', 'perangkatdesa')->update(['role' => 'nonadmin']);
    }
}