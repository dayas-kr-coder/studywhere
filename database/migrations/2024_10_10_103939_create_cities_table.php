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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('country_id');
            $table->string('name', 255);
            $table->string('state_name', 255);
            $table->string('country_name', 255);
            $table->string('state_code', 255);
            $table->boolean('flag')->default(true);
            $table->char('country_code', 2);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('wikiDataId', 255)->nullable();
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
