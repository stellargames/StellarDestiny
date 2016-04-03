<?php

namespace Stellar\Api\Results;

use Stellar\Api\CommandResultInterface;

abstract class CommandResult implements CommandResultInterface
{

    const STATUS_ERROR = false;
    const STATUS_OK = true;

    /**
     * @var bool
     */
    protected $status;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $messages;


    /**
     * CommandResult constructor.
     */
    public function __construct()
    {
        $this->status = self::STATUS_OK;
    }


    /**
     * @return bool
     */
    public function succeeded()
    {
        return $this->status === self::STATUS_OK;
    }


    /**
     * @return bool
     */
    public function failed()
    {
        return $this->status === self::STATUS_ERROR;
    }


    /**
     * Mark the result as a failure.
     *
     * @param $message
     *
     * @return \Stellar\Api\CommandResultInterface
     */
    public function fail($message)
    {
        $this->addMessage($message);
        $this->status = self::STATUS_ERROR;

        return $this;
    }


    /**
     * @param string $message
     *
     * @return \Stellar\Api\CommandResultInterface
     */
    public function addMessage($message)
    {
        $this->messages[] = $message;

        return $this;
    }


    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * @return bool
     */
    public function hasData()
    {
        return count($this->data) === 0;
    }


    /**
     * @param string $key
     * @param string $item
     *
     * @return \Stellar\Api\CommandResultInterface
     */
    public function addItem($key, $item)
    {
        $this->data[$key] = $item;

        return $this;
    }


    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

}
