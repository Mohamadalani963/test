<?php

namespace App\Http\Controllers\Api\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\ContactUsRequests\CreateContactUsRequest;
use App\Http\Resources\UserResources\ContactUsResource;
use App\Repos\ContactUsRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    private ContactUsRepo $contactUsRepo;
    public function __construct(ContactUsRepo $contactUsRepo)
    {
        $this->contactUsRepo = $contactUsRepo;
    }
    public function store(CreateContactUsRequest $createContactUsRequest){
        $data=  $createContactUsRequest->validated();
        $data['user_id'] = Auth::user()->id;
        return new ContactUsResource($this->contactUsRepo->store($data));

    }
}
