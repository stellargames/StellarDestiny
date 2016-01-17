<?php

namespace Stellar\Api;

class CommandHandler implements \Stellar\Contracts\CommandHandler
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
     * @return \Stellar\Contracts\CommandResult
     */
    public function handle($command, $arguments = [ ]) {
        if ( ! isset($this->commands[$command])) {
            throw new \InvalidArgumentException('Unknown command ' . $command);
        }
        $command = new $this->commands[$command];

        $result = $command->execute($arguments);

        return $result;
    }
}
