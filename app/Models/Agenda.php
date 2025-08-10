<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
        'datetime',
        'image',
        'is_publish'
    ];
}
