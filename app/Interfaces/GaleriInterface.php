<?php
namespace App\Interfaces;


interface GaleriInterface
{
    public function index($type = 'image');

    public function store($request, $type = 'image');

    public function show($id, $type = 'image');

    public function update($request, $id, $type = 'image');

    public function destroy($id);

}