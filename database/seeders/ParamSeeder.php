<?php

namespace Database\Seeders;

use App\Models\Param;
use Illuminate\Database\Seeder;

class ParamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params =
        [
        [
            'name' => 'privacy_en',
            'value' => '',
        ],
        [
            'name' => 'privacy_ar',
            'value' => '',
        ],
        [
            'name' => 'privacy_de',
            'value' => '',
        ],
        [
            'name' => 'about_us_en',
            'value' => '',
        ],
        [
            'name' => 'about_us_ar',
            'value' => '',
        ],
        [
            'name' => 'about_us_de',
            'value' => '',
        ],
        [
            'name' => 'currency',
            'value' => 'euro',
        ],
        [
            'name' => 'phone_number',
            'value' => '+963',
        ],
        [
            'name' => 'address',
            'value' => '',
        ],
        [
            'name' => 'email',
            'value' => 'info@offer-apps.com',
        ],
        [
            'name' => 'about_app_en',
            'value' => '',
        ],
        [
            'name' => 'about_app_ar',
            'value' => '',
        ],
        [
            'name' => 'about_app_de',
            'value' => '',
        ],
        [
            'name' => 'big_about_us_en',
            'value' => '',
        ],
        [
            'name' => 'big_about_us_ar',
            'value' => '',
        ],
        [
            'name' => 'big_about_us_de',
            'value' => '',
        ],
        [
            'name' => 'facebook',
            'value' => '',
        ],
        [
            'name' => 'instagram',
            'value' => '',
        ],
        [
            'name' => 'Support_phone_number',
            'value' => '',
        ],
        [
            'name' => 'about_app_cn',
            'value' => '',
        ],
        [
            'name' => 'about_us_cn',
            'value' => '',
        ],
        [
            'name' => 'privacy_cn',
            'value' => '',
        ],
        [
            'name' => 'big_about_us_cn',
            'value' => '',
        ]
        ];
        foreach($params as $param){
            $p = Param::where('name',$param['name'])->count();
            if(!$p){
                Param::create($param);
            }
        }
    }
}
