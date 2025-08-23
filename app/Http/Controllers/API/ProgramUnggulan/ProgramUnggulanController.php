<?php

namespace App\Http\Controllers\Api\ProgramUnggulan;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramUnggulan\ProgramUnggulanRequest;
use App\Interfaces\ProgramUnggulanInterface;
use App\Traits\ImageHandler;
use Illuminate\Support\Facades\DB;

class ProgramUnggulanController extends Controller
{
    use ImageHandler;

    protected $programRepo;

    public function __construct(ProgramUnggulanInterface $programRepo)
    {
        $this->programRepo = $programRepo;
    }

    public function store(ProgramUnggulanRequest $request)
    {
        DB::beginTransaction();
        try {
            $relative_path = null;

            if ($request->hasFile('image')) {
                $relative_path = $this->processImage($request->file('image'), 'ProgramUnggulans');
            }

            $this->programRepo->create([
                'nama_program' => $request->nama_program,
                'deskripsi' => $request->deskripsi,
                'image' => $relative_path ? '/storage/' . $relative_path : null,
                'url' => $request->url,
                'is_publish' => $request->is_publish ?? 0,
            ]);

            DB::commit();
            return apiSuccess(null, 'Create Program Unggulan Successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Error create data Program Unggulan", null, 500, $th->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $program = $this->programRepo->getById($id);
            return apiSuccess($program, 'Show program unggulan successful');
        } catch (\Throwable $th) {
            return apiFailed("Error show data Program Unggulan", null, 500, $th->getMessage());
        }
    }

    public function showAll()
    {
        try {
            $programs = $this->programRepo->getAll();
            return apiSuccess($programs, 'Show All program unggulan successful');
        } catch (\Throwable $th) {
            return apiFailed("Error show all data Program Unggulan", null, 500, $th->getMessage());
        }
    }

    public function update(ProgramUnggulanRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $program = $this->programRepo->getById($id);

            $data = [
                'nama_program' => $request->nama_program,
                'deskripsi' => $request->deskripsi,
                'url' => $request->url,
                'is_publish' => $request->is_publish ?? 0,
            ];

            if ($request->hasFile('image')) {
                if ($program->image) {
                    $this->deleteImage($program->image);
                }
                $relative_path = $this->processImage($request->file('image'), 'ProgramUnggulans');
                $data['image'] = '/storage/' . $relative_path;
            }

            $this->programRepo->update($id, $data);

            DB::commit();
            return apiSuccess(null, 'Update Program Unggulan Successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Error Update data Program Unggulan", null, 500, $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $program = $this->programRepo->getById($id);

            if ($program->image) {
                $this->deleteImage($program->image);
            }

            $program->delete();

            DB::commit();
            return apiSuccess(null, "Delete Program Unggulan Successful");
        } catch (\Throwable $th) {
            DB::rollBack();
            return apiFailed("Error delete data Program Unggulan", null, 500, $th->getMessage());
        }
    }
}
