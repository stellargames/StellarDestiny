<?php

class AuthenticationCest
{

    protected $testCommand;


    public function _before(ApiTester $I)
    {
        $this->testCommand = 'command';
        $I->haveModel(\Stellar\Models\User::class, [
          'name'     => 'John Doe',
          'email'    => 'john@doe.com',
          'status'   => \Stellar\Models\User::REGISTERED,
          'password' => bcrypt('password'),
        ]);
        $I->haveHttpHeader('Accept', 'application/json');
    }


    public function _after(ApiTester $I)
    {
    }


    public function unauthenticatedAccessFails(ApiTester $I)
    {
        $I->sendPOST('command');
        $I->seeResponseCodeIs(401);
        $I->seeResponseContains('Unauthorized');
    }


    public function loginWithoutPasswordFails(ApiTester $I)
    {
        $I->sendPOST('login', ['email' => 'john@doe.com']);
        $token = $this->tryToGrabToken($I);
        $I->assertEmpty($token, 'No token is present');
    }


    public function loginWithWrongPasswordFails(ApiTester $I)
    {
        $I->sendPOST('login', ['email' => 'john@doe.com', 'password' => 'wrong']);
        $token = $this->tryToGrabToken($I);
        $I->assertEmpty($token, 'No token is present');
    }


    public function loginWithValidCredentialsGivesToken(ApiTester $I)
    {
        $I->sendPOST('login', ['email' => 'john@doe.com', 'password' => 'password']);
        $token = $this->tryToGrabToken($I);
        $I->assertNotEmpty($token, 'Token is present');
    }


    public function grabTokenAndAuthenticate(ApiTester $I)
    {
        $I->sendPOST('login', ['email' => 'john@doe.com', 'password' => 'password']);
        $token = $this->tryToGrabToken($I);
        $I->amBearerAuthenticated($token[0]);
        $I->sendPOST('command');
        $I->seeResponseCodeIs(200);
    }


    public function logoutToInvalidateToken(ApiTester $I)
    {
        $this->grabTokenAndAuthenticate($I);
        $I->sendGET('logout');
        $I->sendPOST('command');
        $I->seeResponseCodeIs(401);
    }


    protected function tryToGrabToken(ApiTester $I)
    {
        return $I->grabDataFromResponseByJsonPath("$['data']['token']");
    }


    /**
     * @param \ApiTester $I
     *
     * @return array
     */
    protected function grabToken(ApiTester $I)
    {
        $I->sendPOST('login', ['email' => 'john@doe.com', 'password' => 'password']);
        $token = $this->tryToGrabToken($I);
        $I->assertNotEmpty($token, 'Token is present');
        return $token;
    }

}
