<?php

namespace Stellar\Api\Commands;

use Auth;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Stellar\Api\Results\InfoCommandResult;
use Stellar\Contracts\CommandInterface;
use Stellar\Transformers\ArraySerializer;
use Stellar\Transformers\UserTransformer;

class InfoCommand implements CommandInterface
{

    protected $fractal;


    /**
     * InfoCommand constructor.
     *
     * @param \League\Fractal\Manager $fractal
     */
    public function __construct()
    {
        $this->fractal = new Manager();
        $this->fractal->setSerializer(new ArraySerializer());
    }


    public function execute(array $arguments = [])
    {
        $result = new InfoCommandResult();

        $player = Auth::user();

        $item       = new Item($player, new UserTransformer);
        $playerData = $this->fractal->createData($item)->toArray();

        $result->addItem('player', $playerData);

        return $result;
    }
}
