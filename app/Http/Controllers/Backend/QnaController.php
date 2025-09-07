<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\QnaInterface;
use App\View\Components\ActionButton;
use App\View\Components\StatusPublish;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        try {
            $qnas = $this->qnaRepository->index();
            $datatable = datatables()
                ->of($qnas)
                ->addColumn('question', function ($qna) {
                    return $qna->pertanyaan;
                })
                ->addColumn('answer', function ($qna) {
                    return $qna->jawaban;
                })
                ->addColumn('status', function ($qna) {
                    $statusBadge = new StatusPublish($qna->is_publish);
                    return $statusBadge->render()->with($statusBadge->data());
                })
                ->addColumn('aksi', function ($qna) {
                    $actionButton = new ActionButton(
                        $qna->id,
                        url('/admin/qna/edit') . '?id=' . $qna->id,
                        $qna->id
                    );
                    return $actionButton->render()->with($actionButton->data());
                })
                ->addIndexColumn()
                ->make(true);

            return $datatable;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve Q&A data. ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database query error. ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
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
