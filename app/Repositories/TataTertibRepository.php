<?php

namespace App\Repositories;

use App\Interfaces\TataTertibInterface;
use App\Models\TataTertib;

class TataTertibRepository implements TataTertibInterface
{
    public function getAll()
    {
        return TataTertib::all();
    }

    public function getById($id)
    {
        return TataTertib::find($id);
    }

    public function create(array $data)
    {
        return TataTertib::create($data);
    }

    public function update($id, array $data)
    {
        $tatib = TataTertib::find($id);
        if ($tatib) {
            $tatib->update($data);
            return $tatib;
        }
        return null;
    }

    public function delete($id)
    {
        $tatib = TataTertib::find($id);
        if ($tatib) {
            return $tatib->delete();
        }
        return false;
    }
}
