<?php
use \FunctionalTester;

/**
 * @guy FunctionalTester\UserSteps
 */
class UserRegistrationCest
{
    private $userData;

    public function _before(FunctionalTester $I)
    {
        $this->userData = $I->buildDataFor('User');
    }

    // tests
    public function try_to_register_as_public_user(FunctionalTester $I)
    {
        $I->am('anonymous');

        $I->wantTo('register as public user');

        $I->sendAjaxPostRequest(URL::route(RegistrationPage::$routePublic), [
            'email'                 =>  $this->userData['email'],
            'password'              =>  $this->userData['password'],
            'password_confirmation' =>  $this->userData['password'],
	        'firstname'             =>  $this->userData['firstname'],
	        'lastname'              =>  $this->userData['lastname'],
	        'birthdate'             =>  $this->userData['birthdate'],
	        'gender'                =>  $this->userData['gender'],
	        'occupation'            =>  $this->userData['occupation']
        ]);

        $I->seeResponseCodeIs(200);

        $I->seeRecord(RegistrationPage::$usersTableName, [
            'role_id'  => Config::get('enums.roles.public'),
            'email'    => $this->userData['email']
        ]);

        $I->assertTrue(Auth::check());
    }

    public function try_to_register_with_invalid_data(FunctionalTester $I)
    {
        $invalidEmail = 'notAValidEmail';

        $I->am('anonymous');

        $I->wantTo('register as public user with invalid data');

        $I->sendAjaxPostRequest(URL::route(RegistrationPage::$routePublic), [
            'email' => $invalidEmail,
            'password' => 'dassa242332',
            'password_confirmation' => ''
        ]);

        $I->seeResponseCodeIs(400);

        $I->dontSeeRecord(RegistrationPage::$usersTableName, [
            'email' => $invalidEmail
        ]);
    }
}