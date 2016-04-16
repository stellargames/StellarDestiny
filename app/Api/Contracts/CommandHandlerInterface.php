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
     * @throws \Stellar\Exceptions\UnknownCommandException
     */
    public function handle($player, $command, array $arguments = []);
}
