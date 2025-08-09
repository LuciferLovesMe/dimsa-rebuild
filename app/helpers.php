<?php

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

if (!function_exists('storeImage')) {
    function storeImage($file, $pathFolder)
    {
        $path = public_path() . $pathFolder;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $fileType = $file->getClientOriginalExtension();
        $fileName = time() . '.';
        if ($fileType != 'webp') {
            $imageManager = new ImageManager(new Driver());
            $image = $imageManager->read($file);
            $image->toWebp(80)->save($path . $fileName . 'webp');
        } else {
            $file->store('images/alumni', 'public');
            $file->move($path, $fileName . 'webp');
        }
        return $fileName . 'webp';
    }
}