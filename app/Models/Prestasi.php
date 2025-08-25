<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasis'; // nama tabel

    protected $fillable = [
        'id_guru_staff',
        'nama_lomba',
        'penyelenggara',
        'predikat',
        'tingkat',
        'tahun',
    ];

    /**
     * Relasi ke model GuruStaff
     */
    public function guruStaff()
    {
        return $this->belongsTo(GuruStaff::class, 'id_guru_staff');
    }
}
