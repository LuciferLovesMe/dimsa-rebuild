<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    private $galeriRepository;

    public function __construct(\App\Interfaces\GaleriInterface $galeriRepository)
    {
        $this->galeriRepository = $galeriRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $data = $this->galeriRepository->index($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Gallery items retrieved successfully',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve gallery items: ' . $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred',
        ], 500);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->galeriRepository->store($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create gallery item: ' . $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        } 
        return response()->json([
            'status' => 'success',
            'message' => 'Gallery item created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = $this->galeriRepository->show($id);
            if (!$data) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gallery item not found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Gallery item retrieved successfully',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve gallery item: ' . $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $data = $this->galeriRepository->show($id);
            if (!$data) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gallery item not found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Gallery item retrieved successfully',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve gallery item: ' . $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->galeriRepository->update($request->all(), $id);
            return response()->json([
                'status' => 'success',
                'message' => 'Gallery item updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update gallery item: ' . $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred',
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->galeriRepository->destroy($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Gallery item deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete gallery item: ' . $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred',
        ], 500);
    }
}
