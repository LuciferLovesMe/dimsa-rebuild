<?php

namespace App\Repositories;

use App\Interfaces\EkstrakulikulerInterface;
use App\Models\Ekstrakulikuler;

class EkstrakulikulerRepository implements EkstrakulikulerInterface
{
    private $ekstrakulikuler;

    public function __construct(Ekstrakulikuler $ekstrakulikuler)
    {
        $this->ekstrakulikuler = $ekstrakulikuler;
    }

    public function getAll()
    {
        return $this->ekstrakulikuler;
    }

    public function getById($id)
    {
        return $this->ekstrakulikuler->find($id);
    }

    public function store($data)
    {
        $storedData = [
            'judul' => $data->judul,
            'link' => $data->link,
            'image' => storeImage($data->file('image'), '/uploads/ekstrakulikuler/'),
            'is_publish' => $data->is_publish ?? false,
        ];

        $this->ekstrakulikuler->create($storedData);
        return $storedData;
    }

    public function update($id, $data)
    {
        $updatedData = $this->ekstrakulikuler->findOrFail($id);
        $updatedData->judul = $data->judul;
        $updatedData->link = $data->link;
        $updatedData->is_publish = $data->is_publish ?? false;
        
        if ($data->file('image')) {
            $updatedData->image = storeImage($data->file('image'), '/uploads/ekstrakulikuler/');
        }

        $updatedData->save();
        return $updatedData;
    }

    public function delete($id)
    {
        $deletedData = $this->ekstrakulikuler->findOrFail($id);
        $deletedData->delete();
    }
}