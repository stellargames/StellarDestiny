<?php
namespace api;

use ApiTester;
use Stellar\Models\User;

class InfoCommandCest
{

    public function _before(ApiTester $I)
    {
        $I->amAuthenticated();
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
