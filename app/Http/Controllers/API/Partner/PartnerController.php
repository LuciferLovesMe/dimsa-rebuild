<?php

namespace App\Http\Controllers\API\Partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\AddPartnerRequest;
use App\Interfaces\PartnerInterface;
use App\Traits\ImageHandler;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    use ImageHandler;

    protected $partnerRepository;

    public function __construct(PartnerInterface $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
    }

    public function store(AddPartnerRequest $request)
    {
        DB::beginTransaction();
        try {
            $relative_path = null;
            if ($request->hasFile('logo')) {
                $relative_path = $this->processImage($request->file('logo'), 'Partners');
            }

            $this->partnerRepository->create([
                'nama_mitra' => $request->nama_mitra,
                'logo' => $relative_path ? '/storage/' . $relative_path : null,
                'is_publish' => $request->is_publish ?? 0,
            ]);

            DB::commit();
            return apiSuccess(null, 'Create partner successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Error create partner", null, 500, $th->getMessage());
        }
    }

    public function update(AddPartnerRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $partner = $this->partnerRepository->getById($id);

            if ($request->hasFile('logo')) {
                if ($partner->logo) {
                    $this->deleteImage($partner->logo);
                }
                $relative_path = $this->processImage($request->file('logo'), 'Partners');
                $partner->logo = '/storage/' . $relative_path;
            }

            $this->partnerRepository->update($id, [
                'nama_mitra' => $request->nama_mitra,
                'is_publish' => $request->is_publish ?? 0,
                'logo' => $partner->logo,
            ]);

            DB::commit();
            return apiSuccess(null, 'Update partner successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Error update partner", null, 500, $th->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $partner = $this->partnerRepository->getById($id);
            
            return apiSuccess($partner, 'Show partner successful');
        } catch (\Throwable $th) {
            return apiFailed("Error show partner", null, 500, $th->getMessage());
        }
    }

    public function showAll()
    {
        try {
            $partners = $this->partnerRepository->getAll();
            if ($partners->isEmpty()) {
                return apiSuccess([], 'No partners found');
            }
            return apiSuccess($partners, 'Show All partners successful');
        } catch (\Throwable $th) {
            return apiFailed("Error show partners", null, 500, $th->getMessage());
        }
    }

    public function showAllPublished()
    {
        try {
            $partners = $this->partnerRepository->getAllPublished();
            if (!$partners || $partners->isEmpty()) {
                return apiSuccess([], 'No published partners found');
            }
            return apiSuccess($partners, 'Show All published partners successful');
        } catch (\Throwable $th) {
            return apiFailed("Error show published partners", null, 500, $th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $partner = $this->partnerRepository->getById($id);
            if ($partner->logo) {
                $this->deleteImage($partner->logo);
            }

            $this->partnerRepository->delete($id);

            DB::commit();
            return apiSuccess(null, 'Delete partner successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Error delete partner", null, 500, $th->getMessage());
        }
    }
}