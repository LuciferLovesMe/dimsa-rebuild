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
        
        $path = public_path() . '/uploads/alumni/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $fileType = $file->getClientOriginalExtension();
        $fileName = time() . '.';
        if ($fileType == 'png' || $fileType == 'jpg' || $fileType == 'jpeg') {
            $imageManager = new ImageManager(new Driver());
            $image = $imageManager->read($file);
            $image->toWebp(80)->save($path . $fileName . 'webp');
            $storedData['image'] = $fileName . 'webp';
        } else {
            $storedData['image'] = $file->store('images/alumni', 'public');
            $file->move($path, $storedData['image']);
        }
        $storedData['nama_alumni'] = $data->nama_alumni;
        $storedData['tahun_lulus'] = $data->tahun_lulus;
        $storedData['lembaga'] = $data->lembaga;

        return $this->alumni->create($storedData);
    }
    
    public function update($id, $data)
    {
        $alumni = $this->alumni->findOrFail($id);

        if ($data->file('image')) {
            $path = public_path() . '/uploads/alumni/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if ($alumni->image && file_exists($path . $alumni->image)) {
                unlink($path . $alumni->image);
            }
            
            $file =  $data->file('image');
            
            $fileType = $file->getClientOriginalExtension();
            $fileName = time() . '.';
            if ($fileType == 'png' || $fileType == 'jpg' || $fileType == 'jpeg') {
                $imageManager = new ImageManager(new Driver());
                $image = $imageManager->read($file);
                $image->toWebp(80)->save($path . $fileName . 'webp');
                $storedData['image'] = $fileName . '.webp';
            } else {
                $storedData['image'] = $file->store('images/alumni', 'public');
                $file->move($path, $storedData['image']);
            }
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