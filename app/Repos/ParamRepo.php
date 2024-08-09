<?php

namespace App\Repos;

use App\Exceptions\Errors;
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
    public function update($id, $data, $attr = null)
    {
        $param = Param::where('name', $id)->first();
        if (!$param)
            Errors::ResourceNotFound();
        $param->update($data);
        return $param;
    }
}
