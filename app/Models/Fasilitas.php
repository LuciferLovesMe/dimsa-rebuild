<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $fillable = ['judul', 'is_publish'];

    protected $table = 'fasilitas';

    public function files()
    {
        return $this->hasMany(File::class, 'id_reference')->where('reference', 'fasilitas');
    }
}
