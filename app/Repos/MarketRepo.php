<?php

namespace App\Repos;

use App\Models\Market;
use App\Utils\RandomizationUtils;

class MarketRepo extends CrudRepository
{
    private MarketOwnerRepo $marketOwnerRepo;

    public function __construct(MarketOwnerRepo $marketOwnerRepo)
    {
        parent::__construct(Market::class);
        $this->marketOwnerRepo = $marketOwnerRepo;
    }

    protected $filters = [
        'name' => 'equal',
        'id' => 'equal',
    ];

    public function store($data, $attr = null)
    {
        if (array_key_exists('image', $data)) {
            $data['image'] = $data['image']->store('public/markets');
        }
        $item = parent::store($data);
        $password = array_key_exists('password',$data)?$data['password']:RandomizationUtils::randomPassword(8);
        $data['owner']['password'] = $password;
        $data['owner']['username'] = $data['name'].$item->id;
        $data['owner']['type'] = 'marketOwner';
        $data['owner']['market_id'] = $item->id;
        $data['owner']['phone_number'] = $data['phone_number'];
        $this->marketOwnerRepo->store($data['owner']);

        return ['market' => $item, 'marketOwner' => ['username' => $data['owner']['username'], 'password' => $password]];
    }

    public function update($id, $data, $attr = null)
    {
        if (array_key_exists('image', $data)) {
            $data['image'] = $data['image']->store('public/markets');
        }
        $item = parent::update($id, $data);

        return $item;
    }

    public function delete($id, $attr = null)
    {
        $market = $this->findOrFail($id);
        //TODO check here if it's have offers underneath it
        $market->delete();
    }
}
