<?php

namespace Stellar\Events;

use Illuminate\Queue\SerializesModels;
use Stellar\Models\User;

/**
 * Class UserRegistered
 * @package Stellar\Events
 */
class UserRegistered extends Event
{

    use SerializesModels;

    /**
     * @var User
     */
    public $user;


    /**
     * Create a new event instance.
     *
     * @param User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
    }


    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn() {
        return [ ];
    }
}
