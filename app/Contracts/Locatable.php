<?php
namespace Stellar\Contracts;

use Stellar\Star;

interface Locatable
{

    /**
     * @return Star
     */
    public function getLocation();
}
