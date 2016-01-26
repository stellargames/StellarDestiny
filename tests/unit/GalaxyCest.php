<?php

use Stellar\Galaxy;

class GalaxyCest
{

    /**
     * @var Galaxy
     */
    protected $galaxy;


    public function _before(UnitTester $I) {
        $this->galaxy = new Galaxy();
    }


    public function _after(UnitTester $I) {
    }


    public function anEmptyGalaxyHasNoSize(UnitTester $I) {
        $size = $this->galaxy->getSize();
        $I->assertNull($size);
    }


    public function addSmallGalaxyHasAFewStars(UnitTester $I) {
        $this->galaxy->generateStars(Galaxy::GALAXY_SMALL);
        $size = $this->galaxy->getSize();
        $I->assertEquals(Galaxy::GALAXY_SMALL, $size);
    }


    public function aStarHasAName(UnitTester $I) {
        $this->galaxy->generateStars(Galaxy::GALAXY_SMALL);
        $star = $this->galaxy->getAStar();
        $I->assertNotEmpty($star->getName());
    }

}
