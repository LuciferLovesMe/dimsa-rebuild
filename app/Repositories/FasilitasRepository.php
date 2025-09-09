<?php

namespace App\Repositories;

use App\Interfaces\FasilitasInterface;
use App\Models\Fasilitas;

class FasilitasRepository implements FasilitasInterface
{
    public function index()
    {
        return Fasilitas::with('files')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function show($id)
    {
        return Fasilitas::findOrFail($id)
            ->with('files')
            ->first();
    }

    public function store($data)
    {
        $fasilitas = new Fasilitas();
        $fasilitas->judul = $data->judul;
        $fasilitas->is_publish = $data->is_publish ?? false;
        $fasilitas->save();

        if ($data->file('image')) {
            $files = [];
            foreach ($data->file('image') as $key => $file) {
                array_push($files, [
                    'reference' => 'fasilitas',
                    'id_reference' => $fasilitas->id,
                    'file' => storeImage($file, '/uploads/fasilitas/', $key + 1),
                ]);
            };
            $fasilitas->files()->createMany($files);
        }

        return $fasilitas;
    }

    public function update($id, $data)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->judul = $data->judul;
        $fasilitas->is_publish = $data->is_publish ?? false;
        $fasilitas->save();

        foreach ($data->id_image as $key => $item) {
            $file = $data->file('image')[$key] ?? null;
            if ($file) {
                $storedFile = storeImage($file, '/uploads/fasilitas/', $key + 1);
                $updatedFile = $fasilitas->files()->find($item);
                if ($updatedFile) {
                    $updatedFile->file = $storedFile;
                    $updatedFile->save();
                }
            }
        }
    }

    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->files()->delete();
        $fasilitas->delete();
    }
}
