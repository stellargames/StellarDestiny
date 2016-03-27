<?php
namespace Stellar\Contracts;

interface CommandInterface
{

    /**
     * @param array $arguments
     *
     * @return CommandResultInterface
     */
    public function execute(array $arguments = [ ]);
}
