<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->unique();
            $table->date('tanggal');
            $table->string('pengirim');
            $table->unsignedBigInteger('perihal_surat_id')->nullable();
            $table->text('path');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('perihal_surat_id')->references('id')->on('perihal_surat')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};