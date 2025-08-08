<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LowonganKerja extends Model
{
    protected $fillable = [
        'posisi',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'file',
        'is_publish',
    ];

    public function kualifikasi()
    {
        return $this->hasMany(KualifikasiLowonganKerja::class);
    }
}
