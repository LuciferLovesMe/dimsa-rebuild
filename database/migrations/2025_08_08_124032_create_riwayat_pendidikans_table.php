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
        Schema::create('riwayat_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_guru_staff');
            $table->enum('tingkat_pendidikan', [
                'SD',
                'SMP',
                'SMA',
                'D1',
                'D2',
                'D3',
                'S1',
                'S2',
                'S3'
            ]);
            $table->string('instansi')->nullable();
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
        Schema::dropIfExists('riwayat_pendidikans');
    }
};
