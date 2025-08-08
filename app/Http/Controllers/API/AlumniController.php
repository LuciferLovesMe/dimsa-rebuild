<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    private $alumniRepository;

    public function __construct(\App\Interfaces\AlumniInterface $alumniRepository)
    {
        $this->alumniRepository = $alumniRepository;
    }

    public function index(Request $request)
    {
        try {
            $alumni = $this->alumniRepository->index($request);
            $response = [
                'message' => 'Alumni retrieved successfully',
                'data' => $alumni
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve alumni data. ' . $e->getMessage()], 500);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database query error. ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $alumni = $this->alumniRepository->show($id);
            $response = [
                'message' => 'Alumni retrieved successfully',
                'data' => $alumni
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve alumni data. ' . $e->getMessage()], 500);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database query error. ' . $e->getMessage()], 500);
        }
    }
}
