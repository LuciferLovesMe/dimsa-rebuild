<?php

namespace App\Http\Controllers\API\DewanYayasan;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruStaff\AddGuruStaffRequest;
use App\Http\Requests\GuruStaff\UpdateGuruStaffRequest;
use App\Interfaces\DewanYayasan\PimpinanInterface;

class PimpinanController extends Controller
{
    private $pimpinanRepository;

    public function __construct(PimpinanInterface $pimpinanRepository)
    {
        $this->pimpinanRepository = $pimpinanRepository;
    }

    public function store(AddGuruStaffRequest $request)
    {
        try {
            $this->pimpinanRepository->store($request->all());
            return apiSuccess(null, "Create Pimpinan Successful");
        } catch (\Throwable $th) {
            return apiFailed("Error create data pimpinan", null, 500, $th->getMessage());
        }
    }

    public function update(UpdateGuruStaffRequest $request, $id)
    {
        try {
            $pimpinan = $this->pimpinanRepository->update($request->all(), $id);
            if (!$pimpinan) {
                return apiFailed("Pimpinan tidak ditemukan.", null, 404);
            }

            return apiSuccess(null, "Update Pimpinan Successful");
        } catch (\Throwable $th) {
            return apiFailed("Error update data pimpinan", null, 500, $th->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $pimpinan = $this->pimpinanRepository->show($id);

            if (!$pimpinan) {
                return apiFailed("Pimpinan tidak ditemukan.", null, 404);
            }

            return apiSuccess($pimpinan, "Show Pimpinan Successful");
        } catch (\Throwable $th) {
            return apiFailed("Error show data pimpinan", null, 500, $th->getMessage());
        }
    }



    public function showAll()
    {
        try {
            $data = $this->pimpinanRepository->showAll(10);
            return apiSuccess($data, "Show All Pimpinan Successful");
        } catch (\Throwable $th) {
            return apiFailed("Error show all pimpinan", null, 500, $th->getMessage());
        }
    }

        public function showIndexByID($id)
    {
        try {
            $pengasuh = $this->pimpinanRepository->showGuestByID($id);
            if (!$pengasuh) {
                return apiFailed("Pengasuh tidak ditemukan.", null, 404);
            }
            return apiSuccess($pengasuh, "Pengasuh retrieved successfully.");
        } catch (\Throwable $th) {
            return apiFailed("Failed to retrieve pengasuh.", null, 500, $th->getMessage());
        }
    }
  public function showIndex()
    {
        try {
            $pengasuh = $this->pimpinanRepository->showGuest();

            if (!$pengasuh || $pengasuh->isEmpty()) {
                return apiFailed("Pengasuh not found.", null, 404);
            }
            return apiSuccess($pengasuh, "All pengasuh retrieved successfully.");
        } catch (\Throwable $th) {
            return apiFailed("Failed to retrieve pengasuh list.", null, 500, $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pimpinan = $this->pimpinanRepository->destroy($id);
            if (!$pimpinan) {
                return apiFailed("Pimpinan tidak ditemukan.", null, 404);
            }
            return apiSuccess(null, "Delete Pimpinan Successful");
        } catch (\Throwable $th) {
            return apiFailed("Error delete data pimpinan", null, 500, $th->getMessage());
        }
    }
}
