<?php

namespace App\Interfaces;

interface ProgramUnggulanInterface
{
    public function getAll(int $perPage = 10);
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getPublished();
    public function getGuestById($id);
}
