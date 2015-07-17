<?php  namespace Acme\Forms; 

use Laracasts\Validation\FormValidator;

class AddMenuToRestaurantForm extends FormValidator {

	/**
	 * Validation rules.
	 *
	 * @var array
	 */
	protected $rules = [

		'name'          => 'required|min:3',
		'type'          => 'required|exists:food_types,id',
		'restaurant'    => 'required|exists:restaurants,id',
		'price'         => 'required|numeric',
		'picture'       => 'mimes:jpeg,png'

	];
} 