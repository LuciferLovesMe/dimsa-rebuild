<?php
namespace App\Repositories;

use App\Interfaces\AlumniInterface;
use App\Models\Alumni;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;

class AlumniRepository implements AlumniInterface
{
    protected $alumni;
    public function __construct(Alumni $alumni)
    {
        $this->alumni = $alumni;
    }

    public function index($request)
    {
        return $this->alumni->all();
    }

    public function show($id)
    {
        return $this->alumni->findOrFail($id);
    }  

    public function store($data)
    {
        $file =  $data->file('image');
        
        $storedData['nama_alumni'] = $data->nama_alumni;
        $storedData['tahun_lulus'] = $data->tahun_lulus;
        $storedData['lembaga'] = $data->lembaga;
        $storedData['image'] = storeImage($file, '/uploads/alumni/');

        return $this->alumni->create($storedData);
    }
    
    public function update($id, $data)
    {
        $alumni = $this->alumni->findOrFail($id);

        if ($data->file('image')) {
            $storedData['image'] = storeImage($data->file('image'), '/uploads/alumni/');
        } 
        $storedData['nama_alumni'] = $data->nama_alumni;
        $storedData['tahun_lulus'] = $data->tahun_lulus;
        $storedData['lembaga'] = $data->lembaga;
        $alumni->update($storedData);

        return $alumni;
    }

    public function destroy($id)
    {
        $alumni = $this->alumni->findOrFail($id);
        $alumni->delete();
        return response()->json(['message' => 'Alumni deleted successfully'], 200);
    }
}