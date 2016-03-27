<?php

namespace Stellar\Api\Commands;

use League\Fractal\Resource\Item;
use Stellar\Api\CommandResult;
use Stellar\Contracts\CommandInterface;
use Stellar\Transformers\UserTransformer;

class InfoCommand implements CommandInterface
{

    public function execute(array $arguments = [ ]) {

        $result = new CommandResult();

        $player = auth()->user();

        $result->addItem('player', new Item($player, new UserTransformer));

        return $result;


    }
}
