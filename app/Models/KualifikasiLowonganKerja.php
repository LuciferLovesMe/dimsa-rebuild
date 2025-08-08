<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KualifikasiLowonganKerja extends Model
{
    protected $fillable = [
        'lowongan_kerja_id',
        'deskripsi',
    ];

    public function lowonganKerja()
    {
        return $this->belongsTo(LowonganKerja::class);
    }
}
