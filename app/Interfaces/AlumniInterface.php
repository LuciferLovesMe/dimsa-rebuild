<?php

namespace App\Interfaces;

interface AlumniInterface
{
    public function index($limit = null, $search = null);

    public function show($id);

    public function store($data);

    public function update($id, $data);

    public function destroy($id);
}
