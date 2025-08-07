<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\QnaInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class QnaController extends Controller
{
    private $qnaRepository;

    public function __construct(QnaInterface $qnaRepository)
    {
        $this->qnaRepository = $qnaRepository;
    }

    public function index(Request $request)
    {
        try {
            $qnas = $this->qnaRepository->index($request);
            $response = [
                'data' => $qnas,
                'message' => 'QnAs retrieved successfully',
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve QnA. ' . $e->getMessage()], 500);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database error occurred. ' . $e->getMessage()], 500);
        }
    }
    
    public function show($id)
    {
        try {
            $qna = $this->qnaRepository->show($id);
            if (!$qna) {
                return response()->json(['message' => 'QnA not found'], 404);
            }
            $response = [
                'data' => $qna,
                'message' => 'QnA retrieved successfully',
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve QnA. ' . $e->getMessage()], 500);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database error occurred. ' . $e->getMessage()], 500);
        }
    }
}
