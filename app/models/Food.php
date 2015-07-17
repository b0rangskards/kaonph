<?php

use Laracasts\Presenter\PresentableTrait;

class Food extends \Eloquent {

	use PresentableTrait;

	protected $fillable = ['restaurant_id', 'type_id', 'name', 'price', 'details', 'picture'];

	protected $presenter = 'Acme\Presenters\FoodPresenter';

	public static function newMenu($restaurant_id, $type_id, $name, $price, $details)
	{
		return new static(compact('restaurant_id', 'type_id', 'name', 'price', 'details'));
	}

	public function isASpecialty()
	{
		return ! FoodSpecialty::where('food_id', $this->id)->get()->isEmpty();
	}

	public function type()
	{
		return $this->belongsTo('FoodType', 'type_id', 'id');
	}

	public function restaurant()
	{
		return $this->belongsTo('Restaurant');
	}

	/* Mutators */

	public function setNameAttribute($value)
	{
		$this->attributes['name'] = strtolower($value);
	}

	public function setPriceAttribute($value)
	{
		$this->attributes['price'] = round($value, 2);
	}

	public function setDetailsAttribute($value)
	{
		$this->attributes['details'] = strtolower($value);
	}
}