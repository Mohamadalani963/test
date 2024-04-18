<?php

namespace App\Repos;

use App\Models\Device;

class DeviceRepo extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Device::class);
    }
    protected $filters = [
        'token_id' => 'equal'
    ];
    public function updateBulk($data,$devices){
        Device::whereIn('id',$devices)->update($data);
    }
}
