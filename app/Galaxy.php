<?php
/**
 * Created by PhpStorm.
 * User: Kender
 * Date: 26-Jan-16
 * Time: 19:31
 */

namespace Stellar;

use Stellar\Helpers\NameGenerator;

/**
 * Class Galaxy
 * @package Stellar
 */
class Galaxy
{

    const GALAXY_SMALL = 50;
    const GALAXY_MEDIUM = 150;
    const GALAXY_LARGE = 500;

    /**
     * @var array
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
     */
    public function addStar(Star $star) {
        $this->stars[$star->getName()] = $star;
    }


    /**
     * @return int
     */
    public function getSize() {
        return count($this->stars);
    }


    /**
     * @param int $size
     */
    public function generateStars($size) {
        for ($i = 0; $i < $size; $i++) {
            $name = $this->generateUniqueStarName();
            $this->addStar(new Star($name));
        }
        if ($size > 0) {
            $this->linkAllStars();
        }
    }


    /**
     * @param Star $star
     * @param Star $otherStar
     */
    protected function linkTwoStars(Star $star, Star $otherStar) {
        $star->linkTo($otherStar);
        $otherStar->linkTo($star);
    }


    /**
     *
     */
    protected function linkAllStars() {
        $unlinkedStars = $this->getUnlinkedStars();
        $linkedStars   = $this->getLinkedStars();
        $star          = $this->getLinkStartingStar($linkedStars, $unlinkedStars);
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
        return $this->stars;
    }


    /**
     * @return array
     */
    protected function getUnlinkedStars() {
        /* @var Star $star */
        $unlinkedStars = [ ];
        foreach ($this->stars as $name => $star) {
            $jumpPoints = $star->getJumpPoints();
            if (count($jumpPoints) === 0) {
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
            $jumpPoints = $star->getJumpPoints();
            if (count($jumpPoints) > 0) {
                $linkedStars[$name] = $star;
            }
        }

        return $linkedStars;
    }


    /**
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
            $name = $this->nameGenerator->generateStarName();
        } while (array_key_exists($name, $this->stars));

        return $name;
    }

}
