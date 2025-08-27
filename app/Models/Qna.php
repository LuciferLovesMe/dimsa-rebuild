<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qna extends Model
{
    use HasFactory;
    
    protected $table = 'qnas';

    protected $fillable = [
        'pertanyaan',
        'jawaban',
        'is_publish',
    ];
}
