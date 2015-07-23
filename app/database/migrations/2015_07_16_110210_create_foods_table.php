<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('foods', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('restaurant_id')->unsigned();
			$table->integer('type_id')->unsigned();
			$table->string('name', 50);
			$table->decimal('price');
			$table->string('picture', 100)->nullable();
			$table->text('details')->nullable();
			$table->boolean('is_specialty')->nullable();
			$table->softDeletes();
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
		Schema::drop('foods');
	}

}
