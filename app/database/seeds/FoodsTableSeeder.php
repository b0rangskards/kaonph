<?php

class FoodsTableSeeder extends MasterTableSeeder {

	public function run()
	{
		$restaurants = Restaurant::lists('id');
		$foodTypesId = FoodType::lists('id');

		foreach($restaurants as $id)
		{
			foreach(range(1,15) as $index)
			{
				Food::create([
					'restaurant_id' => $id,
					'type_id' => $this->faker->randomElement($foodTypesId),
					'name' => $this->faker->unique(true, 10000)->firstName,
					'price' => $this->faker->randomFloat(3, 50, 500),
					'details' => $this->faker->paragraph()
				]);
			}
		}
	}

	public function createSlug()
	{
		// TODO: Implement createSlug() method.
	}
}