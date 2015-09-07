<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class Restaurant extends \Eloquent {

	use PresentableTrait, SoftDeletingTrait;

	protected $fillable = ['owner_id', 'name', 'address', 'type', 'coordinates', 'contact_no', 'logo'];

	protected $geofields = ['coordinates'];

	protected $presenter = 'Acme\Presenters\RestaurantPresenter';

	protected $dates = ['deleted_at'];

	public function isOwner()
	{
		return Auth::check() && Auth::user()->id == $this->owner_id;
	}


	public static function newRestaurant($ownerId, $name, $address, $type, $coordinates, $contact_no)
	{
		$restaurant = new static(compact('name', 'address', 'type', 'coordinates', 'contact_no'));

		$restaurant->owner_id = $ownerId;

		return $restaurant;
	}

	public static function updateRestaurant($id, $name, $address, $type, $contact_no, $coordinates)
	{
		$restaurant = static::find($id);

		$restaurant->name = $name;
		$restaurant->address = $address;
		$restaurant->type = $type;
		$restaurant->contact_no = $contact_no;
		$restaurant->coordinates = $coordinates;

		return $restaurant;
	}

	public static function closeRestaurant($restaurantId)
	{
		$restaurant = static::findOrFail($restaurantId);

		$restaurant->delete();

		return $restaurant;
	}

	public static function reOpenRestaurant($restaurantId)
	{
		$restaurant = static::withTrashed()
			->findOrFail($restaurantId);

		$restaurant->restore();

		return $restaurant;
	}


	public function newQuery($excludeDeleted = true)
	{
		$query = '';
		foreach ( $this->geofields as $column ) {
			$query .= ' ASTEXT(' . $column . ') as ' . $column . ' ';
		}

		return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($query));
	}

	public static function getCancelledFoods($restaurantId)
	{
		return Food::onlyTrashed()
			->where('restaurant_id', $restaurantId)
			->get();
	}

	public function getSpecialty()
	{
		return self::getFoodSpecialty($this->id);
	}

	public static function hasFoodSpecialty($restaurantId)
	{
		return self::getFoodSpecialty($restaurantId) !== false;
	}

	public static function getFoodSpecialty($restaurantId)
	{
		$query = Food::where('restaurant_id', $restaurantId)
			->where('is_specialty', 1);

		return !$query
			->get()
			->isEmpty()
			? $query->first()
			: false;
	}

	public function getVisitors()
	{
		return Customer::with('user')
			->distinct('user_id')
		    ->where('restaurant_id', $this->id)
			->orderBy('date_visited', 'DESC')
			->get();
	}

	public function getVisitorsListName()
	{
		$list = "";

		$visitors = Customer::with('user')
			->where('restaurant_id', $this->id)
			->groupBy('restaurant_id')
			->orderBy('date_visited', 'DESC')
			->get();
		foreach($visitors as $visitor)
		{
			$list .= $visitor->user()->first()->present()->fullName ."\n";
		}
		return $list;
	}

	public function getLovedCustomers()
	{
//		return Customer::distinct()
//			->select('user_id')
//			->where('restaurant_id', $this->id)
//			->where('rating', '3')
//			->get();

		return Customer::
		with('user')
		->distinct()
		->select('user_id')
		->where('restaurant_id', $this->id)
		->where('rating', '3')
		->get();
	}

	public function getLovedCustomersList()
	{
		$list = "";
		foreach($this->getLovedCustomers() as $customer)
		{
			$list .= $customer->user->present()->fullName . "<br>";
		}
		return $list;
	}

	public function getJustFineCustomers()
	{
//		return Customer::distinct()
//			->select('user_id')
//			->where('customers.restaurant_id', $this->id)
//			->where('customers.rating', '2')
//			->get();
		return Customer::distinct()
			->with('user')
			->select('user_id')
			->where('customers.restaurant_id', $this->id)
			->where('customers.rating', '2')
			->get();
	}

	public function getJustFineCustomersList()
	{
		$list = "";
		foreach ( $this->getJustFineCustomers() as $customer ) {
			$list .= $customer->user->present()->fullName . "<br>";
		}
		return $list;
	}

	public function getDislikeCustomers()
	{
//		return Customer::distinct()
//			->select('user_id')
//			->where('customers.restaurant_id', $this->id)
//			->where('customers.rating', '1')
//			->get();
		return Customer::distinct()
			->with('user')
			->select('user_id')
			->where('customers.restaurant_id', $this->id)
			->where('customers.rating', '1')
			->get();
	}

	public function getDislikeCustomersList()
	{
		$list = "";
		foreach ( $this->getDislikeCustomers() as $customer ) {
			$list .= $customer->user->present()->fullName . "<br>";
		}
		return $list;
	}

	public static function isExist($restaurantName, $address)
	{
		return !static::where('name', $restaurantName)
			->where('address', $address)
			->get()
			->isEmpty();
	}

	// todo
	public function getRatings($customers, $restaurantId)
	{
		$total = 0; $lovedPercentage = 0;
		$likedPercentage = 0; $dislikePercentage = 0;
		$lovedTotal = 0; $likedTotal = 0; $dislikeTotal = 0;

		if ( !$customers->isEmpty() ) {
			$total = Customer::getDistinctTotalCount($restaurantId);

			$lovedTotal = $this->getLovedCustomers()->count();
			$likedTotal = $this->getJustFineCustomers()->count();
			$dislikeTotal = $this->getDislikeCustomers()->count();

			//get percentage
			$lovedPercentage = $lovedTotal == 0 ? 0 : round(($lovedTotal / $total) * 100);
			$likedPercentage = $likedTotal == 0 ? 0 : round(($likedTotal / $total) * 100);
			$dislikePercentage = $dislikeTotal == 0 ? 0 : round(($dislikeTotal / $total) * 100);
		}

		return [
			'total'         => $total,
			'loved_total'   => $lovedTotal,
			'liked_total'   => $likedTotal,
			'disliked_total'=> $dislikeTotal,
			'loved_perc'    => $lovedPercentage,
			'liked_perc'    => $likedPercentage,
			'disliked_perc' => $dislikePercentage
		];
	}

	public function getFoodTypesAvailable()
	{
		return Food::with('type')
			->where('restaurant_id', $this->id)
			->groupBy('restaurant_id', 'type_id')
			->get();
	}

	public function customers()
	{
		return $this->belongsTo('Customer', 'id', 'restaurant_id');
	}

	public function food()
	{
		return $this->belongsTo('Food');
	}

	public function menu()
	{
		return $this->hasMany('Food', 'restaurant_id', 'id');
	}

	/* Scope Query */

	public function getDistinctFoodTypes()
	{
		return DB::table('restaurants')
			->select(['food_types.id', 'food_types.name'])
			->distinct()
			->leftJoin('foods', 'foods.restaurant_id', '=', 'restaurants.id')
			->leftJoin('food_types', 'food_types.id', '=', 'foods.type_id')
			->where('restaurants.id', $this->id)
			->orderBy('food_types.id')
			->get();
	}

	public function scopeDistance($query, $dist, $location)
	{
		return $query->whereRaw('st_distance(coordinates,POINT(' . $location . ')) < ' . $dist);

	}


	/* Mutators */

	public function setNameAttribute($value)
	{
		$this->attributes['name'] = strtolower($value);
	}

	public function setAddressAttribute($value)
	{
		$this->attributes['address'] = strtolower($value);
	}

	public function setTypeAttribute($value)
	{
		$this->attributes['type'] = strtolower($value);
	}

	public function setCoordinatesAttribute($value)
	{
		$this->attributes['coordinates'] = DB::raw("POINT($value)");
	}

	public function getCoordinatesAttribute($value)
	{
		$coords = substr($value, 6);
		$coords = preg_replace('/[ ,]+/', ',', $coords, 1);

		return substr($coords, 0, -1);
	}



}