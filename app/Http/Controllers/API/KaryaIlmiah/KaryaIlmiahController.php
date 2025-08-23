<?php

namespace App\Http\Controllers\Api\KaryaIlmiah;

use App\Http\Controllers\Controller;
use App\Http\Requests\KaryaIlmiah\KaryaIlmiahRequest;
use App\Interfaces\KaryaIlmiahInterface;

class KaryaIlmiahController extends Controller
{
    private $karyaIlmiahRepo;

    public function __construct(KaryaIlmiahInterface $karyaIlmiahRepo)
    {
        $this->karyaIlmiahRepo = $karyaIlmiahRepo;
    }

    public function store(KaryaIlmiahRequest $request)
    {
        try {
            $this->karyaIlmiahRepo->store($request->validated() + [
                'image' => $request->file('image')
            ]);
            return apiSuccess(null, "Create Karya Ilmiah Successful");
        } catch (\Throwable $th) {
            return apiFailed("Error creating Karya Ilmiah", null, 500, $th->getMessage());
        }
    }

    public function update(KaryaIlmiahRequest $request, $id)
    {
        try {
            $this->karyaIlmiahRepo->update($id, $request->validated() + [
                'image' => $request->file('image')
            ]);
            return apiSuccess(null, "Update Karya Ilmiah Successful");
        } catch (\Throwable $th) {
            return apiFailed("Error updating Karya Ilmiah", null, 500, $th->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data = $this->karyaIlmiahRepo->show($id);
            return apiSuccess($data, "Show Karya Ilmiah Successful");
        } catch (\Throwable $th) {
            return apiFailed("Error fetching Karya Ilmiah", null, 500, $th->getMessage());
        }
    }

    public function showAll()
    {
        try {
            $data = $this->karyaIlmiahRepo->showAll();
            return apiSuccess($data, "Show All Karya Ilmiah Successful");
        } catch (\Throwable $th) {
            return apiFailed("Error fetching all Karya Ilmiah", null, 500, $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->karyaIlmiahRepo->destroy($id);
            return apiSuccess(null, "Delete Karya Ilmiah Successful");
        } catch (\Throwable $th) {
            return apiFailed("Error deleting Karya Ilmiah", null, 500, $th->getMessage());
        }
    }
}