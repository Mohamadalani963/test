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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('contact_information')->nullable();
            $table->string('image')->nullable();
            $table->string('address');
            $table->foreignId('market_id')->references('id')->on('markets')->onDelete('cascade');
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->foreignId('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
