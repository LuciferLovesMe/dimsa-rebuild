<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    protected $fillable = ['judul', 'link', 'image', 'is_publish'];

    protected $table = 'ekstrakulikulers';
}
