<?php

namespace Stellar;

class Star
{

    /** @var string */
    protected $name;

    /**
     * @var JumpPoint[]
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
     * @param Star $star
     */
    public function linkTo(Star $star) {
        $jumpPoint = new JumpPoint($this, $star);
        $this->jumpPoints[] = $jumpPoint;
    }

}
