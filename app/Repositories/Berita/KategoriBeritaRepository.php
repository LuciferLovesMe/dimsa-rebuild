<?php

namespace App\Repositories\Berita;

use App\Interfaces\Berita\KategoriBeritaInterface;
use App\Models\KategoriBerita;

class KategoriBeritaRepository implements KategoriBeritaInterface
{
    public function create(array $data)
    {
        return KategoriBerita::create($data);
    }

    public function update($id, array $data)
    {
        $kategori = KategoriBerita::findOrFail($id);
        $kategori->update($data);
        return $kategori;
    }

    public function togglePublish($id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        $kategori->is_publish = !$kategori->is_publish;
        $kategori->save();
        return $kategori;
    }

    public function getById($id)
    {
        return KategoriBerita::findOrFail($id);
    }

    public function getAll(int $perPage = 10)
    {
        return KategoriBerita::orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function delete($id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        return $kategori->delete();
    }
}
