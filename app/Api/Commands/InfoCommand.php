<?php

namespace Stellar\Api\Commands;

use League\Fractal\Resource\Item;
use Stellar\Api\Results\InfoCommandResult;
use Stellar\Api\Transformers\UserTransformer;

class InfoCommand extends Command
{

    public function execute(array $arguments = [])
    {
        $result = new InfoCommandResult();
        $player = $this->getPlayer($arguments);
        $result->addItem('player', new Item($player, new UserTransformer()));

        return $result;
    }
}
