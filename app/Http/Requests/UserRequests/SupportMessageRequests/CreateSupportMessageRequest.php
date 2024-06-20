<?php

namespace App\Http\Requests\UserRequests\SupportMessageRequests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Type\Decimal;

class CreateSupportMessageRequest extends FormRequest
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
            'phone_number' => "required|string|min:9",
            'description' => "required|string",
            'file' => "sometimes|file",
        ];
    }
}
