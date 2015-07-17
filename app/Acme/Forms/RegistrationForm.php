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
        'password'  =>      'required|alpha_num|min:6|confirmed'

    ];

} 