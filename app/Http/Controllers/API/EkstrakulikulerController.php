<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\EkstrakulikulerInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EkstrakulikulerController extends Controller
{
    private $ekstrakulikulerRepository;

    public function __construct(EkstrakulikulerInterface $ekstrakulikulerRepository)
    {
        $this->ekstrakulikulerRepository = $ekstrakulikulerRepository;
    }

    public function index()
    {
        try {
            $response = [
                'status' => 'success',
                'data' => $this->ekstrakulikulerRepository->getAll()
            ];
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => 'Internal server error. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Database query error. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $responseCode);
    }

    public function show($id)
    {
        try {
            $ekstrakulikuler = $this->ekstrakulikulerRepository->getById($id);
            if (!$ekstrakulikuler) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ekstrakulikuler not found.'
                ], Response::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => 'success',
                'data' => $ekstrakulikuler
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal server error. ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database query error. ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
