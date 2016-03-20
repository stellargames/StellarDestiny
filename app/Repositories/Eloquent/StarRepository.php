<?php

namespace Stellar\Repositories\Eloquent;

use Stellar\Contracts\NameGenerator;
use Stellar\Exceptions\GalaxyException;
use Stellar\Models\Star;
use Stellar\Repositories\Contracts\StarRepositoryInterface;

/**
 * Class StarRepository
 * @package Stellar
 */
class StarRepository implements StarRepositoryInterface
{

    const GALAXY_SMALL = 50;
    const GALAXY_MEDIUM = 150;
    const GALAXY_LARGE = 500;

    /**
     * @var Star[]
     */
    protected $stars = [ ];

    /**
     * @var NameGenerator
     */
    protected $nameGenerator;


    /**
     * Galaxy constructor.
     *
     * @param NameGenerator $nameGenerator
     */
    public function __construct(NameGenerator $nameGenerator) {
        $this->nameGenerator = $nameGenerator;
    }


    /**
     * @param Star $star
     *
     * @throws GalaxyException
     */
    public function addStar(Star $star) {
        $name = $star->name;
        if (array_key_exists($name, $this->stars)) {
            throw new GalaxyException('Duplicate star name: ' . $name);
        }
        $this->stars[$name] = $star;
    }


    /**
     * @return int
     */
    public function getSize() {
        return Star::all()->count();
    }


    /**
     * @param int $amount
     *
     * @throws GalaxyException
     */
    public function generateStars($amount) {
        for ($i = 0; $i < $amount; $i++) {
            $name = $this->generateUniqueStarName();
            $star = Star::create([ 'name' => $name ]);
            $this->addStar($star);
        }
        if ($amount > 0) {
            $this->linkAllStars();
        }
        $this->save();
    }


    /**
     * @param Star $star
     * @param Star $otherStar
     *
     * @throws GalaxyException
     */
    protected function linkTwoStars(Star $star, Star $otherStar) {
        if ($star === $otherStar) {
            throw new GalaxyException('Stars cannot link to themselves.');
        }
        $star->linkTo($otherStar);
        $otherStar->linkTo($star);
    }


    /**
     * @throws GalaxyException
     */
    protected function linkAllStars() {
        $unlinkedStars = $this->getUnlinkedStars();
        $linkedStars   = $this->getLinkedStars();
        $star          = $this->getLinkStartingStar($linkedStars, $unlinkedStars);
        unset($unlinkedStars[$star->name]);
        while (count($unlinkedStars) > 0) {
            $id           = array_rand($unlinkedStars);
            $unlinkedStar = $unlinkedStars[$id];
            $this->linkTwoStars($unlinkedStar, $star);
            $linkedStars[$id] = $unlinkedStar;
            unset($unlinkedStars[$id]);
            $star = $linkedStars[array_rand($linkedStars)];
        }
    }


    /**
     * @return array
     */
    public function getAllStars() {
        if (count($this->stars) === 0) {
            $this->stars = Star::all()->toArray();
        }

        return $this->stars;
    }


    /**
     * @return array
     */
    protected function getUnlinkedStars() {
        /* @var Star $star */
        $unlinkedStars = [ ];
        foreach ($this->stars as $name => $star) {
            if ($star->exits()->get()->count() === 0) {
                $unlinkedStars[$name] = $star;
            }
        }

        return $unlinkedStars;
    }


    /**
     * @return array
     */
    protected function getLinkedStars() {
        /* @var Star $star */
        $linkedStars = [ ];
        foreach ($this->stars as $name => $star) {
            if ($star->exits()->get()->count() > 0) {
                $linkedStars[$name] = $star;
            }
        }

        return $linkedStars;
    }


    /**
     * Helper method to get a starting star when creating links.
     *
     * @param $linkedStars
     * @param $unlinkedStars
     *
     * @return mixed
     */
    protected function getLinkStartingStar($linkedStars, $unlinkedStars) {
        if (count($linkedStars) === 0) {
            $star = $unlinkedStars[array_rand($unlinkedStars)];

            return $star;
        } else {
            $star = $linkedStars[array_rand($linkedStars)];

            return $star;
        }
    }


    /**
     * @return string
     */
    protected function generateUniqueStarName() {
        do {
            $name = $this->nameGenerator->generateName();
        } while (array_key_exists($name, $this->stars));

        return $name;
    }


    /**
     * @return Star
     */
    public static function getStartingStar() {
        return Star::all()->random();
    }


    /**
     * @return void
     */
    public function save() {
        foreach ($this->stars as $star) {
            $star->push();
        }
    }


    /**
     * @param $size
     * 
     * @throws GalaxyException
     */
    public function createNew($size) {
        $this->deleteAllStars();
        $this->generateStars($size);
    }


    public function deleteAllStars() {
        Star::getQuery()->delete();
        $this->stars = [ ];
    }

}
