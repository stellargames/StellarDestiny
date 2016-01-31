<?php

use Stellar\Galaxy;
use Stellar\Star;

class GalaxyCest
{

    /**
     * @var Galaxy
     */
    protected $galaxy;


    public function _before(UnitTester $I) {
        $this->galaxy = new Galaxy(new \Stellar\Helpers\NameGenerator());
    }


    public function _after(UnitTester $I) {
    }


    public function aSmallGalaxyHasAFewStars(UnitTester $I) {
        $this->galaxy->generateStars(Galaxy::GALAXY_SMALL);
        $size = $this->galaxy->getSize();
        $I->assertEquals(Galaxy::GALAXY_SMALL, $size);
    }


    public function youCanAddMoreStars(UnitTester $I) {
        $this->galaxy->generateStars(Galaxy::GALAXY_SMALL);
        $this->galaxy->generateStars(Galaxy::GALAXY_SMALL);
        $size = $this->galaxy->getSize();
        $I->assertEquals(Galaxy::GALAXY_SMALL * 2, $size);
    }


    public function allStarsHaveAName(UnitTester $I) {
        /* @var Star $star */
        $this->galaxy->generateStars(Galaxy::GALAXY_SMALL);
        $stars = $this->galaxy->getAllStars();
        foreach ($stars as $star) {
            $I->assertNotEmpty($star->getName());
        }
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
        /* @var Star $star */
        $this->galaxy->generateStars(Galaxy::GALAXY_LARGE);
        $stars                     = $this->galaxy->getAllStars();
        $star                      = reset($stars);
        $visited[$star->getName()] = true;
        $queue                     = [ $star ];
        while (count($queue) > 0) {
            $star       = array_pop($queue);
            $jumpPoints = array_keys($star->getJumpPoints());
            foreach ($jumpPoints as $jumpPoint) {
                if ( ! array_key_exists($jumpPoint, $visited)) {
                    $queue[]             = $stars[$jumpPoint];
                    $visited[$jumpPoint] = true;
                }
            }
        }
        $I->assertEquals(Galaxy::GALAXY_LARGE, count($visited));
    }

}
