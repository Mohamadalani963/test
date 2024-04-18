<?php

namespace App\Http\Controllers\Api\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequests\SupportMessageRequests\UpdateSupportMessage;
use App\Http\Resources\AdminResources\SupportMessageResource;
use App\Repos\SupportMessageRepo;
use Illuminate\Http\Request;

class SupportMessageController extends Controller
{
    private SupportMessageRepo $supportMessageRepo;
    public function __construct(SupportMessageRepo $supportMessageRepo)
    {
        $this->supportMessageRepo = $supportMessageRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return SupportMessageResource::collection($this->supportMessageRepo->index($request->all(),true,['user']));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,UpdateSupportMessage $updateSupportMessage)
    {
        //
        $this->supportMessageRepo->update($id,$updateSupportMessage->validated());
        return $this->success();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
        $this->supportMessageRepo->delete($id);
        return $this->success();
    }
}
