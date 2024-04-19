<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Service\AuthService;

class AuthController extends Controller
{
    //
    private AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['type'] = 'guest';
        $data['ip'] = $request->ip();
        $response = $this->service->register($data);
        unset($response['user']);
        return $this->success(["data"=>$response]);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $data['ip'] = $request->ip();

        $response = $this->service->login($data);
        $response['user'] = new UserResource($response['user']);

        return $this->success($response);
    }
}
