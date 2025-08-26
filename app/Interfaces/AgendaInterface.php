<?php

namespace App\Interfaces;

interface AgendaInterface
{
    public function create($data);

    public function update($id, $data);

    public function delete($id);

    public function getById($id);

    public function get($type = 'all');

    public function getLatest();
}
