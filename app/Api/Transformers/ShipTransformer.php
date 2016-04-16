<?php

namespace Stellar\Api\Transformers;

use League\Fractal\TransformerAbstract;
use Stellar\Api\Contracts\ShipInterface;

class ShipTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
      'type',
      'location',
      'items',
    ];


    public function transform(ShipInterface $ship)
    {
        return [
          'name'           => $ship->getName(),
          'energy'         => $ship->getEnergy(),
          'structure'      => $ship->getStructure(),
          'credits'        => $ship->getCredits(),
          'energyCapacity' => $ship->getEnergyCapacity(),
          'shields'        => $ship->getShields(),
          'armor'          => $ship->getArmor(),
          'kinetics'       => $ship->getKinetics(),
          'beams'          => $ship->getBeams(),
          'itemCount'      => count($ship->getItems()),
        ];
    }


    public function includeType(ShipInterface $ship)
    {
        $type = $ship->getType();

        return $this->item($type, new ShipTypeTransformer);
    }


    public function includeLocation(ShipInterface $ship)
    {
        $star = $ship->getLocation();

        return $this->item($star, new StarTransformer);
    }


    public function includeItems(ShipInterface $ship)
    {
        $items = $ship->getItems();

        return $this->collection($items, new ItemTransformer, 'embedded');
    }

}
