<?php  namespace Acme\Forms; 

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator {

    /**
     * Validation rules.
     *
     * @var array
     */
    protected $rules = [

        'email'     =>      'required|email|unique:users',
        'password'  =>      'required|alpha_num|min:6|confirmed',
	    'firstname' =>      'required|min:3',
	    'lastname'  =>      'required|min:3',
	    'birthdate' =>      'required|date',
	    'gender'    =>      'required|min:4|max:6',

    ];

} 