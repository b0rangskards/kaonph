<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->string('email', 50);
            $table->string('password', 60);
			$table->string('firstname', 100);
			$table->string('lastname', 100);
			$table->string('birthdate', 100);
			$table->string('gender', 6);
			$table->string('occupation', 20)->nullable();

			$table->string('remember_token', 100);
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
		Schema::drop('users');
	}

}
