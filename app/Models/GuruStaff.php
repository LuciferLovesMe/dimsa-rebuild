<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruStaff extends Model
{
    use HasFactory;

    protected $table = 'guru_staffs';
    protected $fillable = [
        'nama',
        'jabatan',
        'image',
        'role',
        'is_publish',
    ];
    public function prestasis()
    {
        return $this->hasMany(Prestasi::class, 'id_guru_staff');
    }
    public function pengalamanKerjas()
    {
        return $this->hasMany(PengalamanKerja::class, 'id_guru_staff');
    }

    public function riwayatPendidikans()
    {
        return $this->hasMany(RiwayatPendidikan::class, 'id_guru_staff');
    }
}
