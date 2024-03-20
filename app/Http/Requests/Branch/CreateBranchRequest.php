<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class CreateBranchRequest extends FormRequest
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
            'name' => 'required|string',
            'contact_information' => 'sometimes|json',
            'image' => 'sometimes|image',
            'address' => 'required|string',
            'lat' => 'sometimes|decimal:2',
            'lng' => 'sometimes|decimal:2',
            'market_id' => 'required|exists:markets,id',
            'district_id' => 'required|exists:districts,id',
        ];
    }
}
