<?php
namespace api;

use Mockery;
use Stellar\Api\Commands\JumpCommand;
use Stellar\Api\Contracts\CommandResultInterface;
use Stellar\Api\Contracts\PlayerInterface;
use Stellar\Api\Contracts\ShipInterface;
use Stellar\Repositories\Contracts\StarInterface;
use Stellar\Repositories\Contracts\StarRepositoryInterface;
use UnitTester;

class JumpCommandCest
{

    /** @var  JumpCommand */
    protected $command;

    protected $player;

    protected $galaxy;

    protected $ship;

    protected $destinationStar;

    protected $commandArguments;


    public function _before(UnitTester $I)
    {
        $this->destinationStar = Mockery::mock(StarInterface::class);
        $this->ship            = Mockery::mock(ShipInterface::class);
        $this->player          = Mockery::mock(PlayerInterface::class, ['getShip' => $this->ship]);
        $this->galaxy          = Mockery::mock(StarRepositoryInterface::class);
        $this->ship->shouldReceive('getEnergy')->andReturn(1)->byDefault();
        $this->ship->shouldReceive('scanForJumpPoints')->andReturn([$this->destinationStar])->byDefault();
        $this->galaxy->shouldReceive('getStarByName')->with(null)->andReturn(null);
        $this->galaxy->shouldReceive('getStarByName')->with('destination')->andReturn($this->destinationStar);

        $this->commandArguments = ['player' => $this->player, 'galaxy' => $this->galaxy];
        $this->command          = new JumpCommand($this->player, $this->galaxy);
    }


    public function _after(UnitTester $I)
    {
        Mockery::close();
    }


    // tests
    public function failToJumpWithoutDestination(UnitTester $I)
    {
        $result = $this->command->execute();
        $this->assertFailure($I, $result, 'No destination provided');
    }


    public function failToJumpWithAnEmptyDestination(UnitTester $I)
    {
        $this->commandArguments['destination'] = null;
        $result                                = $this->command->execute($this->commandArguments);
        $this->assertFailure($I, $result, 'Illegal destination provided');
    }


    public function failToJumpToAnUnlinkedDestination(UnitTester $I)
    {
        $this->commandArguments['destination'] = 'destination';
        $this->ship->shouldReceive('scanForJumpPoints')->once()->andReturn([]);
        $result = $this->command->execute($this->commandArguments);
        $this->assertFailure($I, $result, 'Illegal destination provided');
    }


    public function failToJumpWithoutEnergy(UnitTester $I)
    {
        $this->commandArguments['destination'] = 'destination';
        $this->ship->shouldReceive('getEnergy')->once()->andReturn(0);
        $result = $this->command->execute($this->commandArguments);
        $this->assertFailure($I, $result, 'Insufficient energy');
    }


    public function performJump(UnitTester $I)
    {
        $this->commandArguments['destination'] = 'destination';
        $this->ship->shouldReceive('setLocation')->once()->with($this->destinationStar);
        $result = $this->command->execute($this->commandArguments);
        $I->assertTrue($result->succeeded(), 'Expected result to be successful');
    }


    /**
     * @param \UnitTester            $I
     * @param CommandResultInterface $result
     */
    protected function assertFailure(UnitTester $I, CommandResultInterface $result, $message = null)
    {
        $I->assertTrue($result->failed(), 'Expected result to be failed');
        $I->assertFalse($result->succeeded(), 'Expected result to nt be succeeded');
        $I->assertFalse($result->hasData(), 'Expected result not to have data');
        if ($message !== null) {
            $I->assertContains($message, $result->getMessages(), 'Expected a specific message to be there');
        }
    }

}
