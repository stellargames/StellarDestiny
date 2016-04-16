<?php
namespace Stellar\Contracts;

use Stellar\Repositories\Contracts\StarInterface;

interface LocatableInterface
{

    /**
     * @return StarInterface
     */
    public function getLocation();
}
