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
        Schema::create('pengalaman_kerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_guru_staff');
            $table->string('posisi')->nullable();
            $table->string('perusahaan')->nullable();
            $table->integer('tahun_mulai');
            $table->integer('tahun_akhir')->nullable();
            $table->foreign('id_guru_staff')->references('id')->on('guru_staffs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengalaman_kerjas');
    }
};
