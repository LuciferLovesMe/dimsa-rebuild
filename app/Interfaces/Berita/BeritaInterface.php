<?php

namespace App\Interfaces\Berita;

interface BeritaInterface
{
    public function getAll(int $perPage = 10);
    public function getBySlug(string $slug);
    public function getByID($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getAllWithoutPaginate();
    public function getAllLimit();

}
