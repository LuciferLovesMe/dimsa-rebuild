<?php
namespace App\Interfaces;


interface PengumumanInterface
{
    public function index($type = 'all', $limit = null);

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);

}