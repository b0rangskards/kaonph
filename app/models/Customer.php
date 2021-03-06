<?php

class Customer extends \Eloquent {

	protected $fillable = ['user_id', 'restaurant_id', 'date_visited', 'rating'];

	public $timestamps = false;

	public static function checkIn($user_id, $restaurant_id, $date_visited, $rating)
	{
		return new static(compact('user_id', 'restaurant_id', 'date_visited', 'rating'));
	}

	public static function getDistinctTotalCount($restaurantId)
	{
		return static::distinct()
			->select('user_id','rating')
			->where('restaurant_id', $restaurantId)
			->get()
			->count();
	}

	public function visitHistory()
	{
		return static::where('user_id', $this->user_id)
			->where('restaurant_id', $this->restaurant_id)
			->get();
	}

	public function timesVisited()
	{
		return $this->visitHistory()->count();
	}

	public function restaurant()
	{
		return $this->belongsTo('Restaurant');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}
}