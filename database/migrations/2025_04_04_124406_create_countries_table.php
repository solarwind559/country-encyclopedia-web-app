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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('official_name')->nullable();
            $table->string('country_code', 3)->nullable();
            $table->unsignedBigInteger('population')->nullable();
            $table->unsignedBigInteger('population_rank')->nullable();
            $table->string('flag')->nullable();
            $table->float('area')->nullable();
            $table->json('neighbors')->nullable();
            $table->json('languages')->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->json('translations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
