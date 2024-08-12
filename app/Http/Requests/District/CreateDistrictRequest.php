<?php

namespace App\Http\Requests\District;

use Illuminate\Foundation\Http\FormRequest;

class CreateDistrictRequest extends FormRequest
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
            'name' => "required|string|unique:districts,name,NULL,id,city,{$this->city}",
            'lat' => 'required|decimal:4',
            'lng' => 'required|decimal:4',
            'city' => ['required', 'in:Damascus,Aleepo,Lattakia,Tartus,Daraa,Sweida,Homs,Deir Al Zor,Al Raqqa,Al Qamishli,Hama,Idlib,Rif Dimshq'],
            'status' => 'sometimes|in:active,inActive',
        ];
    }
}
