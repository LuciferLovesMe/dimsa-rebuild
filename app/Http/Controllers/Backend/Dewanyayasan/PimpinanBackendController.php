<?php

namespace App\Http\Controllers\Backend\DewanYayasan;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruStaff\AddGuruStaffRequest;
use App\Http\Requests\GuruStaff\UpdateGuruStaffRequest;
use App\Interfaces\DewanYayasan\PimpinanInterface;
use App\View\Components\ActionButton;
use App\View\Components\StatusPublish;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;

class PimpinanBackendController extends Controller
{
    protected $PimpinanRepo;

    public function __construct(PimpinanInterface $PimpinanRepo)
    {
        $this->PimpinanRepo = $PimpinanRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $pengasuh = $this->PimpinanRepo->showAll();

            $datatable = datatables()
                ->of($pengasuh)
                ->addIndexColumn() // No
                ->addColumn('image', function ($item) {
                    $img = $item->image;
                    return '<img src="' . $img . '" alt="' . $item->nama . '">';
                })
                ->addColumn('nama', fn($item) => $item->nama)
                ->addColumn('jabatan', fn($item) => $item->jabatan)
                ->addColumn('status', function ($item) {
                    $statusBadge = new StatusPublish($item->status);
                    return $statusBadge->render()->with($statusBadge->data());
                })
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton(
                        '#',
                        '#',
                        '#',
                    );
                    return $actionButton->render()->with($actionButton->data());
                })
                ->rawColumns(['image', 'status', 'aksi'])
                ->make(true);

            return response()->json([
                'status' => 'success',
                'data' => $datatable
            ], Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database query error: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve pengasuh: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Store a newly created resource.
     */
    public function store(AddGuruStaffRequest $request)
    {
        try {
            $Pimpinan = $this->PimpinanRepo->store($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Pimpinan berhasil dibuat',
                'data' => $Pimpinan
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat Pimpinan: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $Pimpinan = $this->PimpinanRepo->show($id);
            if (!$Pimpinan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pimpinan tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => 'success',
                'data' => $Pimpinan
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menampilkan Pimpinan: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource.
     */
    public function update(UpdateGuruStaffRequest $request, $id)
    {
        try {
            $Pimpinan = $this->PimpinanRepo->update($request->all(), $id);

            if (!$Pimpinan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pimpinan tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Pimpinan berhasil diperbarui',
                'data' => $Pimpinan
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui Pimpinan: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource.
     */
    public function destroy($id)
    {
        try {
            $Pimpinan = $this->PimpinanRepo->destroy($id);
            if (!$Pimpinan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pimpinan tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Pimpinan berhasil dihapus'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus Pimpinan: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
