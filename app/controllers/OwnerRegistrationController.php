<?php

use Acme\Forms\RegistrationForm;
use Acme\Helpers\DataHelper;
use Acme\Helpers\ResponseHelper;
use Acme\Registration\OwnerRegistrationCommand;

class OwnerRegistrationController extends \BaseController {

    protected $registrationForm;

    function __construct(RegistrationForm $registrationForm)
    {
        $this->registrationForm = $registrationForm;
    }

    /**
	 * Store a newly created resource in storage.
	 * POST /ownerregistration
	 *
	 * @return Response
	 */
	public function store()
	{
		try
        {
            $this->registrationForm->validate(Input::all());

            $this->execute(OwnerRegistrationCommand::class);

            $message = ['message'   => 'Congratulations! You have successfully registered.',
                        'redirecTo' =>  URL::route('restaurants.index')];

            return ResponseHelper::message($message);

        } catch ( Laracasts\Validation\FormValidationException $exception ) {

            $errors = DataHelper::getErrorDataFromException($exception);

            return ResponseHelper::errorMessage($errors);
        }
	}

}