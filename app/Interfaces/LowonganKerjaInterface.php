<?php

namespace App\Interfaces;

use App\Models\LowonganKerja;

interface LowonganKerjaInterface
{
    public function getAll($type = 'all', $limit = null);

    public function getById(int $id): ?LowonganKerja;

    public function create($data): LowonganKerja;

    public function update(int $id, $data): LowonganKerja;

    public function delete(int $id): bool; 
}