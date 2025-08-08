<?php

namespace App\Http\Controllers\API;

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

    public function index()
    {
        try {
            $response = [
                'status' => 'success',
                'data' => $this->lowonganKerjaRepository->getAll(),
            ];
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ];
        }

        return response()->json($response);
    }

    public function show($id)
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
}
