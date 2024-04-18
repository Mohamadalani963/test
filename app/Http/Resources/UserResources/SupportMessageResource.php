<?php

namespace App\Http\Resources\UserResources;

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
            'title' => $this->title,
            'message' => $this->message,
            'user_id' => $this->user_id,
            'contact_email' => $this->contact_email,
            'file' => $this->file ? url('/').'/storage'.substr($this->file, 6) : null,
        ];
    }
}
