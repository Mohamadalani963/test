<?php

namespace App\Http\Resources\UserResources\Offer;

use App\Http\Resources\UserResources\Category\CategoryResource;
use App\Http\Resources\UserResources\Market\MarketResource;
use App\Models\Param;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $due_to_date = Carbon::parse($this->offer->due_to); //"2024-08-24 00:00:00.000000"
        $current_date = Carbon::now(); //"2024-09-03 20:56:50.412774"
        $creating_date = Carbon::parse($this->offer->created_at); //"2024-08-23 16:20:22.000000"
        $dicision_value = intval($creating_date->diffInHours($due_to_date) / 4);
        $diff_In_hours_from_creation = $current_date > $creating_date ? $creating_date->diffInHours($current_date, true) : $current_date->diffInHours($creating_date, true); //-268 should be around 11
        $diff_In_hours_from_finishing =  $current_date->diffInHours($due_to_date, false); // -260 should be around 10
        $offer_status = "جديد";
        if ($diff_In_hours_from_creation > $dicision_value) {
            $offer_status = "";
            if ($diff_In_hours_from_finishing <= $dicision_value)
                $offer_status = "ينتهي قريباً";
        }
        if ($diff_In_hours_from_finishing <= 0) {
            $offer_status = "منتهي";
        }
        return [
            'id' => $this->offer->id,
            'description' => $this->offer->description,
            'name' => $this->offer->name,
            'offer_price' => $this->offer->offer_price,
            'original_price' => $this->offer->original_price,
            'due_to' => $this->offer->due_to,
            'category_id' => new CategoryResource($this->offer->category),
            'market' => new MarketResource($this->offer->market),
            'main_image' => $this->offer->main_image ? url('/') . '/storage' . substr($this->offer->main_image, 6) : null,
            'offer_status' => $offer_status,
            'hours_before_expiration' => $offer_status == "منتهي" ? 0 : $current_date->diffInHours($due_to_date)
        ];
    }
}
