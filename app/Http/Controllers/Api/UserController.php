<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserLocationRequest;
use App\Http\Resources\User\UserResource;
use App\Repos\DistrictRepo;
use App\Repos\UserRepo;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserRepo $userRepo;
    private DistrictRepo $districtRepo;

    public function __construct(UserRepo $userRepo,DistrictRepo $districtRepo)
    {
        $this->userRepo = $userRepo;
        $this->districtRepo = $districtRepo;
    }

    public function UpdateUserLocation(UpdateUserLocationRequest $updateUserLocationRequest)
    {
        $user = Auth::user();
        $data = $updateUserLocationRequest->validated();
        if(array_key_exists('district_id',$data)){
            $district = $this->districtRepo->show($data['district_id']);
            $data['lat'] = $district->lat;
            $data['lng'] = $district->lng;
        }
        $this->userRepo->update($user->id, $data);

        return $this->success();
    }

    public function show()
    {
        return new UserResource(Auth::user());
    }
}
