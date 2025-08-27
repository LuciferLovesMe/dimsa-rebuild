<?php

namespace App\Repositories;

use App\Interfaces\TestimoniInterface;
use App\Models\Testimoni;

class TestimoniRepository implements TestimoniInterface
{
    public function getAll($type = 'all', $limit = null)
    {
        if ($type === 'published') {
            $testimoni = Testimoni::with('alumni')->where('is_publish', true);
        } else {
            $testimoni = Testimoni::with('alumni');
        }

        if ($limit) {
            $testimoni->limit($limit);
        }

        return $testimoni
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getById($id)
    {
        return Testimoni::with('alumni')->find($id);
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

    public function getLatest()
    {
        return Testimoni::with('alumni')
            ->where('is_publish', true)
            ->orderBy('id', 'desc')
            ->first();
    }
}