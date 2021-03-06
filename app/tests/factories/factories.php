<?php

use Laracasts\TestDummy\Factory;

$factory('User', function($faker) {
	$gender = array_rand(Config::get('enums.gender'));

	return [
		'role_id'       => $faker->numberBetween(1, 3),
		'email'         => $faker->unique(true, 100000)->email,
		'password'      => 'password1234',
		'firstname'     => $faker->unique(true, 10000)->firstName,
		'lastname'      => $faker->unique(true, 10000)->lastName,
		'birthdate'     => $faker->date(),
		'gender'        => $gender,
		'occupation'    => 'worker'
	];
});

$factory('User', 'owner', function($faker) {
	$gender = array_rand(Config::get('enums.gender'));

	return [
		'role_id'       => 2,
		'email'         => $faker->unique(true, 100000)->email,
		'password'      => 'password1234',
		'firstname'     => $faker->unique(true, 10000)->firstName,
		'lastname'      => $faker->unique(true, 10000)->lastName,
		'birthdate'     => $faker->date(),
		'gender'        => $gender,
		'occupation'    => 'worker'
	];
});

$factory('Restaurant', function($faker) {
	$ptBRFaker = Faker\Factory::create('pt_BR');

	$owner              = Factory::create('owner');
	$coords             =  $faker->latitude.','.$faker->longitude;
	$randomType         = $faker->randomElement(Config::get('enums.restauTypes'));

	return [
		'owner_id'     => $owner->id,
		'name'         => $faker->unique(true, 100000)->company,
		'address'      => $faker->unique(true, 100000)->address,
		'coordinates'  => $coords,
		'type'         => $randomType,
		'contact_no'   => $ptBRFaker->landline
	];
});

$factory('FoodType', [
		'name' => $faker->unique(true, 100000)->lastName
]);

$factory('Food', [
		'restaurant_id' => 'factory:Restaurant',
		'type_id'       => 'factory:FoodType',
		'name'          => $faker->unique(true, 100000)->name,
		'price'         => $faker->randomFloat(3, 50, 500),
		'details'       => $faker->paragraph()
]);