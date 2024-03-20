<?php

namespace App\Repos;

use App\Models\District;

class DistrictRepo extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(District::class);
    }

    protected $filters = [
        'city' => 'equal',
        'status' => 'equal',
    ];

    public function delete($id, $attr = null)
    {
        $district = $this->findOrFail($id);
        //TODO check here if it's have a branches underneath it
        $district->delete();
    }
}
