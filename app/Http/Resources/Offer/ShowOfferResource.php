<?php

namespace App\Http\Resources\Offer;

use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Market\MarketResource;
use Carbon\Carbon;
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
        $due_to_date = Carbon::parse($this->due_to);
        $current_date = Carbon::now();
        $creating_date = Carbon::parse($this->created_at);
        $dicision_value = intval($creating_date->diffInHours($due_to_date) / 4);
        $diff_In_hours_from_creation = $current_date->diffInHours($creating_date);
        $diff_In_hours_from_finishing = $current_date->diffInHours($due_to_date);
        $offer_status = "new";
        if ($diff_In_hours_from_creation > $dicision_value) {
            $offer_status = "";
            if ($diff_In_hours_from_finishing <= $dicision_value)
                $offer_status = "end_soon";
        }
        return [
            'id' => $this->id,
            'description' => $this->description,
            'name' => $this->name,
            'offer_price' => $this->offer_price,
            'original_price' => $this->original_price,
            'due_to' => $this->due_to,
            'category_id' => new CategoryResource($this->category),
            'market' => new MarketResource($this->market),
            'main_image' => $this->main_image ? url('/') . '/storage' . substr($this->main_image, 6) : null,
            'images' => ImageResource::collection($this->images),
            'branches' => BranchResource::collection($this->branches),
            'offer_status' => $offer_status,
            'hours_before_expiration' => $current_date->diffInHours($due_to_date)
        ];
    }
}
