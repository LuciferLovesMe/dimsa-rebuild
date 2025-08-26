<?php

namespace App\Interfaces;

interface PublikasiInterface
{
    public function createMajalah($data);

    public function updateMajalah($id, $data);

    public function deleteMajalah($id);

    public function getMajalahById($id);

    public function getMajalah($type = 'all', $limit = null);
}
