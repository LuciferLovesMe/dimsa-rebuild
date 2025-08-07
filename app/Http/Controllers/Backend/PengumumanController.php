<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    private $pengumumanRepository;

    public function __construct(\App\Interfaces\PengumumanInterface $pengumumanRepository)
    {
        $this->pengumumanRepository = $pengumumanRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('backend.pengumuman.index');
        }
        
        try {
            $data = $this->pengumumanRepository->index($request);
            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman retrieved successfully',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve pengumuman: ' . $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }
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
            $this->pengumumanRepository->store($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create pengumuman: ' . $e->getMessage(),
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
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if (!$request->ajax()) {
            return view('backend.pengumuman.show', ['id' => $id]);
        }

        try {
            $data = $this->pengumumanRepository->show($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman retrieved successfully',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve pengumuman: ' . $e->getMessage(),
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->pengumumanRepository->update($id, $request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update pengumuman: ' . $e->getMessage(),
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
            $this->pengumumanRepository->destroy($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete pengumuman: ' . $e->getMessage(),
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
