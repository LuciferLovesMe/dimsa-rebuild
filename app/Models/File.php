<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'reference',
        'id_reference',
        'file',
    ];

    protected $table = 'files';

    public function galeri()
    {
        return $this->belongsTo(Galeri::class, 'id_reference')->where('reference', 'galeri');
    }
}
