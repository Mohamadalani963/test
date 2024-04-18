<?php

namespace App\Http\Requests\UserRequests\SupportMessageRequests;

use Illuminate\Foundation\Http\FormRequest;

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
            'message' => 'required|string',
            'contact_email' => "required|email",
            'title' => "required|string",
            'file' => "sometimes|file",
        ];
    }
}
