<?php

namespace App\Interfaces;

interface KaryaIlmiahInterface
{
    public function store(array $data);
    public function update(int $id, array $data);
    public function show(int $id);
    public function showAll();
    public function destroy(int $id);
}
