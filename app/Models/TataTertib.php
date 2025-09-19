<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TataTertib extends Model
{
    use HasFactory;
    protected $table = 'tatatertibs';

    protected $fillable = [
        'link',
        'is_publish'
    ];
}
