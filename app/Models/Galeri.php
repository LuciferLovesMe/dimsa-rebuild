<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'judul',
        'url',
        'is_publish',
        'type',
    ];

    protected $table = 'galeris';

    public function files()
    {
        return $this->hasMany(File::class, 'id_reference')->where('reference', 'galeri');
    }
}
