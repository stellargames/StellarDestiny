<?php
namespace Stellar\Api\Commands;

use Stellar\Api\Contracts\PlayerInterface;

abstract class Command
{

    protected $player;


    /**
     * Command constructor.
     *
     * @param \Stellar\Api\Contracts\PlayerInterface $player
     */
    public function __construct(PlayerInterface $player)
    {
        $this->player = $player;
    }
}
