<?php
namespace Stellar\Api\Contracts;

use Stellar\Exceptions\ShipException;
use Stellar\Repositories\Contracts\StarInterface;

interface ShipInterface
{

    /**
     * The player that owns the ship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner();


    /**
     * The star the ship is currently at.
     *
     * @return StarInterface
     */
    public function location();


    /**
     * The type or class of ship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type();


    /**
     * The items installed on the ship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items();


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
     * @return StarInterface
     */
    public function getLocation();


    /**
     * @param StarInterface $location
     *
     * @return ShipInterface
     */
    public function setLocation(StarInterface $location);


    /**
     * Unset location.
     */
    public function unsetLocation();


    /**
     * @return array
     */
    public function scanForJumpPoints();


    /**
     * @param StarInterface $destination
     *
     * @return $this
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
