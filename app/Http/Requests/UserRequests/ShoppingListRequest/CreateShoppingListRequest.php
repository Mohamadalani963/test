<?php

namespace App\Http\Requests\UserRequests\ShoppingListRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateShoppingListRequest extends FormRequest
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
        $user = Auth::user();
        return [
            //
            'offer_id' => "required|exists:offers,id|unique:shopping_lists,offer_id,NULL,id,user_id,{$user->id}"
        ];
    }
}
