<?php

namespace App\Http\Resources\AdminResources;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
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
            'user' => new UserResource($this->user),
            'contact_email' => $this->contact_email,
            'file' => $this->file ? url('/').'/storage'.substr($this->file, 6) : null,
            'status' => $this->status
        ];
    }
}
