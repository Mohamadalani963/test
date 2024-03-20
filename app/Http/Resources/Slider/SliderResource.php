<?php

namespace App\Http\Resources\Slider;

use App\Models\Market;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'image' => $this->image ? url('/').'/storage'.substr($this->image, 6) : null,
        ];
        if ($this->sliderable_type != 'other' && $this->sliderable instanceof Market) {
            $data['sliderable_type'] = 'market';
            $data['sliderable_id'] = $this->sliderable_id;

            return $data;
        }
        if ($this->sliderable_type != 'other' && $this->sliderable instanceof Offer) {
            $data['sliderable_type'] = 'offer';
            $data['sliderable_id'] = $this->sliderable_id;

            return $data;
        }
        $data['sliderable_type'] = 'other';
        $data['sliderable_id'] = -1;

        return $data;
    }
}
