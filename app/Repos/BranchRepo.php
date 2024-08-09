<?php

namespace App\Repos;

use App\Models\Branch;

class BranchRepo extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Branch::class);
    }

    protected $filters = [
        'name' => 'equal',
        'id' => 'equal',
        'market_id' => 'equal'
    ];

    public function store($data, $attr = null)
    {
        if (array_key_exists('image', $data)) {
            $data['image'] = $data['image']->store('public/branches');
        }
        $item = parent::store($data);

        return $item;
    }

    public function update($id, $data, $attr = null)
    {
        if (array_key_exists('image', $data)) {
            $data['image'] = $data['image']->store('public/branches');
        }
        $item = parent::update($id, $data);

        return $item;
    }

    public function delete($id, $attr = null)
    {
        $category = $this->findOrFail($id);
        //TODO check here if it's have offers underneath it
        $category->delete();
    }
}
