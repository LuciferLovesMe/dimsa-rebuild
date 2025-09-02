<?php

namespace App\Repositories;

use App\Interfaces\KaryaIlmiahInterface;
use App\Models\KaryaIlmiah;
use App\Models\Publikasi;
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

            return Publikasi::create([
                'judul'      => $data['judul'],
                'penulis'    => $data['penulis'],
                'tanggal'    => $data['tanggal'],
                'url'        => $data['url'],
                'image'      => $relative_path ? '/storage/' . $relative_path : null,
                'type'       => 'karya ilmiah',
                'is_publish' => $data['is_publish'] ?? 0,
            ]);
        });
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $karyaIlmiah = Publikasi::findOrFail($id);

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
        return Publikasi::findOrFail($id);
    }

    public function showAll()
    {

        return Publikasi::where('type', 'karya ilmiah')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $karyaIlmiah = Publikasi::findOrFail($id);

            if ($karyaIlmiah->image) {
                $this->deleteImage($karyaIlmiah->image);
            }

            return $karyaIlmiah->delete();
        });
    }
}
