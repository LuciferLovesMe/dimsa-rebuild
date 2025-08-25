<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramUnggulan extends Model
{
    use HasFactory;

    protected $table = 'program_unggulans';

    protected $fillable = [
        'nama_program',
        'deskripsi',
        'image',
        'url',
        'is_publish',
    ];
}
