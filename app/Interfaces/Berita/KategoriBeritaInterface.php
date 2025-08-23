<?php

namespace App\Interfaces\Berita;

interface KategoriBeritaInterface
{
    public function create(array $data);
    public function update($id, array $data);
    public function togglePublish($id);
    public function getById($id);
    public function getAll(int $perPage = 10);
    public function delete($id);
}