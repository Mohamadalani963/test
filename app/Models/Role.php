<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'role_abilities');
    }

    public function addAbility($ability)
    {
        $ability = Ability::query()
            ->where('name', $ability)
            ->first();
        RoleAbility::create([
            'role_id' => $this->id,
            'ability_id' => $ability->id,
        ]);
    }
}
