<?php

use Laracasts\TestDummy\Factory as TestDummyFactory;

class RestaurantsTableSeeder extends MasterTableSeeder {

	private $restaurants = [
		'Chikaan sa Cebu' => [
			'coordinates' => '10.3292499,123.9029528',
			'type'        => 'filipino',
			'logo'        => 'chikaan.jpg',
			'address'     => 'Salinas Dr Cebu City',
			'contact_no'  => '032 233 0350'
		],
		'alejandros pata' => [
			'coordinates' => '10.311494, 123.894463',
			'type' => 'filipino',
			'address' => 'Century Plaza Commercial Complex, Juana Osmena Street, Kamputhaw, Cebu',
			'contact_no' => '032 2537921'
		],
		'Abuhan Dos' => [
			'coordinates' => '10.30901, 123.8948153',
			'type' => 'filipino',
			'address' => 'F. Ramos St Cebu City',
			'contact_no' => '032 2535774'
		],
		'Shamrock' => [
			'coordinates' => '10.3100921, 123.8925022',
			'type' => 'filipino',
			'address' => 'Capitol Site Cebu City',
			'contact_no' => '032 2546924'
		],
		'Larsian' => [
			'coordinates' => '10.3095107, 123.8918663',
			'type' => 'bbq & grill',
			'address' => 'B. Rodriguez Street, Capitol Site, Cebu City'
		],
		'Yatski Barbecue' => [
			'coordinates' => '10.3153809, 123.8898741',
			'type' => 'bbq & grill',
			'address' => '268-B Don Mariano Cui St Cebu City',
			'contact_no' => '032 4142008'
		],
		'Sunburst' => [
			'coordinates' => '10.3285078, 123.9050934',
			'type' => 'filipino',
			'logo' => 'sunburst.jpg',
			'address' => 'Calyx Centre, IT Park, Lahug, Cebu City',
			'contact_no' => '032 2394804'
		],
		'Jolibee' => [
			'coordinates' => '10.3253421, 123.918454',
			'type'        => 'fastfood',
			'logo'        => 'jollibee.jpg',
			'address'     => 'F. Cabahug Street, Mabolo, Cebu',
			'contact_no'  => '032 346 5463'
		],
		'Ching Palace' => [
			'coordinates' => '10.330659, 123.900318',
			'type'        => 'fine dining',
			'logo'        => 'ching-palace.jpg',
			'address'     => 'Salinas Dr Cebu City',
			'contact_no'  => '032 2338833'
		],
		'Tokyo Table' => [
			'coordinates' => '10.3266303, 123.9325714',
			'type' => 'japanese',
			'address' => 'City Time Square, Mantawe Avenue, Tipolo, Mandaue City, Cebu',
			'contact_no' => '032 2397000'
		],
		'Fujinoya' => [
			'coordinates' => '10.3313835, 123.8999112',
			'type' => 'japanese',
			'address' => 'Wilson Street, Lahug, Cebu',
			'contact_no' => '032 2315238'
		],
		'Azabu' => [
			'coordinates' => '10.3301483, 123.8972281',
			'type' => 'japanese',
			'address' => 'JY Square Prestigio, Gorordo Avenue, Lahug, Cebu',
			'contact_no' => '032 2396849'
		],
		'Sumo Sam' => [
			'coordinates' => '10.3185028, 123.9051202',
			'type' => 'japanese',
			'address' => 'Ground Floor, The Terraces, Ayala Center Cebu, Cebu ',
			'contact_no' => '032 4010643'
		],
		'Kiyomizu' => [
			'coordinates' => '10.3268026,123.9294025',
			'type' => 'japanese',
			'address' => 'Second Floor, Arcada 5, Lopez Jaena Street, Tipolo, Cebu',
			'contact_no' => '032 5209110'
		],
		'Chosun Galbi' => [
			'coordinates' => '10.343544, 123.915106',
			'type' => 'korean',
			'address' => ' A. S. Fortuna Street, Banilad, Cebu',
			'contact_no' => '032 2392281'
		],
		'4.15 Korean BBQ' => [
			'coordinates' => '10.3190322, 123.9007911',
			'type' => 'korean',
			'address' => 'FLC Center, Hernan Cortes Street, Subangdaku, Cebu',
			'contact_no' => '032 5202087'
		],
		'Chicken & Beer' => [
			'coordinates' => '10.3301869, 123.9066946',
			'type' => 'korean',
			'address' => 'G/F Skyrise 4 Building Padriga St Cebu City',
			'contact_no' => '032 2669201'
		],
		'BonChon' => [
			'coordinates' => '10.318476, 123.904763',
			'type' => 'korean',
			'address' => ' Second Floor, The Terraces, Ayala Center Cebu, Cebu ',
			'contact_no' => '032 2662388'
		],
		'Maroo Korean Restaurant' => [
			'coordinates' => '10.343555, 123.910471',
			'type' => 'korean',
			'address' => 'Paseo Saturnino, Ma. Luisa Road, Banilad, Cebu',
			'contact_no' => '+63 9173294694'
		],
		'Harbour City' => [
			'coordinates' => '10.312502, 123.917112',
			'type' => 'chinese',
			'address' => 'Lower Ground Floor, SM City Cebu, North Reclamation Area, Cebu',
			'contact_no' => '032 2320741'
		],
		'Spice Fusion' => [
			'coordinates' => '10.312502, 123.917112',
			'type' => 'chinese',
			'address' => 'Upper Ground Floor, North Wing, SM CIty Cebu, North Reclamation Area, Cebu',
			'contact_no' => '032 2389591'
		],
		'Manila Foodshoppe' => [
			'coordinates' => '10.2953429, 123.8994291',
			'type' => 'chinese',
			'address' => 'Manalili St Cebu City',
			'contact_no' => '032 2554567'
		],
		'Wang Shan Lo - Crown Regency Hotel' => [
			'coordinates' => '10.307856, 123.894523',
			'type' => 'chinese',
			'address' => '20th Floor, Tower 2, Crown Regency Hotel & Towers, Osmeña Boulevard, Jones, Cebu',
			'contact_no' => '032 4187777'
		],
		'Big Mao' => [
			'coordinates' => '10.3185503, 123.9045484',
			'type' => 'chinese',
			'address' => 'Second Floor, The Terraces, Ayala Center Cebu, Cebu Business Park, Cebu',
			'contact_no' => '032 4171334'
		],
		'Flame It' => [
			'coordinates' => '10.317352, 123.905991',
			'type' => 'pizza & burgers',
			'address' => 'Luz - Level 4, Ayala Center, Cebu Business Park, Cebu City, Cebu',
			'contact_no' => '032 2318923'
		],
		'Burger Joint' => [
			'coordinates' => '10.324121, 123.909373',
			'type' => 'pizza & burgers',
			'address' => 'The Gallery, Juan Luna Avenue, Kasambagan, Cebu',
			'contact_no' => '032 2311010'
		],
		'Pizza Republic' => [
			'coordinates' => '10.3291028, 123.9027652',
			'type' => 'pizza & burgers',
			'address' => 'Salinas Dr Cebu City',
			'contact_no' => '032 2663397'
		],
		'Ryans Pizzarelli' => [
			'coordinates' => '10.3059828, 123.8974074',
			'type' => 'pizza & burgers',
			'address' => 'Don Jose Avilla Street, Ma. Cristina Extension, Capitol Site, Cebu',
			'contact_no' => '032 3478827'
		],
		'Yellow Cab' => [
			'coordinates' => '10.3107274, 123.898383',
			'type' => 'pizza & burgers',
			'address' => 'Gen. Maxilom Ave. Cebu City',
			'contact_no' => '032 2537711'
		],
		"Sizzlin' Pepper Steak" => [
			'coordinates' => '10.3181867, 123.9049852',
			'type' => 'steak house',
			'address' => 'The Terraces, Ayala Center, Cebu City',
			'contact_no' => '032 2327824'
		],
		'Olio' => [
			'coordinates' => '10.3277929, 123.9099213',
			'type' => 'steak house',
			'address' => 'The Crossroads, Gov. M. Cuenco Avenue, Kasambagan, Cebu',
			'contact_no' => '032 2323589'
		],
		'Mooshy Steakhauz' => [
			'coordinates' => '10.3002633, 123.8986395',
			'type' => 'steak house',
			'address' => 'P. Del Rosario Street, Colon, Cebu',
			'contact_no' => '032 4151968'
		],
	];

	public function run()
	{
		$ptBRFaker = Faker\Factory::create('pt_BR');

		foreach($this->restaurants as $name => $details)
		{
			$r = new Restaurant();

			Restaurant::create([
				'owner_id'      => User::where('email', 'waynearila@gmail.com')->first()->id,
				'name'          => $name,
				'address'       => isset($details['address']) ? $details['address'] : '',
				'type'          => $details['type'],
				'contact_no'    => isset($details['contact_no']) ? $details['contact_no'] : $ptBRFaker->landline,
				'logo'          => isset($details['logo']) ? $details['logo'] : '',
				'coordinates'   => $details['coordinates']
			]);
		}
	}

	public function createSlug()
	{
		// TODO: Implement createSlug() method.
	}
}