<?php

namespace Stellar\Transformers;

use League\Fractal\TransformerAbstract;
use Stellar\Models\Trader;

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
