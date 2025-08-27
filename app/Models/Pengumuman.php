<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;
    
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
