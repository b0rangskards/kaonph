<?php  namespace Acme\Forms; 

use Laracasts\Validation\FormValidator;

class MakeFoodSpecialtyForm extends FormValidator {


	/**
	 * Validation rules.
	 *
	 * @var array
	 */
	protected $rules = [


		'restaurant_id' => 'required|exists:restaurants,id',
		'food_id'       => 'required|exists:foods,id'

	];

} 