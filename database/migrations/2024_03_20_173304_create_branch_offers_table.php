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
        Schema::create('branch_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreignId('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->unique(['offer_id', 'branch_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_offers');
    }
};
