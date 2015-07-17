<?php
use \FunctionalTester;

class OwnerRegistrationCest
{
    private $ownerData;

    public function _before(FunctionalTester $I)
    {
        $this->ownerData = $I->buildDataFor('User');
    }

    // tests
    public function try_to_register_owner(FunctionalTester $I)
    {
        $I->am('a restaurant owner');

        $I->wantTo('register');

        $I->sendAjaxPostRequest(URL::route(RegistrationPage::$routeOwner), [
            'email' => $this->ownerData['email'],
            'password' => $this->ownerData['password'],
            'password_confirmation' => $this->ownerData['password']
        ]);

        $I->seeResponseCodeIs(200);

        $I->seeRecord(RegistrationPage::$usersTableName, [
            'role_id' => Config::get('enums.roles.owner'),
            'email'   => $this->ownerData['email']
        ]);

        $I->assertTrue(Auth::check());
    }

    public function try_to_register_owner_with_invalid_data(FunctionalTester $I)
    {
        $invalidEmail = 'notAValidEmail';

        $I->am('anonymous');

        $I->wantTo('register owner with invalid data');

        $I->sendAjaxPostRequest(URL::route(RegistrationPage::$routeOwner), [
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