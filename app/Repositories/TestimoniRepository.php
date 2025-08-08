<?php

namespace App\Repositories;

use App\Interfaces\TestimoniInterface;
use App\Models\Testimoni;

class TestimoniRepository implements TestimoniInterface
{
    public function getAll()
    {
        return Testimoni::all();
    }

    public function getById($id)
    {
        return Testimoni::find($id);
    }

    public function create($data)
    {
        return Testimoni::create($data);
    }

    public function update($id, $data)
    {
        $testimoni = Testimoni::find($id);
        if ($testimoni) {
            $testimoni->update($data);
            return $testimoni;
        }
        return null;
    }

    public function delete($id)
    {
        $testimoni = Testimoni::find($id);
        if ($testimoni) {
            $testimoni->delete();
            return true;
        }
        return false;
    }
}