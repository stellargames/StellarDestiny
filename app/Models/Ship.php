<?php

namespace Stellar\Models;

use Illuminate\Database\Eloquent\Model;
use Stellar\Contracts\LocatableInterface;
use Stellar\Exceptions\ShipException;

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
 * @property string $star_name
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereStarName($value)
 * @mixin \Eloquent
 */
class Ship extends Model implements LocatableInterface
{

    public $timestamps = true;

    protected $table = 'ships';

    protected $fillable = [ 'name' ];

    protected $hidden = [ 'user_id', 'star_name', 'ship_type_id', 'created_at', 'updated_at' ];

    protected $appends = [ 'energy_capacity', 'shields', 'armor', 'kinetics', 'beams' ];


    /**
     * The player that owns the ship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        return $this->belongsTo('Stellar\Models\User', 'user_id');
    }


    /**
     * The star the ship is currently at.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location() {
        return $this->belongsTo('Stellar\Models\Star', 'star_name');
    }


    /**
     * The type or class of ship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type() {
        return $this->belongsTo('Stellar\Models\ShipType', 'ship_type_id');
    }


    /**
     * The items installed on the ship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items() {
        return $this->belongsToMany('Stellar\Models\Items\Item')->withPivot('amount', 'paid');
    }


    /**
     * Calculate the total energy storage from the available jumpstores.
     *
     * @return int
     */
    public function getEnergyCapacityAttribute() {
        $capacity   = 10;
        $jumpStores = $this->items->where('type', 'JumpStore');
        foreach ($jumpStores as $jumpstore) {
            $capacity += 10 * $jumpstore->value;
        }

        return $capacity;
    }


    /**
     * Calculate the total shield capacity from the available shields.
     *
     * @return int
     */
    public function getShieldsAttribute() {
        $value = 0;
        $items = $this->items->where('type', 'Shield');
        foreach ($items as $item) {
            $value += $item->value;
        }

        return $value;
    }


    /**
     * Calculate the total armor value from the available armor items.
     *
     * @return int
     */
    public function getArmorAttribute() {
        $value = 0;
        $items = $this->items->where('type', 'Armor');
        foreach ($items as $item) {
            $value += $item->value;
        }

        return $value;
    }


    /**
     * Calculate the total power from the available kinetic weapons.
     *
     * @return int
     */
    public function getKineticsAttribute() {
        $value = 0;
        $items = $this->items->where('type', 'Kinetic Weapon');
        foreach ($items as $item) {
            $value += $item->value;
        }

        return $value;
    }


    /**
     * Calculate the total power value from the available beam weapons.
     *
     * @return int
     */
    public function getBeamsAttribute() {
        $value = 0;
        $items = $this->items->where('type', 'Beam Weapon');
        foreach ($items as $item) {
            $value += $item->value;
        }

        return $value;
    }


    /**
     * @return int
     */
    public function getEnergy() {
        return $this->energy;
    }


    /**
     * @param int $energy
     *
     * @return Ship
     */
    public function setEnergy($energy) {
        $this->energy = $energy;

        return $this;
    }


    /**
     * @param int $amount
     *
     * @return Ship
     */
    public function addEnergy($amount) {
        $this->energy += $amount;

        return $this;
    }


    /**
     * @param int $amount
     *
     * @return Ship
     */
    public function drainEnergy($amount) {
        $this->energy = $amount;

        return $this;
    }


    /**
     * @return Star
     */
    public function getLocation() {
        return $this->location;
    }


    /**
     * @param Star $location
     *
     * @return Ship
     */
    public function setLocation($location) {
        $this->location = $location;

        return $this;
    }


    /**
     * Unset location.
     */
    public function unsetLocation() {
        $this->location = null;
    }


    /**
     * @return array
     */
    public function scanForJumpPoints() {
        if ($this->location === null) {
            return [ ];
        }

        return $this->location->exits;
    }


    /**
     * @param Star $destination
     *
     * @return $this
     * @throws ShipException
     */
    public function jumpTo($destination) {
        if ($this->energy <= 0) {
            throw new ShipException('Not enough energy to make jump.');
        }
        $jumpPoints = $this->scanForJumpPoints();
        foreach ($jumpPoints as $jumpPoint) {
            if ($jumpPoint->name === $destination->name) {
                $this->setLocation($destination);
                $this->drainEnergy(1);

                return $this;
            }
        }
        throw new ShipException('No jumpPoint leading to destination found.');
    }


    public function scanForShips() {
        $star = $this->getLocation();
        return self::atLocation($star);
    }

    public static function atLocation(Star $star) {
        return Ship::whereStarName($star->name);
    }

}
