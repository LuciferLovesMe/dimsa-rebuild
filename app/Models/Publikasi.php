<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    protected $fillable = [
        'judul',
        'penulis',
        'image',
        'url',
        'tanggal_terbit',
        'type',
        'is_publish',
    ];

    protected $table = 'publikasis';
}
