<?php

use Acme\Forms\LogInForm;
use Acme\Helpers\DataHelper;
use Acme\Helpers\ResponseHelper;

class SessionsController extends \BaseController {

    private $logInForm;

    function __construct(LogInForm $logInForm)
    {
        $this->logInForm = $logInForm;
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /sessions
	 *
	 * @return Response
	 */
	public function store()
	{
		try
        {
            $this->logInForm->validate(Input::only('email', 'password'));

            $message = ['message' => 'You are now logged in.',
                'redirecTo' => URL::route('home')];

            return ResponseHelper::message($message);

        } catch ( Laracasts\Validation\FormValidationException $exception ) {

            $errors = DataHelper::getErrorDataFromException($exception);

            return ResponseHelper::errorMessage($errors);
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /sessions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
        Auth::logout();

        Session::flush();

        $message = ['message'   => 'You have now been logged out.',
                    'redirecTo' => URL::route('index')];

        return ResponseHelper::message($message);
	}

}