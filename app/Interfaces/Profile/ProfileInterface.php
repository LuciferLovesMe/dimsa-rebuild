<?php

namespace App\Interfaces\Profile;

interface ProfileInterface
{
    public function getById($id);
    public function update($id, array $data);
}