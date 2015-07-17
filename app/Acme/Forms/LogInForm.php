<?php  namespace Acme\Forms; 

use Auth;
use Laracasts\Validation\FormValidationException;
use Laracasts\Validation\FormValidator;
use Log;
use User;

class LogInForm extends FormValidator {

    /**
     * Validation rules for the sign in form.
     *
     * @var array
     */
    protected $rules = [

        'email'    => 'required|email',

        'password' => 'required'

    ];

    /**
     * Validate the form data
     *
     * @param  mixed $formData
     * @return mixed
     * @throws FormValidationException
     */
    public function validate($formData)
    {
        $formData = $this->normalizeFormData($formData);
        $this->validation = $this->validator->make(
            $formData,
            $this->getValidationRules(),
            $this->getValidationMessages()
        );

        if ( $this->validation->fails() ) {
            throw new FormValidationException('Validation failed', $this->getValidationErrors());
        }

        if ( !Auth::attempt($formData))  throw new FormValidationException('Validation failed', ['error' => 'Invalid Username/Password.']);


        $user = User::where('email', $formData['email'])
                    ->active()
                    ->first();

        if ( is_null($user))  throw new FormValidationException('Validation failed', ['error' => 'Invalid Username/Password.']);

        return true;
    }


} 