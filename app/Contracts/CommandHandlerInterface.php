<?php

namespace Stellar\Contracts;

interface CommandHandlerInterface
{

    /**
     * @param PlayerInterface   $player
     * @param string $command
     * @param array  $arguments
     *
     * @return \Stellar\Api\CommandResultInterface
     */
    public function handle($player, $command, array $arguments = []);
}
