<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\View\Components\ActionButton;
use App\View\Components\StatusPublish;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PengumumanController extends Controller
{
    private $pengumumanRepository;

    public function __construct(\App\Interfaces\PengumumanInterface $pengumumanRepository)
    {
        $this->pengumumanRepository = $pengumumanRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $data = $this->pengumumanRepository->index($request->all());
            $datatable = datatables()
                ->of($data)
                ->addColumn('judul', function ($item){
                    return $item->judul;
                })
                ->addColumn('tanggal', function ($item) {
                    return $item->tanggal ? date('d-m-Y', strtotime($item->tanggal)) : '-';
                })
                ->addColumn('status', function ($item) {
                    $statusBadge = new StatusPublish($item->is_publish);
                    return $statusBadge->render()->with($statusBadge->data());
                })
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton(
                        '#', '#', '#'
                    );
                    return $actionButton->render()->with($actionButton->data());
                })
                ->addIndexColumn()
                ->make(true);
            return response()->json([
                'status' => 'success',
                'data' => $datatable,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve pengumuman: ' . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
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
            $this->pengumumanRepository->store($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create pengumuman: ' . $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred',
        ], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if (!$request->ajax()) {
            return view('backend.pengumuman.show', ['id' => $id]);
        }

        try {
            $data = $this->pengumumanRepository->show($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman retrieved successfully',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve pengumuman: ' . $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
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
            $this->pengumumanRepository->update($id, $request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update pengumuman: ' . $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred',
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->pengumumanRepository->destroy($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete pengumuman: ' . $e->getMessage(),
            ], 500);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred',
        ], 500);
    }
}
