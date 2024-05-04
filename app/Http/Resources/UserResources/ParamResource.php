<?php

namespace App\Http\Resources\UserResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $value = $this->value;
        $type = $this->type;
        switch ($type) {
            case "integer":
                $value = intVal($value);
            case "bool":
                $value = boolval($value);
        }
        return [
            $this->name => $value
        ];
    }
}
