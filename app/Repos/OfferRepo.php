<?php

namespace App\Repos;

use App\Models\Offer;

class OfferRepo extends CrudRepository
{
    private OfferImageRepo $offerImageRepo;

    public function __construct(OfferImageRepo $offerImageRepo)
    {
        $this->offerImageRepo = $offerImageRepo;
        parent::__construct(Offer::class);
    }

    protected $filters = [
        'name' => 'equal',
        'id' => 'equal',
    ];

    public function store($data, $attr = null)
    {
        if (array_key_exists('main_image', $data)) {
            $data['main_image'] = $data['main_image']->store('public/offer/main_image');
        }
        $item = parent::store($data);
        //Store Multi offer Image here
        if (array_key_exists('images', $data) && is_array($data['images'])) {
            foreach ($data['images'] as $image) {
                $temp_image = [
                    'image' => $image,
                    'offer_id' => $item->id,
                ];
                $this->offerImageRepo->store($temp_image);
            }
        }
        if (array_key_exists('branches', $data)) {
            $this->attachBranches($item->id, $data);
        }

        return $item;
    }

    public function update($id, $data, $attr = null)
    {
        if (array_key_exists('main_image', $data)) {
            $data['main_image'] = $data['main_image']->store('public/offer/main_image');
        }
        $item = parent::update($id, $data);

        return $item;
    }

    public function delete($id, $attr = null)
    {
        $offer = $this->findOrFail($id);
        //TODO check here if it's have offers underneath it
        $offer->delete();
    }

    public function attachBranches($id, $data)
    {
        $offer = $this->findOrFail($id);
        $offer->branches()->attach($data['branches']);
    }

    public function detachBranches($id, $data)
    {
        $offer = $this->findOrFail($id);
        $offer->branches()->detach($data['branches']);
    }
    //TODO next step filters
    // $latitude = 37.7749; // Example latitude
    // $longitude = -122.4194; // Example longitude
    // $radius = 10; // Search radius in kilometers
    //
    // $offers = Offer::select('id', 'latitude', 'longitude')
    // ->selectRaw('(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', [$latitude, $longitude, $latitude])
    // ->having('distance', '<', $radius)
    // ->orderBy('distance')
    // ->get();
}
