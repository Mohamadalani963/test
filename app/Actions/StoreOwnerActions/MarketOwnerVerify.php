<?php 

namespace App\Actions\StoreOwnerActions;

use App\Actions\BaseAction;
use App\Exceptions\Errors;
use App\Http\Resources\MarketOwnerResources\UserResource;
use App\Models\User;
use App\Repos\DeviceRepo;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class MarketOwnerVerify extends BaseAction{

    use AsAction;

    public function handle($data)
    {
        $user = User::where('phone_number',$data['phone_number'])->first();
        if(!$user)
            Errors::ResourceNotFound();
        if($data['verification_code']!=$user->verification_code)
            Errors::invalidCode();
            $deviceRepo = app(DeviceRepo::class);
            $abilities = $user->abilities->pluck('name')->toArray();
            $token = $user->createToken($user->username, $abilities);
            $deviceRepo->store(['token_id' => $token->accessToken->id, 'user_id' => $user->id, 'ip' => $data['ip'], 'fcm_token' => array_key_exists('fcm_token', $data) ? $data['fcm_token'] : null]);
    
            return [
                'token' => $token->plainTextToken,
                'user' => $user,
                'verified' => true,
                'abilities' => $abilities,
            ];
    }
    public function asController(ActionRequest $request)
    {
        $data = $request->validated();
        $data['ip'] = $request->ip();
        return $this->handle($data);
    }
    public function rules(){
        return [
        'phone_number' => 'required|string',
        'verification_code' => 'required|min:4|max:4',
        ];
    }
    public function jsonResponse($data): JsonResponse
    {
        $data['user'] = new UserResource($data['user']);
        return $this->success($data);
    }

    public function authorize(ActionRequest $request)
    {return true;}

}