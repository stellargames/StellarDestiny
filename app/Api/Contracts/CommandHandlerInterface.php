<?php

namespace Stellar\Api\Contracts;

interface CommandHandlerInterface
{

    /**
     * @param PlayerInterface $player
     * @param string          $command
     * @param array           $arguments
     *
     * @return \Stellar\Api\Contracts\CommandResultInterface
     */
    public function handle($player, $command, array $arguments = []);
}
