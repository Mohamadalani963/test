<?php

namespace App\Http\Controllers\Api\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\DeviceRequests\RefreshFcmTokenRequest;
use App\Repos\DeviceRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    //
    private DeviceRepo $deviceRepo;
    public function __construct(DeviceRepo $deviceRepo)
    {
        $this->deviceRepo = $deviceRepo;
    }
    public function refreshFcmToken(RefreshFcmTokenRequest $refreshFcmTokenRequest){
        $data = $refreshFcmTokenRequest->validated();
        $token_id = Auth::id();
        $devices = $this->deviceRepo->index(['token_id' => $token_id])->pluck('id');
        $this->deviceRepo->updateBulk($data,$devices);
        return $this->success();
    }
}
