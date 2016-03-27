<?php

namespace Stellar\Transformers;

use League\Fractal\TransformerAbstract;
use Stellar\Models\Ship;
use Stellar\Models\Star;

class StarTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        //'traders',
    ];


    public function transform(Star $star) {
        $exits = [ ];
        foreach ($star->exits as $exit) {
            $exits[] = $exit->name;
        }
        $ships = [ ];
        foreach (Ship::atLocation($star) as $ship) {
            $ships[$ship->id] = $ship->name;
        }

        return [
            'name'  => $star->name,
            'exits' => $exits,
            'ships' => $ships,
        ];
    }


    public function includeTraders(Star $star) {
        $traders = $star->traders;

        return $this->collection($traders, new TraderTransformer);
    }

}
