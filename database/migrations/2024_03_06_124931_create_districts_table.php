<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('city', ['Damascus', 'Aleepo', 'Lattakia', 'Tartus', 'Daraa', 'Sweida', 'Homs', 'Deir Al Zor', 'Al Raqqa', 'Al Qamishli', 'Hama', 'Idlib', 'Rif Dimshq']);
            $table->enum('status', ['active', 'inActive'])->default('active');
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->unique(['name', 'city']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};

// {
//     "id":1,
//     "name": "string",
//     "description": "some description",
//     "main image": "image link",
//     "images":[
//         {
//             "id" : "image_id",
//             "image" : "image link"
//         },
//         {
//             "id" : "image_id",
//             "image" : "image link"
//         }
//     ],
//     "category":[
//         "id",
//         "name" : "category_name",
//         "image" : "category_image nullable"
//     ]
//     "branches":[
//         {
//             "id":1,
//             "name":"branch_name",
//             "lat":20.01,
//             "lng":12.02,
//             "address": "string"
//         }
//     ],
//     "market" :{
//         "id",
//         "name" => "market name",
//         "contact_information"=> "json object",
//         "image" => "market_image_link"
//     },
//     "offer_price" : 152311,
//     "original_price": 200000,
//     "due_to" : 2023-01-25 01:00:12
// }
