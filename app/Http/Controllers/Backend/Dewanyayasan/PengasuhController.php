<?php

namespace App\Http\Controllers\Backend\DewanYayasan;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruStaff\AddGuruStaffRequest;
use App\Http\Requests\GuruStaff\UpdateGuruStaffRequest;
use App\Interfaces\DewanYayasan\PengasuhInterface;
use App\View\Components\ActionButton;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;

class PengasuhController extends Controller
{
    protected $pengasuhRepo;

    public function __construct(PengasuhInterface $pengasuhRepo)
    {
        $this->pengasuhRepo = $pengasuhRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Bisa untuk paginasi
            $pengasuh = $this->pengasuhRepo->showAll($perPage);

            $datatable = datatables()
                ->of($pengasuh)
                ->addIndexColumn() // No
                ->addColumn('thumbnail', function ($item) {
                    $img = $item->image ? asset($item->image) : asset('images/default-thumbnail.png');
                    return '<img src="'.$img.'" alt="Thumbnail" style="width:80px; height:50px; object-fit:cover">';
                })
                ->addColumn('nama', fn($item) => $item->nama)
                ->addColumn('jabatan', fn($item) => $item->jabatan)
                ->addColumn('status', fn($item) => $item->is_publish ? 'Published' : 'Draft')
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton(
                       '#', '#', '#',
                    );
                    return $actionButton->render()->with($actionButton->data());
                })
                ->rawColumns(['thumbnail','aksi'])
                ->make(true);

            return response()->json([
                'status' => 'success',
                'data' => $datatable
            ], Response::HTTP_OK);

        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database query error: '.$e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve pengasuh: '.$e->getMessage()
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
                'message' => 'Gagal membuat pengasuh: '.$e->getMessage()
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
                'message' => 'Gagal menampilkan pengasuh: '.$e->getMessage()
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
                'message' => 'Gagal memperbarui pengasuh: '.$e->getMessage()
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
                'message' => 'Gagal menghapus pengasuh: '.$e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
