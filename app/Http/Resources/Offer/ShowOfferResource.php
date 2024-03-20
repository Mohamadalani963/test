<?php

namespace App\Http\Resources\Offer;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Market\MarketResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowOfferResource extends JsonResource
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
            'description' => $this->description,
            'name' => $this->name,
            'offer_price' => $this->offer_price,
            'original_price' => $this->original_price,
            'due_to' => $this->due_to,
            'category_id' => new CategoryResource($this->category),
            'market_id' => new MarketResource($this->market),
            'main_image' => $this->main_image ? url('/').'/storage'.substr($this->main_image, 6) : null,
            'images' => ImageResource::collection($this->images),
        ];
    }
}
