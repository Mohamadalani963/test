<?php

namespace App\Http\Requests\AdminRequests\ParamRequest;

use Illuminate\Foundation\Http\FormRequest;

class CreateParamRequest extends FormRequest
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
            'name' => 'required|string|unique:params,name',
            'value' => 'required|string',
            'type' => 'required|in:integer,string,bool'
        ];
    }
}
