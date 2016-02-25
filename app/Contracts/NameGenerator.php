<?php
namespace Stellar\Contracts;

interface NameGenerator
{

    /**
     * Generate a star name.
     *
     * @return string
     */
    public function generateName();
}
