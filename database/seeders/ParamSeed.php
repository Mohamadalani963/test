<?php

namespace Database\Seeders;

use App\Models\Param;
use Illuminate\Database\Seeder;

class ParamSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Param::insert([
            [
                'key' => 'privacy_en',
                'value' => '',
            ],
            [
                'key' => 'privacy_ar',
                'value' => '',
            ],
            [
                'key' => 'privacy_de',
                'value' => '',
            ],
            [
                'key' => 'about_us_en',
                'value' => '',
            ],
            [
                'key' => 'about_us_ar',
                'value' => '',
            ],
            [
                'key' => 'about_us_de',
                'value' => '',
            ],
            [
                'key' => 'currency',
                'value' => 'euro',
            ],
            [
                'key' => 'phone_number',
                'value' => '+963 964398421',
            ],
            [
                'key' => 'address',
                'value' => '',
            ],
            [
                'key' => 'email',
                'value' => 'info@octa-apps.com',
            ],
            [
                'key' => 'about_app_en',
                'value' => '',
            ],
            [
                'key' => 'about_app_ar',
                'value' => '',
            ],
            [
                'key' => 'about_app_de',
                'value' => '',
            ],
            [
                'key' => 'big_about_us_en',
                'value' => '',
            ],
            [
                'key' => 'big_about_us_ar',
                'value' => '',
            ],
            [
                'key' => 'big_about_us_de',
                'value' => '',
            ],
            [
                'key' => 'facebook',
                'value' => '',
            ],
            [
                'key' => 'instagram',
                'value' => '',
            ],
            [
                'key' => 'Support_phone_number',
                'value' => '+963 964398421',
            ],
            [
                'key' => 'about_app_cn',
                'value' => '',
            ],
            [
                'key' => 'about_us_cn',
                'value' => '',
            ],
            [
                'key' => 'privacy_cn',
                'value' => '',
            ],
            [
                'key' => 'big_about_us_cn',
                'value' => '',
            ],
        ]);
    }
}
