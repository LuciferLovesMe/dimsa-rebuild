<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\TestimoniInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestimoniController extends Controller
{
    private $testimoniRepository;

    public function __construct(TestimoniInterface $testimoniRepository)
    {
        $this->testimoniRepository = $testimoniRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('backend.testimoni.index');
        }

        try {
            $response = [
                'status' => 'success',
                'data' => $this->testimoniRepository->getAll()
            ];
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to retrieve testimonies. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to retrieve testimonies. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_BAD_REQUEST;
        } 

        return response()->json($response, $responseCode);
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
            $this->testimoniRepository->create($request->all());
            $response = [
                'status' => 'success',
                'message' => 'Testimony created successfully.'
            ];
            $responseCode = Response::HTTP_CREATED;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to create testimony. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to create testimony. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_BAD_REQUEST;
        }

        return response()->json($response, $responseCode);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $testimoni = $this->testimoniRepository->getById($id);
            if (!$testimoni) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Testimony not found.'
                ], Response::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => 'success',
                'data' => $testimoni
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve testimony. ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve testimony. ' . $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
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
            $this->testimoniRepository->update($id, $request->all());
            $response = [
                'status' => 'success',
                'message' => 'Testimony updated successfully.'
            ];
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to update testimony. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to update testimony. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_BAD_REQUEST;
        }

        return response()->json($response, $responseCode);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->testimoniRepository->delete($id);
            $response = [
                'status' => 'success',
                'message' => 'Testimony deleted successfully.'
            ];
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to delete testimony. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to delete testimony. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_BAD_REQUEST;
        }

        return response()->json($response, $responseCode);
    }
}
