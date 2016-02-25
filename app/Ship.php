<?php

namespace Stellar;

use Stellar\Contracts\Locatable;
use Stellar\Exceptions\ShipException;

class Ship implements Locatable
{

    /** @var Star */
    protected $location;

    protected $energy;


    /**
     * @return Star
     */
    public function getLocation() {
        return $this->location;
    }


    /**
     * @return array
     */
    public function scanForJumpPoints() {
        if ($this->location === null) {
            return [ ];
        }

        return $this->location->getJumpPoints();
    }


    /**
     * @param $star
     *
     * @return $this
     * @throws ShipException
     */
    public function setLocation($star) {
        if ($this->location === null) {
            $this->location = $star;
        }
        else {
            throw new ShipException('Ship already has a location');
        }
        return $this;
    }


    /**
     * @param $destinationStar
     *
     * @return $this
     * @throws ShipException
     */
    public function jumpTo($destinationStar) {
        if ($this->energy <= 0) {
            throw new ShipException('Not enough energy to make jump.');
        }
        $jumpPoints = $this->scanForJumpPoints();
        foreach ($jumpPoints as $jumpPoint) {
            if ($jumpPoint->getDestination() === $destinationStar) {
                $this->location = $destinationStar;
                $this->energy--;
                return $this;
            }
        }
        throw new ShipException('No jumpPoint leading to destination found.');
    }


    public function addEnergy($amount) {
        $this->energy += $amount;
    }


    public function getEnergy() {
        return $this->energy;
    }


    public function unsetLocation() {
        $this->location = null;
    }

}
