<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\AttachBranchRequest;
use App\Http\Requests\Offer\CreateOfferRequest;
use App\Http\Requests\Offer\DetachBranchRequest;
use App\Http\Requests\Offer\UpdateOfferRequest;
use App\Http\Resources\Offer\OfferResource;
use App\Http\Resources\Offer\ShowOfferResource;
use App\Repos\OfferRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    private OfferRepo $offerRepo;

    public function __construct(OfferRepo $offerRepo)
    {
        $this->offerRepo = $offerRepo;
    }

    public function index(Request $request)
    {
        $filters = $request->all();
        if (array_key_exists('orderByMarketLocation', $filters)) {
            $user = Auth::user();
            if (!($user->lat && $user->lng))
                unset($filters['orderByMarketLocation']);
            $filters['orderByMarketLocation'] = [$user->lat, $user->lng];
        }
        return OfferResource::collection($this->offerRepo->index(query: $filters, relations: ["category", "market"]))->additional(['status' => 'success']);
    }

    public function store(CreateOfferRequest $createOfferRequest)
    {
        return $this->success(
            $this->offerRepo->store($createOfferRequest->validated())
                ->toArray()
        );
    }

    public function update($id, UpdateOfferRequest $updateOfferRequest)
    {
        $this->offerRepo->update($id, $updateOfferRequest->validated());

        return $this->success();
    }

    public function show($id)
    {
        return ['data' => new ShowOfferResource($this->offerRepo->show($id)), 'status' => 'success'];
    }

    public function delete($id)
    {
        $this->offerRepo->delete($id);

        return $this->success();
    }

    public function attachBranch($id, AttachBranchRequest $attachBranchRequest)
    {
        $this->offerRepo->attachBranches($id, $attachBranchRequest->validated());

        return $this->success();
    }

    public function detachBranch($id, DetachBranchRequest $detachBranchRequest)
    {
        $this->offerRepo->detachBranches($id, $detachBranchRequest->validated());

        return $this->success();
    }
}
