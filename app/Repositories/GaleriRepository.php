<?php
namespace App\Repositories;

use App\Models\Galeri;

class GaleriRepository implements \App\Interfaces\GaleriInterface
{
    /**
     * 
     * Display a listing of the resource.
     */
    public function index($request)
    {
        // Logic to retrieve and return a list of gallery items
        $data = Galeri::with('files')
            ->when(isset($request['judul']), function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request['judul'] . '%');
            })
            ->orderBy('id', 'desc')
            ->get();
        
        return $data;
    } 
    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        // Logic to store a new gallery item
        $galeri = new Galeri();
        $galeri->judul = $request['judul'];
        $galeri->url = $request['url'];
        $galeri->type = $request['type'];
        $galeri->is_publish = ($request['is_publish'] == true || 1) ? 1 : 0;

        if ($request['type'] == 'image') {
            $files = [];
            foreach ($request->file('image') as $key => $file) {
                array_push($files, [
                    'reference' => 'galeri',
                    'id_reference' => $galeri->id,
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $file->store('galeri', 'public'),
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            };
            $galeri->save();
            $galeri->files()->createMany($files);
        }
    }

    /**
     * Display the specified resource.
     * @param mixed $id
     * @return mixed
     * */
    public function show($id)
    {
        // Logic to retrieve a specific gallery item by ID
    }

    /** 
     * Update the specified resource in storage.
     * @param mixed $id
     * @return mixed
     * */
    public function update($request, $id)
    {
        // Logic to update a specific gallery item by ID
    }

    /**
     * Remove the specified resource from storage.
     * @param mixed $id
     * @return mixed
     * */
    public function destroy($id)
    {
        // Logic to remove a specific gallery item by ID
    } 
}