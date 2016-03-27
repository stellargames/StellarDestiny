<?php
namespace Stellar\Contracts;

use Stellar\Models\Star;

interface LocatableInterface
{

    /**
     * @return Star
     */
    public function getLocation();
}
