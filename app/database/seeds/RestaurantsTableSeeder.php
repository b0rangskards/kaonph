<?php

use Laracasts\TestDummy\Factory as TestDummyFactory;

class RestaurantsTableSeeder extends MasterTableSeeder {

	private $restaurants = [
		'Chikaan' => [
			'coordinates' => '10.311414859766117,123.8943886756897',
			'type'        => 'filipino',
			'logo'        => 'chikaan.jpg'
		],
		'Jolibee' => [
			'coordinates' => '10.312048192662012,123.91734838485718',
			'type'        => 'fastfood',
			'logo'        => 'jollibee.jpg'
		],
		'Mcdo' => [
			'coordinates' => '10.317959238256728,123.90498876571655',
			'type'        => 'fastfood',
			'logo'        => 'mcdo.jpg'
		],
		'Sunburst' => [
			'coordinates' => '10.32788110089246,123.90576124191284',
			'type'        => 'fine dining',
			'logo'        => 'sunburst.jpg'
		],
		'Casa Verde' => [
			'coordinates' => '10.310148190153349,123.90061140060425',
			'type'        => 'fine dining',
			'logo'        => 'casaverde.jpg'
		],
		'Ching Palace' => [
			'coordinates' => '10.331005367299943,123.90032172203064',
			'type'        => 'fine dining',
			'logo'        => 'ching-palace.jpg'
		]
	];

	public function run()
	{
		$ptBRFaker = Faker\Factory::create('pt_BR');

		foreach($this->restaurants as $name => $details)
		{
			$owner = TestDummyFactory::create('User', [
				'role_id' => 2
			]);

			$r = new Restaurant();

			Restaurant::create([
				'owner_id'      => $owner->id,
				'name'          => $name,
				'address'       => $this->faker->unique(true, 1000)->address,
				'type'          => $details['type'],
				'contact_no'    => $ptBRFaker->phoneNumber,
				'logo'          => $details['logo'],
				'coordinates'   => $details['coordinates']
			]);
		}
	}

	public function createSlug()
	{
		// TODO: Implement createSlug() method.
	}
}