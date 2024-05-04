<?php

namespace App\Http\Controllers\Api\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\ShoppingListRequest\CreateShoppingListRequest;
use App\Http\Resources\UserResources\ShoppingList\ShoppingListResources;
use App\Repos\ShoppingListRepo;
use Illuminate\Http\Request;

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
        return ShoppingListResources::collection($this->shoppingListRepo->index($request))->additional(['status' => 'success']);
    }
    public function store(CreateShoppingListRequest $request)
    {
        return new ShoppingListResources($this->shoppingListRepo->store($request->validated()));
    }
}
