<?php 

namespace App\Actions\StoreOwnerActions;

use App\Actions\BaseAction;
use App\Exceptions\Errors;
use App\Models\User;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class MarketOwnerLogin extends BaseAction{

    use AsAction;

    public function handle($data)
    {
        $user = User::where('phone_number',$data['phone_number'])->first();
        if(!$user)
            Errors::ResourceNotFound();
        if (! Hash::check($data['password'], $user->password)) {
            Errors::InvalidCredentials();
        }    
        $user->generateVerifyCode();
        
    }
    public function asController(ActionRequest $request)
    {
        $data = $request->validated();

        return $this->handle($data);
    }
    public function rules(){
        return [
        'phone_number' => 'required|string',
        'password' => 'required|min:6|max:10',
        ];
    }
    public function jsonResponse($data): JsonResponse
    {
        return $this->success($data);
    }

    public function authorize(ActionRequest $request)
    {return true;}

}