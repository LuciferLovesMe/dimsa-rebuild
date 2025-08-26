<?php

namespace App\Http\Controllers\Backend\DewanYayasan;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruStaff\AddGuruStaffRequest;
use App\Http\Requests\GuruStaff\UpdateGuruStaffRequest;
use App\Interfaces\GuruStaffInterface;
use App\View\Components\ActionButton;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;

class GuruStaffController extends Controller
{
    protected $guruStaffRepo;

    public function __construct(GuruStaffInterface $guruStaffRepo)
    {
        $this->guruStaffRepo = $guruStaffRepo;
    }

    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); 
            $guruStaff = $this->guruStaffRepo->showAll($perPage);

            $datatable = datatables()
                ->of($guruStaff)
                ->addIndexColumn()
                ->addColumn('thumbnail', function ($item) {
                    $img = $item->image ? asset($item->image) : asset('images/default-thumbnail.png');
                    return '<img src="'.$img.'" alt="Thumbnail" style="width:80px; height:50px; object-fit:cover">';
                })
                ->addColumn('nama', fn($item) => $item->nama)
                ->addColumn('jabatan', fn($item) => $item->jabatan)
                ->addColumn('status', fn($item) => $item->is_publish ? 'Published' : 'Draft')
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton('#', '#', '#');
                    return $actionButton->render();
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
                'message' => 'Failed to retrieve GuruStaff: '.$e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(AddGuruStaffRequest $request)
    {
        try {
            $guruStaff = $this->guruStaffRepo->store($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'GuruStaff berhasil dibuat',
                'data' => $guruStaff
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat GuruStaff: '.$e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $guruStaff = $this->guruStaffRepo->show($id);

            if (!$guruStaff) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'GuruStaff tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => 'success',
                'data' => $guruStaff
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menampilkan GuruStaff: '.$e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateGuruStaffRequest $request, $id)
    {
        try {
            $guruStaff = $this->guruStaffRepo->update($id, $request->all());

            if (!$guruStaff) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'GuruStaff tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'GuruStaff berhasil diperbarui',
                'data' => $guruStaff
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui GuruStaff: '.$e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->guruStaffRepo->destroy($id);

            if (!$deleted) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'GuruStaff tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'GuruStaff berhasil dihapus'
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus GuruStaff: '.$e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
