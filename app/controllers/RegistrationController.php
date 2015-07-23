<?php

use Acme\Forms\RegistrationForm;
use Acme\Helpers\DataHelper;
use Acme\Helpers\ResponseHelper;
use Acme\Registration\RegistrationCommand;

class RegistrationController extends \BaseController {

    protected $registrationForm;

    function __construct(RegistrationForm $registrationForm)
    {
        $this->registrationForm = $registrationForm;
    }


    /**
	 * Store a newly created resource in storage.
	 * POST /registration
	 *
	 * @return Response
	 */
	public function store()
	{
        try
        {
	        Log::info(Input::all());

            $this->registrationForm->validate(Input::all());

            $this->execute(RegistrationCommand::class);

            $message = ['message'   => 'Congratulations! You have successfully registered.',
                        'redirecTo' => URL::route('home')];

            return ResponseHelper::message($message);

        } catch ( Laracasts\Validation\FormValidationException $exception ) {

            $errors = DataHelper::getErrorDataFromException($exception);

            return ResponseHelper::errorMessage($errors);
        }
	}

}