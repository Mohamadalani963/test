<?php

namespace App\Repos;

use App\Models\OfferImages;

class OfferImageRepo extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(OfferImages::class);
    }

    protected $filters = [
        'id' => 'equal',
    ];

    public function store($data, $attr = null)
    {
        if (array_key_exists('image', $data)) {
            $data['image'] = $data['image']->store('public/offer/image');
        }
        $item = parent::store($data);

        return $item;
    }
}
