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
        //
        $marektOwnerAbilities = [];
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

            'branch::index',
            'branch::show',

            'offer::index',
            'offer::show',

            'slider::index',
            'supportMessage::store',
            'contactUs::store',
            'param::index'

        ];

        $admin = Role::where('name', '*')->first();
        if (! $admin) {
            $admin = Role::create(['name' => '*']);
        }
        $admin->abilities()->attach(Ability::pluck('id')->toArray());

        $user = Role::where('name', 'market_owner')->first();
        if (! $user) {
            $user = Role::create(['name' => 'market_owner']);
        }
        $user->abilities()->sync(Ability::whereIn('name', $marektOwnerAbilities)->pluck('id')->toArray());

        $guest = Role::where('name', 'guest')->first();
        if (! $guest) {
            $guest = Role::create(['name' => 'guest']);
        }
        $guest->abilities()->sync(Ability::whereIn('name', $guestAbilities)->pluck('id')->toArray());
    }
}
