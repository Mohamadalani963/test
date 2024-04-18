<?php

namespace App\Http\Controllers\Api\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\SupportMessageRequests\CreateSupportMessageRequest;
use App\Http\Resources\UserResources\SupportMessageResource;
use App\Repos\SupportMessageRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportMessageController extends Controller
{
    private SupportMessageRepo $supportMessageRepo;
    public function __construct(SupportMessageRepo $supportMessageRepo)
    {
        $this->supportMessageRepo = $supportMessageRepo;
    }
    public function store(CreateSupportMessageRequest $createSupportMessageRequest){
        $data=  $createSupportMessageRequest->validated();
        $data['user_id'] = Auth::user()->id;
        return new SupportMessageResource($this->supportMessageRepo->store($data));

    }
}
