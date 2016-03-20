<?php
namespace Stellar\Contracts;

use Stellar\Models\Star;

interface Locatable
{

    /**
     * @return Star
     */
    public function getLocation();
}
