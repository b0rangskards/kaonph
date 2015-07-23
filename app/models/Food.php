<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laracasts\Presenter\PresentableTrait;

class Food extends \Eloquent {

	use PresentableTrait, SoftDeletingTrait;

	protected $fillable = ['restaurant_id', 'type_id', 'name', 'price', 'details', 'picture', 'is_specialty'];

	protected $presenter = 'Acme\Presenters\FoodPresenter';

	protected $dates = ['deleted_at'];

	public static function newMenu($restaurant_id, $type_id, $name, $price, $details)
	{
		return new static(compact('restaurant_id', 'type_id', 'name', 'price', 'details'));
	}

	public static function updateMenu($food_id, $type_id, $name, $price, $details)
	{
		$food = static::findOrFail($food_id);

		$food->type_id = $type_id;
		$food->name = $name;
		$food->price = $price;
		$food->details = $details;

		return $food;
	}

	public static function makeSpecialty($foodId)
	{
		$food = static::findOrFail($foodId);

		$food->is_specialty = 1;

		return $food;
	}

	public static function cancelSpecialty($foodId)
	{
		$food = static::findOrFail($foodId);

		$food->is_specialty = 0;

		return $food;
	}

	public static function cancelFood($foodId)
	{
		$food = static::findOrFail($foodId);

		$food->is_specialty = 0;
		$food->save();

		$food->delete();


		return $food;
	}

	public static function offerFood($foodId)
	{
		$food = static::withTrashed()
			->findOrFail($foodId);

		$food->restore();

		return $food;
	}

	public function isASpecialty()
	{
		return $this->is_specialty === 1;
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