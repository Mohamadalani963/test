<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\CreateBranchRequest;
use App\Http\Requests\Branch\UpdateBranchRequest;
use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\Branch\ShowBranchResource;
use App\Repos\BranchRepo;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    private BranchRepo $branchRepo;

    public function __construct(BranchRepo $branchRepo)
    {
        $this->branchRepo = $branchRepo;
    }

    public function index(Request $request)
    {
        return BranchResource::collection($this->branchRepo->index(query: $request->all()))->additional(['status' => 'success']);
    }

    public function store(CreateBranchRequest $createBranchRequest)
    {
        $data = $createBranchRequest->validated();
        if (array_key_exists('contact_information', $data)) {
            $data['contact_information'] = json_decode($data['contact_information']);
        }

        return $this->success(
            $this->branchRepo->store($data)->toArray()
        );
    }

    public function update($id, UpdateBranchRequest $updateBranchRequest)
    {
        $this->branchRepo->update($id, $updateBranchRequest->validated());

        return $this->success();
    }

    public function show($id)
    {
        return ['data' => new ShowBranchResource($this->branchRepo->show($id)),'status'=>'success'];
    }

    public function delete($id)
    {
        $this->branchRepo->delete($id);

        return $this->success();
    }
}
