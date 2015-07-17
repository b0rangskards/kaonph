<?php
namespace FunctionalTester;

use Auth;
use Config;
use LoginPage;
use URL;

class UserSteps extends \FunctionalTester
{

    protected $I;

    function __construct($scenario)
    {
        parent::__construct($scenario);
        $this->I = $this;
    }

    public function signInAsUser()
    {
        $myPassword = 'mypassword123';

        $user = $this->I->have('User', [
           'role_id'  => Config::get('enums.roles.public'),
           'password' => $myPassword
        ]);

        $this->signIn($user->email, $myPassword);
    }

    public function signInAsOwner()
    {
        $myPassword = 'mypassword123';

        $user = $this->I->have('User', [
            'role_id' => Config::get('enums.roles.owner'),
            'password' => $myPassword
        ]);

        $this->signIn($user->email, $myPassword);

	    return $user;
    }

    public function signInAsAdmin()
    {
        $myPassword = 'mypassword123';

        $user = $this->I->have('User', [
            'role_id' => Config::get('enums.roles.admin'),
            'password' => $myPassword
        ]);

        $this->signIn($user->email, $myPassword);
    }

    public function signIn($email, $password)
    {
        $this->I->sendAjaxPostRequest(URL::route(LoginPage::$route), [
            'email'    => $email,
            'password' => $password]);

        $this->I->seeResponseCodeIs(200);

        $this->I->assertTrue(Auth::check());
    }



}