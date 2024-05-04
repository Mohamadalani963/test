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
        $params = $this->paramRepo->index($request->all(), false);
        $data = [];
        foreach ($params as $param) {
            $value = $param->value;
            $type = $param->type;
            switch ($type) {
                case "integer":
                    $value = intval($value);
                    break;
                case "bool":
                    $value = boolval($value);
                    break;
                default:
                    $value = $param->value;
            }
            $data[$param->name] = $value;
        }
        $response = [
            "data" => $data
        ];

        return $this->success($response);
    }
}
