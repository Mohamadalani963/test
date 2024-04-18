<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\ShowCategoryResource;
use App\Repos\CategoryRepo;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryRepo $categoryRepo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index(Request $request)
    {
        return CategoryResource::collection($this->categoryRepo->index(query: $request->all()))->additional(['status' => 'success']);
    }

    public function store(CreateCategoryRequest $createCategoryRequest)
    {
        return $this->success(
            $this->categoryRepo->store($createCategoryRequest->validated())
                ->toArray()
        );
    }

    public function update($id, UpdateCategoryRequest $updateCategoryRequest)
    {
        $this->categoryRepo->update($id, $updateCategoryRequest->validated());

        return $this->success();
    }

    public function show($id)
    {
        return new ShowCategoryResource($this->categoryRepo->show($id));
    }

    public function delete($id)
    {
        $this->categoryRepo->delete($id);

        return $this->success();
    }
}
