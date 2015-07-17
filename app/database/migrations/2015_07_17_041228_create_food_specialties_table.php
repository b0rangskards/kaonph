<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFoodSpecialtiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('food_specialties', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('restaurant_id')->unsigned();
			$table->integer('food_id')->unsigned();

			$table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
			$table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('food_specialties');
	}

}
