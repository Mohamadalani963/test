<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //TODO Assign Abilities
        //
        $userAbilities = [];
        $guestAbilities = [
            'district::index',
            'district::show',

            'category::index',
            'category::show',

            'market::index',
            'market::show',

            'favorite::index',
            'favorite::store',
            'favorite::delete',
        ];

        $admin = Role::where('name', '*')->first();
        if (! $admin) {
            $admin = Role::create(['name' => '*']);
        }
        $admin->abilities()->attach(Ability::pluck('id')->toArray());

        $user = Role::where('name', 'branch_admin')->first();
        if (! $user) {
            $user = Role::create(['name' => 'branch_admin']);
        }
        $user->abilities()->sync(Ability::whereIn('name', $userAbilities)->pluck('id')->toArray());

        $user = Role::where('name', 'market_owner')->first();
        if (! $user) {
            $user = Role::create(['name' => 'market_owner']);
        }
        $user->abilities()->sync(Ability::whereIn('name', $userAbilities)->pluck('id')->toArray());

        $guest = Role::where('name', 'guest')->first();
        if (! $guest) {
            $guest = Role::create(['name' => 'guest']);
        }
        $guest->abilities()->sync(Ability::whereIn('name', $guestAbilities)->pluck('id')->toArray());
    }
}
