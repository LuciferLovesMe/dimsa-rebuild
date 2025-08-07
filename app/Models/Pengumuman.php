<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'url',
        'is_publish',
    ];

    protected $table = 'pengumumans';

    public $timestamps = true;
}
