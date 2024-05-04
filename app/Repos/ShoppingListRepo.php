<?php

namespace App\Repos;

use App\Models\ShoppingList;

class ShoppingListRepo extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(ShoppingList::class);
    }

    protected $filters = [
        'user_id' => 'equal',
        'offer_id' => 'equal',
    ];
}
