<?php

namespace App\Http\Resources\AdminResources;

use App\Http\Resources\User\UserResource;
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
            'phone_number' => $this->phone_number,
            'user' => new UserResource($this->user),
            'file' => $this->file ? url('/') . '/storage' . substr($this->file, 6) : null,
            'status' => $this->status
        ];
    }
}
