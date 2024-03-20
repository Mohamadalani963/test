<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string',
            'contact_information' => 'sometimes|json',
            'image' => 'sometimes|image',
            'address' => 'sometimes|string',
            'lat' => 'sometimes|decimal:2',
            'lng' => 'sometimes|decimal:2',
            'market_id' => 'sometimes|exists:markets,id',
            'district_id' => 'sometimes|exists:districts,id',
        ];
    }
}
