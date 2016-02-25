<?php

use Stellar\Exceptions\ShipException;
use Stellar\Galaxy;
use Stellar\Ship;
use Stellar\Star;

class ShipCest
{

    protected $destinationStar;

    /** @var Ship */
    protected $ship;


    public function _before(UnitTester $I) {
        $this->destinationStar = new Star('destination');
        $this->ship   = new Ship();
        $startingStar = new Star('source');
        $this->ship->setLocation($startingStar);
        $this->ship->addEnergy(10);

    }


    public function _after(UnitTester $I) {
    }


    public function jumpWithoutALocation(UnitTester $I) {
        $this->ship->unsetLocation();
        $exceptionThrown = false;
        try {
            $this->ship->jumpTo($this->destinationStar);
        } catch (ShipException $exception) {
            $exceptionThrown = true;
        }
        $I->assertTrue($exceptionThrown, 'Expected exception not thrown.');
    }


    public function jumpToAnUnlinkedStar(UnitTester $I) {
        $exceptionThrown = false;
        try {
            $this->ship->jumpTo($this->destinationStar);
        } catch (ShipException $exception) {
            $exceptionThrown = true;
        }
        $I->assertTrue($exceptionThrown, 'Expected exception not thrown.');
    }


    public function jumpWithoutEnergy(UnitTester $I) {
        $exceptionThrown = false;
        try {
            $this->ship->jumpTo($this->destinationStar);
        } catch (ShipException $exception) {
            $exceptionThrown = true;
        }
        $I->assertTrue($exceptionThrown, 'Expected exception not thrown.');
    }


    public function jumpToALinkedStar(UnitTester $I) {
        $this->ship->getLocation()->linkTo($this->destinationStar);
        $this->ship->jumpTo($this->destinationStar);
        $I->assertEquals($this->destinationStar, $this->ship->getLocation());
    }


    public function jumpingTakesEnergy(UnitTester $I) {
        $this->ship->getLocation()->linkTo($this->destinationStar);
        $before = $this->ship->getEnergy();
        $this->ship->jumpTo($this->destinationStar);
        $I->assertLessThan($before, $this->ship->getEnergy());
    }


    public function travelThroughAGalaxy(UnitTester $I) {
        $size = Galaxy::GALAXY_LARGE;
        $this->createGalaxyAndPlaceShip($size);
        $count = $this->howManyStarsCanWeVisit();
        $I->assertEquals($size, $count);
    }


    /**
     * @param $size
     *
     * @throws ShipException
     */
    protected function createGalaxyAndPlaceShip($size) {
        $galaxy = new Galaxy(new \Stellar\Helpers\StarNameGenerator());
        $galaxy->generateStars($size);
        $this->ship->unsetLocation();
        $star = $galaxy->getStartingStar();
        $this->ship->setLocation($star);
    }


    /**
     * @return int
     * @throws ShipException
     */
    protected function howManyStarsCanWeVisit() {
        /** @var \Stellar\JumpPoint $jumpPoint */
        $visited = [ ];
        $queue   = [ ];
        do {
            $jumpPoints = $this->ship->scanForJumpPoints();
            $unvisited  = 0;
            foreach ($jumpPoints as $jumpPoint) {
                $destination = $jumpPoint->getDestination();
                if ( ! array_key_exists($destination->getName(), $visited)) {
                    $queue[] = $jumpPoint;
                    $unvisited++;
                }
            }
            if ($unvisited <= 1) {
                $visited[$this->ship->getLocation()->getName()] = true;
            }
            if ($unvisited > 0) {
                $jumpPoint   = array_pop($queue);
                $destination = $jumpPoint->getDestination();
                $this->ship->addEnergy(1);
                $this->ship->jumpTo($destination);
            }
        } while ($unvisited > 0);

        return count($visited);
    }

}
