<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_abilities');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_abilities');
    }
}
