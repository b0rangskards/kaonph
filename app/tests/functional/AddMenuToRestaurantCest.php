<?php
use \FunctionalTester;
use Faker\Factory as Faker;

/**
 * @guy FunctionalTester\UserSteps
 */
class AddMenuToRestaurantCest
{
	private $foodData;

    public function _before(FunctionalTester $I)
    {
	    $faker = Faker::create();

	    $restau = $I->have('Restaurant');

	    $foodTypeLists = FoodType::lists('id');

	    $this->foodData = $I->buildDataFor('Food', [
		    'restaurant_id'     =>   $restau->id,
	        'type_id'           =>   $faker->randomElement($foodTypeLists)
	    ]);

    }

    // tests
    public function try_to_add_new_menu_to_restaurant_with_valid_data(FunctionalTester $I)
    {
	    $owner = $I->signInAsOwner();


	    dd(Auth::check());
	    $I->am('a added new menu to restaurant with role owner');

	    $I->wantTo('add new menu to restaurant');

	    $I->sendAjaxPostRequest(URL::route(FoodPage::$newFoodRoute), [
		    'restaurant_id' => $this->foodData['restaurant_id'],
		    'type_id'       => $this->foodData['type_id'],
		    'name'          => $this->foodData['name'],
		    'price'         => $this->foodData['price'],
		    'details'       => $this->foodData['details']
	    ]);

	    $I->seeResponseCodeIs(200);

	    $I->seeRecord(FoodPage::$tableName, [
		    'restaurant_id' => $this->foodData['restaurant_id'],
		    'type_id'       => $this->foodData['type_id'],
		    'name'          => strtolower($this->foodData['name']),
		    'price'         => round($this->foodData['price'],2),
		    'details'       => strtolower($this->foodData['details'])
	    ]);
    }
}