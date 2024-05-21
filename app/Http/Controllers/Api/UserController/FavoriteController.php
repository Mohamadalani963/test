<?php

namespace App\Http\Controllers\Api\UserController;

use App\Exceptions\Errors;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\Favorite\CreateFavoriteRequest;
use App\Http\Resources\UserResources\Favorite\FavoriteResource;
use App\Repos\FavoriteRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    //
    private FavoriteRepo $favoriteRepo;

    public function __construct(FavoriteRepo $favoriteRepo)
    {
        $this->favoriteRepo = $favoriteRepo;
    }

    public function index(Request $request)
    {
        return FavoriteResource::collection($this->favoriteRepo->index(query: $request->all(), relations: ['user', 'market']))->additional(['status' => 'success']);
    }

    public function store(CreateFavoriteRequest $createFavoriteRequest)
    {
        $data = $createFavoriteRequest->validated();
        $data['user_id'] = Auth::user()->id;
        return $this->success(new FavoriteResource($this->favoriteRepo->store($data)));
    }

    public function delete($market_id)
    {
        $user = Auth::user();
        $record = $this->favoriteRepo->index(['market_id' => $market_id, 'user_id' => $user->id])->first();
        if (!$record) {
            Errors::ResourceNotFound();
        }
        $record->delete();

        return $this->success();
    }
}
