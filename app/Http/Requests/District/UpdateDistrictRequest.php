<?php

namespace App\Http\Requests\District;

use App\Exceptions\Errors;
use App\Models\District;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDistrictRequest extends FormRequest
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
        $id = $this->id;
        $city = $this->city;
        if (! $city) {
            $destrict = District::find($id);
            if (! $destrict) {
                Errors::ResourceNotFound();
            }
            $city = $destrict->city;
        }

        return [
            //
            'name' => "sometimes|string|unique:districts,name,NULL,id,city,{$city}",
            'lat' => 'sometimes|decimal:4',
            'lng' => 'sometimes|decimal:4',
            'city' => ['sometimes', 'in:Damascus,Aleepo,Lattakia,Tartus,Daraa,Sweida,Homs,Deir Al Zor,Al Raqqa,Al Qamishli,Hama,Idlib,Rif Dimshq'],
            'status' => 'sometimes|in:active,inActive',

        ];
    }
}
