<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysOnFoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('foods', function(Blueprint $table)
		{
			$table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
			$table->foreign('type_id')->references('id')->on('food_types')->onDelete('cascade');

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('foods', function(Blueprint $table)
		{
			$table->dropForeign('foods_restaurant_id_foreign');
			$table->dropForeign('foods_type_id_foreign');
		});
	}

}
