<?php

namespace App\Http\Controllers\API\DewanYayasan;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruStaff\AddGuruStaffRequest;
use App\Http\Requests\GuruStaff\UpdateGuruStaffRequest;
use App\Interfaces\DewanYayasan\PengasuhInterface;


class PengasuhController extends Controller
{
    private $pengasuhRepo;

    public function __construct(PengasuhInterface $pengasuhRepo)
    {
        $this->pengasuhRepo = $pengasuhRepo;
    }

    public function store(AddGuruStaffRequest $request)
    {
        try {
            $this->pengasuhRepo->store($request->all());
            return apiSuccess(null, "Pengasuh created successfully.");
        } catch (\Throwable $th) {
            return apiFailed("Failed to create pengasuh.", null, 500, $th->getMessage());
        }
    }

    public function update(UpdateGuruStaffRequest $request, $id)
    {
        try {
            $pengasuh = $this->pengasuhRepo->update($request->all(), $id);

            if (!$pengasuh) {
                return apiFailed("Pengasuh tidak ditemukan.", null, 404);
            }

            return apiSuccess($pengasuh, "Pengasuh updated successfully.");
        } catch (\Throwable $th) {
            return apiFailed("Failed to update pengasuh.", null, 500, $th->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $pengasuh = $this->pengasuhRepo->show($id);
            if (!$pengasuh) {
                return apiFailed("Pengasuh tidak ditemukan.", null, 404);
            }

            return apiSuccess($pengasuh, "Pengasuh retrieved successfully.");
        } catch (\Throwable $th) {
            return apiFailed("Failed to retrieve pengasuh.", null, 500, $th->getMessage());
        }
    }

    public function showAll()
    {
        try {
            $pengasuh = $this->pengasuhRepo->showAll();
            return apiSuccess($pengasuh, "All pengasuh retrieved successfully.");
        } catch (\Throwable $th) {
            return apiFailed("Failed to retrieve pengasuh list.", null, 500, $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pengasuh = $this->pengasuhRepo->destroy($id);
            if (!$pengasuh) {
                return apiFailed("Pengasuh tidak ditemukan.", null, 404);
            }

            return apiSuccess(null, "Pengasuh deleted successfully.");
        } catch (\Throwable $th) {
            return apiFailed("Failed to delete pengasuh.", null, 500, $th->getMessage());
        }
    }
}
