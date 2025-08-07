<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\PengumumanInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    private $pengumumanRepository;

    public function __construct(PengumumanInterface $pengumumanRepository)
    {
        $this->pengumumanRepository = $pengumumanRepository;
    }
    
    public function index(Request $request)
    {
        try {
            $pengumuman = $this->pengumumanRepository->index($request);
            $response = [
                'data' => $pengumuman,
                'message' => 'Pengumuman retrieved successfully',
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve pengumuman. ' . $e->getMessage()], 500);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database error occurred. ' . $e->getMessage()], 500);
        }
    }
    
    public function show($id)
    {
        try {
            $pengumuman = $this->pengumumanRepository->show($id);
            if (!$pengumuman) {
                return response()->json(['message' => 'Pengumuman not found'], 404);
            }
            $response = [
                'data' => $pengumuman,
                'message' => 'Pengumuman retrieved successfully',
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve pengumuman. ' . $e->getMessage()], 500);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database error occurred. ' . $e->getMessage()], 500);
        }
    }
}