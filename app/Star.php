<?php
/**
 * Created by PhpStorm.
 * User: Kender
 * Date: 26-Jan-16
 * Time: 20:30
 */

namespace Stellar;

class Star
{

    /**
     * @var array
     */
    protected $jumpPoints = [ ];


    /**
     * Star constructor.
     *
     * @param string $name
     */
    public function __construct($name) {
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }


    /**
     * @return array
     */
    public function getJumpPoints() {
        return $this->jumpPoints;
    }


    /**
     * @param Star $otherStar
     */
    public function linkTo(Star $otherStar) {
        $this->jumpPoints[$otherStar->getName()] = true;
    }

}
