<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaIlmiah extends Model
{
    use HasFactory;

    protected $table = 'karya_ilmiahs';

    protected $fillable = [
        'judul',
        'penulis',
        'tanggal',
        'url',
        'image',
        'is_publish'
    ];
}