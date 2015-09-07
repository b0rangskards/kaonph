<?php

class UsersTableSeeder extends MasterTableSeeder {

	public function run()
	{
		User::create([
			'role_id' => '2',
			'email'   => 'waynearila@gmail.com',
			'password' => 'watdapak',
			'firstname' => 'wayne',
			'lastname' => 'abarquez',
			'birthdate' => '1989-09-08',
			'gender' => 'male',
			'occupation' => 'tambay'
		]);
	}

	public function createSlug()
	{
		// TODO: Implement createSlug() method.
	}
}