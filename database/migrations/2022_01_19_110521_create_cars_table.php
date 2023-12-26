<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('price')->nullable();
            $table->integer('provider_name')->nullable();
            $table->string('specification')->nullable();
            $table->string('rating')->nullable();
            $table->string('provider_location')->nullable();
            $table->string('important_information')->nullable();
            $table->string('security_deposit')->nullable();
            $table->string('damage_excess')->nullable();
            $table->string('fuel_policy')->nullable();
            $table->string('mileage')->nullable();
            $table->string('extra_information');
            $table->string('lan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
