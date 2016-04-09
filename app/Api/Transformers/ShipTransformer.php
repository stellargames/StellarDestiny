<?php

namespace Stellar\Api\Transformers;

use League\Fractal\TransformerAbstract;
use Stellar\Models\Ship;

class ShipTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
      'type',
      'location',
      'items',
    ];


    public function transform(Ship $ship)
    {
        return [
          'name'           => $ship->name,
          'energy'         => $ship->energy,
          'structure'      => $ship->structure,
          'credits'        => $ship->credits,
          'energyCapacity' => $ship->energy_capacity,
          'shields'        => $ship->shields,
          'armor'          => $ship->armor,
          'kinetics'       => $ship->kinetics,
          'beams'          => $ship->beams,
          'itemCount'      => count($ship->items),
        ];
    }


    public function includeType(Ship $ship)
    {
        $type = $ship->type;

        return $this->item($type, new ShipTypeTransformer);
    }


    public function includeLocation(Ship $ship)
    {
        $star = $ship->location;

        return $this->item($star, new StarTransformer);
    }


    public function includeItems(Ship $ship)
    {
        $items = $ship->items;

        return $this->collection($items, new ItemTransformer, 'embedded');
    }

}
