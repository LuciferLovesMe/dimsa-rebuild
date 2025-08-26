<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    use HasFactory;
    
    protected $fillable = ['judul', 'link', 'image', 'is_publish'];

    protected $table = 'ekstrakulikulers';
}
