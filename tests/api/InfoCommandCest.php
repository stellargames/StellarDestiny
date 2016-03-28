<?php
namespace api;

use FunctionalTester;
use Stellar\Contracts\CommandHandlerInterface;

class InfoCommandCest
{

    /**
     * @var CommandHandlerInterface
     */
    protected $handler;

    public function _before(FunctionalTester $I)
    {
        // Get the command handler.
        $this->handler = $I->getApplication()->make('Stellar\Contracts\CommandHandlerInterface');
    }


    public function _after(FunctionalTester $I)
    {
    }


    public function tryToCallInfoCommand(FunctionalTester $I)
    {
        //$result = $this->handler->handle('info');
        //$I->assertTrue($result->succeeded(), 'Checking command success');
    }



}
