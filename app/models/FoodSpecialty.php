<?php

class FoodSpecialty extends \Eloquent {

	protected $fillable = ['restaurant_id', 'food_id'];

	public $timestamps = false;

	public $table = 'food_specialties';

	public function restaurant()
	{
		return $this->belongsTo('Restaurant', 'restaurant_id', 'id');
	}

	public function food()
	{
		return $this->belongsTo('Food', 'food_id', 'id');
	}

}