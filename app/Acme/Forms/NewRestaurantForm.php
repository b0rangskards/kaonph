<?php namespace Acme\Forms;


use Laracasts\Validation\FormValidator;

class NewRestaurantForm extends FormValidator {

	/**
	  * Validation rules.
	  *
	  * @var array
	  */
	 protected $rules = [

		 'name'         => 'required|min:3|company_name|unique:restaurants',
         'address'      => 'required|min:5',
		 'type'         => 'required',
		 'contact_no'   => 'required',
		 'logo'         => 'mimes:jpeg,png',
		 'coordinates'  => 'required'

	 ];

} 