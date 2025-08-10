<?php

namespace App\Repositories;

use App\Interfaces\AgendaInterface;
use App\Models\Agenda;

class AgendaRepository implements AgendaInterface 
{
    private $agenda;

    public function __construct(Agenda $agenda)
    {
        $this->agenda = $agenda;
    }

    public function create($data)
    {
        $storedData = [
            'nama' => $data->nama,
            'datetime' => $data->datetime,
            'alamat' => $data->alamat,
            'image' => storeImage($data->file('image'), '/uploads/agenda'),
            'is_publish' => $data->is_publish ?? false
        ];

        return $this->agenda->create($storedData);
    }

    public function update($id, $data)
    {
        $updatedData = $this->agenda->findOrFail($id);
        $updatedData->nama = $data->nama;
        $updatedData->datetime = $data->datetime;
        $updatedData->alamat = $data->alamat;
        $updatedData->image = ($data->file('image')) ? storeImage($data->file('image'), '/uploads/agenda') : $updatedData->image;
        $updatedData->is_publish = $data->is_publish ?? false;
        $updatedData->save();

        return $updatedData;
    }

    public function delete($id)
    {
        $data = $this->agenda->findOrFail($id);
        return $data->delete();
    }

    public function getById($id)
    {
        return $this->agenda->findOrFail($id);
    }

    public function get()
    {
        return $this->agenda->all();
    }
}