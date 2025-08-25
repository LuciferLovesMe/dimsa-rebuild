<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengalamanKerja extends Model
{
    use HasFactory;

    protected $table = 'pengalaman_kerjas';

    protected $fillable = [
        'id_guru_staff',
        'posisi',
        'perusahaan',
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
