<?php

use Stellar\Exceptions\ShipException;
use Stellar\Models\Ship;
use Stellar\Models\Star;

class ShipCest
{

    /** @var Ship */
    protected $ship;


    public function _before(FunctionalTester $I)
    {
        $this->ship   = new Ship();
        $startingStar = Star::create(['name' => 'source']);
        $this->ship->setLocation($startingStar);
    }


    public function _after(FunctionalTester $I)
    {
    }


    public function jumpWithoutALocation(FunctionalTester $I)
    {
        $destinationStar = $this->createLinkedStar();
        $this->ship->unsetLocation();
        $this->assertJumpFails($I, $destinationStar);
    }


    public function jumpToAnUnlinkedStar(FunctionalTester $I)
    {
        $destinationStar = Star::create(['name' => 'unlinked']);
        $this->assertJumpFails($I, $destinationStar);
    }


    public function jumpWithoutEnergy(FunctionalTester $I)
    {
        $this->ship->setEnergy(0);
        $destinationStar = $this->createLinkedStar();
        $this->assertJumpFails($I, $destinationStar);
    }


    public function jumpToALinkedStar(FunctionalTester $I)
    {
        $destinationStar = $this->createLinkedStar();
        $this->makeJump($destinationStar);
        $I->assertEquals($destinationStar, $this->ship->getLocation());
    }


    public function jumpingTakesEnergy(FunctionalTester $I)
    {
        $this->makeJump($this->createLinkedStar());
        $I->assertLessThan(1, $this->ship->getEnergy());
    }


    /**
     * @param \FunctionalTester $I
     * @param Star              $destinationStar
     */
    protected function assertJumpFails(FunctionalTester $I, $destinationStar)
    {
        $exceptionThrown = false;
        try {
            $this->ship->jumpTo($destinationStar);
        } catch (ShipException $exception) {
            $exceptionThrown = true;
        }
        $I->assertTrue($exceptionThrown, 'Expected exception not thrown.');
    }


    /**
     * @param Star $destinationStar
     *
     * @return null|\Stellar\Models\Star
     * @throws \Stellar\Exceptions\ShipException
     */
    protected function makeJump($destinationStar)
    {
        $this->ship->setEnergy(1);
        $this->ship->jumpTo($destinationStar);
    }


    /**
     * Create a star that is linked to the ships current location.
     *
     * @return Star
     */
    protected function createLinkedStar()
    {
        $star = Star::create(['name' => 'linked']);
        $this->ship->getLocation()->linkTo($star);
        return $star;
    }

}
