<?php
namespace Stellar\Api\Contracts;

interface CommandInterface
{

    /**
     * @param array $arguments
     *
     * @return \Stellar\Api\Contracts\CommandResultInterface
     */
    public function execute(array $arguments = []);
}
