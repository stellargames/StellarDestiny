<?php

namespace Stellar;

use Stellar\Contracts\Locatable;

class JumpPoint implements Locatable
{

    /** @var Star */
    protected $location;

    /** @var Star */
    protected $destination;


    /**
     * JumpPoint constructor.
     *
     * @param Star $location
     * @param Star $destination
     */
    public function __construct(Star $location, Star $destination) {
        $this->location    = $location;
        $this->destination = $destination;
    }


    /**
     * @return Star
     */
    public function getDestination() {
        return $this->destination;
    }


    /**
     * @return Star
     */
    public function getLocation() {
        return $this->location;
    }

}
