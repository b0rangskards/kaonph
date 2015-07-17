<?php  namespace Acme\Forms; 

use Laracasts\Validation\FormValidator;

class CheckinForm extends FormValidator {

	protected  $rules = [

		'restaurant_id' => 'required|exists:restaurants,id',
		'rating'        => 'required|numeric|digits_between:1,3'

	];
} 