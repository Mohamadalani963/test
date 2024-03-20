<?php

namespace App\Service;

use App\Exceptions\Errors;
use App\Models\Role;
use App\Repos\DeviceRepo;
use App\Repos\UserRepo;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    private UserRepo $userRepo;

    private DeviceRepo $deviceRepo;

    public function __construct(UserRepo $userRepo, DeviceRepo $deviceRepo)
    {
        $this->userRepo = $userRepo;
        $this->deviceRepo = $deviceRepo;
    }

    public function register($data)
    {
        $role = Role::where('name', 'guest')->first();
        $abilities = $role->abilities;
        $data['abilities'] = $abilities;
        $user = $this->userRepo->store($data);
        $abilities_name = $abilities->pluck('name')->toArray();
        $token = $user->createToken($user->username ?? 'test', $abilities_name);
        $this->deviceRepo->store(['token_id' => $token->accessToken->id, 'user_id' => $user->id, 'ip' => $data['ip'], 'fcm_token' => array_key_exists('fcm_token', $data) ? $data['fcm_token'] : null]);

        return [
            'token' => $token->plainTextToken,
            'user' => $user,
            'abilities' => $abilities_name,
        ];
    }

    public function login($data)
    {
        $username = $data['username'];
        $user = $this->userRepo->index(query: ['username' => $username], paginated: false, relations: ['abilities'])->first();
        if (! $user) {
            Errors::ResourceNotFound(systemMessage: "User with username $username is trying to login with username that is not exists");
        }
        if (! Hash::check($data['password'], $user->password)) {
            Errors::InvalidCredentials();
        }

        $abilities = $user->abilities->pluck('name')->toArray();
        $token = $user->createToken($user->username, $abilities);
        $this->deviceRepo->store(['token_id' => $token->accessToken->id, 'user_id' => $user->id, 'ip' => $data['ip'], 'fcm_token' => array_key_exists('fcm_token', $data) ? $data['fcm_token'] : null]);

        return [
            'token' => $token->plainTextToken,
            'user' => $user,
            'verified' => true,
            'abilities' => $abilities,
        ];
    }
}
