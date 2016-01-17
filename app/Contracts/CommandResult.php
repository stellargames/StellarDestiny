<?php
namespace Stellar\Contracts;

use League\Fractal\Resource\ResourceInterface;

interface CommandResult
{

    /**
     * @return bool
     */
    public function succeeded();


    /**
     * @return bool
     */
    public function failed();


    /**
     * Mark the result as a failure.
     *
     * @param $message
     *
     * @return \Stellar\Contracts\CommandResult
     */
    public function fail($message);


    /**
     * @return array
     */
    public function getData();


    /**
     * @return bool
     */
    public function hasData();


    /**
     * @param string            $key
     * @param ResourceInterface $item
     *
     * @return CommandResult
     */
    public function addItem($key, $item);


    /**
     * @return array
     */
    public function getMessages();


    /**
     * @param string $message
     *
     * @return \Stellar\Contracts\CommandResult
     */
    public function addMessage($message);
}
