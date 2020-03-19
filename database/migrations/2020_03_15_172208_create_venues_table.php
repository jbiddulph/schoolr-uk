<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('venuename');
            $table->string('venuetype')->nullable();
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('town');
            $table->string('county')->nullable();
            $table->string('postcode');
            $table->string('postalsearch');
            $table->string('telephone')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('website')->nullable();
            $table->string('photo')->default('venue-default.png');
            $table->integer('is_live')->default('1');
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
        Schema::dropIfExists('venues');
    }
}
