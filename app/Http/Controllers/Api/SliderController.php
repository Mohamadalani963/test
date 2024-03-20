<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\CreateSliderRequest;
use App\Http\Resources\Slider\SliderResource;
use App\Models\Market;
use App\Models\Offer;
use App\Repos\SliderRepo;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    private SliderRepo $sliderRepo;

    public function __construct(SliderRepo $sliderRepo)
    {
        $this->sliderRepo = $sliderRepo;
    }

    public function index(Request $request)
    {
        return SliderResource::collection($this->sliderRepo->index(query: $request->all()));
    }

    public function store(CreateSliderRequest $createSliderRequest)
    {
        $data = $createSliderRequest->validated();
        switch ($data['sliderable_type']) {
            case 'market':
                $data['sliderable_type'] = Market::class;
                break;
            case 'offer':
                $data['sliderable_type'] = Offer::class;
                break;
            default:
                $data['sliderable_type'] = 'other';
        }

        return $this->success(
            $this->sliderRepo->store($data)
                ->toArray()
        );
    }

    public function delete($id)
    {
        $this->sliderRepo->delete($id);

        return $this->success();
    }
}
