<?php

use Laracasts\Presenter\PresentableTrait;

class Restaurant extends \Eloquent {

	use PresentableTrait;

	protected $fillable = ['owner_id', 'name', 'address', 'type', 'coordinates', 'contact_no', 'logo'];

	protected $geofields = ['coordinates'];

	protected $presenter = 'Acme\Presenters\RestaurantPresenter';


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


	public function newQuery($excludeDeleted = true)
	{
		$query = '';
		foreach ( $this->geofields as $column ) {
			$query .= ' ASTEXT(' . $column . ') as ' . $column . ' ';
		}

		return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($query));
	}

	public function hasFoodSpecialty()
	{
		return $this->getFoodSpecialty() !== false;
	}

	public function getFoodSpecialty()
	{
		return !FoodSpecialty::where('restaurant_id', $this->id)->get()->isEmpty() ? FoodSpecialty::where('restaurant_id', $this->id)->first()->food : false;
	}

	public function getVisitors()
	{
		return Customer::with('user')
//			->select(DB::raw('COUNT(user_id) AS num_visits, *'))
		    ->where('restaurant_id', $this->id)
			->groupBy('restaurant_id')
			->orderBy('date_visited', 'DESC')
			->get();
	}

//	public function getVisits()
//	{
//		return DB::table('customers')
//			->select( DB::raw('COUNT(user_id) AS num_visits, *') )
//	}

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
			$list .= $visitor->user()->first()->email ."\n";
		}
		return $list;
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