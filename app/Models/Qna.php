<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qna extends Model
{
    protected $table = 'qnas';

    protected $fillable = [
        'pertanyaan',
        'jawaban',
        'is_publish',
    ];
}
