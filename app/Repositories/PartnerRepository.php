<?php

namespace App\Repositories;

use App\Interfaces\PartnerInterface;
use App\Models\Partner;

class PartnerRepository implements PartnerInterface
{
    public function getAll()
    {
        return Partner::all();
    }
    public function getAllPublished()
    {
        return Partner::where('is_publish', 1)->get();
    }

    public function getById($id)
    {
        return Partner::findOrFail($id);
    }

    public function create(array $data)
    {
        return Partner::create($data);
    }

    public function update($id, array $data)
    {
        $partner = Partner::findOrFail($id);
        $partner->update($data);
        return $partner;
    }

    public function delete($id)
    {
        $partner = Partner::findOrFail($id);
        return $partner->delete();
    }
}