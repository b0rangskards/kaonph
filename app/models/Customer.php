<?php

class Customer extends \Eloquent {

	protected $fillable = ['user_id', 'restaurant_id', 'date_visited', 'rating'];

	public $timestamps = false;

	public static function checkIn($user_id, $restaurant_id, $date_visited, $rating)
	{
		return new static(compact('user_id', 'restaurant_id', 'date_visited', 'rating'));
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