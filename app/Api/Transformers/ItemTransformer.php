<?php

namespace Stellar\Api\Transformers;

use League\Fractal\TransformerAbstract;
use Stellar\Models\Items\Item;

class ItemTransformer extends TransformerAbstract
{

    public function transform(Item $item)
    {
        $result = [
          'name'  => $item->name,
          'type'  => $item->type,
          'value' => $item->value,
        ];

        if (isset($item->pivot)) {
            $result['amount'] = (int)$item->pivot->amount;
            $result['paid']   = (int)$item->pivot->paid;
        }

        return $result;
    }

}
