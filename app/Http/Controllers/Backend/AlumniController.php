<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\View\Components\ActionButton;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AlumniController extends Controller
{
    protected $alumniRepository;

    public function __construct(\App\Interfaces\AlumniInterface $alumniRepository)
    {
        $this->alumniRepository = $alumniRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $alumni = $this->alumniRepository->index($request);
            $datatable = datatables()
                ->of($alumni)
                ->addColumn('nama_alumni', function ($item) {
                    return $item->nama_alumni;
                })
                ->addColumn('tahun_lulus', function ($item) {
                    return $item->tahun_lulus;
                })
                ->addColumn('lembaga', function ($item) {
                    return $item->lembaga;
                })
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton(
                        '#', '#', '#'
                    );
                    return $actionButton->render()->with($actionButton->data());
                })
                ->addIndexColumn()
                ->make(true);

            return response()->json($datatable, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve alumni data. ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
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
            $alumni = $this->alumniRepository->store($request);
            $response = [
                'message' => 'Alumni created successfully',
                'data' => $alumni
            ];
            // Return a JSON response with the created alumni data
            return response()->json($response, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create alumni. ' . $e->getMessage()], 500);
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
            return view('backend.alumni.show', ['id' => $id]);
        }

        try {
            $response = [
                'data' => $this->alumniRepository->show($id),
                'message' => 'Alumni retrieved successfully'
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve alumni. ' . $e->getMessage()], 500);
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
            $alumni = $this->alumniRepository->update($id, $request);
            return response()->json(['message' => 'Alumni updated successfully', 'data' => $alumni], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update alumni. ' . $e->getMessage()], 500);
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
            $response = [
                'message' => 'Alumni deleted successfully',
                'data' => $this->alumniRepository->destroy($id)
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete alumni. ' . $e->getMessage()], 500);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database query error. ' . $e->getMessage()], 500);
        }
    }
}
