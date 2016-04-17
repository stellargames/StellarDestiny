<?php

namespace Stellar\Api\Contracts;

interface CommandHandlerInterface
{

    /**
     * @param string $command
     * @param array  $arguments
     *
     * @return \Stellar\Api\Contracts\CommandResultInterface
     * @throws \Stellar\Exceptions\UnknownCommandException
     */
    public function handle($command, array $arguments = []);
}
