<?php

namespace Stellar\Listeners;

use Stellar\Events\UserRegistered;

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
        $player = $event->user;
        if ($player->isPlayer()) {
            $player->setStartingShip();
        }
    }
}
