<?php

namespace Stellar\Api\Commands;

use Stellar\Api\Contracts\CommandResultInterface;
use Stellar\Api\Results\JumpCommandResult;
use Stellar\Repositories\Contracts\StarInterface;

class JumpCommand extends Command
{

    /**
     * @param array $arguments
     *
     * @return CommandResultInterface
     */
    public function execute(array $arguments = [])
    {
        $result = new JumpCommandResult();
        if (!array_key_exists('destination', $arguments)) {
            return $result->fail('No destination provided');
        }
        try {
            $galaxy = $this->getGalaxy($arguments);
        } catch (\InvalidArgumentException $e) {
            return $result->fail($e->getMessage());
        }
        $star = $galaxy->getStarByName($arguments['destination']);
        if (!$star instanceof StarInterface) {
            return $result->fail('Illegal destination provided');
        }
        try {
            $player = $this->getPlayer($arguments);
        } catch (\InvalidArgumentException $e) {
            return $result->fail($e->getMessage());
        }
        $ship       = $player->getShip();
        $jumpPoints = $ship->scanForJumpPoints();
        if (!in_array($star, $jumpPoints, false)) {
            return $result->fail('Illegal destination provided');
        }

        if ($ship->getEnergy() < 1) {
            return $result->fail('Insufficient energy');
        }

        $ship->setLocation($star);

        return $result;
    }
}
