<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pendidikans';

    protected $fillable = [
        'id_guru_staff',
        'tingkat_pendidikan',
        'instansi',
        'tahun_mulai',
        'tahun_akhir',
    ];

    /**
     * Relasi ke GuruStaff
     */
    public function guruStaff()
    {
        return $this->belongsTo(GuruStaff::class, 'id_guru_staff');
    }
}
