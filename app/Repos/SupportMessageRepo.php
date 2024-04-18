<?php

namespace App\Repos;

use App\Models\Market;
use App\Models\SupportMessage;
use App\Utils\RandomizationUtils;

class SupportMessageRepo extends CrudRepository
{

    public function __construct()
    {
        parent::__construct(SupportMessage::class);
    }

    protected $filters = [
        'name' => 'equal',
        'id' => 'equal',
    ];

    public function store($data, $attr = null)
    {
        if (array_key_exists('file', $data)) {
            $data['file'] = $data['file']->store('public/supportMessage');
        }
        $item = parent::store($data);
        return $item;
    }

    public function update($id, $data, $attr = null)
    {
        if (array_key_exists('file', $data)) {
            $data['file'] = $data['file']->store('public/supportMessage');
        }
        $item = parent::update($id, $data);

        return $item;
    }
}
