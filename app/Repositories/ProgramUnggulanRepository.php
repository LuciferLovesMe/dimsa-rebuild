<?php

namespace App\Repositories;

use App\Interfaces\ProgramUnggulanInterface;
use App\Models\ProgramUnggulan;

class ProgramUnggulanRepository implements ProgramUnggulanInterface
{
    public function getAll(int $perPage = 10)
    {
        return ProgramUnggulan::orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getById($id)
    {
        return ProgramUnggulan::findOrFail($id);
    }

    public function create(array $data)
    {
        return ProgramUnggulan::create($data);
    }

    public function update($id, array $data)
    {
        $program = ProgramUnggulan::findOrFail($id);
        $program->update($data);
        return $program;
    }

    public function delete($id)
    {
        $program = ProgramUnggulan::findOrFail($id);
        return $program->delete();
    }
}