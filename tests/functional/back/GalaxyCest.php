<?php

use Stellar\Exceptions\GalaxyException;
use Stellar\Models\Star;
use Stellar\Repositories\Eloquent\StarRepository;

class GalaxyCest
{

    /**
     * @var StarRepository
     */
    protected $galaxy;


    public function _before(FunctionalTester $I) {
        $generator = Mockery::mock('\Stellar\Contracts\NameGenerator');
        $generator->shouldReceive('generateName')->andReturnUsing(
            function () {
                return str_random(8);
            }
        );
        $this->galaxy = new StarRepository($generator);
        $this->galaxy->deleteAllStars();
    }


    public function _after(FunctionalTester $I) {
        Mockery::close();
    }


    public function makeASmallGalaxy(FunctionalTester $I) {
        $this->galaxy->createNew(StarRepository::GALAXY_SMALL);
        $size = $this->galaxy->getSize();
        $I->assertEquals(StarRepository::GALAXY_SMALL, $size);
    }


    public function addMoreStars(FunctionalTester $I) {
        $this->galaxy->createNew(StarRepository::GALAXY_SMALL);
        $this->galaxy->generateStars(StarRepository::GALAXY_SMALL);
        $size = $this->galaxy->getSize();
        $I->assertEquals(StarRepository::GALAXY_SMALL * 2, $size);
    }


    public function checkThatAllStarsHaveAName(FunctionalTester $I) {
        $this->galaxy->createNew(StarRepository::GALAXY_SMALL);
        $stars = $this->galaxy->getAllStars();
        foreach ($stars as $star) {
            $I->assertNotEmpty($star->name);
        }
    }


    public function duplicateStarNamesAreForbidden(FunctionalTester $I) {
        $exceptionThrown = false;
        $star            = new Star([ 'name' => 'a name' ]);
        $this->galaxy->addStar($star);
        $anotherStar = new Star([ 'name' => 'a name' ]);
        try {
            $this->galaxy->addStar($anotherStar);
        } catch (GalaxyException $exception) {
            $exceptionThrown = true;
        }
        $I->assertTrue($exceptionThrown);
    }


    public function allStarsHaveAtLeastOneJumpPoint(FunctionalTester $I) {
        $this->galaxy->createNew(StarRepository::GALAXY_SMALL);
        $stars = $this->galaxy->getAllStars();
        foreach ($stars as $star) {
            $jumpPoints = $star->exits;
            $I->assertGreaterThanOrEqual(1, count($jumpPoints));
        }
    }


    public function travelToAllStars(FunctionalTester $I) {
        $this->galaxy->createNew(StarRepository::GALAXY_LARGE);
        $count = $this->howManyStarsCanWeVisit();
        $I->assertEquals(StarRepository::GALAXY_LARGE, $count);
    }


    /**
     * @return int
     */
    protected function howManyStarsCanWeVisit() {
        $stars   = $this->galaxy->getAllStars();
        $star    = reset($stars);
        $visited = [ $star->name ];
        $queue   = [ $star ];
        while (count($queue) > 0) {
            $star = array_pop($queue);
            $exits = $star->exits;
            foreach ($exits as $exit) {
                $destination = $exit->name;
                if ( ! in_array($destination, $visited, false)) {
                    $queue[]   = $exit;
                    $visited[] = $destination;
                }
            }
        }

        return count($visited);
    }

}
