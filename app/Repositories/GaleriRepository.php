<?php
namespace App\Repositories;

use App\Models\Galeri;

class GaleriRepository implements \App\Interfaces\GaleriInterface
{
    public function index($request, $type = 'image')
    {
        // Logic to retrieve and return a list of gallery items
        $data = Galeri::with('files')
            ->when(isset($request->judul), function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->judul . '%');
            })
            ->where('type', $type)
            ->orderBy('id', 'desc')
            ->get();
        
        return $data;
    } 
    
    public function store($request, $type = 'image')
    {
        // Logic to store a new gallery item
        $galeri = new Galeri();
        $galeri->judul = $request->judul;
        $galeri->type = $request->type;
        $galeri->url = $type != 'image' ? $request->url : null;
        $galeri->is_publish = $request->is_publish ?? false;
        $galeri->save();
        
        if ($type == 'image') {
            if ($request->file('image')) {
                $files = [];
                foreach ($request->file('image') as $key => $file) {
                    array_push($files, [
                        'reference' => 'galeri',
                        'id_reference' => $galeri->id,
                        'file' => storeImage($file, '/uploads/files/galeri/'),
                    ]);
                };
                $galeri->files()->createMany($files);
            }
        }

        return $galeri;
    }

    public function show($id, $type = 'image')
    {
        $data = Galeri::with('files')
            ->where('id', $id)
            ->first();
        if (!$data) {
            throw new \Exception('Gallery item not found');
        }  
        return $data;
    }

    public function update($request, $id, $type = 'image')
    {
        $data = Galeri::findOrFail($id);
        $data->judul = $request->judul;
        $data->url = $type != 'image' ? $request->url : null;
        $data->type = $data->type;
        $data->is_publish = $request->is_publish ?? $data->is_publish;
        
        if ($type == 'image') {
            foreach ($request->id_file as $key => $item) {
                $file = $request->file('image')[$key] ?? null;
                if ($file) {
                    $storedFile = storeImage($file, '/uploads/files/galeri/', $key + 1);
                    $updatedFile = $data->files()->find($item);
                    if ($updatedFile) {
                        $updatedFile->file = $storedFile;
                        $updatedFile->save();
                    }
                }
            }
        }

        $data->save();
    }

    public function destroy($id)
    {
        $data = Galeri::find($id);
        if (!$data) {
            throw new \Exception('Gallery item not found');
        }
        $data->files()->delete();
        $data->delete();
    }
}