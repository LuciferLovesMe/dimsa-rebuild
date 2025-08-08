<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $fillable = [
        'nama_alumni',
        'tahun_lulus',
        'lembaga',
        'image',
    ];

    protected $table = 'alumnis';
}
