<?php

namespace App\Http\Requests\Offer;

use Illuminate\Foundation\Http\FormRequest;

class CreateOfferRequest extends FormRequest
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
            'description' => 'sometimes|string',
            'name' => 'required|string',
            'offer_price' => 'required|integer',
            'original_price' => 'required|integer',
            'due_to' => 'sometimes|date',
            'category_id' => 'required|exists:categories,id',
            'market_id' => 'required|exists:markets,id',
            'main_image' => 'sometimes|image',
            'images' => 'sometimes|array',
            'images.*' => 'image',
            'branches' => 'sometimes|array',
            'branches.*' => 'integer|exists:branches,id',
        ];
    }
}
