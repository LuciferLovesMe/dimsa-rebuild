<?php

namespace App\Http\Controllers\API\Components;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {

        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,webp',
        ]);

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');


            $manager = new ImageManager(new Driver());


            $image = $manager->read($file)
                ->scale(width: 1280)
                ->encode(new WebpEncoder(quality: 75));


            $folder = 'berita/' . date('Y/m');


            $fileName = Str::uuid() . '.webp';
            $path = $folder . '/' . $fileName;


            Storage::disk('public')->put($path, (string) $image);


            $url = asset('storage/' . $path);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $fileName,
                'url' => $url
            ]);
        }

        return response()->json([
            'uploaded' => 0,
            'error' => ['message' => 'Tidak ada file yang diupload.']
        ]);
    }
}
