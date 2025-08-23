<?php

namespace App\Repositories\Profiles;

use App\Interfaces\Profile\ProfileInterface;
use App\Models\User;

class ProfileRepository implements ProfileInterface
{
    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }
}
