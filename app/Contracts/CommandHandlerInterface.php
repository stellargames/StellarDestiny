<?php

namespace Stellar\Contracts;

interface CommandHandlerInterface
{

    /**
     * @param string $command
     * @param array  $arguments
     *
     * @return \Stellar\Contracts\CommandResultInterface
     */
    public function handle($command, array $arguments = [ ]);
}
