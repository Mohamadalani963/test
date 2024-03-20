<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserLocationRequest;
use App\Http\Resources\User\UserResource;
use App\Repos\UserRepo;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserRepo $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function UpdateUserLocation(UpdateUserLocationRequest $updateUserLocationRequest)
    {
        $user = Auth::user();
        $data = $updateUserLocationRequest->validated();
        $this->userRepo->update($user->id, $data);

        return $this->success();
    }

    public function show()
    {
        return new UserResource(Auth::user());
    }
}
