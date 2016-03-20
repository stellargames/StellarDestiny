<?php
namespace Stellar\Contracts;

interface Command
{

    /**
     * @param array $arguments
     *
     * @return CommandResult
     */
    public function execute(array $arguments = [ ]);
}
