<?php

use Stellar\Exceptions\ShipException;
use Stellar\Models\Star;
use Stellar\Models\Ship;

class ShipCest
{

    protected $destinationStar;

    /** @var Ship */
    protected $ship;


    public function _before(FunctionalTester $I) {
        $this->destinationStar = Star::create([ 'name' => 'destination' ]);
        $this->ship            = new Ship();
        $startingStar          = Star::create([ 'name' => 'source']);
        $this->ship->setLocation($startingStar);
        $this->ship->addEnergy(10);
    }


    public function _after(FunctionalTester $I) {
    }


    public function jumpWithoutALocation(FunctionalTester $I) {
        $this->ship->unsetLocation();
        $exceptionThrown = false;
        try {
            $this->ship->jumpTo($this->destinationStar);
        } catch (ShipException $exception) {
            $exceptionThrown = true;
        }
        $I->assertTrue($exceptionThrown, 'Expected exception not thrown.');
    }


    public function jumpToAnUnlinkedStar(FunctionalTester $I) {
        $exceptionThrown = false;
        try {
            $this->ship->jumpTo($this->destinationStar);
        } catch (ShipException $exception) {
            $exceptionThrown = true;
        }
        $I->assertTrue($exceptionThrown, 'Expected exception not thrown.');
    }


    public function jumpWithoutEnergy(FunctionalTester $I) {
        $exceptionThrown = false;
        try {
            $this->ship->jumpTo($this->destinationStar);
        } catch (ShipException $exception) {
            $exceptionThrown = true;
        }
        $I->assertTrue($exceptionThrown, 'Expected exception not thrown.');
    }


    public function jumpToALinkedStar(FunctionalTester $I) {
        $location = $this->ship->getLocation();
        $location->linkTo($this->destinationStar);
        $this->ship->jumpTo($this->destinationStar);
        $I->assertEquals($this->destinationStar, $this->ship->getLocation());
    }


    public function jumpingTakesEnergy(FunctionalTester $I) {
        $this->ship->getLocation()->linkTo($this->destinationStar);
        $before = $this->ship->getEnergy();
        $this->ship->jumpTo($this->destinationStar);
        $I->assertLessThan($before, $this->ship->getEnergy());
    }
    

}
