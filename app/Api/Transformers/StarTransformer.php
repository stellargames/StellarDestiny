<?php

namespace Stellar\Api\Transformers;

use League\Fractal\TransformerAbstract;
use Stellar\Models\Ship;
use Stellar\Repositories\Contracts\StarInterface;

class StarTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        //'traders',
    ];


    public function transform(StarInterface $star)
    {
        $exits = [];
        foreach ($star->exits() as $exit) {
            $exits[] = $exit->name;
        }
        $ships = [];
        foreach (Ship::atLocation($star) as $ship) {
            $ships[$ship->id] = $ship->name;
        }

        return [
          'name'  => $star->getName(),
          'exits' => $exits,
          'ships' => $ships,
        ];
    }


    public function includeTraders(StarInterface $star)
    {
        $traders = $star->getTraders();

        return $this->collection($traders, new TraderTransformer);
    }

}
