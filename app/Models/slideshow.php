<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slideshow extends Model
{
    use HasFactory;
    protected $table = 'slideshows';

    protected $fillable = [
        'file',
        'headline'
    ];
}
