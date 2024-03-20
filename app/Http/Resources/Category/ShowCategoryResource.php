<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //TODO get back to this when finishing offers
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image ? url('/').'/storage'.substr($this->image, 6) : null,
        ];
    }
}
