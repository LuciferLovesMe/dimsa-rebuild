<?php

namespace App\Interfaces\DewanYayasan;

interface PengasuhInterface
{

    public function store(array $data);
    public function update(array $data, int $id);
    public function show(int $id);
    public function showAll(int $perPage = 10);
    public function destroy(int $id);
}
