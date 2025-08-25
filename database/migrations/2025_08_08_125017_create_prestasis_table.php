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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_guru_staff');
            $table->string('nama_lomba');
            $table->string('penyelenggara')->nullable();
            $table->enum('tingkat', [
                'Sekolah',
                'Kecamatan',
                'Kabupaten',
                'Provinsi',
                'Nasional',
                'Internasional'
            ]);
            $table->enum('predikat', [
                'Juara 1',
                'Juara 2',
                'Juara 3',
                'Harapan 1',
                'Harapan 2',
                'Harapan 3',
                'Finalis',
                'Peserta'
            ]);
            $table->integer('tahun');
            $table->foreign('id_guru_staff')->references('id')->on('guru_staffs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
