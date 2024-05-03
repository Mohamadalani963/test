<?php

namespace App\Http\Controllers\Api\UserController;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResources\ParamResource;
use App\Repos\ParamRepo;
use Illuminate\Http\Request;

class ParamController extends Controller
{
    //
    private ParamRepo $paramRepo;
    public function __construct(ParamRepo $paramRepo)
    {
        $this->paramRepo = $paramRepo;
    }
    public function index(Request $request)
    {
        $params = $this->paramRepo->index($request->all(), false)->toArray();

        $data = collect($params)->pluck('value', 'name')->toArray();

        $response = [
            "data" => $data
        ];

        return $this->success($response);
    }
}
