<?php

namespace Stellar\Api\Transformers;

class ArraySerializer extends \League\Fractal\Serializer\ArraySerializer
{

    const RESOURCE_EMBEDDED_KEY = 'embedded';


    /**
     * Serialize a collection.
     *
     * Use resourceKey 'embedded' to exclude the key in the response.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data)
    {
        return $resourceKey === self::RESOURCE_EMBEDDED_KEY ? $data : parent::collection($resourceKey, $data);
    }

}
