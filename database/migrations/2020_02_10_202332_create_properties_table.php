<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->integer('user_id');
            $table->integer('company_id');
            $table->string('propname');
            $table->integer('propcost');
            $table->integer('proptype_id');
            $table->string('propimage');
            $table->integer('bedroom')->default(0);
            $table->integer('bathroom')->default(0);
            $table->integer('kitchen')->default(0);
            $table->integer('garage')->default(0);
            $table->integer('reception')->default(0);
            $table->integer('conservatory')->default(0);
            $table->integer('outbuilding')->default(0);
            $table->string('address');
            $table->string('town');
            $table->string('county');
            $table->string('postcode');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('description');
            $table->string('floorplan');
            $table->string('brochure');
            $table->date('last_date');
            $table->integer('category_id');
            $table->integer('is_featured')->default(0);
            $table->integer('is_live')->default(0);
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
        Schema::dropIfExists('properties');
    }
}
