<?php

namespace App\Http\Controllers\Backend\Slideshow;

use App\Http\Controllers\Controller;
use App\Interfaces\SlideshowInterface;
use App\Http\Requests\Slideshow\SlideshowRequest;
use App\Http\Requests\Slideshow\UpdateSlideShowRequest;
use App\View\Components\ActionButton;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SlideshowController extends Controller
{
    private $slideshowRepository;

    public function __construct(SlideshowInterface $slideshowRepository)
    {
        $this->slideshowRepository = $slideshowRepository;
    }

    public function index(Request $request)
    {
        try {
            $slides = $this->slideshowRepository->showAll();

            $datatable = datatables()
                ->of($slides)
                ->addColumn('headline', fn($item) => $item->headline ?? '-')
                ->addColumn('image', fn($item) => '<img src="' . asset($item->file) . '" alt="Slide" style="max-width:100px">')
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton(
                         '#', '#', '#'
                    );
                    return $actionButton->render()->with($actionButton->data());
                })
                ->addIndexColumn()
                ->rawColumns(['image', 'aksi'])
                ->make(true);

            return response()->json([
                'status' => 'success',
                'data' => $datatable
            ], Response::HTTP_OK);

        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database query error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create()
    {
        // return view form create jika perlu
    }

    public function store(SlideshowRequest $request)
    {
        try {
            $files = $request->file('file') ?: [];
            $headlines = $request->input('headline') ?: [];

            $this->slideshowRepository->store([
                'files' => is_array($files) ? $files : [$files],
                'headlines' => is_array($headlines) ? $headlines : [$headlines],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Slideshow created successfully'
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(string $id)
    {
        try {
            $slide = $this->slideshowRepository->show($id);
            return response()->json([
                'status' => 'success',
                'data' => $slide
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit(string $id)
    {
        // return view form edit jika perlu
    }

    public function update(UpdateSlideShowRequest $request, string $id)
    {
        try {
            $files = $request->file('file') ?: [];
            $headlines = $request->input('headline') ?: [];

            $this->slideshowRepository->update([
                'ids' => [$id],
                'headlines' => is_array($headlines) ? $headlines : [$headlines],
                'files' => is_array($files) ? $files : [$files],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Slideshow updated successfully'
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->slideshowRepository->destroy($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Slideshow deleted successfully'
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
