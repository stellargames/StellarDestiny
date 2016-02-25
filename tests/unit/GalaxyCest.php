<?php

use Stellar\Exceptions\GalaxyException;
use Stellar\Galaxy;
use Stellar\JumpPoint;
use Stellar\Star;

class GalaxyCest
{

    /**
     * @var Galaxy
     */
    protected $galaxy;


    public function _before(UnitTester $I) {
        $generator = Mockery::mock('\Stellar\Contracts\NameGenerator');
        $generator->shouldReceive('generateName')->andReturnUsing(
                function () {
                    return str_random(12);
                }
            );
        $this->galaxy = new Galaxy($generator);
    }


    public function _after(UnitTester $I) {
        Mockery::close();
    }


    public function makeASmallGalaxy(UnitTester $I) {
        $this->galaxy->generateStars(Galaxy::GALAXY_SMALL);
        $size = $this->galaxy->getSize();
        $I->assertEquals(Galaxy::GALAXY_SMALL, $size);
    }


    public function addMoreStars(UnitTester $I) {
        $this->galaxy->generateStars(Galaxy::GALAXY_SMALL);
        $this->galaxy->generateStars(Galaxy::GALAXY_SMALL);
        $size = $this->galaxy->getSize();
        $I->assertEquals(Galaxy::GALAXY_SMALL * 2, $size);
    }


    public function checkThatAllStarsHaveAName(UnitTester $I) {
        /* @var Star $star */
        $this->galaxy->generateStars(Galaxy::GALAXY_SMALL);
        $stars = $this->galaxy->getAllStars();
        foreach ($stars as $star) {
            $I->assertNotEmpty($star->getName());
        }
    }


    public function duplicateStarNamesAreForbidden(UnitTester $I) {
        $exceptionThrown = false;
        $star            = new Star('a name');
        $this->galaxy->addStar($star);
        $anotherStar = new Star('a name');
        try {
            $this->galaxy->addStar($anotherStar);
        } catch (GalaxyException $exception) {
            $exceptionThrown = true;
        }
        $I->assertTrue($exceptionThrown);
    }


    public function allStarsHaveAtLeastOneJumpPoint(UnitTester $I) {
        /* @var Star $star */
        $this->galaxy->generateStars(Galaxy::GALAXY_SMALL);
        $stars = $this->galaxy->getAllStars();
        foreach ($stars as $star) {
            $jumpPoints = $star->getJumpPoints();
            $I->assertGreaterThanOrEqual(1, count($jumpPoints));
        }
    }


    public function travelToAllStars(UnitTester $I) {
        $this->galaxy->generateStars(Galaxy::GALAXY_LARGE);
        $count = $this->howManyStarsCanWeVisit();
        $I->assertEquals(Galaxy::GALAXY_LARGE, $count);
    }


    /**
     * @return int
     */
    protected function howManyStarsCanWeVisit() {
        /* @var Star $star */
        /* @var JumpPoint $jumpPoint */
        $stars   = $this->galaxy->getAllStars();
        $star    = reset($stars);
        $visited = [ $star ];
        $queue   = [ $star ];
        while (count($queue) > 0) {
            $star       = array_pop($queue);
            $jumpPoints = $star->getJumpPoints();
            foreach ($jumpPoints as $jumpPoint) {
                $destination = $jumpPoint->getDestination();
                if ( ! in_array($destination, $visited, true)) {
                    $queue[]   = $destination;
                    $visited[] = $destination;
                }
            }
        }

        return count($visited);
    }

}
