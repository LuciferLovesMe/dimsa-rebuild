<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ImageHandler;

class CkeditorController extends Controller
{
    use ImageHandler;

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $path = $this->processImage($request->file('upload'), 'CKEditor');

            $url = asset('storage/' . $path);

            // CKEditor5 butuh format JSON: { "url": "..." }
            return response()->json([
                'url' => $url
            ]);
        }

        return response()->json(['error' => 'Tidak ada file diupload'], 400);
    }
}
