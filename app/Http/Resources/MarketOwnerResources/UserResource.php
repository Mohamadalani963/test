<?php

namespace App\Http\Resources\MarketOwnerResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username' => $this->username,
            'type' => $this->type,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }
}
