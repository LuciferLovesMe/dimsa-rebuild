<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Interfaces\Profile\ProfileInterface;
use App\Traits\ImageHandler;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use ImageHandler;

    protected $profileRepository;

    public function __construct(ProfileInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function update(ProfileUpdateRequest $request)
    {
        try {
            $user = $this->profileRepository->getById(Auth::id());

            if ($request->hasFile('image')) {
                if ($user->image) {
                    $this->deleteImage($user->image);
                }
                $relative_path = $this->processImage($request->file('image'), 'Profiles');
                $user->image = '/storage/' . $relative_path;
            }

            $this->profileRepository->update($user->id, [
                'name' => $request->name,
                'email' => $request->email,
                'image' => $user->image,
            ]);

            return apiSuccess(null, "Update profile successful");
        } catch (\Throwable $th) {
            return apiFailed('Update profile failed', null, 500, $th->getMessage());
        }
    }

    public function show()
    {
        try {
            $user = $this->profileRepository->getById(Auth::id());
            return apiSuccess($user, "Show data profile successful");
        } catch (\Throwable $th) {
            return apiFailed('Show profile failed', null, 500, $th->getMessage());
        }
    }
}