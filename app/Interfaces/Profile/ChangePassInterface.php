<?php

namespace App\Interfaces\Profile;

interface ChangePassInterface
{
    public function getById($id);
    public function updatePassword($id, string $newPassword);
}
