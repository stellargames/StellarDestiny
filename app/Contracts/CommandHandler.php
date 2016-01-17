<?php

namespace Stellar\Contracts;

interface CommandHandler
{

    /**
     * @param string $command
     * @param array  $arguments
     *
     * @return \Stellar\Contracts\CommandResult
     */
    public function handle($command, $arguments = [ ]);
}
