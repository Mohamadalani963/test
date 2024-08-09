<?php

namespace App\Http\Resources\Market;

use App\Http\Resources\AdminResources\MarketOwnerResource;
use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowMarketResource extends JsonResource
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
            'image' => $this->image ? url('/') . '/storage' . substr($this->image, 6) : null,
            'contact_information' => ($this->contact_information),
            'owners' => MarketOwnerResource::collection($this->owners),
            'branches' => BranchResource::collection($this->branch)
        ];
    }
}
