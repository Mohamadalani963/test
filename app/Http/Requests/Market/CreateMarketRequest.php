<?php

namespace App\Http\Requests\Market;

use Illuminate\Foundation\Http\FormRequest;

class CreateMarketRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'sometimes|image',
            'contact_information' => 'sometimes|json',
            'owner.first_name' => 'required|string',
            'owner.last_name' => 'required|string',
            'owner.id_number' => 'required|string',
            'owner.phone_number' => 'required|string',
        ];
    }
}
