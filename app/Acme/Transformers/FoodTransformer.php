<?php  namespace Acme\Transformers; 

use URL;

class FoodTransformer extends Transformer {

	public function transform($food)
	{
		return [
			'id' => $food['id'],
			'restaurant_id' => $food['restaurant_id'],
			'type_id' => $food['type_id'],
			'name' => ucwords($food['name']),
			'price' => $food['price'],
			'image' => $food['picture'] ? URL::asset('images/restaurants').'/'.strtolower($food['restaurant']['name'] . '/' . $food['picture']) : null,
			'details' => $food['details'],
			'is_specialty' => $food['is_specialty']
		];
	}
}