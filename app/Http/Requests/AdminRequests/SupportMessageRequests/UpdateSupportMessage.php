<?php

namespace App\Http\Requests\AdminRequests\SupportMessageRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupportMessage extends FormRequest
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
            //
            'status' => 'required|in:reviewed,notReviewed'
        ];
    }
}
