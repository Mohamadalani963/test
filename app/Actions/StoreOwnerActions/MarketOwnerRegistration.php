<?php 

namespace App\Actions\StoreOwnerActions;

use App\Actions\BaseAction;
use App\Models\Market;
use App\Models\User;
use App\Repos\MarketOwnerRepo;
use App\Repos\MarketRepo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class MarketOwnerRegistration extends BaseAction{

    use AsAction;

    public function handle($data)
    {
        $markeRepo = app(MarketRepo::class);
        return $markeRepo->store($data);

    }
    public function asController(ActionRequest $request)
    {
        $data = $request->validated();

        return $this->handle($data);
    }
    public function rules(){
        return [
        'name' => 'required|string',
        'phone_number' => 'required|string|unique:users,phone_number',
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