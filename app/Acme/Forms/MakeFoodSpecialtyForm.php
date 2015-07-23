<?php  namespace Acme\Forms; 

use Laracasts\Validation\FormValidator;
use Restaurant;

class MakeFoodSpecialtyForm extends FormValidator {


	/**
	 * Validation rules.
	 *
	 * @var array
	 */
	protected $rules = [

		'restaurant_id' => 'required|numeric|exists:restaurants,id',
		'food_id'       => 'required|numeric|exists:foods,id'

	];

} 