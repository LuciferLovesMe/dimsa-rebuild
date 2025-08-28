<?php

namespace App\Http\Controllers\Backend\Berita;

use App\Http\Controllers\Controller;
use App\Http\Requests\Berita\KategoriBeritaRequest;
use App\Interfaces\Berita\KategoriBeritaInterface;
use App\View\Components\ActionButton;
use App\View\Components\StatusPublish;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KategoriBeritaController extends Controller
{
    protected $kategoriRepo;

    public function __construct(KategoriBeritaInterface $kategoriRepo)
    {
        $this->kategoriRepo = $kategoriRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $kategori = $this->kategoriRepo->getAllWithoutPaginate();

            $datatable = datatables()
                ->of($kategori)
                ->addColumn('nama_kategori', fn($item) => $item->nama_kategori)
                ->addColumn('status', function ($item) {
                    $statusBadge = new StatusPublish($item->status);
                    return $statusBadge->render()->with($statusBadge->data());
                })
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton(
                        '#',
                        '#',
                        '#'
                    );
                    return $actionButton->render()->with($actionButton->data());
                })
                ->addIndexColumn()
                ->rawColumns(['status', 'aksi'])
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
                'message' => 'Failed to retrieve categories: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(KategoriBeritaRequest $request)
    {
        try {
            $kategori = $this->kategoriRepo->create([
                'nama_kategori' => $request->nama_kategori,
                'is_publish' => $request->input('is_publish', 0),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori berhasil dibuat',
                'data' => $kategori
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat kategori: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(KategoriBeritaRequest $request, $id)
    {
        try {
            $kategori = $this->kategoriRepo->update($id, [
                'nama_kategori' => $request->nama_kategori,
                'is_publish' => $request->input('is_publish', 0),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori berhasil diperbarui',
                'data' => $kategori
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui kategori: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function togglePublish($id)
    {
        try {
            $kategori = $this->kategoriRepo->togglePublish($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Status publish kategori berhasil diubah',
                'data' => $kategori
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengubah status publish: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $this->kategoriRepo->delete($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori berhasil dihapus'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus kategori: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
