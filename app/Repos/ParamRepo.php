<?php

namespace App\Repos;

use App\Models\Market;
use App\Models\Param;
use App\Models\SupportMessage;
use App\Utils\RandomizationUtils;

class ParamRepo extends CrudRepository
{

    public function __construct()
    {
        parent::__construct(Param::class);
    }

    protected $filters = [
        'name' => 'equal',
        'id' => 'equal',
    ];

}
