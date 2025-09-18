<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Gd\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

trait ImageHandler
{
    private function processImage($file, $prefix, $folder = null)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)
            ->scale(width: 1280)
            ->encode(new WebpEncoder(quality: 75));

        if ($prefix === 'Berita') {
            $path = !empty($folder)
                ? "{$prefix}/{$folder}/" . date('Y/m') . '/' . Str::uuid() . '.webp'
                : "{$prefix}/" . date('Y/m') . '/' . Str::uuid() . '.webp';
        } else {
            $path = !empty($folder)
                ? "{$prefix}/{$folder}/" . Str::uuid() . '.webp'
                : "{$prefix}/" . Str::uuid() . '.webp';
        }

        Storage::disk('public')->put($path, (string) $image);

        return $path;
    }


    private function deleteImage($image)
    {
        $path = str_replace('/storage/', '', $image);
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }



    private function deleteCKEditorImages($html)
    {
        preg_match_all('/<img[^>]+src="([^">]+)"/', $html, $matches);
        $urls = $matches[1] ?? [];

        foreach ($urls as $url) {
            $path = str_replace(asset('storage') . '/', '', $url);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}
