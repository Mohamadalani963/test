<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferImage\CreateOfferImageRequest;
use App\Repos\OfferImageRepo;

class OfferImageController extends Controller
{
    private OfferImageRepo $offerImageRepo;

    public function __construct(OfferImageRepo $offerImageRepo)
    {
        $this->offerImageRepo = $offerImageRepo;
    }

    public function store(CreateOfferImageRequest $createOfferImageRequest)
    {
        return $this->success(
            $this->offerImageRepo->store($createOfferImageRequest->validated())
                ->toArray()
        );
    }

    public function delete($id)
    {
        $this->offerImageRepo->delete($id);

        return $this->success();
    }
}
