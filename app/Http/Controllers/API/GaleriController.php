<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\GaleriInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GaleriController extends Controller
{
    private $galeriRepository;

    public function __construct(GaleriInterface $galeriRepository)
    {
        $this->galeriRepository = $galeriRepository;
    }

    public function index(Request $request)
    {
        try {
            $response = [
                'status' => 'success',
                'data' => $this->galeriRepository->index($request, $request->type ?? 'image'),
            ];
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Database query error. ' . $e->getMessage(),
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $responseCode);
    }

    public function show($id, Request $request)
    {
        try {
            $response = [
                'status' => 'success',
                'data' => $this->galeriRepository->show($id, $request),
            ];
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Database query error. ' . $e->getMessage(),
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $responseCode);
    }
}
