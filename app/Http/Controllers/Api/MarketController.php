<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Market\CreateMarketRequest;
use App\Http\Requests\Market\UpdateMarketRequest;
use App\Http\Resources\Market\MarketResource;
use App\Http\Resources\Market\ShowMarketResource;
use App\Repos\MarketRepo;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    private MarketRepo $marketRepo;

    public function __construct(MarketRepo $marketRepo)
    {
        $this->marketRepo = $marketRepo;
    }

    public function index(Request $request)
    {
        return MarketResource::collection($this->marketRepo->index(query: $request->all()))->additional(['status' => 'success']);
    }

    public function store(CreateMarketRequest $createMarketRequest)
    {
        $data = $createMarketRequest->validated();
        if (array_key_exists('contact_information', $data)) {
            $data['contact_information'] = json_decode($data['contact_information']);
        }

        return $this->success(
            $this->marketRepo->store($data)
        );
    }

    public function update($id, UpdateMarketRequest $updateMarketRequest)
    {
        $this->marketRepo->update($id, $updateMarketRequest->validated());

        return $this->success();
    }

    public function show($id)
    {
        return ['data'=>new ShowMarketResource($this->marketRepo->show($id)),'status'=>'success'];
    }

    public function delete($id)
    {
        $this->marketRepo->delete($id);

        return $this->success();
    }
}
