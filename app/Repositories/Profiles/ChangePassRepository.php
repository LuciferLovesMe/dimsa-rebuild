<?php

namespace App\Repositories\Profiles;

use App\Interfaces\Profile\ChangePassInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePassRepository implements ChangePassInterface
{
    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function updatePassword($id, string $newPassword)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make($newPassword);
        $user->save();
        return $user;
    }
}