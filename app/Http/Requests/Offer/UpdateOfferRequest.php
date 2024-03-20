<?php

namespace App\Http\Requests\Offer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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
            'name' => 'sometimes|string',
            'offer_price' => 'sometimes|integer',
            'original_price' => 'sometimes|integer',
            'due_to' => 'sometimes|date',
            'category_id' => 'sometimes|exists:categories,id',
            'market_id' => 'sometimes|exists:markets,id',
            'main_image' => 'sometimes|image',
        ];
    }
}
