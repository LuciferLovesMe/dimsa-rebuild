<?php

namespace App\Interfaces;

interface SlideshowInterface
{
    public function store(array $data);
    public function show($id);
    public function showAll();
    public function update(array $data);
    public function destroy($id);
}