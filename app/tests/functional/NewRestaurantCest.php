<?php
use \FunctionalTester;

/**
 * @guy FunctionalTester\UserSteps
 */
class NewRestaurantCest
{
	private $restauData;

    public function _before(FunctionalTester $I)
    {
		$this->restauData = $I->buildDataFor('Restaurant');
    }

    // tests
    public function try_to_add_new_restaurant_with_valid_data(FunctionalTester $I)
    {
	     $I->signInAsOwner();

		 $I->am('a registered user with role owner');

	     $I->wantTo('add new restaurant');

	     $I->sendAjaxPostRequest(URL::route(RestaurantPage::$newRestaurantRoute), [
	         'name'         => $this->restauData['name'],
	         'address'      => $this->restauData['address'],
		     'coordinates'  => $this->restauData['coordinates'],
		     'type'         => $this->restauData['type'],
		     'contact_no'   => $this->restauData['contact_no']
	     ]);

	     $I->seeResponseCodeIs(200);

	     $I->seeRecord(RestaurantPage::$tableName, [
		     'name'         => $this->restauData['name'],
		     'address'      => $this->restauData['address'],
		     'type'         => $this->restauData['type'],
		     'contact_no'   => $this->restauData['contact_no']
	     ]);

	    $restau = Restaurant::whereName(strtolower($this->restauData['name']))->first();

	    $I->assertEquals($restau->coordinates, $this->restauData['coordinates']);
    }


}