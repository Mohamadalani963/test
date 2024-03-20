<?php

namespace App\Http\Resources\Branch;

use App\Http\Resources\District\DistrictResource;
use App\Http\Resources\Market\MarketResource;
use App\Http\Resources\Offer\OfferResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowBranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'contact_information' => $this->contact_information,
            'image' => $this->image ? url('/').'/storage'.substr($this->image, 6) : null,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'market' => new MarketResource($this->market),
            'district' => new DistrictResource($this->district),
            'offers' => OfferResource::collection($this->offers)
        ];
    }
}
