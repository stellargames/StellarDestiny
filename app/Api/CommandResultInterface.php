<?php
namespace Stellar\Api;

interface CommandResultInterface
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
     * @param string $message
     *
     * @return \Stellar\Api\CommandResultInterface
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
     * @param string $key
     * @param string $item
     *
     * @return \Stellar\Api\CommandResultInterface
     */
    public function addItem($key, $item);


    /**
     * @return array
     */
    public function getMessages();


    /**
     * @param string $message
     *
     * @return \Stellar\Api\CommandResultInterface
     */
    public function addMessage($message);
}
