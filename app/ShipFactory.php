<?php

namespace Stellar;

use Stellar\Models\Items\CargoPod;
use Stellar\Models\Items\JumpStore;
use Stellar\Models\Ship;
use Stellar\Models\ShipType;
use Stellar\Models\Star;
use Stellar\Models\User;

class ShipFactory
{

    /**
     * Generate the starting ship for all players.
     *
     * @param User $player
     *
     * @return Ship
     */
    public static function getStartingShip(User $player)
    {
        $ship = new Ship([ 'name' => Ship::randomName() ]);
        // Start with an 'Explorer' class hip.
        $shipType = ShipType::whereName('Explorer')->first();
        $ship->type()->associate($shipType);
        // Place it at a random star.
        $star = Star::findStartLocation();
        $ship->location()->associate($star);
        // Give it to the player.
        $ship->owner()->associate($player);
        $ship->save();
        // Add a jumpstore and a cargo pod.
        $item = JumpStore::whereValue(1)->get()->random();
        $ship->items()->attach($item, [ 'amount' => 1 ]);
        $item = CargoPod::whereValue(1)->get()->random();
        $ship->items()->attach($item, [ 'amount' => 1 ]);
        // Start with a bit of money and full energy.
        $ship->credits   = 1000;
        $ship->energy    = $ship->energy_capacity;
        $ship->structure = $shipType->structure;

        return $ship;
    }
}
