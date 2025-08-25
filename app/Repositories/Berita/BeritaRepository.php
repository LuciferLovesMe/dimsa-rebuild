<?php

namespace App\Repositories\Berita;

use App\Interfaces\Berita\BeritaInterface;
use App\Models\Berita;

class BeritaRepository implements BeritaInterface
{
    public function getAll(int $perPage = 10)
    {
        return Berita::with('kategori')->latest()->paginate($perPage);
    }

    public function getBySlug(string $slug)
    {
        return Berita::with('kategori')->where('slug', $slug)->first();
    }
     public function getByID($id)
      {
        return Berita::with('kategori')->findOrFail($id);
    }
  
    public function getAllWithoutPaginate()
    {
        return Berita::with('kategori')->latest()->get();
    }

    public function create(array $data)
    {
        return Berita::create($data);
    }

    public function update($id, array $data)
    {
        $berita = Berita::findOrFail($id);
        $berita->update($data);
        return $berita;
    }

    public function delete($id)
    {
        $berita = Berita::findOrFail($id);
        return $berita->delete();
    }
}