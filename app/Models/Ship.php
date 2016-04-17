<?php

namespace Stellar\Models;

use Illuminate\Database\Eloquent\Model;
use Stellar\Api\Contracts\PlayerInterface;
use Stellar\Api\Contracts\ShipInterface;
use Stellar\Contracts\LocatableInterface;
use Stellar\Exceptions\ShipException;
use Stellar\Repositories\Contracts\StarInterface;

class Ship extends Model implements LocatableInterface, ShipInterface
{

    public $timestamps = true;

    protected $table = 'ships';

    protected $fillable = ['name'];

    protected $hidden = [
      'user_id',
      'star_name',
      'ship_type_id',
      'created_at',
      'updated_at',
    ];

    protected $appends = [
      'energy_capacity',
      'shields',
      'armor',
      'kinetics',
      'beams',
    ];


    /**
     * The player that owns the ship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('Stellar\Models\User', 'user_id');
    }


    /**
     * The star the ship is currently at.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('Stellar\Models\Star', 'star_name');
    }


    /**
     * The type or class of ship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('Stellar\Models\ShipType', 'ship_type_id');
    }


    /**
     * The items installed on the ship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany('Stellar\Models\Items\Item')->withPivot('amount', 'paid');
    }


    /**
     * Calculate the total energy storage from the available jumpstores.
     *
     * @return int
     */
    public function getEnergyCapacityAttribute()
    {
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
    public function getShieldsAttribute()
    {
        $items = $this->items->where('type', 'Shield');
        return $this->calculateItemsValue($items);
    }


    /**
     * Calculate the total armor value from the available armor items.
     *
     * @return int
     */
    public function getArmorAttribute()
    {
        $items = $this->items->where('type', 'Armor');
        return $this->calculateItemsValue($items);
    }


    /**
     * Calculate the total power from the available kinetic weapons.
     *
     * @return int
     */
    public function getKineticsAttribute()
    {
        $items = $this->items->where('type', 'Kinetic Weapon');
        return $this->calculateItemsValue($items);
    }


    /**
     * Calculate the total power value from the available beam weapons.
     *
     * @return int
     */
    public function getBeamsAttribute()
    {
        $items = $this->items->where('type', 'Beam Weapon');
        return $this->calculateItemsValue($items);
    }


    /**
     * @return int
     */
    public function getEnergy()
    {
        return $this->energy;
    }


    /**
     * @param int $energy
     *
     * @return Ship
     */
    public function setEnergy($energy)
    {
        $this->energy = $energy;

        return $this;
    }


    /**
     * @param int $amount
     *
     * @return Ship
     */
    public function addEnergy($amount)
    {
        $this->energy += $amount;

        return $this;
    }


    /**
     * @param int $amount
     *
     * @return ShipInterface
     */
    public function drainEnergy($amount)
    {
        $this->energy -= $amount;

        return $this;
    }


    /**
     * @return StarInterface
     */
    public function getLocation()
    {
        return $this->location;
    }


    /**
     * @param StarInterface $location
     *
     * @return ShipInterface
     */
    public function setLocation(StarInterface $location)
    {
        $this->location = $location;

        return $this;
    }


    /**
     * Unset location.
     */
    public function unsetLocation()
    {
        $this->location = null;
        return $this;
    }


    /**
     * @return array
     */
    public function scanForJumpPoints()
    {
        if ($this->location === null) {
            return [];
        }

        return $this->location->getJumpPoints();
    }


    /**
     * @param StarInterface $destination
     *
     * @return $this
     * @throws ShipException
     */
    public function jumpTo(StarInterface $destination)
    {
        if ($this->energy <= 0) {
            throw new ShipException('Not enough energy to make jump.');
        }
        $jumpPoints = $this->scanForJumpPoints();
        foreach ($jumpPoints as $jumpPoint) {
            if ($jumpPoint['name'] === $destination->getName()) {
                $this->setLocation($destination);
                $this->drainEnergy(1);

                return $this;
            }
        }
        throw new ShipException('No jumpPoint leading to destination found.');
    }


    public function scanForShips()
    {
        $star = $this->getLocation();
        return self::atLocation($star);
    }


    public static function atLocation(StarInterface $star)
    {
        return Ship::whereStarName($star->getName());
    }


    /**
     * Calculate the total energy storage from the available jumpstores.
     *
     * @return int
     */
    public function getEnergyCapacity()
    {
        return $this->energyCapacity;
    }


    /**
     * Calculate the total shield capacity from the available shields.
     *
     * @return int
     */
    public function getShields()
    {
        return $this->shields;
    }


    /**
     * Calculate the total armor value from the available armor items.
     *
     * @return int
     */
    public function getArmor()
    {
        return $this->armor;
    }


    /**
     * Calculate the total power from the available kinetic weapons.
     *
     * @return int
     */
    public function getKinetics()
    {
        return $this->kinetics;
    }


    /**
     * Calculate the total power value from the available beam weapons.
     *
     * @return int
     */
    public function getBeams()
    {
        return $this->beams;
    }


    /**
     * @param $items
     *
     * @return int
     */
    protected function calculateItemsValue($items)
    {
        $value = 0;
        foreach ($items as $item) {
            $value += $item->value;
        }

        return $value;
    }


    /**
     * The type or class of ship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * The items installed on the ship.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items->toArray();
    }


    /**
     * The player that owns the ship.
     *
     * @return PlayerInterface
     */
    public function getOwner()
    {
        return $this->owner;
    }


    /**
     * The items installed on the ship.
     *
     * @return array
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Get the amount of structure points this ship has.
     *
     * @return int
     */
    public function getStructure()
    {
        return $this->type->structure;
    }


    /**
     * Get the amount of credits store on this ship.
     *
     * @return int
     */
    public function getCredits()
    {
        return $this->credits;
    }
}
