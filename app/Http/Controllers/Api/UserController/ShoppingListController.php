<?php

namespace App\Http\Controllers\Api\UserController;

use App\Exceptions\Errors;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\ShoppingListRequest\CreateShoppingListRequest;
use App\Http\Resources\UserResources\ShoppingList\ShoppingListResources;
use App\Repos\ShoppingListRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingListController extends Controller
{
    private ShoppingListRepo $shoppingListRepo;
    public function __construct(ShoppingListRepo $shoppingListRepo)
    {
        $this->shoppingListRepo = $shoppingListRepo;
    }
    //
    public function index(Request $request)
    {
        return ShoppingListResources::collection($this->shoppingListRepo->index($request->all(), relations: ['user', 'offer']))->additional(['status' => 'success']);
    }
    public function store(CreateShoppingListRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        return new ShoppingListResources($this->shoppingListRepo->store($data));
    }
    public function delete($id)
    {
        $user = Auth::user();
        $shoppingList = $this->shoppingListRepo->show($id);
        if ($shoppingList->user_id != $user->id)
            Errors::NotAuthorized();
        $shoppingList->delete();
        return $this->success();
    }
}
