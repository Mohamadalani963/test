<?php

namespace App\Http\Controllers\Api\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\AttachBranchRequest;
use App\Http\Requests\Offer\CreateOfferRequest;
use App\Http\Requests\Offer\DetachBranchRequest;
use App\Http\Requests\Offer\UpdateOfferRequest;
use App\Http\Resources\Offer\ShowOfferResource;
use App\Http\Resources\UserResources\Offer\OfferResource;
use App\Models\BranchOffer;
use App\Models\District;
use App\Models\Offer;
use App\Repos\OfferRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    private OfferRepo $offerRepo;

    public function __construct(OfferRepo $offerRepo)
    {
        $this->offerRepo = $offerRepo;
    }

    public function index(Request $request)
    {
        $filters = $request->all();
        $lat = null;
        $lng = null;
        $orderedByLocation = false;

        // Check if district_id exists in filters and find the district
        if (array_key_exists('district_id', $filters)) {
            $district = District::find($filters['district_id']);
            if ($district) {
                $lat = $district->lat;
                $lng = $district->lng;
                $orderedByLocation = true;
            }
        }

        // Start building the query
        $query = BranchOffer::query()->with(['offer' => function ($query) {
            $query->with(['market', 'category']);
        }]);

        // If location ordering is needed, calculate the distance and add it to the query
        if ($orderedByLocation) {
            $haversine = "(6371 * acos(cos(radians($lat)) * cos(radians(branches.lat)) * cos(radians(branches.lng) - radians($lng)) + sin(radians($lat)) * sin(radians(branches.lat)))) AS distance";

            // Include the Haversine calculation in the select clause and order by distance
            $query->selectRaw("*, $haversine")->orderBy('distance');
        }

        // Execute the query and return the results with the status
        return OfferResource::collection($query->paginate())->additional(['status' => 'success']);
    }
}
