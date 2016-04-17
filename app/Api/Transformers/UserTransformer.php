<?php

namespace Stellar\Api\Transformers;

use League\Fractal\TransformerAbstract;
use Stellar\Api\Contracts\PlayerInterface;

class UserTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
      'ship',
    ];


    /**
     * @param \Stellar\Api\Contracts\PlayerInterface $player
     *
     * @return array
     */
    public function transform(PlayerInterface $player)
    {
        return [
          'name'        => $player->getName(),
          'reputation'  => $player->getReputation(),
          'alignment'   => $player->getAlignment(),
          'affiliation' => $player->getAffiliation(),
        ];
    }


    /**
     * @param \Stellar\Api\Contracts\PlayerInterface $player
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeShip(PlayerInterface $player)
    {
        $ship = $player->getShip();

        if ($ship === null) {
            return $this->null();
        }

        return $this->item($ship, new ShipTransformer());
    }

}
