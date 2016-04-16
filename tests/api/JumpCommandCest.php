<?php

class JumpCommandCest
{

    protected $galaxy;


    public function _before(ApiTester $I)
    {
        $I->amAuthenticated();
    }


    public function _after(ApiTester $I)
    {
    }


    // tests
    public function jumpWithoutDestinationFails(ApiTester $I)
    {
        $request = [
          'command'   => 'jump',
          'arguments' => [],
        ];

        $I->sendPOST('command', $request);
        $I->seeResponseContainsJson(['success' => false]);
    }


    public function jumpToNowhereFails(ApiTester $I)
    {
        $request = [
          'command'   => 'jump',
          'arguments' => ['destination' => null],
        ];

        $I->sendPOST('command', $request);
        $I->seeResponseContainsJson(['success' => false]);
    }


    public function jumpToGarbageFails(ApiTester $I)
    {
        $request = [
          'command'   => 'jump',
          'arguments' => ['destination' => ['foo']],
        ];

        $I->sendPOST('command', $request);
        $I->seeResponseContainsJson(['success' => false]);
    }


    public function canJump(ApiTester $I)
    {
        $galaxy  = Galaxy::createNew(50);
        $star    = $galaxy->getStartingStar();
        $request = [
          'command'   => 'jump',
          'arguments' => ['destination' => [$star->getName()]],
        ];

        $I->sendPOST('command', $request);
        $I->seeResponseContainsJson(['success' => true]);
    }

}
