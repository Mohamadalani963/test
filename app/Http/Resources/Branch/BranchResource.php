<?php

namespace App\Http\Resources\Branch;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'market_id' => ($this->market_id),
            'district_id' => ($this->district_id),
        ];
    }
}
