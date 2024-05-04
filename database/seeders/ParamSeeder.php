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
                    "name" => "app_version",
                    "value" => "1.0.0",
                    "type" => "string"
                ],
                [
                    "name" => "mandatory_update",
                    "value" => "true",
                    "type" => "bool"
                ]
            ];
        foreach ($params as $param) {
            $p = Param::where('name', $param['name'])->count();
            if (!$p) {
                Param::create($param);
            }
        }
    }
}
