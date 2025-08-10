<?php

namespace App\Repositories;

use App\Interfaces\PublikasiInterface;
use App\Models\Publikasi;

class PublikasiRepository implements PublikasiInterface
{
    private $publikasi;

    public function __construct(Publikasi $publikasi)
    {
        $this->publikasi = $publikasi;
    }

    public function createMajalah($data)
    {
        $storedData = [
            'judul' => $data->judul,
            'penulis' => $data->penulis,
            'url' => $data->url,
            'tanggal_terbit' => $data->tanggal_terbit,
            'is_publish' => $data->is_publish ?? false,
            'image' => storeImage($data->file('image'), '/uploads/publikasi/majalah/'),
            'type' => 'majalah',
        ];

        return $this->publikasi->create($storedData);
    }

    public function updateMajalah($id, $data)
    {
        $publikasi = $this->publikasi->findOrFail($id);
        $publikasi->judul = $data->judul;
        $publikasi->penulis = $data->penulis;
        $publikasi->url = $data->url;
        $publikasi->tanggal_terbit = $data->tanggal_terbit;
        $publikasi->is_publish = $data->is_publish ?? $publikasi->is_publish;
        $publikasi->image = $data->file('image') ? storeImage($data->file('image'), '/uploads/publikasi/majalah/') : $publikasi->image;
        $publikasi->save();
        return $publikasi;
    }

    public function deleteMajalah($id)
    {
        $publikasi = $this->publikasi->findOrFail($id);
        $publikasi->delete();
    }

    public function getMajalahById($id)
    {
        return $this->publikasi->findOrFail($id);
    }

    public function getMajalah()
    {
        return $this->publikasi
            ->where('type', 'majalah')
            ->get();
    }
}