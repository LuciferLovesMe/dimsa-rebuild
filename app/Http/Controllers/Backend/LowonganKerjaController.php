<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\LowonganKerjaInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class LowonganKerjaController extends Controller
{
    private $lowonganKerjaRepository;

    public function __construct(LowonganKerjaInterface $lowonganKerjaRepository)
    {
        $this->lowonganKerjaRepository = $lowonganKerjaRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('backend.lowongan_kerja.index');
        }

        try {
            $response = [
                'status' => 'success',
                'data' => $this->lowonganKerjaRepository->getAll(),
            ];
            
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($response, 500);
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ];

            return response()->json($response, 500);
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
            $lowonganKerja = $this->lowonganKerjaRepository->create($request);

            return response()->json([
                'status' => 'success',
                'data' => $lowonganKerja,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $lowonganKerja = $this->lowonganKerjaRepository->getById($id);

            if (!$lowonganKerja) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Job vacancy not found.',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $lowonganKerja,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
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
            $lowonganKerja = $this->lowonganKerjaRepository->update($id, $request);

            return response()->json([
                'status' => 'success',
                'data' => $lowonganKerja,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->lowonganKerjaRepository->delete($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Job vacancy deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
