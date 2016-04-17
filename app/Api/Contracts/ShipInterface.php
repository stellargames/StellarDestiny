<?php
namespace Stellar\Api\Contracts;

use Stellar\Exceptions\ShipException;
use Stellar\Models\ShipType;
use Stellar\Repositories\Contracts\StarInterface;

interface ShipInterface
{

    /**
     * The player that owns the ship.
     *
     * @return PlayerInterface
     */
    public function getOwner();


    /**
     * The type or class of ship.
     *
     * @return ShipType
     */
    public function getType();


    /**
     * The items installed on the ship.
     *
     * @return array
     */
    public function getItems();

    /**
     * The items installed on the ship.
     *
     * @return array
     */
    public function getName();


    /**
     * Calculate the total energy storage from the available jumpstores.
     *
     * @return int
     */
    public function getEnergyCapacity();


    /**
     * Calculate the total shield capacity from the available shields.
     *
     * @return int
     */
    public function getShields();
    
    /**
     * Get the amount of structure points this ship has.
     *
     * @return int
     */
    public function getStructure();
    
    /**
     * Get the amount of credits store on this ship.
     *
     * @return int
     */
    public function getCredits();


    /**
     * Calculate the total armor value from the available armor items.
     *
     * @return int
     */
    public function getArmor();


    /**
     * Calculate the total power from the available kinetic weapons.
     *
     * @return int
     */
    public function getKinetics();


    /**
     * Calculate the total power value from the available beam weapons.
     *
     * @return int
     */
    public function getBeams();


    /**
     * @return int
     */
    public function getEnergy();


    /**
     * @return StarInterface
     */
    public function getLocation();


    /**
     * @param int $energy
     *
     * @return ShipInterface
     */
    public function setEnergy($energy);


    /**
     * @param int $amount
     *
     * @return ShipInterface
     */
    public function addEnergy($amount);


    /**
     * @param int $amount
     *
     * @return ShipInterface
     */
    public function drainEnergy($amount);


    /**
     * @param StarInterface $location
     *
     * @return ShipInterface
     */
    public function setLocation(StarInterface $location);


    /**
     * Unset location.
     *
     * @return ShipInterface
     */
    public function unsetLocation();


    /**
     * @return array
     */
    public function scanForJumpPoints();


    /**
     * @param StarInterface $destination
     *
     * @return ShipInterface
     * @throws ShipException
     */
    public function jumpTo(StarInterface $destination);


    /**
     * Scan for ships in the same location.
     *
     * @return array
     */
    public function scanForShips();
}
