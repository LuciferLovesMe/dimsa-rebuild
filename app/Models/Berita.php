<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use Sluggable;

    protected $fillable = [
        'judul',
        'slug',
        'penulis',
        'isi',
        'tanggal',
        'cover',
        'is_publish',
        'id_kategori_berita'
    ];

    /**
     * Configurasi sluggable
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul',   // slug diambil dari field judul
                'onUpdate' => true     // slug ikut update kalau judul berubah
            ]
        ];
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id');
    }
}