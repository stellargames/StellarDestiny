<?php

namespace Stellar\Transformers;

use League\Fractal\TransformerAbstract;
use Stellar\Models\User;

class UserTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'ship',
    ];


    public function transform(User $user) {
        return [
            'name'        => $user->name,
            'reputation'  => $user->reputation,
            'alignment'   => $user->alignment,
            'affiliation' => $user->affiliation,
        ];
    }


    public function includeShip(User $user) {
        $ship = $user->ship;

        return $this->item($ship, new ShipTransformer);
    }

}
