<?php

namespace Stellar\Listeners;

use Stellar\Events\UserRegistered;
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
        $shipType = ShipType::whereName('Explorer')->first();
        $star = Star::random()->first();
        $ship = new Ship($shipType, $event->user, $star, 'Serenity');
        $ship->credits = 1000;
        $ship->items->add(new Jumpstore());
        $ship->energy = 50;
        $ship->save();
    }
}
