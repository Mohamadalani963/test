<?php

namespace Database\Seeders;

use App\Models\Ability;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $abilities = [
            'district::index',
            'district::store',
            'district::update',
            'district::delete',
            'district::show',

            'category::index',
            'category::store',
            'category::update',
            'category::delete',
            'category::show',

            'market::index',
            'market::store',
            'market::update',
            'market::delete',
            'market::show',

            'favorite::index',
            'favorite::store',
            'favorite::delete',

            'branch::index',
            'branch::store',
            'branch::delete',
            'branch::update',
            'branch::show',

            'offer::index',
            'offer::store',
            'offer::delete',
            'offer::update',
            'offer::show',

            'offerImage::store',
            'offerImage::delete',

            'slider::index',
            'slider::store',
            'slider::delete',

            'supportMessage::index',
            'supportMessage::store',
            'supportMessage::update',
            'supportMessage::delete',

            'contactUs::index',
            'contactUs::store',
            'contactUs::update',
            'contactUs::delete',

            'param::index',
            'param::store',
            'param::update',
            'param::delete'
        ];

        foreach ($abilities as $newAbility) {
            $ability = Ability::where('name', $newAbility)->first();
            if (! $ability) {
                Ability::create(['name' => $newAbility]);
            }
        }
    }
}
