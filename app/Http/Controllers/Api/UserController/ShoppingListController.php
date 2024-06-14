<?php

namespace App\Http\Controllers\Api\UserController;

use App\Exceptions\Errors;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\ShoppingListRequest\CreateShoppingListRequest;
use App\Http\Resources\Offer\OfferResource;
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
        $user  = $request->user();
        $filters = $request->all();
        if ($user->type == 'guest')
            $filters['user_id'] = $user->id;
        $shoppingList = $this->shoppingListRepo->index($filters, paginated: false, relations: ['user', 'offer.category', 'offer.market']);
        $offers = $shoppingList->map(function ($item) {
            return $item->offer;
        });
        return [
            'data' => [
                'total_price_after_offer' => $offers->sum('offer_price'),
                'total_price_before_offer' => $offers->sum('original_price'),
                'offers' => OfferResource::collection($offers)
            ],
            'status' => 'success'
        ];
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
