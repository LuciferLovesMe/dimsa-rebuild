<?php

namespace App\Http\Controllers\API\Berita;

use App\Http\Controllers\Controller;
use App\Http\Requests\Berita\BeritaRequest;
use App\Interfaces\Berita\BeritaInterface;
use App\Traits\ImageHandler;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    use ImageHandler;

    protected $beritaRepo;

    public function __construct(BeritaInterface $beritaRepo)
    {
        $this->beritaRepo = $beritaRepo;
    }

    public function index()
    {
        $data = $this->beritaRepo->getAll();
        return apiSuccess($data, 'List berita');
    }

    public function show($slug)
    {
        $data = $this->beritaRepo->getBySlug($slug);

        if (!$data) {
            return apiFailed(null, 'Berita tidak ditemukan', 404);
        }

        return apiSuccess($data, 'Detail berita');
    }

    public function showById($id)
    {
        $data = $this->beritaRepo->getByID($id);

        if (!$data) {
            return apiFailed(null, 'Berita tidak ditemukan', 404);
        }

        return apiSuccess($data, 'Detail berita');
    }

    public function showLimit()
    {
        $data = $this->beritaRepo->getAllLimit();
        if (!$data) {
            return apiFailed(null, 'Berita tidak ditemukan', 404);
        }

        return apiSuccess($data, 'List Berita');
    }

    public function store(BeritaRequest $request)
    {
        DB::beginTransaction();
        try {
            $coverPath = null;

            if ($request->hasFile('cover')) {
                $coverPath = $this->processImage($request->file('cover'), 'Berita', 'Cover');
            }

            $this->beritaRepo->create([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'isi' => $request->isi,
                'tanggal' => $request->tanggal,
                'cover' => $coverPath ? '/storage/' . $coverPath : null,
                'is_publish' => $request->is_publish ?? 0,
                'id_kategori_berita' => $request->id_kategori_berita,
            ]);

            DB::commit();
            return apiSuccess(null, 'Berita berhasil dibuat');
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Gagal membuat berita", null, 500, $th->getMessage());
        }
    }

    public function update(BeritaRequest $request, $id)
    {
        DB::beginTransaction();
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

            DB::commit();
            return apiSuccess(null, 'Berita berhasil diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Gagal mengupdate berita", null, 500, $th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $berita = $this->beritaRepo->getByID($id); // kalau id, sebaiknya buat `getById` di repo

            $this->deleteImage($berita->cover);
            $this->deleteCKEditorImages($berita->isi);

            $berita->delete();

            DB::commit();
            return apiSuccess(null, 'Berita berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Gagal menghapus berita", null, 500, $th->getMessage());
        }
    }
}
