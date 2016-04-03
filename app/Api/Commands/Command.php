<?php
namespace Stellar\Api\Commands;

use Stellar\Contracts\PlayerInterface;

abstract class Command
{

    protected $player;


    /**
     * Command constructor.
     *
     * @param \Stellar\Contracts\PlayerInterface $player
     */
    public function __construct(PlayerInterface $player)
    {
        $this->player = $player;
    }
}
