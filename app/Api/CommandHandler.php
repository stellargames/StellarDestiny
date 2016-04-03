<?php

namespace Stellar\Api;

use Stellar\Contracts\CommandHandlerInterface;
use Stellar\Contracts\PlayerInterface;

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
    public function __construct($commands)
    {
        $this->commands = $commands;
    }


    /**
     * Handle the execution of the specified command.
     *
     * @param PlayerInterface $player
     * @param string          $command   The command to execute.
     * @param array           $arguments [optional] arguments for the command.
     *
     * @return \Stellar\Api\CommandResultInterface
     */
    public function handle($player, $command, array $arguments = [])
    {
        if (!array_key_exists($command, $this->commands)) {
            return null;
        }
        /** @var \Stellar\Api\CommandInterface $command */
        $command = new $this->commands[$command]($player);

        return $command->execute($arguments);
    }
}
