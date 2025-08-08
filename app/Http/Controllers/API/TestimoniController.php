<?php

namespace App\Http\Controllers\API;

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

    public function index(Request $request)
    {
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

    public function show($id)
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

        return response()->json($response, $responseCode);
    }

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
}
