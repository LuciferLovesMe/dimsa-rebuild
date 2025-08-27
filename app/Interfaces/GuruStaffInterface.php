<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface GuruStaffInterface
{
    public function store(array $data, $image = null);
    public function update(int $id, array $data, $image = null);
    public function show(int $id);
    public function showAll(int $perPage = 10);
    public function destroy(int $id);
    public function showGuest();
    public function showGuestByID($id);
}
