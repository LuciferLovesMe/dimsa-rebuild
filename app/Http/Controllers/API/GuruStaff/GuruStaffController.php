<?php

namespace App\Http\Controllers\API\GuruStaff;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruStaff\AddGuruStaffRequest;
use App\Http\Requests\GuruStaff\UpdateGuruStaffRequest;
use App\Interfaces\GuruStaffInterface;


class GuruStaffController extends Controller
{
    private GuruStaffInterface $guruStaffRepository;

    public function __construct(GuruStaffInterface $guruStaffRepository)
    {
        $this->guruStaffRepository = $guruStaffRepository;
    }

    public function store(AddGuruStaffRequest $request)
    {
        try {
            $this->guruStaffRepository->store($request->all(), $request->file('image'));
            return apiSuccess(null, "Create Guru Staff Successful");
        } catch (\Throwable $th) {
            return apiFailed("Error create data Guru Staff", null, 500, $th->getMessage());
        }
    }

    public function update(UpdateGuruStaffRequest $request, $id)
    {
        try {
            $guru_staff = $this->guruStaffRepository->update($id, $request->all(), $request->file('image'));
            if (!$guru_staff) {
                return apiFailed("Guru Staff tidak ditemukan.", null, 404);
            }

            return apiSuccess(null, "Update Guru Staff Successful");
        } catch (\Throwable $th) {
            return apiFailed("Error update data Guru Staff", null, 500, $th->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $guru_staff = $this->guruStaffRepository->show($id);
            if (!$guru_staff) {
                return apiFailed("Guru Staff tidak ditemukan.", null, 404);
            }

            return apiSuccess($guru_staff, "Show Guru Staff successful");
        } catch (\Throwable $th) {
            return apiFailed("Error fetching Guru Staff detail", null, 500, $th->getMessage());
        }
    }

    public function showAll()
    {
        try {
            $data = $this->guruStaffRepository->showAll();
            return apiSuccess($data, "Show Guru Staff successful");
        } catch (\Throwable $th) {
            return apiFailed("Error fetching Guru Staff list", null, 500, $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $guru_staff = $this->guruStaffRepository->destroy($id);
            if (!$guru_staff) {
                return apiFailed("Guru Staff tidak ditemukan.", null, 404);
            }
            return apiSuccess(null, "Delete Guru Staff Successful");
        } catch (\Throwable $th) {
            return apiFailed("Error delete data Guru Staff", null, 500, $th->getMessage());
        }
    }
}
