<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $fillable = ['alumni_id', 'testimoni', 'is_publish'];

    protected $table = 'testimonis';

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
