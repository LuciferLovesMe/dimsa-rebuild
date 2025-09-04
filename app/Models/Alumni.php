<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_alumni',
        'tahun_lulus',
        'lembaga',
        'image',
        'pekerjaan'
    ];

    protected $table = 'alumnis';
}
