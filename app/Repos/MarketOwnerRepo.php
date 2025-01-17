<?php

namespace App\Repos;

use App\Exceptions\ApiException;
use App\Models\MarketOwner;

class MarketOwnerRepo extends CrudRepository
{
    private UserRepo $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        parent::__construct(MarketOwner::class);
        $this->userRepo = $userRepo;
    }

    protected $filters = [
        'first_name' => 'equal',
        'id' => 'equal',
    ];

    public function store($data, $attr = null)
    {
       
        $user = $this->userRepo->store($data);
        $data['user_id'] = $user->id;
        return parent::store($data);
            
    }
}
