<?php

namespace App\Http\Controllers\Api\Berita;

use App\Http\Controllers\Controller;
use App\Http\Requests\Berita\KategoriBeritaRequest;
use App\Interfaces\Berita\KategoriBeritaInterface;
use Illuminate\Support\Facades\DB;

class KategoriBeritaController extends Controller
{
    protected $kategoriRepo;

    public function __construct(KategoriBeritaInterface $kategoriRepo)
    {
        $this->kategoriRepo = $kategoriRepo;
    }

    public function store(KategoriBeritaRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->kategoriRepo->create([
                'nama_kategori' => $request->nama_kategori,
                'is_publish' => 0,
            ]);

            DB::commit();
            return apiSuccess(null, 'Create category successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Error create category", null, 500, $th->getMessage());
        }
    }

    public function update(KategoriBeritaRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->kategoriRepo->update($id, [
                'nama_kategori' => $request->nama_kategori,
            ]);

            DB::commit();
            return apiSuccess(null, 'Update category successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Error update category", null, 500, $th->getMessage());
        }
    }

    public function published($id)
    {
        DB::beginTransaction();
        try {
            $this->kategoriRepo->togglePublish($id);

            DB::commit();
            return apiSuccess(null, 'Toggle publish category successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Error toggle publish category", null, 500, $th->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $kategori = $this->kategoriRepo->getById($id);
            return apiSuccess($kategori, 'Show category successful');
        } catch (\Throwable $th) {
            return apiFailed("Category not found", null, 404, $th->getMessage());
        }
    }

    public function showAll()
    {
        try {
            $kategori = $this->kategoriRepo->getAll();
            return apiSuccess($kategori, 'Show all categories successful');
        } catch (\Throwable $th) {
            return apiFailed("Error show categories", null, 500, $th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->kategoriRepo->delete($id);

            DB::commit();
            return apiSuccess(null, 'Delete category successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Error delete category", null, 500, $th->getMessage());
        }
    }
}