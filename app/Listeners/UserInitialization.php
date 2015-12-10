<?php

namespace Stellar\Listeners;

use Stellar\Events\UserRegistered;
use Stellar\Models\Items\CargoPod;
use Stellar\Models\Items\Jumpstore;
use Stellar\Models\Ship;
use Stellar\Models\ShipType;
use Stellar\Models\Star;

class UserInitialization
{

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }


    /**
     * Handle the event.
     *
     * @param  UserRegistered $event
     *
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        // Give the player a ship.
        $shipType = ShipType::whereName('Explorer')->first();
        $star = Star::random()->first();
        $ship = new Ship($shipType, auth()->user(), $star, 'Serenity');
        $ship->credits = 1000;
        $ship->energy = 50;
        $ship->save();
        // Add a jumpstore and a cargo pod.
        $item = Jumpstore::whereValue(1)->get()->random();
        $ship->items()->attach($item, ['amount' => 1]);
        $item = CargoPod::whereValue(1)->get()->random();
        $ship->items()->attach($item, ['amount' => 1]);

     }
}
