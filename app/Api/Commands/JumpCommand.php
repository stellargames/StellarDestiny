<?php

namespace Stellar\Api\Commands;

use Stellar\Api\Contracts\CommandInterface;
use Stellar\Api\Contracts\CommandResultInterface;
use Stellar\Api\Results\JumpCommandResult;
use Stellar\Facades\Galaxy;
use Stellar\Repositories\Contracts\StarInterface;

class JumpCommand implements CommandInterface
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
        $star = Galaxy::getStarByname($arguments['destination']);
        if (!$star instanceof StarInterface) {
            return $result->fail('Illegal destination provided');
        }

        return $result;
    }
}
