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
        Schema::table('sliders', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('sliderable_id')->nullable(true)->change();
            $table->string('sliderable_type')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('be_nullable', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('sliderable_id')->nullable(false)->change();
            $table->string('sliderable_type')->nullable(false)->change();
        });
    }
};
