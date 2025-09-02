<?php

namespace app\Http\Controllers\Backend\Dewanyayasan;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruStaff\AddGuruStaffRequest;
use App\Http\Requests\GuruStaff\UpdateGuruStaffRequest;
use App\Interfaces\DewanYayasan\PengasuhInterface;
use App\View\Components\ActionButton;
use App\View\Components\StatusPublish;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;

class PengasuhBackendController extends Controller
{
    protected $pengasuhRepo;

    public function __construct(PengasuhInterface $pengasuhRepo)
    {
        $this->pengasuhRepo = $pengasuhRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $pengasuh = $this->pengasuhRepo->showAll();

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
            $pengasuh = $this->pengasuhRepo->store($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Pengasuh berhasil dibuat',
                'data' => $pengasuh
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat pengasuh: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $pengasuh = $this->pengasuhRepo->show($id);
            if (!$pengasuh) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pengasuh tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => 'success',
                'data' => $pengasuh
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menampilkan pengasuh: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource.
     */
    public function update(UpdateGuruStaffRequest $request, $id)
    {
        try {
            $pengasuh = $this->pengasuhRepo->update($request->all(), $id);

            if (!$pengasuh) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pengasuh tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Pengasuh berhasil diperbarui',
                'data' => $pengasuh
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui pengasuh: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource.
     */
    public function destroy($id)
    {
        try {
            $pengasuh = $this->pengasuhRepo->destroy($id);
            if (!$pengasuh) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pengasuh tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Pengasuh berhasil dihapus'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus pengasuh: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
