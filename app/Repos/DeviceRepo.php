<?php

namespace App\Repos;

use App\Models\Device;

class DeviceRepo extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Device::class);
    }
}
