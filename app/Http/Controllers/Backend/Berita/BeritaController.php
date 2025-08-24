<?php

namespace App\Http\Controllers\Backend\Berita;

use App\Http\Controllers\Controller;
use App\Http\Requests\Berita\BeritaRequest;
use App\Interfaces\Berita\BeritaInterface;
use App\Traits\ImageHandler;
use App\View\Components\ActionButton;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BeritaController extends Controller
{
    use ImageHandler;

    protected $beritaRepo;

    public function __construct(BeritaInterface $beritaRepo)
    {
        $this->beritaRepo = $beritaRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    try {
        $perPage = $request->input('per_page', 10);
        $berita = $this->beritaRepo->getAll($perPage);

        $datatable = datatables()
            ->of($berita)
            ->addIndexColumn() // No
            ->addColumn('thumbnail', function ($item) {
               
                $cover = asset($item->cover);
                return '<img src="'.$cover.'" alt="Thumbnail" style="width:80px; height:50px; object-fit:cover">';
            })
            ->addColumn('judul', fn($item) => $item->judul)
            ->addColumn('tanggal', fn($item) => $item->tanggal->format('d-m-Y'))
            ->addColumn('penulis', fn($item) => $item->penulis)
            ->addColumn('status', fn($item) => $item->is_publish ? 'Published' : 'Draft')
            ->addColumn('aksi', function ($item) {
                $actionButton = new ActionButton(
                   '#', '#', '#'
                );
                return $actionButton->render()->with($actionButton->data());
            })
            ->rawColumns(['thumbnail','aksi'])
            ->make(true);

        return response()->json([
            'status' => 'success',
            'data' => $datatable
        ], Response::HTTP_OK);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to retrieve berita: ' . $e->getMessage()
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}


    public function store(BeritaRequest $request)
    {
        try {
            $coverPath = null;

            if ($request->hasFile('cover')) {
                $coverPath = $this->processImage($request->file('cover'), 'Berita', 'Cover');
            }

            $berita = $this->beritaRepo->create([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'isi' => $request->isi,
                'tanggal' => $request->tanggal,
                'cover' => $coverPath ? '/storage/' . $coverPath : null,
                'is_publish' => $request->is_publish ?? 0,
                'id_kategori_berita' => $request->id_kategori_berita,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Berita berhasil dibuat',
                'data' => $berita
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat berita: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $berita = $this->beritaRepo->getByID($id);
            return response()->json([
                'status' => 'success',
                'data' => $berita
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Berita tidak ditemukan: ' . $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }


    public function update(BeritaRequest $request, $id)
    {
        try {
            $berita = $this->beritaRepo->update($id, [
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'isi' => $request->isi,
                'tanggal' => $request->tanggal,
                'is_publish' => $request->is_publish ?? 0,
                'id_kategori_berita' => $request->id_kategori_berita,
            ]);

            if ($request->hasFile('cover')) {
                $this->deleteImage($berita->cover);
                $coverPath = $this->processImage($request->file('cover'), 'Berita', 'Cover');
                $berita->cover = '/storage/' . $coverPath;
                $berita->save();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Berita berhasil diupdate',
                'data' => $berita
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengupdate berita: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $berita = $this->beritaRepo->delete($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Berita berhasil dihapus'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus berita: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
