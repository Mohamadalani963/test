<?php

namespace App\Repos;

use App\Exceptions\ApiException;
use App\Models\User;

class UserRepo extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    protected $filters = [
        'user_id' => 'user_id',
        'type' => 'equal',
        'username' => 'equal',
        'email' => 'like',
    ];

    public function store($data, $attr = null)
    {
            $user = parent::store($data);
            if (array_key_exists('abilities', $data)) {
                $user->abilities()->attach($data['abilities']);
            }
            return $user;
       
    }

    // @filters
    public function user_id($user_id)
    {
        return $this->query->where('user_id', $user_id);
    }
}
