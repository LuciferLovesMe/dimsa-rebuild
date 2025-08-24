<?php

namespace App\Http\Controllers\API\Slideshow;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slideshow\SlideshowRequest;
use App\Http\Requests\Slideshow\UpdateSlideShowRequest;
use App\Interfaces\SlideshowInterface;

class SlideshowController extends Controller
{
    private $slideshowRepo;

    public function __construct(SlideshowInterface $slideshowRepo)
    {
        $this->slideshowRepo = $slideshowRepo;
    }

    public function store(SlideshowRequest $request)
    {
        try {
            if (!$request->hasFile('file')) {
                return apiFailed('No file uploaded.', null, 400);
            }

            $this->slideshowRepo->store([
                'files' => $request->file('file'),
                'headlines' => $request->input('headline', []),
            ]);

            return apiSuccess(null, 'Slideshow has been saved successfully.');
        } catch (\Throwable $th) {
            return apiFailed('Failed to save slideshow.', null, 500, $th->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $slideshow = $this->slideshowRepo->show($id);
            return apiSuccess($slideshow, 'Slideshow retrieved successfully.');
        } catch (\Throwable $th) {
            return apiFailed('Failed to retrieve slideshow.', null, 404, $th->getMessage());
        }
    }

    public function showAll()
    {
        try {
            $slideshows = $this->slideshowRepo->showAll();
            return apiSuccess($slideshows, 'All slideshows retrieved successfully.');
        } catch (\Throwable $th) {
            return apiFailed('Failed to retrieve all slideshows.', null, 500, $th->getMessage());
        }
    }

    public function update(UpdateSlideShowRequest $request)
    {
        try {
            $this->slideshowRepo->update([
                'ids' => $request->input('id'),
                'headlines' => $request->input('headline', []),
                'files' => $request->file('file', []),
            ]);

            return apiSuccess(null, 'Slideshow updated successfully.');
        } catch (\Throwable $th) {
            return apiFailed('Failed to update slideshow.', null, 500, $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->slideshowRepo->destroy($id);
            return apiSuccess(null, 'Slideshow deleted successfully.');
        } catch (\Throwable $th) {
            return apiFailed('Failed to delete slideshow.', null, 500, $th->getMessage());
        }
    }
}