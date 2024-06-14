<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class CreateSliderRequest extends FormRequest
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
        if ($this->sliderable_type == 'market') {
            return [
                'sliderable_id' => 'required|integer|exists:markets,id',
                'sliderable_type' => 'required|in:market,offer',
                'image' => 'required|file',
            ];
        }
        if ($this->sliderable_type == 'offer') {
            return [
                'sliderable_id' => 'required|integer|exists:offers,id',
                'sliderable_type' => 'required|in:market,offer',
                'image' => 'required|file',
            ];
        }
        return [
            'image' => 'required|file',
        ];
    }
}
