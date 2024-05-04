<?php

namespace App\Http\Resources\UserResources\ShoppingList;

use App\Http\Resources\Offer\OfferResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShoppingListResources extends JsonResource
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
            'user' => new UserResource($this->user),
            'offer' => new OfferResource($this->offer)
        ];
    }
}
