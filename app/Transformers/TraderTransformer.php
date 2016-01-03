<?php

namespace Stellar\Transformers;

use League\Fractal\TransformerAbstract;

class TraderTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
    ];


    public function transform(Trader $trader) {
        return [
            'name' => $trader->name,
        ];
    }

}
