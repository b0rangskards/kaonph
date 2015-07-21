<?php  namespace Acme\Restaurants; 

use Acme\Base\BaseRepositoryInterface;
use Acme\Helpers\DataHelper;
use Auth;
use Config;
use Customer;
use DB;
use Faker\Factory\Factory;
use Restaurant;
use Faker\Factory as Faker;

class RestaurantRepository implements BaseRepositoryInterface {

	public function save(Restaurant $restaurant)
	{
		return $restaurant->save();
	}

	public function getRestaurantsWithCustomer()
	{
		return Restaurant::with('customers')
			->get();
	}

	public function getAllLovedRestaurants()
	{
		$result = [];

		$restaurants = $this->getRestaurantsWithCustomer();

		$ratings = [];
		foreach($restaurants as $r){
			$ratings = $r->getRatings($r->customers()->get(), $r->id);

			if($ratings['loved_total'] > $ratings['liked_total'] && $ratings['loved_total'] > $ratings['disliked_total']) {
				$result[] = $r->toArray();
			}
		}
		return $result;
	}

	public function getLovedRestaurants($userId)
	{
		return Restaurant::whereHas('customers', function($query) use($userId){
			$query->distinct('user_id', 'restaurant_id', 'rating');
			$query->where('user_id', $userId);
			$query->where('rating', '3');
		})->with('customers')
			->get();
	}

	public function getLikedRestaurants($userId)
	{
		return Restaurant::whereHas('customers', function ($query) use ($userId) {
			$query->distinct('user_id', 'restaurant_id', 'rating');
			$query->where('user_id', $userId);
			$query->where('rating', '2');
		})->with('customers')
			->get();
	}

	public function getDislikedRestaurants($userId)
	{
		return Restaurant::whereHas('customers', function ($query) use ($userId) {
			$query->distinct('user_id', 'restaurant_id', 'rating');
			$query->where('user_id', $userId);
			$query->where('rating', '1');
		})->with('customers')
			->get();
	}

	public function getPlacesByCurl()
	{
		$restaurants = DataHelper::getRestaurantsByCurl();
		$ownerId = Auth::user()->id;

		$ptBRFaker = Faker::create('pt_BR');

		foreach($restaurants as $restaurant) {
			$r = new Restaurant();
			$r->owner_id    = $ownerId;
			$r->name        = $restaurant['name'];
			$r->address     = $restaurant['address'];
			$r->type        = 'fine dining';
			$r->contact_no	= $ptBRFaker->landline;
			$r->coordinates = $restaurant['coordinates']['lat'] .','. $restaurant['coordinates']['lng'];
			$r->save();
		}
	}

	public function getTableData()
	{
		// TODO: Implement getTableData() method.
	}

	public function getTableColumns()
	{
		// TODO: Implement getTableColumns() method.
	}
}