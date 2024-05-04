<?php

namespace App\Http\Resources\AdminResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $value = $this->value;
        $type = $this->type;
        switch ($type) {
            case "integer":
                $value = intval($value);
                break;
            case "bool":
                $value = boolval($value);
                break;
            default:
        }
        return [
            $this->name => $value
        ];
    }
}
