<?php

namespace Stellar\Api;

use Stellar\Contracts\CommandHandlerInterface;
use Stellar\Contracts\CommandInterface;

class CommandHandler implements CommandHandlerInterface
{

    /**
     * @var array
     */
    protected $commands;


    /**
     * CommandHandler constructor.
     *
     * @param $commands
     */
    public function __construct($commands) {
        $this->commands = $commands;
    }


    /**
     * Handle the execution of the specified command.
     *
     * @param string $command   The command to execute.
     * @param array  $arguments [optional] arguments for the command.
     *
     * @return \Stellar\Contracts\CommandResultInterface
     */
    public function handle($command, array $arguments = [ ]) {
        if ( ! array_key_exists($command, $this->commands)) {
            return null;
        }
        /** @var CommandInterface $command */
        $command = new $this->commands[$command];

        $result = $command->execute($arguments);

        return $result;
    }
}
