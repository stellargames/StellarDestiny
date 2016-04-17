<?php
namespace Stellar\Api\Commands;

use Stellar\Api\Contracts\CommandInterface;
use Stellar\Api\Contracts\PlayerInterface;
use Stellar\Repositories\Contracts\StarRepositoryInterface;

abstract class Command implements CommandInterface
{

    // Code common to all commands can go here.

    /**
     * @param array $arguments
     *
     * @return StarRepositoryInterface
     * @throws \InvalidArgumentException
     */
    protected function getGalaxy(array $arguments)
    {
        if (!array_key_exists('galaxy', $arguments) || !$arguments['galaxy'] instanceof StarRepositoryInterface) {
            throw new \InvalidArgumentException('Could not determine galaxy');
        }
        return $arguments['galaxy'];
    }


    /**
     * @param array $arguments
     *
     * @return PlayerInterface
     * @throws \InvalidArgumentException
     */
    protected function getPlayer(array $arguments)
    {
        if (!array_key_exists('player', $arguments) || !$arguments['player'] instanceof PlayerInterface) {
            throw new \InvalidArgumentException('Could not determine player');
        }
        return $arguments['player'];
    }
}
