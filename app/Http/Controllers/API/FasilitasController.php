<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\FasilitasInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FasilitasController extends Controller
{
    private $fasilitasRepository;

    public function __construct(FasilitasInterface $fasilitasRepository)
    {
        $this->fasilitasRepository = $fasilitasRepository;
    }

    public function index()
    {
        try {
            $response = [
                'status' => 'success',
                'data' => $this->fasilitasRepository->index()
            ];
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Database query error'
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $responseCode);
    }

    public function show($id)
    {
        try {
            $fasilitas = $this->fasilitasRepository->show($id);
            $response = [
                'status' => 'success',
                'data' => $fasilitas
            ];
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Database query error'
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $responseCode);
    }
}
