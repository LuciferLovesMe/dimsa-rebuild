<?php

namespace App\Interfaces;

interface PartnerInterface
{
    public function getAll();
    public function getAllPublished();
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}