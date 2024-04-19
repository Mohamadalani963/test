<?php

namespace App\Http\Controllers\Api\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequests\ContactUsRequests\UpdateContactUsRequest;
use App\Http\Resources\AdminResources\ContactUsResource;
use App\Repos\ContactUsRepo;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    private ContactUsRepo $contactUsRepo;
    public function __construct(ContactUsRepo $contactUsRepo)
    {
        $this->contactUsRepo = $contactUsRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return ContactUsResource::collection($this->contactUsRepo->index($request->all(),true,['user']))->additional(['status' => 'success']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,UpdateContactUsRequest $updateContactUsRequest)
    {
        //
        $this->contactUsRepo->update($id,$updateContactUsRequest->validated());
        return $this->success();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
        $this->contactUsRepo->delete($id);
        return $this->success();
    }
}
