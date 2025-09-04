<?php

namespace App\Repositories;

use App\Interfaces\SlideshowInterface;
use App\Models\Slideshow;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;

class SlideshowRepository implements SlideshowInterface
{
    protected $manager;
    protected $storagePath = 'Slideshows';

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
        Storage::disk('public')->makeDirectory($this->storagePath);
    }

    public function store(array $data)
    {
        $files = $data['files'] ?? [];
        $headlines = $data['headlines'] ?? [];

        foreach ($files as $index => $file) {
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $relativePath = $this->storagePath . '/' . $filename;

            $image = $this->manager->read($file)->encode(new AutoEncoder(quality: 75));
            Storage::disk('public')->put($relativePath, (string) $image);

            Slideshow::create([
                'file' => '/storage/' . $relativePath,
                'headline' => $headlines[$index] ?? null,
            ]);
        }

        return true;
    }

    public function show($id)
    {
        return Slideshow::findOrFail($id);
    }

    public function showAll()
    {
        return Slideshow::orderBy('created_at', 'desc')->get();
    }

    public function update(array $data)
    {
        $ids = $data['ids'] ?? [];
        $headlines = $data['headlines'] ?? [];
        $files = $data['files'] ?? [];

        foreach ($ids as $index => $id) {
            $slideshow = Slideshow::findOrFail($id);
            $slideshow->headline = $headlines[$index] ?? $slideshow->headline;

            if (!empty($files[$index])) {
                $file = $files[$index];
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $relativePath = $this->storagePath . '/' . $fileName;

                $image = $this->manager->read($file)->encode(new AutoEncoder(quality: 75));
                Storage::disk('public')->put($relativePath, (string) $image);

                // Hapus file lama
                if ($slideshow->file) {
                    $oldPath = str_replace('/storage/', '', $slideshow->file);
                    Storage::disk('public')->delete($oldPath);
                }

                $slideshow->file = '/storage/' . $relativePath;
            }

            $slideshow->save();
        }

        return true;
    }

    public function destroy($id)
    {
        $slideshow = Slideshow::findOrFail($id);

        if ($slideshow->file) {
            $oldPath = str_replace('/storage/', '', $slideshow->file);
            Storage::disk('public')->delete($oldPath);
        }

        return $slideshow->delete();
    }
}
