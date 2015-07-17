<?php

class Food_TypesTableSeeder extends MasterTableSeeder {

	private $types = [
		'Salad',
		'Appetizer',
		'Main Dish',
		'Desert',
		'Pasta',
		'Soup',
		'Seafoods',
		'Wine',
		'Beverages',
		'Shakes',
	];

	public function run()
	{

		foreach($this->types as $type)
		{
			FoodType::create([
				'name' => $type
			]);
		}
	}

	public function createSlug()
	{
		// TODO: Implement createSlug() method.
	}
}