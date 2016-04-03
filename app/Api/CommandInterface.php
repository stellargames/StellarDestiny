<?php
namespace Stellar\Api;

interface CommandInterface
{

    /**
     * @param array $arguments
     *
     * @return \Stellar\Api\CommandResultInterface
     */
    public function execute(array $arguments = []);
}
