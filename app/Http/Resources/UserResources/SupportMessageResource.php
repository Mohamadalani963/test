<?php

namespace App\Http\Resources\UserResources;

use GPBMetadata\Google\Type\Decimal;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportMessageResource extends JsonResource
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
            'description' => $this->description,
            'user_id' => $this->user_id,
            'phone_number' => $this->phone_number,
            'file' => $this->file ? url('/') . '/storage' . substr($this->file, 6) : null,
        ];
    }
}
