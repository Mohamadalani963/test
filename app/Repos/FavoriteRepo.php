<?php

namespace App\Repos;

use App\Models\Favorite;

class FavoriteRepo extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Favorite::class);
    }

    protected $filters = [
        'user_id' => 'equal',
        'market_id' => 'equal',
    ];
}
