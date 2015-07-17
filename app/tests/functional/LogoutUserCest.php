<?php
use \FunctionalTester;

/**
 * @guy FunctionalTester\UserSteps
 */
class LogoutUserCest
{
    public function _before(FunctionalTester $I)
    {
        $I->signInAsUser();
    }

    // tests
    public function try_to_logout(FunctionalTester $I)
    {
        $I->am('a logged in user');

        $I->wantTo('logout');

        $I->assertTrue(Auth::check());

        $I->sendAjaxRequest('DELETE', URL::route('sessions.destroy'));

        $I->assertFalse(Auth::check());
    }
}