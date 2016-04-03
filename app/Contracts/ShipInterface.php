<?php
/**
 * Created by PhpStorm.
 * User: Kender
 * Date: 03-Apr-16
 * Time: 11:01
 */
namespace Stellar\Contracts;

use Stellar\Exceptions\ShipException;
use Stellar\Models\Ship;
use Stellar\Models\Star;

/**
 * Stellar\Models\Ship
 *
 * @property integer                                                                    $id
 * @property integer                                                                    $user_id
 * @property integer                                                                    $star_id
 * @property integer                                                                    $ship_type_id
 * @property integer                                                                    $energy
 * @property integer                                                                    $structure
 * @property integer                                                                    $credits
 * @property string                                                                     $name
 * @property \Carbon\Carbon                                                             $created_at
 * @property \Carbon\Carbon                                                             $updated_at
 * @property-read \Stellar\Models\User                                                  $owner
 * @property-read \Stellar\Models\Star                                                  $location
 * @property-read \Stellar\Models\ShipType                                              $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Models\Items\Item[] $items
 * @property-read int                                                                   $energy_capacity
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereStarId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereShipTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereEnergy($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereStructure($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereCredits($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereUpdatedAt($value)
 * @property-read mixed                                                                 $cargo_capacity
 * @property-read mixed                                                                 $shields
 * @property-read mixed                                                                 $armor
 * @property-read mixed                                                                 $kinetics
 * @property-read mixed                                                                 $beams
 * @property string                                                                     $star_name
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereStarName($value)
 * @mixin \Eloquent
 */
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
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
     * @return Ship
     */
    public function setEnergy($energy);


    /**
     * @param int $amount
     *
     * @return Ship
     */
    public function addEnergy($amount);


    /**
     * @param int $amount
     *
     * @return Ship
     */
    public function drainEnergy($amount);


    /**
     * @return Star
     */
    public function getLocation();


    /**
     * @param Star $location
     *
     * @return Ship
     */
    public function setLocation($location);


    /**
     * Unset location.
     */
    public function unsetLocation();


    /**
     * @return array
     */
    public function scanForJumpPoints();


    /**
     * @param Star $destination
     *
     * @return $this
     * @throws ShipException
     */
    public function jumpTo($destination);


    public function scanForShips();
}
