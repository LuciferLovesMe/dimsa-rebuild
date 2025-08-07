<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\QnaInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class QnaController extends Controller
{
    protected $qnaRepository;

    public function __construct(QnaInterface $qnaRepository)
    {
        $this->qnaRepository = $qnaRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('backend.qna.index');
        }

        try {
            $qnas = $this->qnaRepository->index();
            $response = [
                'message' => 'Q&A data retrieved successfully',
                'data' => $qnas,
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve Q&A data. ' . $e->getMessage()], 500);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database query error. ' . $e->getMessage()], 500);
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
            $data = $request->validate([
                'pertanyaan' => 'required|string|max:255',
                'jawaban' => 'required|string|max:255',
                'is_publish' => 'boolean',
            ]);

            $qna = $this->qnaRepository->store($data);
            return response()->json(['message' => 'Q&A created successfully', 'data' => $qna], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create Q&A. ' . $e->getMessage()], 500);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database query error. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {   
        if (!$request->ajax()) {
            return view('backend.qna.show', ['id' => $id]);
        }
        
        try {
            $qna = $this->qnaRepository->show($id);
            return response()->json(['message' => 'Q&A retrieved successfully', 'data' => $qna], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve Q&A. ' . $e->getMessage()], 500);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database query error. ' . $e->getMessage()], 500);
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
            $data = $request->validate([
                'pertanyaan' => 'required|string|max:255',
                'jawaban' => 'required|string|max:255',
                'is_publish' => 'boolean',
            ]);

            $qna = $this->qnaRepository->update($id, $data);
            return response()->json(['message' => 'Q&A updated successfully', 'data' => $qna], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update Q&A. ' . $e->getMessage()], 500);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database query error. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleted = $this->qnaRepository->destroy($id);
            if ($deleted) {
                return response()->json(['message' => 'Q&A deleted successfully'], 200);
            } else {
                return response()->json(['error' => 'Q&A not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Q&A. ' . $e->getMessage()], 500);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database query error. ' . $e->getMessage()], 500);
        }
    }
}
