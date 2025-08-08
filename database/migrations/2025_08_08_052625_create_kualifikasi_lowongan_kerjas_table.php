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
        Schema::create('kualifikasi_lowongan_kerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lowongan_kerja_id')->constrained('lowongan_kerjas')->onDelete('cascade');
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kualifikasi_lowongan_kerjas');
    }
};
