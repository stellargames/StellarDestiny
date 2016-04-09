<?php
namespace api;

use ApiTester;
use Stellar\Models\User;

class InfoCommandCest
{

    public function _before(ApiTester $I)
    {
        // Log in to get a token.
        $I->haveModel(User::class, [
          'name'     => 'John Doe',
          'email'    => 'john@doe.com',
          'status'   => User::REGISTERED,
          'password' => bcrypt('password'),
        ]);
        $I->sendPOST('login', ['email' => 'john@doe.com', 'password' => 'password']);
        $token = $I->grabDataFromResponseByJsonPath("$['data']['token']");
        $I->amBearerAuthenticated($token[0]);
        $I->haveHttpHeader('Accept', 'application/json');
    }


    public function _after(ApiTester $I)
    {
        //$I->sendGET('logout');
    }


    public function responseMatchesRequestId(ApiTester $I)
    {
        $request = [
          'command'   => 'info',
          'arguments' => [],
          'requestId' => 123,
        ];

        $I->sendPOST('command', $request);
        $I->seeResponseContainsJson(['requestId' => 123]);
    }


    public function tryToCallInfoCommand(ApiTester $I)
    {
        $request = [
          'command'   => 'info',
          'arguments' => [],
        ];

        $I->sendPOST('command', $request);
    }

}
