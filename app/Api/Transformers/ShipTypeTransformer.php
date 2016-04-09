<?php

namespace Stellar\Api\Transformers;

use League\Fractal\TransformerAbstract;
use Stellar\Models\ShipType;

class ShipTypeTransformer extends TransformerAbstract
{

    public function transform(ShipType $shipType)
    {
        return [
          'name'        => $shipType->name,
          'description' => $shipType->description,
          'slots'       => (int)$shipType->slots,
          'structure'   => (int)$shipType->structure,
        ];
    }

}
