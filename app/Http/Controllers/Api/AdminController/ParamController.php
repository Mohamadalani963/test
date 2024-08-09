<?php

namespace App\Http\Controllers\Api\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequests\ParamRequest\CreateParamRequest;
use App\Http\Requests\AdminRequests\ParamRequest\UpdateParamRequest;
use App\Http\Resources\AdminResources\ParamResource;
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
            }
            $data[$param->name] = $value;
        }
        $response = [
            "data" => $data
        ];
        return $this->success($response);
    }
    public function store(CreateParamRequest $createParamRequest)
    {
        $data = $createParamRequest->validated();
        $this->paramRepo->store($data);
        return $this->success();
    }
    public function update($name, UpdateParamRequest $updateParamRequest)
    {
        $data =  $updateParamRequest->validated();
        $this->paramRepo->update($name, $data);
        return $this->success();
    }
    public function delete($id)
    {
        $this->paramRepo->delete($id);
        return $this->success();
    }
}
