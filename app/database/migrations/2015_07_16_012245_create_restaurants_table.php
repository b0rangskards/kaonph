<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('owner_id')->unsigned();
			$table->string('name', 50);
			$table->string('address');
			$table->string('type', 50);
			$table->string('contact_no');
			$table->string('logo', 100)->nullable();
			$table->softDeletes();
			$table->timestamps();
		});

		DB::statement('ALTER TABLE restaurants ADD coordinates POINT');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('restaurants');
	}

}
