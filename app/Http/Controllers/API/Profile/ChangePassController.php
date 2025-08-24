<?php

namespace App\Http\Controllers\API\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ChangePassRequest;
use App\Interfaces\Profile\ChangePassInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassController extends Controller
{
    protected $authRepository;

    public function __construct(ChangePassInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function update(ChangePassRequest $request)
    {
        try {
            $user = $this->authRepository->getById(Auth::id());

            if (!Hash::check($request->old_pass, $user->password)) {
                return apiFailed("Current password does not match", null, 422);
            }

            $this->authRepository->updatePassword($user->id, $request->new_pass);

            return apiSuccess(null, "Update password successful");
        } catch (\Throwable $th) {
            return apiFailed("Server error", null, 500, $th->getMessage());
        }
    }
}