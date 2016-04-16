<?php

namespace Stellar\Api;

use Stellar\Api\Contracts\CommandHandlerInterface;
use Stellar\Api\Contracts\PlayerInterface;
use Stellar\Exceptions\UnknownCommandException;

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
     * @return \Stellar\Api\Contracts\CommandResultInterface
     * @throws \Stellar\Exceptions\UnknownCommandException
     */
    public function handle($player, $command, array $arguments = [])
    {
        if (!array_key_exists($command, $this->commands)) {
            throw new UnknownCommandException('Unknown command: ' . $command);
        }
        /** @var \Stellar\Api\Contracts\CommandInterface $command */
        $command = new $this->commands[$command]($player);

        return $command->execute($arguments);
    }
}
