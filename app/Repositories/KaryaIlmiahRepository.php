<?php

namespace App\Repositories;

use App\Interfaces\KaryaIlmiahInterface;
use App\Models\KaryaIlmiah;
use Illuminate\Support\Facades\DB;
use App\Traits\ImageHandler;

class KaryaIlmiahRepository implements KaryaIlmiahInterface
{
    use ImageHandler;

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $relative_path = null;

            if (isset($data['image']) && $data['image']) {
                $relative_path = $this->processImage($data['image'], 'KaryaIlmiah');
            }

            return KaryaIlmiah::create([
                'judul'      => $data['judul'],
                'penulis'    => $data['penulis'],
                'tanggal'    => $data['tanggal'],
                'url'        => $data['url'],
                'image'      => $relative_path ? '/storage/' . $relative_path : null,
                'is_publish' => $data['is_publish'] ?? 0,
            ]);
        });
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $karyaIlmiah = KaryaIlmiah::findOrFail($id);

            if (isset($data['image']) && $data['image']) {
                if ($karyaIlmiah->image) {
                    $this->deleteImage($karyaIlmiah->image);
                }
                $relative_path = $this->processImage($data['image'], 'KaryaIlmiah');
                $karyaIlmiah->image = '/storage/' . $relative_path;
            }

            $karyaIlmiah->update([
                'judul'      => $data['judul'],
                'penulis'    => $data['penulis'],
                'tanggal'    => $data['tanggal'],
                'url'        => $data['url'],
                'is_publish' => $data['is_publish'] ?? 0,
            ]);

            return $karyaIlmiah;
        });
    }

    public function show(int $id)
    {
        return KaryaIlmiah::findOrFail($id);
    }

    public function showAll()
    {
        return KaryaIlmiah::orderBy('created_at', 'desc')->get();
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $karyaIlmiah = KaryaIlmiah::findOrFail($id);

            if ($karyaIlmiah->image) {
                $this->deleteImage($karyaIlmiah->image);
            }

            return $karyaIlmiah->delete();
        });
    }
}
