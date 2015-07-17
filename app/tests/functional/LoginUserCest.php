<?php
use \FunctionalTester;

/**
 * @guy FunctionalTester\UserSteps
 */
class LoginUserCest
{
    private $user;

    private $myPassword = 'mypassword123';

    public function _before(FunctionalTester $I)
    {
        $this->user = $I->have('User', [
           'role_id' => Config::get('enums.roles.public'),
           'password'=> $this->myPassword
        ]);
    }

    // tests
    public function try_to_login_with_valid_data(FunctionalTester $I)
    {
        $I->am('a registered user');

        $I->wantTo('login to my account');

        $I->sendAjaxPostRequest(URL::route(LoginPage::$route), [
            'email'    => $this->user->email,
            'password' => $this->myPassword
        ]);

        $I->seeResponseCodeIs(200);

        $I->assertTrue(Auth::check());
    }

    public function try_to_login_with_invalid_data(FunctionalTester $I)
    {
        $I->am('a registered user');

        $I->wantTo('login to my account with invalid data');

        $I->sendAjaxPostRequest(URL::route(LoginPage::$route), [
            'email' => 'dsadsadsa',
            'password' => $this->myPassword
        ]);

        $I->seeResponseCodeIs(400);

        $I->assertFalse(Auth::check());
    }
}