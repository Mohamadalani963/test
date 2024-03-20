<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\District\CreateDistrictRequest;
use App\Http\Requests\District\UpdateDistrictRequest;
use App\Http\Resources\District\DistrictResource;
use App\Http\Resources\District\ShowDistrictResource;
use App\Repos\DistrictRepo;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    private DistrictRepo $districtRepo;

    public function __construct(DistrictRepo $districtRepo)
    {
        $this->districtRepo = $districtRepo;
    }

    public function index(Request $request)
    {
        return DistrictResource::collection($this->districtRepo->index(query: $request->all()));
    }

    public function store(CreateDistrictRequest $createDistrictRequest)
    {
        return $this->success($this->districtRepo->store($createDistrictRequest->validated())->toArray());
    }

    public function update($id, UpdateDistrictRequest $updateDestrictRequest)
    {
        $this->districtRepo->update($id, $updateDestrictRequest->validated());

        return $this->success();
    }

    public function show($id)
    {
        return new ShowDistrictResource($this->districtRepo->show($id));
    }

    public function delete($id)
    {
        $this->districtRepo->delete($id);

        return $this->success();
    }
}
