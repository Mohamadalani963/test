<?php

namespace App\Http\Resources\District;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class DistrictResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = Auth::user();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'city' => $this->city,
            'lng' => $this->lng,
            'lat' => $this->lat,
            'status' => $this->when($user->type == 'super_admin', $this->status),
        ];
    }
}
