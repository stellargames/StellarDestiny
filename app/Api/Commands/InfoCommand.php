<?php

namespace Stellar\Api\Commands;

use Stellar\Api\Results\InfoCommandResult;

class InfoCommand extends Command
{

    public function execute(array $arguments = [])
    {
        $result = new InfoCommandResult();

        $result->addItem('player', $this->player);

        return $result;
    }
}
