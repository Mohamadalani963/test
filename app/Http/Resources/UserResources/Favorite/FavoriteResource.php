<?php

namespace App\Http\Resources\UserResources\Favorite;

use App\Http\Resources\Market\MarketResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => new UserResource($this->user),
            'market' => new MarketResource($this->market),
        ];
    }
}
