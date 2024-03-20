<?php

namespace App\Repos;

use App\Models\Slider;

class SliderRepo extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Slider::class);
    }

    protected $filters = [
    ];

    public function store($data, $attr = null)
    {
        if (array_key_exists('image', $data)) {
            $data['image'] = $data['image']->store('public/slider');
        }
        $item = parent::store($data);

        return $item;
    }
}
