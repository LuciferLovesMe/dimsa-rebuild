<?php

namespace App\Http\Controllers\API\TataTertib;

use App\Http\Controllers\Controller;
use App\Http\Requests\TataTertib\TatatertibRerquest;
use App\Interfaces\TataTertibInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TataTertibController extends Controller
{
    private $tatibRepo;


    public function __construct(TataTertibInterface $tatibRepo)
    {
        $this->tatibRepo = $tatibRepo;
    }

    public function store(TatatertibRerquest $request)
    {
        DB::beginTransaction();
        try {
            $data = [
                'link' => $request->link,
                'is_publish' => $request->is_publish ?? 0,
            ];

            $this->tatibRepo->create($data);

            DB::commit();

            return apiSuccess($data, "Tata tertib created successfull");
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Error create data ", null, 500, $th->getMessage());
        }
    }

    public function index()
    {
        try {

            $data = $this->tatibRepo->getAll();

            if (!$data || $data->isEmpty()) {
                return apiFailed("data not found", null, 404);
            }

            return apiSuccess($data,  "Tata tertib created successfull");
        } catch (\Throwable $th) {

            return apiFailed("Error show data ", null, 500, $th->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $data = $this->tatibRepo->getById($id);
            if (!$data) {
                return apiFailed("data not found", null, 404);
            }
            return apiSuccess($data, 'Show All  successful');
        } catch (\Throwable $th) {
            return apiFailed("Error show data ", null, 500, $th->getMessage());
        }
    }

    public function update($id, TatatertibRerquest $request)
    {
        DB::beginTransaction();
        try {
            $tatib = $this->tatibRepo->getById($id);
            $data = [
                'link' => $request->link,
                'is_publish' => $request->is_publish ?? 0,
            ];
            if (!$tatib) {
                return apiFailed("data not found", null, 404);
            }
            $this->tatibRepo->update($id, $data);

            DB::commit();
            return apiSuccess(null, 'update successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Error update data ", null, 500, $th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $tatib = $this->tatibRepo->getById($id);
            if (!$tatib) {
                return apiFailed("data not found", null, 404);
            }
            $this->tatibRepo->delete($id);
            DB::commit();
            return apiSuccess(null, "Delete Tatib Successful");
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Error delete data ", null, 500, $th->getMessage());
        }
    }
}
